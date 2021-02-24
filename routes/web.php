<?php
namespace App\Http\Controllers;


use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Admin\AdminKonsultasiController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\User\DashboardController as UserDashboardController;
use App\Http\Controllers\User\UserKonsultasiController;
use App\Http\Controllers\VariabelController;
use App\Http\Controllers\HimpunanController;
use App\Http\Controllers\AturanController;
use App\Http\Controllers\KeputusanController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
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

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

// Route::group(['prefix' => 'admin'], function () {
//     Route::post('/variabel/import-excel', [VariabelController::class, 'importExcel'])->name('variabel.excel');
//     Route::resource('/variabel', VariabelController::class);

//     Route::post('himpunan/import-excel', [HimpunanController::class, 'importExcel'])->name('himpunan.excel');
//     Route::resource('/himpunan', HimpunanController::class);

//     Route::post('keputusan/import-excel', [KeputusanController::class, 'importExcel'])->name('keputusan.excel');
//     Route::resource('/keputusan', KeputusanController::class);

//     // Aturan
//     Route::get('/aturan/{id}/edit/detail-aturan', [AturanController::class, 'editDetailAturan'])->name('edit.detailaturan');
//     Route::patch('/aturan/{id}/update/detail-aturan', [AturanController::class, 'updateDetailAturan'])->name('update.detailaturan');
//     Route::resource('/aturan', AturanController::class);
//     Route::get('/aturan/{id}/detail-aturan', [AturanController::class, 'aturanHimpunan'])->name('aturan.himpunan');
//     Route::post('/aturan-detail/{id}', [AturanController::class, 'handleAturanDetail'])->name('handle.detailaturan');
//     // Route::get('/show-konsultasi', [KonsultasiController::class, 'showKonsultasi'])->name('show.konsultasi');

//     // Route konsultasi
//     Route::get('/konsultasi/hasil', [KonsultasiController::class, 'hasilDiagnosa'])->name('konsultasi.hasilDiagnosa');
//     Route::post('/konsultasi/simpan-pertanyaan', [KonsultasiController::class, 'handleKonsultasi'])->name('konsultasi.simpan');
//     Route::get('/konsultasi/daftar-pertanyaan', [KonsultasiController::class, 'konsultasi'])->name('konsultasi.pertanyaan');
//     Route::get('/konsultasi/show-diagnosa', [KonsultasiController::class, 'showDiagnosa'])->name('konsultasi.showDiagnosa');

//     Route::resource('/konsultasi', KonsultasiController::class);
//     // Route::middleware(['auth:api'])->group(function () {
//     //     Route::resource('/konsultasi', KonsultasiController::class);
//     // });
// });

// Route::get('admin-dashboard', [Admin\DashboardController::class, 'index'])->name('admin.dashboard')->middleware('role:admin');
// Route::get('user-dashboard', [User\DashboardController::class, 'index'])->name('user.dashboard')->middleware('role:user');

Route::middleware(['role:admin'])->group(function () {
    Route::get('admin-dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');


        Route::post('/variabel/import-excel', [VariabelController::class, 'importExcel'])->name('variabel.excel');
        Route::get('/variabel/cetak_variabel', [VariabelController::class, 'printVariabel'])->name('print.variabel');
        Route::resource('/variabel', VariabelController::class);

        Route::post('himpunan/import-excel', [HimpunanController::class, 'importExcel'])->name('himpunan.excel');
        Route::get('/himpunan/cetak-himpunan', [HimpunanController::class, 'printHimpunan'])->name('print.himpunan');
        Route::resource('/himpunan', HimpunanController::class);

        Route::post('keputusan/import-excel', [KeputusanController::class, 'importExcel'])->name('keputusan.excel');
        Route::get('keputusan/cetak_keputusan', [KeputusanController::class, 'printKeputusan'])->name('print.keputusan');
        Route::resource('/keputusan', KeputusanController::class);

        // Aturan
        Route::get('/aturan/{id}/edit/detail-aturan', [AturanController::class, 'editDetailAturan'])->name('edit.detailaturan');
        Route::patch('/aturan/{id}/update/detail-aturan', [AturanController::class, 'updateDetailAturan'])->name('update.detailaturan');
        Route::get('/aturan/{id}/detail-aturan', [AturanController::class, 'aturanHimpunan'])->name('aturan.himpunan');
        Route::post('/aturan-detail/{id}', [AturanController::class, 'handleAturanDetail'])->name('handle.detailaturan');
        Route::get('/aturan/cetak_aturan', [AturanController::class, 'printAturan'])->name('print.aturan');
        Route::resource('/aturan', AturanController::class);
        // Route::get('/show-konsultasi', [KonsultasiController::class, 'showKonsultasi'])->name('show.konsultasi');

        // Route konsultasi

            Route::get('/admin-konsultasi/hasil', [AdminKonsultasiController::class, 'hasilDiagnosa'])->name('admin.konsultasi.hasilDiagnosa');
            Route::post('/admin-konsultasi/simpan-pertanyaan', [AdminKonsultasiController::class, 'handleKonsultasi'])->name('admin.konsultasi.simpan');
            Route::get('/admin-konsultasi/daftar-pertanyaan', [AdminKonsultasiController::class, 'konsultasi'])->name('admin.konsultasi.pertanyaan');
            Route::get('/admin-konsultasi/show-diagnosa', [AdminKonsultasiController::class, 'showDiagnosa'])->name('admin.konsultasi.showDiagnosa');
            Route::get('/admin-konsultasi/cetak-konsultasi-byid/{id}', [AdminKonsultasiController::class, 'printKonsultasiById'])->name('print.konsulbyid');
            Route::resource('/admin-konsultasi', AdminKonsultasiController::class);



        // Route::middleware(['auth:api'])->group(function () {
        //     Route::resource('/konsultasi', KonsultasiController::class);
        // });

        // Data pengguna / users
        Route::get('users/cetak-users', [AdminUserController::class, 'cetakPdf'])->name('users.pdf');
        Route::resource('/users', AdminUserController::class);


});

Route::middleware(['role:user'])->group(function () {
    Route::get('/user-dashboard', [UserDashboardController::class, 'index'])->name('user.dashboard');

    // Route konsultasi
    // Route::prefix('user')->group(function () {

        Route::get('/user-konsultasi/hasil', [UserKonsultasiController::class, 'hasilDiagnosa'])->name('user.konsultasi.hasilDiagnosa');
        Route::post('/user-konsultasi/simpan-pertanyaan', [UserKonsultasiController::class, 'handleKonsultasi'])->name('user.konsultasi.simpan');
        Route::get('/user-konsultasi/daftar-pertanyaan', [UserKonsultasiController::class, 'konsultasi'])->name('user.konsultasi.pertanyaan');
        Route::get('/user-konsultasi/show-diagnosa', [UserKonsultasiController::class, 'showDiagnosa'])->name('user.konsultasi.showDiagnosa');
        Route::resource('/user-konsultasi', UserKonsultasiController::class);
    // });

    Route::resource('/history-user', HistoryUserController::class);

    Route::get('/user-setting/{id}/editpass', [UserController::class, 'editpass'])->name('user-setting.editpass');
    Route::resource('/user-setting', UserController::class);



    // Route::resource('/konsultasi', KonsultasiController::class);


});

Auth::routes();



