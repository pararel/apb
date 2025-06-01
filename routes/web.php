<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AccountController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\TargetController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FirebaseController;
/*
Route::middleware('auth')->group(function () {
    Route::middleware('check.user')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'showDashboard'])->name('dashboard');
        Route::get('/history', [HistoryController::class, 'index'])->name('history');
        Route::get('/target', [TargetController::class, 'showTarget'])->name('target');
        Route::post('/target', [TargetController::class, 'store'])->name('targetStore');
        Route::patch('/target/{id}', [TargetController::class, 'update'])->name('targetUpdate');
        Route::delete('/target/{id}', [TargetController::class, 'destroy'])->name('targetDestroy');
        Route::get('/community', [PostController::class, 'showCommunity'])->name('community');
        Route::post('/community', [PostController::class, 'storePost']);
        Route::delete('/community/{id}', [PostController::class, 'destroy'])->name('communityDelete');
        Route::get('/news', [NewsController::class, 'showUserNews'])->name('news');
        Route::get('/FAQ', [FeedbackController::class, 'showFaqForm'])->name('faq');
        Route::post('/FAQ', [FeedbackController::class, 'storeFeedback']);
        Route::get('/settings', [AccountController::class, 'showSettingsForm'])->name('settings');
    });
    Route::middleware('check.admin')->group(function () {
        Route::get('/admin/community', [PostController::class, 'showAdminCommunity'])->name('adminCommunity');
        Route::post('/admin/community', [PostController::class, 'storePost']);
        Route::delete('/admin/community/{id}', [PostController::class, 'destroy'])->name('adminCommunityDelete');
        Route::get('/admin', [FeedbackController::class, 'showFeedbacks'])->name('adminDashboard');
        Route::get('/admin/news', [NewsController::class, 'showAdminNews'])->name('adminNews');
        Route::post('/admin/news', [NewsController::class, 'storeNews']);
        Route::delete('/admin/news/{id}', [NewsController::class, 'destroy'])->name('adminNewsDelete');
        Route::get('/admin/settings', [AccountController::class, 'showAdminSettingsForm'])->name('adminSettings');
    });
    Route::post('/logout', [AccountController::class, 'logout'])->name('logout');
    Route::post('/updateProfile', [AccountController::class, 'updateProfile'])->name('updateProfile');
    Route::post('/updatePassword', [AccountController::class, 'updatePassword'])->name('updatePassword');
    Route::post('/favorite/{postId}', [PostController::class, 'toggleFavorite'])->name('favorite');
    Route::post('/comment/{postId}', [PostController::class, 'addComment'])->name('comment');
    Route::delete('/comment/{id}', [PostController::class, 'destroyComment'])->name('commentDestroy');
});


Route::middleware(['guest'])->group(function(){
    Route::get('/signup', [AccountController::class, 'showSignupForm'])->name('signup');
    Route::post('/signup', [AccountController::class, 'signup']);
    Route::get('/login', [AccountController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AccountController::class, 'login']);
    Route::get('/', function () {
        return view('main.welcome');
    })->name('welcome');
}); */
Route::get('/', [FirebaseController::class, 'getUsers'])->name('firebaseDashboard');
Route::get('/admin/settings', [FirebaseController::class, 'showAdminSettingsForm'])->name('firebaseSettings');
Route::get('/admin/news', [FirebaseController::class, 'showAdminNews'])->name('firebaseNews');