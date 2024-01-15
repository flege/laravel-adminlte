<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

//Route::get('/', function () {
//    return view('auth.login');
//})->name('index');
Route::get('/', [App\Http\Controllers\MainController::class, 'index'])->name('index');

Auth::routes([
    'register' => false, // remove this class to activate register route
    'reset' => false, // remove this class to activate password reset ro+ute
    'confirm' => false, // remove this class to activate password confirmation route
    'verify' => false // remove this class to activate email verification route
]);

Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');

Route::prefix('/user')->group(function () {
    Route::get('/', [App\Http\Controllers\UserController::class, 'index'])->name('user.index');
    Route::post('insert', [App\Http\Controllers\UserController::class, 'store'])->name('user.store');
    Route::get('edit/{id}', [App\Http\Controllers\UserController::class, 'edit'])->name('user.edit');
    Route::put('update', [App\Http\Controllers\UserController::class, 'update'])->name('user.update');
    Route::delete('delete/{id}', [App\Http\Controllers\UserController::class, 'destroy'])->name('user.destroy');
});
