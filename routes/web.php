<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\donationUserController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/signup', [donationUserController::class, 'donationUser_signup'])->name('donationUser.signup');
Route::post('/store', [donationUserController::class, 'store'])->name('store');
Route::post('/donation/store', [donationUserController::class, 'store_donationLists'])->name('store_donationLists');
Route::match(['get', 'post'], '/login', [donationUserController::class, 'donationUser_login'])->name('donationUser.login');
Route::get('/dashboard', [donationUserController::class, 'dashboard'])->name('dashboard');
Route::get('/', [donationUserController::class, 'landing'])->name('landing');
Route::get('/logout', [donationUserController::class, 'logout'])->name('logout');
Route::get('/campaigns', [donationUserController::class, 'campaigns'])->name('campaigns');
