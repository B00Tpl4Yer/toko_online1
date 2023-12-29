<?php

namespace App\Http\Controllers;

use App\Models\metodepengiriman;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\stok;
use App\Models\Order;
use App\Services\OperatorService;
use App\Models\Pembayaran;
use App\Models\order_items;
use Illuminate\Support\Str;
use App\Models\metodepembayaran;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class OperatorController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:operator');
    }



    public function create()
    {
        return view('operator.stock.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_produk' => 'required',
            'harga_produk' => 'required|numeric',
            'informasi_produk' => 'required',
            'deskripsi_produk' => 'required',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:10048',
            'jumlah_produk' => 'required|numeric',
            'slug' => 'nullable|unique:stoks,slug',
        ]);

        // Upload foto jika ada

        // if ($request->hasFile('foto')) {
        //     $fotoName = Storage::putFileAs('images', $request->file('foto'), time().'.'.$request->file('foto')->extension());

        // }
        $fotoName = $request->file('foto')->store('public/images');
        $slug = $request->input('slug') ?: Str::slug($request->input('nama_produk'));

        // Simpan data ke database
        stok::create([
            'nama_produk' => $request->input('nama_produk'),
            'harga_produk' => $request->input('harga_produk'),
            'informasi_produk' => $request->input('informasi_produk'),
            'deskripsi_produk' => $request->input('deskripsi_produk'),
            'foto' => $fotoName,
            'jumlah_produk' => $request->input('jumlah_produk'),
            'slug' => $slug,
        ]);

        return redirect()->route('index')->with('success', 'Produk berhasil ditambahkan');
    }
    public function edit(stok $stok)
    {
        return view('operator.stock.edit', compact('stok'));
    }

    public function update(Request $request, stok $stok)
    {
        $request->validate([
            'nama_produk' => 'required',
            'harga_produk' => 'required|numeric',
            'informasi_produk' => 'required',
            'deskripsi_produk' => 'required',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:10048',
            'jumlah_produk' => 'required|numeric',
            'slug' => 'nullable|unique:stoks,slug,' . $stok->id,
        ]);

        // Upload foto jika ada
        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($stok->foto) {
                Storage::delete($stok->foto);
            }

            $fotoName = $request->file('foto')->store('public/images');
        } else {
            $fotoName = $stok->foto;
        }

        $slug = $request->input('slug') ?: Str::slug($request->input('nama_produk'));

        // Update data ke database
        $stok->update([
            'nama_produk' => $request->input('nama_produk'),
            'harga_produk' => $request->input('harga_produk'),
            'informasi_produk' => $request->input('informasi_produk'),
            'deskripsi_produk' => $request->input('deskripsi_produk'),
            'foto' => $fotoName,
            'jumlah_produk' => $request->input('jumlah_produk'),
            'slug' => $slug,
        ]);

        return redirect()->route('index')->with('success', 'Produk berhasil diperbarui');
    }

    public function destroy(stok $stok)
    {
        // Hapus foto jika ada
        if ($stok->foto) {
            Storage::delete($stok->foto);
        }

        // Hapus data dari database
        $stok->delete();

        return redirect()->route('index')->with('success', 'Produk berhasil dihapus');
    }

    public function showOrder()
    {
        $orders = Order::with(['user', 'pembayaran', 'pengiriman'])->get();
        return view('operator.payment.showpayment', compact('orders'));
    }

    public function viewPaymentProof(Order $order)
    {
        if ($order->pembayaran->status != 'menunggu') {
            return redirect()->route('index')->with('error', 'Pembayaran sudah diverifikasi sebelumnya.');
        }
        return view('operator.payment.view_proof', compact('order'));
    }

    public function verifyPayment(Request $request, Order $order)
    {
        $request->validate([
            'verification_status' => 'required|in:diverifikasi,ditolak',
        ]);

        $statusVerifikasi = $request->input('verification_status');

        // Cek apakah pembayaran sudah diverifikasi sebelumnya
        if ($order->pembayaran->status != 'menunggu') {
            return redirect()->route('index')->with('error', 'Pembayaran sudah diverifikasi sebelumnya.');
        }

        // Update status verifikasi pembayaran
        $order->pembayaran->update([
            'status' => $statusVerifikasi,
        ]);

        // Update status order berdasarkan verifikasi pembayaran
        if ($statusVerifikasi == 'diverifikasi') {
            $order->update(['status' => 'menunggu pengiriman']);
        } elseif ($statusVerifikasi == 'ditolak') {
            $order->pembayaran->update(['status' => 'ditolak']);

            return redirect()->route('index')->with('error', 'Maaf, pembayaran Anda ditolak.');
        }

        return redirect()->route('index')->with('success', 'Verifikasi pembayaran berhasil dilakukan.');
    }

    public function indexbank()
    {
        $bank = metodepembayaran::all();
        $send = metodepengiriman::all();
        return view('operator.payment.bank', compact('bank', 'send'));
    }
    public function indexsend()
    {
        $bank = metodepengiriman::all();
        return view('operator.send.showsend', compact('bank'));
    }
    public function createBankAccount()
    {
        return view('operator.payment.create');
    }

    public function addBankAccount(Request $request)
    {
        $request->validate([
            'nama_bank' => 'required|string',
            'nama_rekening' => 'required|string',
            'nomor_rekening' => 'required|string',
            'qrcode' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        // Upload foto jika ada
        if ($request->hasFile('qrcode')) {
            $qrcode = $request->file('qrcode');
            $fotoName = time() . '.' . $qrcode->getClientOriginalExtension();
            $qrcode->move(public_path('QRcode'), $fotoName);
        } else {
            $fotoName = null;
        }

        metodepembayaran::create([
            'nama_bank' => $request->input('nama_bank'),
            'nama_rekening' => $request->input('nama_rekening'),
            'nomor_rekening' => $request->input('nomor_rekening'),
            'qrcode' => $fotoName,
        ]);

        return redirect()->route('operator.bank.index')->with('success', 'Rekening bank berhasil ditambahkan.');
    }
    public function editBankAccount(metodepembayaran $pembayaran)
    {
        return view('operator.payment.edit', compact('pembayaran'));
    }
    public function updateBankAccount(Request $request, metodepembayaran $pembayaran)
    {
        $request->validate([
            'nama_bank' => 'required|string',
            'nama_rekening' => 'required|string',
            'nomor_rekening' => 'required|string',
            'qrcode' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Initialize the file name
        $fotoName = $pembayaran->qrcode;

        // Upload new photo if provided
        if ($request->hasFile('qrcode')) {
            $qrcode = $request->file('qrcode');
            $fotoName = time() . '.' . $qrcode->getClientOriginalExtension();
            $qrcode->move(public_path('QRcode'), $fotoName);

            // Delete the old file if it exists
            $oldFilePath = public_path('QRcode/' . $pembayaran->qrcode);
            if (file_exists($oldFilePath)) {
                unlink($oldFilePath);
            }
        }

        $pembayaran->update([
            'nama_bank' => $request->input('nama_bank'),
            'nama_rekening' => $request->input('nama_rekening'),
            'nomor_rekening' => $request->input('nomor_rekening'),
            'qrcode' => $fotoName,
        ]);

        return redirect()->route('operator.bank.index')->with('success', 'Rekening bank berhasil diperbarui.');
    }


    public function deleteBankAccount(metodepembayaran $pembayaran)
    {
        $pembayaran->update([
            'nama_bank' => null,
            'nama_rekening' => null,
            'nomor_rekening' => null,
            'qrcode' => null,
        ]);

        return redirect()->route('operator.bank.index')->with('success', 'Rekening bank berhasil dihapus.');
    }

    public function deletePayment(metodepembayaran $pembayaran)
    {
        $pembayaran->delete();

        return redirect()->route('index')->with('success', 'Rekening bank berhasil dihapus.');
    }

    public function viewSendform(Order $order)
    {
        // Cek apakah pembayaran sudah diverifikasi sebelumnya
        if ($order->status !== 'barang dikirim') {
            return back()->with('error', 'Pengiriman sudah diverifikasi sebelumnya.');
        }
        return view('operator.send.view_send', compact('order'));
    }

    public function verifySend(Request $request, Order $order)
    {
        $request->validate([
            'verification_status' => 'required|in:telah dikirim',
        ]);

        $statusVerifikasi = $request->input('verification_status');

        // Cek apakah pembayaran sudah diverifikasi sebelumnya
        if ($order->pengiriman->status != 'menunggu') {
            return redirect()->route('index')->with('error', 'Pengiriman sudah diverifikasi sebelumnya.');
        }

        // Update status verifikasi pembayaran
        $order->pengiriman->update([
            'status' => $statusVerifikasi,
        ]);

        // Update status order berdasarkan verifikasi pembayaran
        if ($statusVerifikasi == 'telah dikirim') {

            $order->update(['status' => 'barang diterima']);

            // Mendapatkan pengguna yang melakukan order
            $user = $order->user;

            // Periksa apakah pengguna sudah memiliki metode pengiriman
            if ($user->metodePengiriman()->exists()) {

                // Jika sudah ada, putus hubungan dengan metode pengiriman yang lama
                $user->metodePengiriman()->detach();


            }

        }

        return redirect()->route('index')->with('success', 'Verifikasi pengiriman berhasil dilakukan.');
    }




    public function createsend()
    {
        return view('operator.send.create');
    }

    public function addsend(Request $request)
    {
        $request->validate([
            'nama_kurir' => 'required|string',
            'nomor_telepon' => 'required|string',
        ]);

        metodepengiriman::create([
            'nama_kurir' => $request->input('nama_kurir'),
            'nomor_telepon' => $request->input('nomor_telepon'),
        ]);

        return redirect()->route('index')->with('success', 'Kurir berhasil ditambahkan.');
    }

    public function editsend(metodepengiriman $pembayaran)
    {
        return view('operator.send.edit', compact('pembayaran'));
    }
    public function updatesend(Request $request, metodepengiriman $pembayaran)
    {
        $request->validate([
            'nama_kurir' => 'required|string',
            'nomor_telepon' => 'required|string',
        ]);


        $pembayaran->update([
            'nama_kurir' => $request->input('nama_kurir'),
            'nomor_telepon' => $request->input('nomor_telepon'),
        ]);

        return redirect()->route('index')->with('success', 'kurir berhasil diperbarui.');
    }

    public function deletesend(metodepengiriman $pengiriman)
    {
        $pengiriman->delete();

        return redirect()->route('index')->with('success', 'kurir berhasil dihapus.');
    }

    public function seepostman(User $user)
    {
        // Mendapatkan semua metode pengiriman yang tersedia
        $availableMethods = MetodePengiriman::all();

        // Pastikan ada metode pengiriman yang tersedia
        if ($availableMethods->isEmpty()) {
            return redirect()->route('index')->with('error', 'Tidak ada metode pengiriman yang tersedia.');
        }

        return view('operator.send.send', compact('user', 'availableMethods'));
    }

    public function assignShippingMethod(Request $request, User $user)
    {
        // Mendapatkan semua metode pengiriman yang tersedia
        $availableMethods = MetodePengiriman::all();

        // Pastikan ada metode pengiriman yang tersedia
        if ($availableMethods->isEmpty()) {
            return redirect()->route('index')->with('error', 'Tidak ada metode pengiriman yang tersedia.');
        }

        // Jika status belum barang diterima, pilih salah satu metode pengiriman secara acak
        $selectedMethod = $availableMethods->random();

        // Simpan metode pengiriman yang dipilih ke pengguna
        $user->metodePengiriman()->attach($selectedMethod->id);

        return redirect()->route('index')->with('success', 'Metode pengiriman berhasil ditentukan untuk pengguna.');
    }




}



