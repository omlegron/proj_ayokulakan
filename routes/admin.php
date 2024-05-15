<?php 
    // route karyawan
    Route::get('/', 'Dashboard\DashboardController@index')->name('dashboard');
    Route::get('/karyawan', 'Dashboard\KaryawanController@index')->name('karyawan');
    Route::get('/karyawan/show/{id}', 'Dashboard\KaryawanController@show')->name('karyawan.show');
    Route::get('/karyawan/searching', 'Dashboard\KaryawanController@search')->name('karyawan.search');
    Route::get('/karyawan/create', 'Dashboard\KaryawanController@create');
    Route::get('/karyawan/{id}/edit', 'Dashboard\KaryawanController@edit')->name('karyawan.edit');
    Route::post('/karyawan', 'Dashboard\KaryawanController@store');
    Route::put('/karyawan/{id}', 'Dashboard\KaryawanController@update')->name('karyawan.update');
    Route::delete('/karyawan/{id}', 'Dashboard\KaryawanController@delete')->name('karyawan.delete');

    // route user
    Route::get('/user', 'Dashboard\UserAyoController@index')->name('user');
    Route::get('/user/show/{id}', 'Dashboard\UserAyoController@show')->name('user.show');
    Route::get('/user/detail-transaksi/{id}', 'Dashboard\UserAyoController@shows')->name('detail.show');
    Route::get('/user/search', 'Dashboard\UserAyoController@search')->name('user.search');
    // route toko
    Route::resource('/toko', 'Dashboard\TokoController');
    Route::get('/toko/show/search','Dashboard\TokoController@search')->name('toko.search');
    Route::get('/toko/show/barang','Dashboard\TokoController@cari');
    Route::get('/toko/detail/{id}','Dashboard\TokoController@detail');

    // route sewa
    Route::resource('/sewa', 'Dashboard\SewaController');
    Route::get('/sewa/detail/{id}','Dashboard\SewaController@detail');

    // route kurir
    Route::get('/kurir','Dashboard\AdminKurirController@index');
    Route::get('/kurir/{id}','Dashboard\AdminKurirController@show')->name('kurir.show');
    Route::get('/kurir/show/verif','Dashboard\AdminKurirController@verif');
    Route::get('/kurir/show/batal-verif','Dashboard\AdminKurirController@batal');
    Route::get('/kurir/show/search','Dashboard\AdminKurirController@search');

    // route voucher
    Route::namespace('Dashboard')->group(function(){
        Route::resource('/voucher', 'AdminVoucherController');
    });

    // route kaki lima
    Route::get('/kaki-lima','Dashboard\AdminKakiLimaController@index');
    Route::get('/kaki-lima/{id}','Dashboard\AdminKakiLimaController@show')->name('kaki.show');
    Route::get('/kaki-lima/show/search','Dashboard\AdminKakiLimaController@search');
    Route::get('/kaki-lima/show/verif','Dashboard\AdminKakiLimaController@verif');
    Route::get('/kaki-lima/show/batal-verif','Dashboard\AdminKakiLimaController@batal');

    // route haji umroh
    Route::get('/haji-umroh','Dashboard\AdminHajiUmrohController@index');
    Route::get('/haji-umroh/{id}','Dashboard\AdminHajiUmrohController@show');

    // galerry keagamaan

    Route::resource('/galerry','Dashboard\AdminGaleryController');

    // route berita
    Route::resource('/berita','Dashboard\AdminBeritaController');
    Route::get('/berita/ajax/search','Dashboard\AdminBeritaController@search');

    // route konten-web
    Route::get('/konten-web','Dashboard\KontenWebController@index');
    Route::get('/konten-web/{id}/edit','Dashboard\KontenWebController@edit');
    Route::put('/konten-web/{id}','Dashboard\KontenWebController@update');
    Route::get('/konten-web/create','Dashboard\KontenWebController@create');
    Route::post('/konten-web','Dashboard\KontenWebController@store');

    // route pembayaran-online
    Route::get('pembayaran','Dashboard\PembayaranController@index');

    // roue auth
    Route::get('login','Dashboard\auth\AdminLoginController@index');
    Route::post('login','Dashboard\auth\AdminLoginController@login');

?>