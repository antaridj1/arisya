<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BarangController;

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
    return view('login');
});

Route::get('/login', [AuthController::class, 'getLogin'])->name('getLogin')->middleware('guest');
Route::post('/login', [AuthController::class, 'postLogin'])->name('postLogin');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index']);

    Route::group(['prefix' => 'barang', 'as' => 'barang.'], function () {
        Route::get('/', [BarangController::class, 'index'])->name('index');
        Route::get('create', [BarangController::class, 'create'])->name('create');
        Route::post('store', [BarangController::class, 'store'])->name('store');
        Route::get('edit/{barang}', [BarangController::class, 'edit'])->name('edit');
        Route::patch('update/{barang}', [BarangController::class, 'update'])->name('update');
        Route::delete('delete/{barang}', [BarangController::class, 'destroy'])->name('delete');
    });
});