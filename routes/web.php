<?php

use App\Http\Controllers\AbsenController;
use App\Http\Controllers\DendaController;
use App\Http\Controllers\GajiController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\KasbonController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LokasiController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\UserController;
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
  $data = [
    'title' => 'Login'
  ];
  return view('login.login', $data);
})->name('/');

Route::get('welcome', function () {
  $data = [
    'title' => 'dashboard'
  ];
  return view('welcome', $data);
})->name('welcome')->middleware('auth');

// login
Route::get('login', [LoginController::class, 'index'])->name('login');
Route::post('prosesLogin', [LoginController::class, 'prosesLogin'])->name('prosesLogin');
Route::get('logout', [LoginController::class, 'logout'])->name('logout');

Route::get('karyawan', [KaryawanController::class, 'index'])->name('karyawan')->middleware('auth');
Route::post('tambahKaryawan', [KaryawanController::class, 'tambahKaryawan'])->name('tambahKaryawan')->middleware('auth');
Route::post('editKaryawan', [KaryawanController::class, 'editKaryawan'])->name('editKaryawan')->middleware('auth');
Route::get('hapusKaryawan', [KaryawanController::class, 'hapusKaryawan'])->name('hapusKaryawan')->middleware('auth');

Route::get('user', [UserController::class, 'index'])->name('user')->middleware('auth');
Route::post('tambahUser', [UserController::class, 'tambahUser'])->name('tambahUser')->middleware('auth');
Route::post('editUser', [UserController::class, 'editUser'])->name('editUser')->middleware('auth');
Route::get('hapusUser', [UserController::class, 'hapusUser'])->name('hapusUser')->middleware('auth');

Route::get('absen', [AbsenController::class, 'index'])->name('absen')->middleware('auth');
Route::post('tambahAbsen', [AbsenController::class, 'tambahAbsen'])->name('tambahAbsen')->middleware('auth');
Route::post('editAbsen', [AbsenController::class, 'editAbsen'])->name('editAbsen')->middleware('auth');
Route::get('hapusAbsen', [AbsenController::class, 'hapusAbsen'])->name('hapusAbsen')->middleware('auth');

Route::get('status', [StatusController::class, 'index'])->name('status')->middleware('auth');
Route::post('tambahStatus', [StatusController::class, 'tambahStatus'])->name('tambahStatus')->middleware('auth');
Route::post('editStatus', [StatusController::class, 'editStatus'])->name('editStatus')->middleware('auth');
Route::get('hapusStatus', [StatusController::class, 'hapusStatus'])->name('hapusStatus')->middleware('auth');

Route::get('lokasi', [LokasiController::class, 'index'])->name('lokasi')->middleware('auth');
Route::post('tambahLokasi', [LokasiController::class, 'tambahLokasi'])->name('tambahLokasi')->middleware('auth');
Route::post('editLokasi', [LokasiController::class, 'editLokasi'])->name('editLokasi')->middleware('auth');
Route::get('hapusLokasi', [LokasiController::class, 'hapusLokasi'])->name('hapusLokasi')->middleware('auth');

Route::get('gaji', [GajiController::class, 'index'])->name('gaji')->middleware('auth');
Route::post('tambahGaji', [GajiController::class, 'tambahGaji'])->name('tambahGaji')->middleware('auth');
Route::post('editGaji', [GajiController::class, 'editGaji'])->name('editGaji')->middleware('auth');
Route::get('hapusGaji', [GajiController::class, 'hapusGaji'])->name('hapusGaji')->middleware('auth');

Route::get('kasbon', [KasbonController::class, 'index'])->name('kasbon')->middleware('auth');
Route::post('tambahKasbon', [KasbonController::class, 'tambahKasbon'])->name('tambahKasbon')->middleware('auth');
Route::post('editKasbon', [KasbonController::class, 'editKasbon'])->name('editKasbon')->middleware('auth');
Route::get('hapusKasbon', [KasbonController::class, 'hapusKasbon'])->name('hapusKasbon')->middleware('auth');

Route::get('denda', [DendaController::class, 'index'])->name('denda')->middleware('auth');
Route::post('tambahDenda', [DendaController::class, 'tambahDenda'])->name('tambahDenda')->middleware('auth');
Route::post('editDenda', [DendaController::class, 'editDenda'])->name('editDenda')->middleware('auth');
Route::get('hapusDenda', [DendaController::class, 'hapusDenda'])->name('hapusDenda')->middleware('auth');

Route::get('view', [LaporanController::class, 'view'])->name('view')->middleware('auth');
Route::get('export', [LaporanController::class, 'export'])->name('export')->middleware('auth');

Route::get('laporanKaryawan', [LaporanController::class, 'laporanKaryawan'])->name('laporanKaryawan')->middleware('auth');
Route::get('exportKaryawan', [LaporanController::class, 'exportKaryawan'])->name('exportKaryawan')->middleware('auth');

Route::get('lapKaryawan', [LaporanController::class, 'lapKaryawan'])->name('lapKaryawan')->middleware('auth');
Route::get('exportLapKaryawan', [LaporanController::class, 'exportLapKaryawan'])->name('exportLapKaryawan')->middleware('auth');

Route::get('laporanLokasi', [LaporanController::class, 'laporanLokasi'])->name('laporanLokasi')->middleware('auth');
Route::get('exportLaporanLokasi', [LaporanController::class, 'exportLaporanLokasi'])->name('exportLaporanLokasi')->middleware('auth');

Route::get('lapKasbon', [LaporanController::class, 'lapKasbon'])->name('lapKasbon')->middleware('auth');
Route::get('exportLapKasbon', [LaporanController::class, 'exportLapKasbon'])->name('exportLapKasbon')->middleware('auth');

Route::get('lapDenda', [LaporanController::class, 'lapDenda'])->name('lapDenda')->middleware('auth');
Route::get('exportLapDenda', [LaporanController::class, 'exportLapDenda'])->name('exportLapDenda')->middleware('auth');

Route::get('lapDataDenda', [LaporanController::class, 'lapDataDenda'])->name('lapDataDenda')->middleware('auth');
Route::get('exportLapDataDenda', [LaporanController::class, 'exportLapDataDenda'])->name('exportLapDataDenda')->middleware('auth');

Route::get('lapDataKasbon', [LaporanController::class, 'lapDataKasbon'])->name('lapDataKasbon')->middleware('auth');
Route::get('exportLapDataKasbon', [LaporanController::class, 'exportLapDataKasbon'])->name('exportLapDataKasbon')->middleware('auth');

Route::get('lapAbsen', [LaporanController::class, 'lapAbsen'])->name('lapAbsen')->middleware('auth');
Route::get('exportLapAbsen', [LaporanController::class, 'exportLapAbsen'])->name('exportLapAbsen')->middleware('auth');

Route::get('rGajiKaryawan', [LaporanController::class, 'rGajiKaryawan'])->name('rGajiKaryawan')->middleware('auth');


