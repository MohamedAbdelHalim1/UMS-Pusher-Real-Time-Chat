<?php

use Illuminate\Support\Facades\Route;

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


Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/users/{user}', [App\Http\Controllers\HomeController::class, 'show'])->name('users.show');
Route::get('/users/{user}/edit', [App\Http\Controllers\HomeController::class, 'edit'])->name('users.edit');
Route::patch('/users/{user}', [App\Http\Controllers\HomeController::class, 'update'])->name('users.update');
Route::delete('/users/{id}', [App\Http\Controllers\HomeController::class, 'destroy'])->name('users.destroy');
Route::patch('users/restore/{id}', [App\Http\Controllers\HomeController::class, 'restore'])->name('users.restore');


Route::get('/user/Messenger/{id}', [App\Http\Controllers\MessengerController::class, 'index'])->name('user.chat');
Route::post('/broadcast', [App\Http\Controllers\MessengerController::class, 'broadcast']);
Route::post('/receive', [App\Http\Controllers\MessengerController::class, 'receive']);


Route::get('/profile/{id}', [App\Http\Controllers\ProfileController::class, 'show_profile'])->name('profile');
Route::get('/edit-profile/{id}', [App\Http\Controllers\ProfileController::class, 'edit_profile'])->name('profile.edit');
Route::put('/update-profile/{id}', [App\Http\Controllers\ProfileController::class, 'update_profile'])->name('update_profile');
Route::get('/profile/change-password/{id}', [App\Http\Controllers\ProfileController::class, 'changePasswordForm'])->name('profile_change_password');
Route::put('/profile/change-password/{id}', [App\Http\Controllers\ProfileController::class, 'changePassword'])->name('update_password');

