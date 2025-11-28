<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeContoller;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\DashboardControllerr;
use App\Http\Controllers\MultipleuploadsController;

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
    return 'Nama saya: '.$param1;
});

Route::get('/nim/{param1?}', function ($param1 = '') {
    return 'NIM saya: '.$param1;
});

Route :: get ('/mahasiswa/{param1}',[MahasiswaController:: class,'show']);

Route::get('/about', function () {
    return view('halaman-about');
});

route::get('/home',[HomeContoller::class,'index'])
          ->name('home');


Route::get('/pegawai', [PegawaiController::class, 'index']);

Route::post('question/store', [QuestionController::class, 'store'])
		->name('question.store');

route::get('dashboard', [DashboardControllerr::class, 'index'])
        ->name('dashboard');

Route::resource('pelanggan', PelangganController::class);

Route::resource('user', UserController::class);

// Routes untuk multiple uploads - TIDAK ADA YANG DIUBAH/HAPUS, HANYA DITAMBAH
Route::post('/uploads/store', [MultipleuploadsController::class, 'store'])->name('uploads.store');
Route::delete('/uploads/{id}', [MultipleuploadsController::class, 'destroy'])->name('uploads.destroy');
