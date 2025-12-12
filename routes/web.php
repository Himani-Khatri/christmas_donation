<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\donationUserController;
use App\Http\Controllers\CampaignController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/signup', [donationUserController::class, 'donationUser_signup'])->name('donationUser.signup');
Route::post('/store', [donationUserController::class, 'store'])->name('store');
Route::post('/donation/store', [donationUserController::class, 'store_donationLists'])->name('store_donationLists');

// Payment page
Route::get('/payment/{id}', [donationUserController::class, 'payment'])->name('payment');

// Payment success (handle POST from form)
Route::post('/payment/success/{id}', [donationUserController::class, 'paymentSuccess'])->name('payment.success');

Route::match(['get', 'post'], '/login', [donationUserController::class, 'donationUser_login'])->name('donationUser.login');
Route::get('/dashboard', [donationUserController::class, 'dashboard'])->name('dashboard');
Route::get('/', [donationUserController::class, 'landing'])->name('landing');
Route::get('/logout', [donationUserController::class, 'logout'])->name('logout');
Route::get('/campaigns', [donationUserController::class, 'campaigns'])->name('campaigns');

// Admin campaign routes
Route::prefix('admin')->group(function () {

    Route::get('campaigns', [CampaignController::class, 'index'])->name('admin.campaign.index');
    Route::get('campaigns/create', [CampaignController::class, 'create'])->name('admin.campaign.create');
    Route::post('campaigns/store', [CampaignController::class, 'store'])->name('admin.campaign.store');
});

Route::get('/campaign/{id}', [CampaignController::class, 'show'])->name('campaign.show');
// Admin Campaign Routes
Route::get('/admin/campaigns', [CampaignController::class, 'admin_index'])->name('admin.campaign.index');
Route::get('/admin/campaigns/create', [CampaignController::class, 'admin_create'])->name('admin.campaign.create');
Route::post('/admin/campaigns/store', [CampaignController::class, 'admin_store'])->name('admin.campaign.store');

// User Campaign Routes
Route::get('/campaigns', [CampaignController::class, 'user_campaigns'])->name('campaign.list');
Route::get('/campaigns/{id}', [CampaignController::class, 'user_campaign_show'])->name('campaign.show');
