<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\OrderController;


Route::middleware('guest')->group(function () {

    Route::get('/login?', [AuthController::class, 'showLogin'])->name('login');
    Route::name('auth.')->group(function () {
        Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
        Route::post('/login', [AuthController::class, 'login']);
        Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
        Route::post('/register', [AuthController::class, 'register']);
        Route::post('/forget', [AuthController::class, 'forgetPassword'])->name('forget');
        Route::post('/reset', [AuthController::class, 'resetPassword'])->name('reset');
        Route::get('/diakun', [AuthController::class, 'redirectDiAkun'])->name('diakun');
        Route::get('/diakun/callback/{token}', [AuthController::class, 'callbackDiakun']);
    });
    Route::get('/forget', [AuthController::class, 'showForgetPassword'])->name('password.request');
    Route::get('/reset', [AuthController::class, 'showResetPassword'])->name('password.reset');
});
Route::middleware('auth')->group(function () {

    Route::name('auth.')->group(function () {
        Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
        Route::get('/profile', [AuthController::class, 'showEditProfile'])->name('profile');
        Route::post('/profile', [AuthController::class, 'editProfile'])->name('profile');
        
    });
});



Route::get('/', [FrontController::class, 'index'])->name('front.index');

Route::get('/browse/{category:slug}', [FrontController::class, 'category'])->name('front.category');
Route::get('/details/{shirt:slug}', [FrontController::class, 'details'])->name('front.details');

Route::get('/check-booking', [OrderController::class, 'checkBooking'])->name('front.check_booking');
Route::post('/check-booking/details', [OrderController::class, 'checkBookingDetails'])->name('front.check_booking_details');

Route::post('/order/begin/{shirt:slug}', [OrderController::class, 'saveOrder'])->name('front.save_order');
Route::get('/order/booking/', [OrderController::class, 'booking'])->name('front.booking');
Route::get('/order/booking/customer-data', [OrderController::class, 'customerData'])->name('front.customer_data');
Route::post('/order/booking/customer-data/save', [OrderController::class, 'saveCustomerData'])->name('front.save_customer_data');

Route::get('/order/payment', [OrderController::class, 'payment'])->name('front.payment');
Route::post('/order/payment/confirm', [OrderController::class, 'paymentConfirm'])->name('front.payment_confirm');

Route::get('/order/finished/{productTransaction:id}', [OrderController::class, 'orderFinished'])->name('front.order_finished');
