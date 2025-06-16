<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AccountController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\TargetController;
use App\Http\Controllers\DashboardController;

Route::middleware(['firebase.auth'])->group(function () {
    Route::get('/admin', [AccountController::class, 'showUsers'])->name('adminDashboard');
    Route::delete('/admin/user/{uid}', [AccountController::class, 'deleteUser'])->name('deleteUser');
    Route::get('/admin/news', [NewsController::class, 'showAdminNews'])->name('adminNews');
    Route::post('/admin/news', [NewsController::class, 'storeNews']);
    Route::delete('/admin/news/{id}', [NewsController::class, 'destroy'])->name('adminNewsDelete');
    Route::get('/admin/settings', [AccountController::class, 'showAdminSettingsForm'])->name('adminSettings');
    Route::post('/logout', [AccountController::class, 'logout'])->name('logout');
    Route::post('/updateProfile', [AccountController::class, 'updateProfile'])->name('updateProfile');
    Route::post('/updatePassword', [AccountController::class, 'updatePassword'])->name('updatePassword');
});



Route::get('/signup', [AccountController::class, 'showSignupForm'])->name('signup');
Route::post('/signup', [AccountController::class, 'signup']);
Route::get('/login', [AccountController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AccountController::class, 'login']);
Route::get('/', function () {
    return view('main.welcome');
})->name('welcome');