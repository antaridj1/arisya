<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PenjualanController;

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

    Route::group(['prefix' => 'karyawan', 'as' => 'karyawan.'], function () {
        Route::get('/', [UserController::class, 'index'])->name('index');
        Route::get('create', [UserController::class, 'create'])->name('create');
        Route::post('store', [UserController::class, 'store'])->name('store');
        Route::get('edit/{user}', [UserController::class, 'edit'])->name('edit');
        Route::patch('update/{user}', [UserController::class, 'update'])->name('update');
        Route::delete('delete/{user}', [UserController::class, 'destroy'])->name('delete');
        Route::put('editStatus/{user}', [UserController::class, 'updateStatus'])->name('editStatus');
    });

    Route::get('/profil', [UserController::class, 'profil'])->name('profil');
    Route::put('editpass/{user}', [UserController::class, 'updatePass'])->name('editpass');
});