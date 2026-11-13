<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BikeController;

Route::get('/', function () {
    return view('welcome');
});
/*No sabemos todavía lo que responderá la ruta /dashboard, por lo que la comentamos de momento
Route::get('/dashboard', [BikeController::class, '])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');
*/
Route::get('/bikes', [BikeController::class, 'index'])->name('bikes.index');
Route::get('/bikes/{bike}', [BikeController::class, 'show'])->name('bikes.show');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/bikes/{bike}/book', [App\Http\Controllers\BookingController::class, 'create'])->name('booking.create');
    Route::post('/bookings', [App\Http\Controllers\BookingController::class, 'store'])->name('booking.store');
    Route::get('/my-bookings', [App\Http\Controllers\BookingController::class, 'index'])->name('booking.index');
    Route::get('/my-bookings/{booking}', [App\Http\Controllers\BookingController::class, 'show'])->name('booking.show');
    Route::patch('/my-bookings/{booking}/cancel', [App\Http\Controllers\BookingController::class, 'cancel'])->name('booking.cancel');
});

require __DIR__.'/auth.php';
