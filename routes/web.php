<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
// Admin Controller
use App\Http\Controllers\Admin\NasabahController as AdminNasabahController;
use App\Http\Controllers\Admin\PetugasController as AdminPetugasController;
use App\Http\Controllers\Admin\SampahController as AdminSampahController;
use App\Http\Controllers\Admin\PengepulController as AdminPengepulController;
use App\Http\Controllers\Admin\BannerController as AdminBannerController;
use App\Http\Controllers\Admin\ArtikelController as AdminArtikelController;
use App\Http\Controllers\Admin\AplikasiAndroidController as AdminAplikasiAndroidController;
use App\Http\Controllers\Admin\TokenWhatsAppController as AdminTokenWhatsAppController;
use App\Http\Controllers\Admin\FeedbackController as AdminFeedbackController;
use App\Http\Controllers\Admin\TentangKamiController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\PencairanSaldoController as AdminTarikSaldoController;
use App\Http\Controllers\Admin\PengirimanPengepulController as AdminPengirimanPengepulController;
use App\Http\Controllers\Admin\TransaksiController as AdminTransaksiController;
use App\Http\Controllers\Admin\LaporanController as AdminLaporanController;

// Petugas Controller
use App\Http\Controllers\Petugas\DashboardController as PetugasDashboardController;
use App\Http\Controllers\Petugas\TransaksiController as PetugasTransaksiController;
use App\Http\Controllers\Petugas\NasabahController as PetugasNasabahController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('guest')->group(function () {
    Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('login', [AuthController::class, 'login'])->name('login.post');
});

Route::middleware(['auth', 'checkRole:admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');

    // Data Master
    Route::resource('/data-nasabah', AdminNasabahController::class)->names('admin.nasabah');
    Route::resource('/data-petugas', AdminPetugasController::class)->names('admin.petugas');
    Route::resource('/data-sampah', AdminSampahController::class)->names('admin.sampah');
    Route::resource('/data-pengepul', AdminPengepulController::class)->names('admin.pengepul');

    // Manajemen Konten
    Route::resource('/data-banner', AdminBannerController::class)->names('admin.banner');
    Route::resource('/data-artikel', AdminArtikelController::class)->names('admin.artikel');

    // Transaksi
    Route::resource('/transaksi', AdminTransaksiController::class)->names('admin.transaksi');
    Route::get('/transaksi/print/{transaksi}', [AdminTransaksiController::class, 'print'])->name('admin.transaksi.print');



    Route::get('/laporan', [AdminLaporanController::class, 'index'])->name('admin.laporan.index');
    Route::get('/laporan/print', [AdminLaporanController::class, 'print'])->name('admin.laporan.print');
    // Route::get('', 'AdminTransaksiController@print')->name('admin.transaksi.print');

    Route::get('/tarik-saldo', [AdminTarikSaldoController::class, 'index'])->name('admin.tarik-saldo.index');
    Route::post('/tarik-saldo/setujui/{id}', [AdminTarikSaldoController::class, 'setujui'])->name('admin.tarik-saldo.setujui');
    Route::post('/tarik-saldo/tolak/{id}', [AdminTarikSaldoController::class, 'tolak'])->name('admin.tarik-saldo.tolak');

    Route::resource('/pengiriman/sampah', AdminPengirimanPengepulController::class)->names('admin.pengiriman');

    // Pengaturan
    Route::get('/token-whatsapp', [AdminTokenWhatsAppController::class, 'index'])->name('admin.token-whatsapp.index');
    Route::post('/token-whatsapp', [AdminTokenWhatsAppController::class, 'update'])->name('admin.token-whatsapp.update');
    Route::resource('/update-apk', AdminAplikasiAndroidController::class)->names('admin.aplikasi');
    Route::get('/tentang-kami', [TentangKamiController::class, 'index'])->name('admin.tentang_kami.index');
    Route::post('/tentang-kami', [TentangKamiController::class, 'store'])->name('admin.tentang_kami.store');
    Route::put('/tentang-kami/update/{id}', [TentangKamiController::class, 'update'])->name('admin.tentang_kami.update');

    // Feedback
    Route::resource('/data-feedback', AdminFeedbackController::class)->names('admin.feedback');
});

Route::middleware(['auth', 'checkRole:petugas'])->prefix('petugas')->group(function () {
    Route::get('/dashboard', [PetugasDashboardController::class, 'index'])->name('petugas.dashboard');

    // Data Master
    Route::resource('/data-nasabah', PetugasNasabahController::class)->names('petugas.nasabah');
    // Transaksi
    Route::resource('/transaksi', PetugasTransaksiController::class)->names('petugas.transaksi');
    Route::get('/transaksi/print/{transaksi}', [PetugasTransaksiController::class, 'print'])->name('petugas.transaksi.print');
});

Route::post('logout', [AuthController::class, 'logout'])->name('logout');
