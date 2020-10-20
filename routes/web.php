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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['verify' => true]);
Route::get('terms-and-conditions', [App\Http\Controllers\TermsController::class, 'current' ])->name('terms.current');

Route::group(['middleware'=>['verified', 'auth']], function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::resource('users', App\Http\Controllers\UserController::class, ['only' => ['edit', 'update']]);
    Route::put('users/delete/{id}', [App\Http\Controllers\UserController::class, 'destroy'])->name('user.delete');
    Route::put('users/unverify/{user}', [App\Http\Controllers\UserController::class, 'unverify'])->name('users.unverify');
    Route::get('home/search', [App\Http\Controllers\HomeController::class, 'search'])->name('home.search');
    Route::resource('terms', App\Http\Controllers\TermsController::class, ['except' => ['show']]);
    Route::post('terms/publish/{term}', [App\Http\Controllers\TermsController::class, 'publish'])->name('terms.publish');
});


