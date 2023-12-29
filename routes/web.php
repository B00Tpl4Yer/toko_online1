<?php

use App\Http\Controllers\ProfileController;
use App\Livewire\Showproduk;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OperatorController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PublicController;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', [PublicController::class, 'index'])->name('index');
Route::get('/stocks/user/{stok}', [PublicController::class, 'show'])->name('stock.show');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Route 'Admin'
Route::middleware(['auth'])->group(function () {
    Route::middleware(['role:admin'])->group(function () {
        Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
        Route::post('naikkan-tingkat/{user}', [AdminController::class, 'naikkanTingkat'])->name('admin.naikkan-tingkat');
        Route::post('turunkan-tingkat/{user}', [AdminController::class, 'turunkanTingkat'])->name('admin.turunkan-tingkat');
        Route::get('delete-user/{user}', [AdminController::class, 'deleteUser'])->name('admin.delete-user');
        Route::get('delete-operator/{user}', [AdminController::class, 'deleteOperator'])->name('admin.delete-operator');
        Route::post('ganti-password/{user}', [AdminController::class, 'changePassword'])->name('admin.ganti-password');
    });
});
//'operator'
Route::middleware(['auth'])->group(function () {
    Route::middleware(['role:operator'])->group(function () {
        Route::get('/stocks/create', [OperatorController::class, 'create'])->name('stock.create');
        Route::post('/stocks', [OperatorController::class, 'store'])->name('stock.store');
        Route::get('/stocks/{stok}/edit', [OperatorController::class, 'edit'])->name('stock.edit');
        Route::put('/stocks/{stok}', [OperatorController::class, 'update'])->name('stock.update');
        Route::delete('/stok/{stok}', [OperatorController::class, 'destroy'])->name('stok.destroy');
        Route::get('/show-order', [OperatorController::class, 'showOrder'])->name('operatorshoworders');
        Route::get('/orders/{order}/view-payment-proof', [OperatorController::class, 'viewPaymentProof'])->name('operator.order.view_proof');
        Route::post('/orders/{order}/verify-payment', [OperatorController::class, 'verifyPayment'])->name('operator.order.verify_payment');
        Route::get('/operator/payment/bank', [OperatorController::class, 'indexbank'])->name('operator.bank.index');
        Route::get('/operator/payment/bank/create', [OperatorController::class, 'createBankAccount'])->name('operator.bank.create');
        Route::post('/operator/payment/bank', [OperatorController::class, 'addBankAccount'])->name('operator.bank.store');
        Route::get('/operator/payment/bank/{pembayaran}/edit', [OperatorController::class, 'editBankAccount'])->name('operator.bank.edit');
        Route::put('/operator/payment/bank/{pembayaran}', [OperatorController::class, 'updateBankAccount'])->name('operator.bank.update');
        Route::delete('/operator/payment/bank/{pembayaran}', [OperatorController::class, 'deleteBankAccount'])->name('operator.bank.delete');
        Route::get('/orders/{order}/view-send', [OperatorController::class, 'viewSendform'])->name('operator.viewsend');
        Route::post('/orders/{order}/verify-send', [OperatorController::class, 'verifySend'])->name('operator.verifysend');
        Route::get('/operator/sned/create', [OperatorController::class, 'createsend'])->name('operator.send.create');
        Route::post('/operator/sendadd', [OperatorController::class, 'addsend'])->name('operator.send.store');
        Route::get('/operator/send/{pembayaran}/edit', [OperatorController::class, 'editsend'])->name('operator.send.edit');
        Route::put('/operator/send/{pembayaran}', [OperatorController::class, 'updatesend'])->name('operator.send.update');
        Route::delete('/operator/send/{pengiriman}', [OperatorController::class, 'deletesend'])->name('operator.send.delete');
        Route::get('/operator/postman/{user}', [OperatorController::class, 'seepostman'])->name('operator.send.postman');
        Route::post('/operator/postman/{user}/assign', [OperatorController::class, 'assignShippingMethod'])
            ->name('operator.assignShippingMethod');


    });
});
//'user'
Route::middleware(['auth'])->group(function () {
    Route::middleware(['role:user'])->group(function () {
        Route::get('/cart', [UserController::class, 'viewCart'])->name('cart.index');
        Route::put('/cart/{cartItem}', [UserController::class, 'reduceQuantity'])->name('cart.reduceQuantity');
        Route::delete('/cart/{cartItem}', [UserController::class, 'removeFromCart'])->name('cart.removeFromCart');
        Route::post('/checkout', [UserController::class, 'checkout'])->name('checkout');
        Route::get('/status',[UserController::class, 'status'])->name('status');
        Route::get('/payment/form/{order}', [UserController::class, 'paymentForm'])->name('payment.form');
        Route::post('/orders/{order}/process-payment', [UserController::class, 'processPayment'])->name('user.order.process_payment');
        Route::get('/payment/bank', [UserController::class, 'indexbank'])->name('user.bank.index');
        Route::get('/orders/{order}/upload-payment-proof', [UserController::class, 'uploadPaymentProofForm'])->name('user.order.upload_proof_form');
        Route::post('/orders/{order}/upload-payment-proof', [UserController::class, 'uploadPaymentProof'])->name('user.order.upload_proof');
        Route::get('/Send/form/{order}', [UserController::class, 'SendForm'])->name('Send.form');
        Route::post('/Send/{order}/process', [UserController::class, 'processSend'])->name('user.process_send');
        Route::get('/Send/{order}/processs', [UserController::class, 'seesend'])->name('user.see_send');

    });
});

require __DIR__ . '/auth.php';
