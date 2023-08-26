<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\OrganizerController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::post('register2', [AuthController::class, 'register'])->name('register2');
Route::post('login2', [AuthController::class, 'login'])->name('login2');
Route::resource('organizers', OrganizerController::class);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Route::middleware('auth')->group(function () {
Route::view('about', 'about')->name('about');

Route::get('users', [\App\Http\Controllers\UserController::class, 'index'])->name('users.index');

Route::get('profile', [\App\Http\Controllers\ProfileController::class, 'show'])->name('profile.show');
Route::put('profile', [\App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
// });
