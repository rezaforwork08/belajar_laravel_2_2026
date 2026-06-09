<?php

use App\Http\Controllers\LatihanController;
use App\Http\Controllers\LockerController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('latihan', [LatihanController::class, 'index']);
Route::get('tambah', [LatihanController::class, 'tambah'])->name('tambah');
Route::get('kurang', [LatihanController::class, 'kurang'])->name('kurang');
Route::get('bagi', [LatihanController::class, 'bagi'])->name('bagi');
Route::get('kali', [LatihanController::class, 'kali'])->name('kali');

// cara yang panjang
// Route::get('latihan', [App\Http\Controllers\LatihanController::class, 'index']);

Route::post('action-tambah', [LatihanController::class, 'actionTambah'])
    ->name('action-tambah');

//Profiles
Route::get('profile', [ProfileController::class, 'index']);

//Login

Route::get('/', [LoginController::class, 'index'])->name('login');
Route::post('action-login', [LoginController::class, 'actionLogin'])
    ->name('action-login');
Route::post('action-logout', [LoginController::class, 'actionLogout'])
    ->name('action-logout');


Route::middleware(['auth', 'prevent-back'])->group(function () {
    Route::get('dashboard', function () {
        return view('dashboard.index');
    });
    // resource : GET, POST, PUT, DELETE
    Route::resource('user', \App\Http\Controllers\UserController::class);
    Route::resource('role', \App\Http\Controllers\RoleController::class);
    Route::resource('key', \App\Http\Controllers\KeyController::class);
    Route::resource('major', \App\Http\Controllers\MajorController::class);
    Route::resource('student', \App\Http\Controllers\StudentController::class);

    // Route::get('locker', [LockerController::class, 'index'])->name('locker.index');
    // Route::get('locker/create', [LockerController::class, 'create'])->name('locker.create');
    // Route::post('locker/store', [LockerController::class, 'store'])->name('locker.store');
    // Route::get('locker/{id}/edit', [LockerController::class, 'edit'])->name('locker.edit');
    // Route::put('locker/{id}/update', [LockerController::class, 'update'])->name('locker.update');
    // Route::delete('locker/{id}/delete', [LockerController::class, 'destroy'])->name('locker.destroy');
    Route::resource('locker', LockerController::class);
});
