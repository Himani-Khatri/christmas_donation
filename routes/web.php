<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\donationUserController;
use App\Http\Controllers\CampaignController;
use App\Http\Controllers\KhaltiController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminDonationController;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

// Landing page
Route::get('/', [donationUserController::class, 'landing'])->name('landing');

// User signup & login
Route::get('/signup', [donationUserController::class, 'donationUser_signup'])->name('donationUser.signup');
Route::post('/store', [donationUserController::class, 'store'])->name('store');
Route::match(['get','post'], '/login', [donationUserController::class, 'donationUser_login'])->name('donationUser.login');
Route::get('/logout', [donationUserController::class, 'logout'])->name('logout');

// Campaigns for users
Route::get('/campaigns', [CampaignController::class, 'user_campaigns'])->name('campaign.list');
Route::get('/campaigns/{id}', [CampaignController::class, 'user_campaign_show'])->name('campaign.show');

// Payment routes
Route::get('/payment/{id}', [donationUserController::class, 'payment'])->name('payment');
Route::post('/payment/success/{id}', [donationUserController::class, 'paymentSuccess'])->name('payment.success');


Route::middleware('web')->group(function () {

    Route::get('/dashboard', [donationUserController::class, 'dashboard'])->name('dashboard');

    Route::get('/donations/create', [donationUserController::class, 'create_donationLists'])->name('donations.create');
    Route::post('/donations/store', [donationUserController::class, 'store_donationLists'])->name('donations.store');

    Route::post('/donations/{id}/received', [donationUserController::class, 'markReceived'])->name('donation.markReceived');
});


Route::prefix('admin')->group(function () {

    Route::get('/login', [AdminController::class, 'login'])->name('admin.login');
    Route::post('/login', [AdminController::class, 'doLogin'])->name('admin.login.submit');
    Route::get('/logout', [AdminController::class, 'logout'])->name('admin.logout');

    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    Route::get('/donations', [AdminDonationController::class, 'index'])->name('admin.donations');
    Route::post('/donations/{id}/pickup', [AdminDonationController::class, 'setPickup'])->name('admin.donation.pickup');
    Route::post('/donations/{id}/status', [AdminDonationController::class, 'updateStatus'])->name('admin.donation.status');
    Route::post('/donations/{id}/mark-received', [AdminDonationController::class, 'markReceived'])->name('admin.donation.markReceived');

    Route::get('/campaigns', [CampaignController::class, 'admin_index'])->name('admin.campaign.index');
    Route::get('/campaigns/create', [CampaignController::class, 'admin_create'])->name('admin.campaign.create');
    Route::post('/campaigns/store', [CampaignController::class, 'admin_store'])->name('admin.campaign.store');
});


Route::post('/khalti/initiate', [KhaltiController::class, 'initiate'])->name('khalti.initiate');
Route::get('/khalti/verify', [KhaltiController::class, 'verify'])->name('khalti.verify');

Route::get('/donations/create', [donationUserController::class, 'create_donationLists'])->name('donation.create');

Route::post('/donations/store', [donationUserController::class, 'store_donationLists'])->name('store_donationLists');

Route::get('/admin/campaign-donations', [AdminDonationController::class, 'campaignDonations'])
     ->name('campaign.donation');
