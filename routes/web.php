<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Models\Room;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PayPalController;
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

Route::get('/', [HomeController::class, 'index']);

Route::get('/rooms', [RoomController::class, 'index'])->name('rooms.index');

Route::middleware(['auth'])->group(function () {
    Route::get('/home', [HomeController::class, 'authenticate'])->name('home');
    Route::post('rooms/check-availability', [BookingController::class, 'checkAvailability'])->name('rooms.checkavail');
    Route::get('rooms/book/{room_id}', [RoomController::class, 'book'])->name('rooms.book');
    Route::post('rooms/confirmBooking', [BookingController::class, 'confirmBooking'])->name('rooms.confirmBooking');
    Route::get('rooms/MyBooking', [BookingController::class, 'MyBooking'])->name('rooms.mybooking');

    /* PayPal Payment Integration URL */
    Route::get('/paypal/pay/{bookingId}/{totalAmount}', [PayPalController::class, 'createOrder'])->name('paypal.pay');
    Route::get('/paypal/capture/{bookingId}', [PayPalController::class, 'captureOrder'])->name('paypal.capture');
    Route::get('/paypal/cancel/{bookingId}', [PayPalController::class, 'cancelOrder'])->name('paypal.cancel');
});

Route::middleware(['auth', 'admin'])->group(function () {
    // Admin-only routes
    Route::get('/manage-rooms', [AdminController::class, 'AllRooms'])->name('manage.rooms');
    Route::get('/rooms/create', [AdminController::class, 'CreateRoom'])->name('rooms.create');
    Route::post('/rooms', [AdminController::class, 'StoreRoom'])->name('rooms.store');
    Route::get('/rooms/edit/{id}', [AdminController::class, 'EditRoom'])->name('rooms.edit');
    Route::put('/rooms/{id}', [AdminController::class, 'UpdateRoom'])->name('rooms.update');
    Route::delete('/rooms/{id}', [AdminController::class, 'DestroyRoom'])->name('rooms.destroy');
    Route::get('/manage-bookings', [AdminController::class, 'viewBookings'])->name('manage.bookings');
    Route::post('/rooms/{room}/update-avail', [RoomController::class, 'toggleAvailability'])->name('update.availability');
});



require __DIR__.'/auth.php';
