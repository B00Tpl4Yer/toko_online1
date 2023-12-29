<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\stok;
use App\Models\Order;
use App\Models\Cart;
use App\Models\Pembayaran;
use App\Models\order_item;
use App\Models\metodepembayaran;
use App\Models\metodepengiriman;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:user');
    }




    // Menghapus produk dari keranjang belanja
    public function removeFromCart(Request $request, Cart $cartItem)
    {
        // Validasi apakah user yang sedang login adalah pemilik keranjang
        if (!$cartItem || $cartItem->user_id !== auth()->id()) {
            abort(403, 'Unauthorized');
        }

        // Mengembalikan stok produk yang dihapus
        $stok = $cartItem->stock;

        // Check if $stok is not null before calling increment
        if ($stok) {
            $stok->increment('jumlah_produk', $cartItem->quantity);
            $cartItem->delete();

        }


        // Hapus produk dari keranjang
        $cartItem->delete();

        // Redirect atau tampilkan view keranjang belanja
        return redirect()->route('cart.index')->with('success', 'Produk dihapus dari keranjang');
    }

    public function viewCart()
    {
        $userId = auth()->id();
        $cartItems = Cart::where('user_id', $userId)->get();
        return view('user.keranjang.index', compact('cartItems'));
    }

    public function checkout(Request $request)
    {
        // Mendapatkan produk yang ada di keranjang pengguna
        $cartItems = Cart::with('stock')->where('user_id', auth()->id())->get();

        // Grupkan produk berdasarkan stok_id untuk menggabungkan barang dengan id yang sama
        $groupedCartItems = $cartItems->groupBy('stok_id');

        // Buat order baru
        $randomSlug = Str::slug(Str::random(8));
        while (Order::where('slug', $randomSlug)->exists()) {
            $randomSlug = Str::slug(Str::random(8));
        }

        $order = Order::create([
            'user_id' => auth()->id(),
            'status' => 'belum bayar',
            'slug' => $randomSlug,
        ]);

        foreach ($groupedCartItems as $stokId => $group) {
            $totalQuantity = 0;

            foreach ($group as $cartItem) {
                // Mendapatkan jumlah yang dipilih untuk setiap produk di keranjang
                $selectedQuantity = $cartItem->quantity;

                // Validasi bahwa jumlah yang dipilih tidak melebihi jumlah barang di keranjang
                if ($selectedQuantity > $cartItem->stock->jumlah_produk) {
                    return back()->with('error', 'Jumlah yang dipilih melebihi jumlah barang di keranjang');
                }

                // Tambahkan jumlah produk
                $totalQuantity += $selectedQuantity;

                // Kurangkan stok produk di keranjang
                $cartItem->stock->decrement('jumlah_produk', $selectedQuantity);

                // Hapus barang dari keranjang
                $cartItem->delete();

                // Tambahkan produk ke dalam order_item
                Order_Item::create([
                    'order_id' => $order->id,
                    'stok_id' => $stokId,
                    'quantity' => $selectedQuantity,
                ]);
            }
        }

        return redirect()->route('status')->with('success', 'Barang berhasil dipindahkan ke pesanan');
    }

    public function status()
    {
        $user_id = auth()->id();

        $belumbayar = Order::where('user_id', $user_id)->where('status', 'belum bayar')->count();
        $barangdikirim = Order::where('user_id', $user_id)->whereIn('status', ['menunggu pengiriman', 'barang dikirim'])->count();
        $barangditerima = Order::where('user_id', $user_id)->where('status', 'barang diterima')->count();

        $show = Order::where('user_id', $user_id)->get();

        return view('user.status.index', compact('belumbayar', 'barangdikirim', 'barangditerima', 'show'));
    }



    public function paymentForm(Order $order)
    {
        $userId = auth()->id();

        $orderItems = order_item::with('stock')
            ->whereHas('order', function ($query) use ($userId, $order) {
                $query->where('user_id', $userId)->where('id', $order->id); // Menambahkan kondisi order ID
            })
            ->get();

        // Menghitung total harga_produk dari orderan user
        $totalHargaProduk = $orderItems->sum(function ($orderItem) {
            return $orderItem->stock->harga_produk * $orderItem->quantity;
        });

        // Cek apakah pengguna sudah memilih metode pembayaran sebelumnya
        if ($order->pembayaran && $order->pembayaran->status != 'ditolak') {
            return redirect()->back()->with('error', 'Anda sudah memilih metode pembayaran sebelumnya.');
        }

        return view('user.payment.form', compact('order', 'orderItems', 'totalHargaProduk'));
    }


    // public function indexbank() {
    //     $bank = metodepembayaran::all();
    // return view ('user.payment.transfer_info',compact('bank'));
    // }



    public function processPayment(Request $request, Order $order)
    {
        if ($order->pembayaran && $order->pembayaran->status !== 'ditolak') {
            return redirect()->route('index')->with('error', 'Anda sudah memilih metode pembayaran sebelumnya.');
        }

        $request->validate([
            'payment_method' => 'required|in:COD,transfer',
        ]);

        $metodePembayaran = $request->input('payment_method');

        if ($metodePembayaran == 'COD') {
            // Simpan data pembayaran COD
            $order->pembayaran()->create([
                'metode_pembayaran' => 'COD',
                'status' => 'menunggu',
            ]);

            // Ubah status order menjadi "menunggu pembayaran"
            // $order->update(['status' => 'menunggu pembayaran']);

            return redirect()->route('index')->with('success', 'Pesanan berhasil ditempatkan. Tunggu verifikasi pembayaran.');
        } elseif ($metodePembayaran == 'transfer') {
            $rekening = metodepembayaran::all();
            return view('user.payment.transfer_info', compact('order', 'rekening'));
        }

        return back()->with('error', 'Metode pembayaran tidak valid.');
    }

    public function uploadPaymentProofForm(Order $order)
    {

        // Cek apakah pengguna sudah mengupload bukti pembayaran sebelumnya
        if ($order->pembayaran && $order->pembayaran->status != 'ditolak') {
            return redirect()->route('index')->with('error', 'Anda sudah mengupload bukti pembayaran sebelumnya.');
        }

        return view('user.payment.upload_proof_form', compact('order'));
    }

    public function uploadPaymentProof(Request $request, Order $order)
    {
        // Cek apakah pengguna sudah mengupload bukti pembayaran sebelumnya
        if ($order->pembayaran && $order->pembayaran->status != 'ditolak') {
            return redirect()->route('index')->with('error', 'Anda sudah mengupload bukti pembayaran sebelumnya.');
        }

        $request->validate([
            'bukti_pembayaran' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Upload bukti pembayaran
        $buktiPembayaran = $request->file('bukti_pembayaran');
        $buktiName = time() . '.' . $buktiPembayaran->getClientOriginalExtension();
        $buktiPembayaran->move(public_path('payment_proofs'), $buktiName);

        // Simpan data pembayaran
        $order->pembayaran()->create([
            'metode_pembayaran' => 'transfer',
            'bukti_pembayaran' => $buktiName,
            'status' => 'menunggu',
        ]);

        // Ubah status order menjadi "menunggu verifikasi pembayaran"
        // $order->update(['status' => 'menunggu verifikasi pembayaran']);

        return redirect()->route('index')->with('success', 'Bukti pembayaran berhasil diupload. Tunggu verifikasi pembayaran.');
    }

    public function SendForm(Order $order)
    {
        $userId = auth()->id();

        $orderItems = order_item::with('stock')
            ->whereHas('order', function ($query) use ($userId, $order) {
                $query->where('user_id', $userId)->where('id', $order->id); // Menambahkan kondisi order ID
            })
            ->get();
                // Menghitung total harga_produk dari orderan user
                $totalHargaProduk = $orderItems->sum(function ($orderItem) {
                    return $orderItem->stock->harga_produk * $orderItem->quantity;
                });

        // Cek apakah pengguna sudah memilih metode pembayaran sebelumnya
        if ($order->status !== 'menunggu pengiriman') {
            return redirect()->back()->with('error', 'Anda tidak dapat mengakses order ini.');
        }

        return view('user.Send.fom', compact('order', 'orderItems' ,'totalHargaProduk'));
    }

    public function processSend(Request $request, Order $order)
    {
        if ($order->status !== 'menunggu pengiriman') {
            return redirect()->route('index')->with('error', 'Anda tidak dapat mengakses order ini.');
        }

        $request->validate([
            'payment_method' => 'required|in:COD,pengiriman',
        ]);

        $metode_pengiriman = $request->input('payment_method');

        if ($metode_pengiriman == 'COD') {
            $order->update(['status' => 'barang dikirim']);
            $order->pengiriman()->create([
                'metode_pengiriman' => 'COD',
                'status' => 'menunggu',
            ]);

            // Ubah status order menjadi "menunggu pembayaran"
            // $order->update(['status' => 'menunggu pembayaran']);

            return redirect()->route('index')->with('success', 'silahkan ambil barang anda di toko.');
        }elseif ($metode_pengiriman == 'pengiriman') {
            $order->update(['status' => 'barang dikirim']);

            // Mendapatkan pengguna yang sedang membuat pesanan
            $user = Auth::user();

            // Periksa apakah pengguna sudah memiliki metode pengiriman
            if (!$user->metodePengiriman()->exists()) {
                // Jika belum, pilih metode pengiriman secara acak dan hubungkan dengan pengguna
                $availableMethods = MetodePengiriman::all();

                // Pastikan ada metode pengiriman yang tersedia
                if ($availableMethods->isEmpty()) {
                    return redirect()->route('index')->with('error', 'Tidak ada metode pengiriman yang tersedia.');
                }

                // Pilih salah satu metode pengiriman secara acak
                $selectedMethod = $availableMethods->random();

                // Simpan metode pengiriman yang dipilih ke pengguna
                $user->metodePengiriman()->attach($selectedMethod->id);
            }

            // Mendapatkan metode pengiriman yang telah ditentukan untuk pengguna
            $rekening = $user->metodePengiriman()->first();
            $order->pengiriman()->create([
                'metode_pengiriman' => 'pengiriman',
                'status' => 'menunggu',
            ]);

            return view('user.send.process', compact('order', 'rekening'));
        }


        return back()->with('error', 'Metode pembayaran tidak valid.');
    }
    public function seesend() {
        $user = Auth::user();
        $rekening = $user->metodePengiriman()->first();
        return view('user.send.process', compact('rekening'));
    }


}



// elseif ($metode_pengiriman == 'pengiriman') {
//     $order->update(['status' => 'barang dikirim']);

//     // Ambil semua metode pengiriman yang tersedia
//     $availableMethods = MetodePengiriman::all();

//     // Pastikan ada metode pengiriman yang tersedia
//     if ($availableMethods->isEmpty()) {
//         return back()->with('error', 'Tidak ada metode pengiriman yang tersedia.');
//     }

//     // Ambil metode pengiriman secara acak
//     $selectedMethod = $availableMethods->random();

//     // Buat entri pengiriman untuk pesanan
//     $order->pengiriman()->create([
//         'metode_pengiriman' => $selectedMethod->nama_kurir,
//         'status' => 'menunggu',
//     ]);

//     // Simpan metode pengiriman yang dipilih ke pengguna
//     $user = Auth::user();
//     $user->metodePengiriman()->attach($selectedMethod->id);

//     return view('user.send.process', compact('order', 'selectedMethod'));
// }
