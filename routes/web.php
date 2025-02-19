<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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

Route::get('lupa-password', '\Laravel\Fortify\Http\Controllers\PasswordResetLinkController@create')->name('password.request');
Route::post('lupa-password', '\Laravel\Fortify\Http\Controllers\PasswordResetLinkController@store')->name('password.email');

Route::get('reset-password/{token}', '\Laravel\Fortify\Http\Controllers\NewPasswordController@create')->name('password.reset');
Route::post('reset-password', '\Laravel\Fortify\Http\Controllers\NewPasswordController@store')->name('password.update');

Route::get('logout', '\Laravel\Fortify\Http\Controllers\AuthenticatedSessionController@destroy')->name('logout');

Route::group(['as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth:sanctum', 'verified']], function() {
    
    Route::get('/', 'DashboardController@index')->name('dashboard.index');
    
    // Route::get('/tambah', 'PengajuanController@create')->name('pengajuan.create')->middleware('has_access:module.pengajuan.create');
    // Route::post('/store', 'PengajuanController@store')->name('pengajuan.store')->middleware('has_access:module.pengajuan.create');
    // Route::get('/{pengajuan:slug}/ubah', 'PengajuanController@edit')->name('pengajuan.edit');
    // Route::match(['put', 'patch'], '/{pengajuan:slug}', 'PengajuanController@update')->name('pengajuan.update')->middleware('has_access:module.pengajuan.edit');
    // Route::delete('/{pengajuan:slug}', 'PengajuanController@destroy')->name('pengajuan.destroy')->middleware('has_access:module.pengajuan.delete');
    // Route::get('/table', 'PengajuanController@table')->name('pengajuan.table')->middleware('has_access:module.pengajuan.index');

    Route::group(['prefix' => 'user', 'as' => 'profile.', 'namespace' => 'UserProfile'], function() {
        Route::get('profile', 'ProfileController@show')->name('show');
        Route::match(['put', 'patch'], 'profile', '\Laravel\Fortify\Http\Controllers\ProfileInformationController@update')->name('update');

        Route::get('password', 'PasswordController@show')->name('password');
        Route::match(['put', 'patch'], 'password', '\Laravel\Fortify\Http\Controllers\PasswordController@update')->name('password-update');
    });
   
    Route::get('log-activity', 'LogActivityController@index')->name('log-activity.index')->middleware('has_access:module.log-activity.index');
    Route::get('log-activity/{log_activity:id}/detail', 'LogActivityController@detail')->name('log-activity.detail')->middleware('has_access:module.log-activity.detail');
    Route::get('getLogAktivitasTable', 'LogActivityController@table')->name('log-activity.table')->middleware('has_access:module.log-activity.index');

    Route::group(['prefix' => 'surat', 'as' => 'surat.', 'namespace' => 'Surat'], function() {

        Route::group(['prefix' => 'pengajuan', 'as' => 'pengajuan.'], function() {
            Route::get('/', 'PengajuanController@index')->name('index')->middleware('has_access:module.surat.pengajuan.index');
            Route::get('/tambah', 'PengajuanController@create')->name('create')->middleware('has_access:module.surat.pengajuan.create');
            Route::post('/store', 'PengajuanController@store')->name('store');

            Route::get('/{pengajuan:slug}/ubah', 'PengajuanController@edit')->name('edit');
          
            Route::match(['put', 'patch'], '/{pengajuan:slug}', 'PengajuanController@update')->name('update')->middleware('has_access:module.surat.pengajuan.edit');
            Route::delete('/{pengajuan:slug}', 'PengajuanController@destroy')->name('destroy')->middleware('has_access:module.surat.pengajuan.delete');
            Route::get('/table', 'PengajuanController@table')->name('table')->middleware('has_access:module.surat.pengajuan.index');
        });


        Route::group(['prefix' => 'surat_masuk', 'as' => 'masuk.'], function() {
            Route::get('/', 'SuratMasukController@index')->name('index')->middleware('has_access:module.surat.masuk.index');
            Route::get('/tambah', 'SuratMasukController@create')->name('create')->middleware('has_access:module.surat.masuk.create');
            Route::post('/store', 'SuratMasukController@store')->name('store');

            Route::get('/{pengajuan:slug}/ubah', 'SuratMasukController@edit')->name('edit');
          
            Route::match(['put', 'patch'], '/{pengajuan:slug}', 'SuratMasukController@update')->name('update')->middleware('has_access:module.surat.masuk.edit');
            Route::delete('/{pengajuan:slug}', 'SuratMasukController@destroy')->name('destroy')->middleware('has_access:module.surat.masuk.delete');
            Route::get('/table', 'SuratMasukController@table')->name('table')->middleware('has_access:module.surat.masuk.index');
        });

        Route::group(['prefix' => 'surat_keluar', 'as' => 'keluar.'], function() {
            Route::get('/', 'SuratKeluarController@index')->name('index')->middleware('has_access:module.surat.keluar.index');
            Route::get('/tambah', 'SuratKeluarController@create')->name('create')->middleware('has_access:module.keluar.create');
            Route::post('/store', 'SuratKeluarController@store')->name('store');
            Route::get('/{pengajuan:slug}/ubah', 'SuratKeluarController@edit')->name('edit');
            Route::match(['put', 'patch'], '/{pengajuan:slug}', 'SuratKeluarController@update')->name('update')->middleware('has_access:module.surat.keluar.edit');
            Route::delete('/{pengajuan:slug}', 'SuratKeluarController@destroy')->name('destroy')->middleware('has_access:module.surat.keluar.delete');
            Route::get('/table', 'SuratKeluarController@table')->name('table')->middleware('has_access:module.surat.keluar.index');
        });
    });

    Route::group(['prefix' => 'data-master', 'as' => 'data-master.', 'namespace' => 'DataMaster'], function() {
        Route::group(['prefix' => 'jabatan', 'as' => 'jabatan.'], function() {
            Route::get('/', 'JabatanController@index')->name('index')->middleware('has_access:module.data-master.jabatan.index');
            Route::get('/tambah', 'JabatanController@create')->name('create')->middleware('has_access:module.data-master.jabatan.create');
            Route::post('/', 'JabatanController@store')->name('store')->middleware('has_access:module.data-master.jabatan.create');
            Route::get('/{jabatan:slug}/ubah', 'JabatanController@edit')->name('edit')->middleware('has_access:module.data-master.jabatan.edit');
            Route::match(['put', 'patch'], '/{jabatan:slug}', 'JabatanController@update')->name('update')->middleware('has_access:module.data-master.jabatan.edit');
            Route::delete('/{jabatan:slug}', 'JabatanController@destroy')->name('destroy')->middleware('has_access:module.data-master.jabatan.delete');
            Route::get('/table', 'JabatanController@table')->name('table')->middleware('has_access:module.data-master.jabatan.index');
        });

        Route::group(['prefix' => 'karyawan', 'as' => 'karyawan.'], function() {
            Route::get('/', 'KaryawanController@index')->name('index')->middleware('has_access:module.data-master.karyawan.index');
            Route::get('/tambah', 'KaryawanController@create')->name('create')->middleware('has_access:module.data-master.karyawan.create');
            Route::post('/', 'KaryawanController@store')->name('store')->middleware('has_access:module.data-master.karyawan.create');
            Route::get('/{karyawan:slug}/ubah', 'KaryawanController@edit')->name('edit')->middleware('has_access:module.data-master.karyawan.edit');
            Route::match(['put', 'patch'], '/{karyawan:slug}', 'KaryawanController@update')->name('update')->middleware('has_access:module.data-master.karyawan.edit');
            Route::delete('/{karyawan:slug}', 'KaryawanController@destroy')->name('destroy')->middleware('has_access:module.data-master.karyawan.delete');
            Route::get('/table', 'KaryawanController@table')->name('table')->middleware('has_access:module.data-master.karyawan.index');
        });

        Route::group(['prefix' => 'banner', 'as' => 'banner.'], function() {
            Route::get('/', 'BannerController@index')->name('index')->middleware('has_access:module.data-master.banner.index');
            Route::get('/{banner:slug}/ubah', 'BannerController@edit')->name('edit')->middleware('has_access:module.data-master.banner.edit');
            Route::match(['put', 'patch'], '/{banner:slug}', 'BannerController@update')->name('update')->middleware('has_access:module.data-master.banner.edit');
            Route::delete('/{banner:slug}', 'BannerController@destroy')->name('destroy')->middleware('has_access:module.data-master.banner.delete');
            Route::get('/table', 'BannerController@table')->name('table')->middleware('has_access:module.data-master.banner.index');
        });

    });
});

Route::get('/{pengajuan:slug}/sertifikasi', 'Admin\Surat\SuratMasukController@sertifikasi')->name('sertifikasi');
