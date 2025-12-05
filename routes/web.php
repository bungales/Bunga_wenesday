<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardControllerr;
use App\Http\Controllers\HomeContoller;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\MultipleuploadsController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// TAMBAHKAN BARIS INI - Public Routes (tanpa middleware)
Route::get('/', function () {
    return view('welcome');
});

Route::get('/pcr', function () {
    return 'Selamat Datang di Website Kampus PCR!';
});

Route::get('/mahasiswa', function () {
    return 'Halo Mahasiswa';
})->name('mahasiswa.show');

Route::get('/nama/{param1}', function ($param1) {
    return 'Nama saya: ' . $param1;
});

Route::get('/nim/{param1?}', function ($param1 = '') {
    return 'NIM saya: ' . $param1;
});

Route::get('/mahasiswa/{param1}', [MahasiswaController::class, 'show']);

Route::get('/about', function () {
    return view('halaman-about');
});

Route::get('/home', [HomeContoller::class, 'index'])
    ->name('home');

// Routes untuk login (harus bisa diakses tanpa login)
Route::get('auth', [AuthController::class, 'index'])->name('auth');
Route::post('auth/login', [AuthController::class, 'login'])->name('auth.login');


// PROTECTED ROUTES (perlu login)


// route
Route::group(['middleware' => ['checkislogin']], function () {

    // Dashboard (perlu login)
    Route::get('dashboard', [DashboardControllerr::class, 'index'])
        ->name('dashboard');

    // Pegawai (perlu login)
    Route::get('/pegawai', [PegawaiController::class, 'index']);

    // Question store (perlu login)
    Route::post('question/store', [QuestionController::class, 'store'])
        ->name('question.store');

    // Pelanggan resource (semua route: index, create, store, show, edit, update, destroy)
    Route::resource('pelanggan', PelangganController::class);

    // USER ROUTES DENGAN MIDDLEWARE CHECKROLE:SUPER ADMIN - TAMBAHAN BARU
    Route::group(['middleware' => ['checkrole:Super Admin']], function () {
        Route::resource('user', UserController::class);
        Route::delete('/user/{id}/picture', [UserController::class, 'destroyPicture'])->name('user.destroy.picture');
    });

    // Multiple uploads (perlu login)
    Route::post('/uploads/store', [MultipleuploadsController::class, 'store'])->name('uploads.store');
    Route::delete('/uploads/{id}', [MultipleuploadsController::class, 'destroy'])->name('uploads.destroy');

    // Logout (perlu login)
    Route::get('auth/logout', [AuthController::class, 'logout'])->name('auth.logout');

});
