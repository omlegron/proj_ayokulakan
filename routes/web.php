<?php

use Intervention\Image\Facades\Image;

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
// Route::view('katam-terpadu', 'welcome');


// FRONT END;
if (substr(Request::path(), 0, 2) == 's/') {
    Route::group(['namespace' => 'NotFound'], function () {
        Route::get(Request::path(), 'NotFoundController@index');
        Route::get('404', 'NotFoundController@index');
        Route::get('notfound', 'NotFoundController@index');
    });
}

Route::get('/card_yokurir', 'ImageControl@kartu_yokurir')->name("kartu_yokurir.card");
Route::get('/card_kakilima', 'ImageControl@kartu_kakilima')->name("kakilima.card");
Route::group(['namespace' => 'Notification'], function () {
    Route::get('/mess-not/{id}/{review}', 'NotificationController@showNotif');
    Route::get('/mess-not', 'NotificationController@indexNotification');
    Route::get('/mess-not/show-all', 'NotificationController@showNotifAll');
    Route::post('/mess-not/store', 'NotificationController@store');
});

Route::group(['namespace' => 'Picture'], function () {
    Route::post('/picture/bulk-unlink', 'PictureController@bulkUnlink');
});

Route::group(['namespace' => 'FrontEnd'], function () {

    Route::group(['namespace' => 'Home'], function () {
        Route::get('/', 'HomeController@index');
        Route::get('/fbarang/{id}/{name}', 'HomeController@show');
        Route::get('/ajkategori/{id}', 'HomeController@ajkategori');
    });

    Route::group(['namespace' => 'Tentang'], function () {
        Route::get('/tentang', 'TentangController@index');
        Route::get('/aturan-pengguna', 'AturanPenggunaController@index');
        Route::get('/identitas-brand', 'IdentitasBrandController@index');
        Route::get('/kebijakan-privasi', 'KebijakanPrivasiController@index');
        Route::get('/kontak-kami', 'KontakKamiController@index');
        Route::post('kontak/saran', 'KontakKamiController@kontak')->name('kontak');
        Route::get('/syarat-dan-ketentuan', 'SyaratDanKetentuan@index');
        Route::get('/perjanjian', 'PerjanjianController@index');
        // Route::get('/fbarang/{id}/{name}', 'TentangController@show');
    });

    Route::group(['prefix' => 'fiturs', 'namespace' => 'PanduanPelapak'], function () {
        Route::get('/pelapak/panduan-pelapak', 'PanduanPelapakController@indexWebViews');

        Route::get('/pembeli/panduan-pembeli', 'PanduanPembeliController@indexWebViews');

        Route::get('/rental/rental-perental', 'PanduanRentalController@indexWebViews');

        Route::get('/kurir/panduan-kurir', 'PanduanKurirController@indexWebViews');

        Route::get('/kaki-lima/panduan-kaki-lima', 'PanduanKakiLimaController@indexWebViews');

        Route::get('/haji-umroh/panduan', 'PanduanHajiUmrohController@indexWebViews');
    });

    Route::group(['prefix' => 'fitur', 'namespace' => 'PanduanPelapak'], function () {
        Route::get('/pelapak/panduan-pelapak', 'PanduanPelapakController@index');

        Route::get('/pembeli/panduan-pembeli', 'PanduanPembeliController@index');

        Route::get('/rental/sewa', 'PanduanRentalController@index');

        Route::get('/kurir/panduan-kurir', 'PanduanKurirController@index');

        Route::get('/kaki-lima/panduan-kaki-lima', 'PanduanKakiLimaController@index');

        Route::get('/haji-umroh/panduan', 'PanduanHajiUmrohController@index');
    });

    Route::group(['namespace' => 'KabarTerbaru'], function () {
        Route::get('/kabar-terbaru', 'KabarTerbaruController@index');
        Route::post('/baca-berita', 'KabarTerbaruController@baca_berita');
        Route::get('/kabar-terbaru/sortAjax', 'KabarTerbaruController@sortajax');
        Route::get('/kabar-terbaru/{id}/kabar-terbaru/{judul}', 'KabarTerbaruController@show');
    });
    Route::group(['namespace' => 'PendaftaranKurir'], function () {
        Route::get('/yokuy-kurir', 'PendaftaranKurirController@index');
        Route::post('/yokuy-kurir/store', 'PendaftaranKurirController@store');
        Route::get('/yokuy-kurir/show', 'PendaftaranKurirController@tentang')->name('kurir-tentang');
        Route::post('/yokuy-kurir/newStore', 'PendaftaranKurirController@newStore');
        Route::get('/yokuy-kurir/pendaftaran', 'PendaftaranKurirController@create');
        Route::get('/yokuy-kurir/{id}/kabar-terbaru/{judul}', 'PendaftaranKurirController@show');
    });

    Route::group(['namespace' => 'KakiLima'], function () {
        Route::post('/kaki-lima/store', 'KakiLimaController@store');
        Route::get('/kaki-lima', 'KakiLimaController@index');
        Route::get('/kaki-lima/show','KakiLimaController@tentang')->name('kaki-lima');
        Route::get('/kaki-lima/pendaftaran', 'KakiLimaController@create');
    });

    Route::group(['prefix' => 'sc', 'namespace' => 'Searching'], function () {
        Route::get('/barang', 'SearchingController@index');
        Route::get('/barang/rental', 'SearchingController@rentalSerch')->name('search-rental');
        Route::get('/cat-barang/{categ}/{name}', 'SearchingController@categorySearch');
        Route::get('/aj-barang', 'SearchingController@ajIndex');
        Route::get('/aj-cat', 'SearchingController@ajcat');
        Route::get('/terdekat','SearchingController@closes');
        Route::get('/barang/{id}/{name}', 'SearchingController@show');
        Route::get('/barang/{id}', 'SearchingController@detail');
        Route::get('/sewa/{id}', 'SearchingController@details');

        Route::get('/rental', 'SearchingController@indexRental');
        Route::get('/rental/{id}/{name}', 'SearchingController@showRental');
        Route::get('/cat-rental/{categ}/{name}', 'SearchingController@categorySearchRental');
        Route::get('/cat-rental/all-lapak', 'SearchingController@allapak');
        Route::get('/aj-rental', 'SearchingController@ajIndexRental');
        Route::get('/ajx-sewa', 'SearchingController@ajRen');
    });

    Route::group(['prefix' => 'favorit', 'namespace' => 'Favorit'], function () {
        Route::get('/{id}', 'LikeFavoritBarangController@show');
        Route::get('/rental/{id}', 'LikeFavoritBarangController@showRental');
        Route::post('/hapus', 'LikeFavoritBarangController@hapus');
    });

    Route::group(['namespace' => 'Cart', 'middleware' => 'guest'], function () {
        Route::get('keranjang','CartController@indexCart');
        Route::get('keranjang/{id}/{jml}/{type}', 'CartController@tambahKeranjang');
        Route::get('keranjang/show', 'CartController@show');
        Route::get('keranjang/store', 'CartController@getKeranjang');
        Route::get('keranjang/pengiriman', 'CartController@getPengiriman');
        Route::get('keranjang/voucher', 'CartController@getvoucher');
        Route::get('keranjang/claim', 'CartController@getClaim');
        Route::get('keranjang/edit', 'CartController@getedit');
        Route::get('keranjang/edit-phone', 'CartController@getPhone');
        Route::get('keranjang/edit-mail', 'CartController@getMail');

        Route::post('keranjang/upload', 'CartController@upload');
        Route::post('keranjang/hapus', 'CartController@hapusKeranjang');
        Route::post('keranjang/pembayaran', 'CartController@storeKeranjang');
        Route::post('keranjang/store-mt', 'CartController@storeMidtrans');
        Route::post('keranjang/ubah-profile', 'CartController@storeProfile');

        Route::post('keranjang-sewa/upload', 'CartSewaController@upload');
        Route::get('keranjang-sewa/{id}/{jml}/{type}', 'CartSewaController@tambahKeranjang');
        Route::get('keranjang-sewa/show', 'CartSewaController@show');
        Route::post('keranjang-sewa/hapus', 'CartSewaController@hapusKeranjang');
        Route::post('keranjang-sewa/pembayaran', 'CartSewaController@storeKeranjang');
        Route::get('keranjang-sewa/store', 'CartSewaController@getKeranjang');
        Route::post('keranjang-sewa/store-mt', 'CartSewaController@storeMidtrans');
    });

    Route::group(['namespace' => 'Transaksi', 'middleware' => 'guest'], function () {
        Route::get('transaksi/confirmation/{order_id}', 'TransaksiController@confirmMidtrans');
        Route::post('transaksi/delete', 'TransaksiController@deleteTransaksi');
    });


    Route::group(['namespace' => 'HajiUmroh'], function () {
        Route::get('berita-terbaru', 'BeritaTerbaruHajiUmrohController@index');
        Route::post('baca-haji', 'BeritaTerbaruHajiUmrohController@bacaHaji');
        Route::get('berita-terbaru/{id}', 'BeritaTerbaruHajiUmrohController@show');
        Route::get('ajax-show', 'BeritaTerbaruHajiUmrohController@beritaajax');
        Route::resource('tentang-haji-umroh', 'TentangHajiUmrohController');
        Route::resource('gallery-photo', 'GalleryHajiUmrohController');
        Route::post('daftar-haji-umroh/store', 'DaftarHajiUmrohController@store');
        Route::get('daftar-haji-umroh', 'DaftarHajiUmrohController@index');
        Route::get('daftar-haji-umroh/paket/{id}', 'DaftarHajiUmrohController@paket');
        Route::get('daftar-haji-umroh/jadwal/{id}', 'DaftarHajiUmrohController@jadwal');
        Route::get('arah-qiblat', 'ArahQiblatController@index');
        Route::get('jadwal-sholat', 'JadwaSholatController@index');
        Route::get('ajx-kota', 'JadwaSholatController@kota');
        Route::post('jadwal-sholat/save-token', 'JadwaSholatController@saveToken')->name('jadwal-sholat-token');
        Route::post('jadwal-sholat/send/notification', 'JadwaSholatController@sendNotif')->name('token-send');
        Route::get('quran', 'JadwaSholatController@quran');
        Route::get('hadits', 'HaditsController@index');
        Route::post('baca-quran', 'JadwaSholatController@bacaQuran');
    });


    Route::group(['namespace' => 'Zakat'], function () {
        Route::get('zakat-info', 'ZakatController@info');
        Route::resource('gallery-zakat-infaq', 'GalleryZakatController');
    });

    Route::group(['namespace' => 'KonversiMataUang'], function () {
        Route::get('konversi-mata-uang', 'KonversiMataUangController@index');
    });

    Route::group(['namespace' => 'Maps'], function () {
        Route::get('maps-ayokulakan', 'MapController@index');
        Route::get('maps-ayokulakan-search', 'MapController@search');
        Route::get('cari-mesjid', 'MapController@mesjid');
        Route::get('cari-kaki-lima', 'MapController@kakiLima');
        Route::get('perkiraan-cuaca', 'MapController@cuaca');
        Route::get('kalender-tanam', 'MapController@tanam');
        Route::get('pencarian-ikan', 'MapController@ikan');
        Route::get('informasi-ikan', 'MapController@informasi');
        Route::post('baca-ikan', 'MapController@bacaIkan');
        Route::get('kurir', 'MapController@kurir');
    });

    Route::group(['namespace' => 'PPOB'], function () {
        Route::post('ppob-pulsa/store', 'PPOBPulsaController@storeMidtrans');
        Route::post('ppob-pulsa/check-pulsa', 'PPOBPulsaController@checkRequest');
        Route::post('ppob-pulsa/check-game', 'PPOBPulsaController@checkGame');

        Route::post('ppob-pasca/check-esamsat', 'PPOBPascaController@PPOBIquiryEsamsat');
        Route::post('ppob-pasca/check-bpjs', 'PPOBPascaController@PPOBIquiryBpjs');
        Route::post('ppob-pasca/check-pdam', 'PPOBPascaController@PPOBIquiryPdam');
        Route::post('ppob-pasca/check-pln-prabayar', 'PPOBPascaController@PPOBIquiryPlnPrabayar');
        Route::post('ppob-pasca/check-pln-postpaid', 'PPOBPascaController@PPOBIquiryPlnPostpaid');
        Route::post('ppob-pasca/check-tv', 'PPOBPascaController@PPOBIquiryTv');
        Route::post('ppob-pasca/check-internet', 'PPOBPascaController@PPOBIquiryInternet');
        Route::post('ppob-pasca/check-tlp-rmh', 'PPOBPascaController@PPOBIquiryTLpRmh');

        Route::post('ppob-pasca/store', 'PPOBPascaController@storeMidtrans');
    });

    Route::group(['namespace' => 'Ticket'], function () {
        Route::get('check-ticket/detail/{id}', 'CheckTiketController@show');
        Route::post('check-ticket/store', 'CheckTiketController@store');
        Route::post('check-ticket/check-kursi', 'CheckTiketController@checkKursi');
        Route::get('check-ticket/kereta', 'CheckTiketController@checkKereta');

        Route::get('/check-ticket/download/{id}', 'CheckTiketController@download');
        Route::post('/check-ticket/grid', 'CheckTiketController@grid');
        Route::get('/check-ticket/list', 'CheckTiketController@showList');
    });

    Route::group(['namespace' => 'Chat'], function () {
        Route::post('chat/notif', 'ChatController@postNotif');
        Route::post('chat/room/send-message', 'ChatController@sendChat');
        Route::post('chat/room/send-diskusi', 'ChatController@sendDiskusi');
        Route::post('chat/load-chat', 'ChatController@loadChat');
        Route::post('chat/add-friend', 'ChatController@addFriend');
        Route::get('chat/show-list', 'ChatController@showList');
        Route::get('chat/show-friend', 'ChatController@friendList');
        Route::get('chat', 'ChatController@index');
        Route::get('chat/diskusi','ChatController@diskusi');
        Route::get('chat/ulasan','ChatController@ulasan');
        Route::get('chat-sewa', 'ChatController@indexSewa');
    });

    Route::prefix('airlinee')->namespace('Darmawisata')->group(function () {
        Route::get('/', 'AirlineController@showAirlineForm')->name('airline');
        Route::get('/schedule', 'AirlineController@showAirlineSchedule')->name('airline.schedule');
        Route::get('/booking', 'AirlineController@showFormAirlineBookingList')->name('airline.booking');
        Route::post('/booking/grid', 'AirlineController@grid');
        Route::post('/booking/{id}', 'AirlineController@setAirlineBooking');
        Route::get('/booking/download/{id}', 'AirlineController@getBookingDownload');
        Route::get('/booking/detail/{id}', 'AirlineController@getBooking');
        Route::post('/issued', 'AirlineController@setIssued')->name('airline.issued');
        Route::post('/cart/{cart}', 'AirlineController@showAirlineCart')->name('airline.cart');
        Route::post('/cart-schedule/{cart}', 'AirlineController@showAirlineCartDul');
        Route::get('/get-schedule', 'AirlineController@getSchedule');
        Route::post('/baggaeMeal', 'AirlineController@getBaggaeAndMeal');
        Route::post('/price-booking', 'AirlineController@priceBooking');
    });

    Route::group(['prefix' => 'hotel','namespace' => 'Darmawisata'], function () {
        Route::get('/booking/download/{id}', 'HotelController@getBookingDownload');
        Route::get('/booking/detail/{id}', 'HotelController@getBookingDetail');
        Route::get('/booking-list', 'HotelController@showHotelBookingList');
        
        Route::post('/bayar/{id}', 'HotelController@bayar');
        Route::post('/booking-list/grid', 'HotelController@grid');
        Route::post('/bookings', 'HotelController@setBooking');
        Route::post('/detail', 'HotelController@getDetailRooms');
        
        Route::get('/searchRooms', 'HotelController@searchRooms');
        Route::get('/search', 'HotelController@search');
        Route::get('/', 'HotelController@index');
    });

    Route::group(['prefix' => 'kapal','namespace' => 'Darmawisata'], function () {
        Route::get('/', 'KapalController@index');
        Route::get('/info', 'KapalController@info');
        Route::get('/panduan', 'KapalController@panduan');
        Route::post('/bayar/{id}', 'KapalController@bayar');
        Route::get('/schedule', 'KapalController@schedule');
        Route::get('/rooms', 'KapalController@rooms');
        Route::post('/booking', 'KapalController@booking');
        Route::get('/booking-list', 'KapalController@getBookingList');
        Route::post('/booking-list/grid', 'KapalController@grid');
        Route::get('/booking/download/{id}', 'KapalController@getBookingDownload');
        Route::get('/booking/detail/{id}', 'KapalController@getBookingDetail');
    });

    Route::group(['prefix' => 'bus','namespace' => 'Darmawisata'], function () {
        Route::get('/', 'BusController@index');
        Route::get('/rute', 'BusController@rute');
        Route::get('/schedule', 'BusController@schedule');
        Route::get('/seat', 'BusController@seat');
        Route::post('/booking', 'BusController@booking');
        Route::get('/list', 'BusController@getList');
        Route::post('/list/grid', 'BusController@grid');
        Route::get('/download/{id}', 'BusController@getBookingDownload');
        Route::get('/detail/{id}', 'BusController@getBookingDetail');
        Route::post('/payment/{id}', 'BusController@bayar');
    });

    Route::group(['prefix' => 'tour','namespace' => 'Darmawisata'], function () {
        Route::get('/', 'TourController@index');
        Route::get('/search', 'TourController@search');
        Route::post('/booking', 'TourController@booking');
        Route::get('/list', 'TourController@getList');
        Route::post('/list/grid', 'TourController@grid');
        Route::get('/detail/{id}', 'TourController@getBookingDetail');
    });

    Route::group(['prefix' => 'travel','namespace' => 'Darmawisata'], function () {
        Route::get('/', 'TravelController@index');
        Route::get('/search', 'TravelController@search');
        Route::get('/seat', 'TravelController@seat');
        Route::post('/booking', 'TravelController@booking');
        Route::get('/list', 'TravelController@getList');
        Route::post('/list/grid', 'TravelController@grid');
        Route::get('/detail/{id}', 'TravelController@getBookingDetail');
        Route::get('/download/{id}', 'TravelController@getBookingDownload');
        Route::post('/payment/{id}', 'TravelController@bayar');
    });

});

Route::get('404', 'Dashboard\DashboardController@notFoundPage');
Route::get('/ampas', 'Ajax\MailJobQueueController@queue');

// BACKENd
Auth::routes();
Route::get('login/phone', 'Auth\LoginPhoneController@index');
Route::post('login/phone', 'Auth\LoginPhoneController@checkCredentials');
Route::post('login/checkNumber', 'Auth\LoginPhoneController@checkPhoneNumber');

// Route::group(['middleware' => 'auth'], function () {

Route::group(['prefix' => 'option', 'namespace' => 'Ajax'], function () {
    Route::get('showSubKategori/{id}', 'OptionController@showSubKategori');
    Route::get('id_sub_kategori/{id}', 'OptionController@showSubKategori');
    Route::get('id_child_kategori/{id}', 'OptionController@showSubChildKategori');
    Route::get('showSubProvinsi/{id}', 'OptionController@showSubProvinsi');
    Route::get('id_provinsi/{id}', 'OptionController@showSubProvinsi');
    Route::get('id_kota/{id}', 'OptionController@showSubKota');
    Route::get('id_kecamatan/{id}', 'OptionController@showSubKecamatan');
    Route::get('id_kelurahan/{id}', 'OptionController@showSubKelurahan');
    Route::get('showBarang/{id}', 'OptionController@showBarang');
    Route::get('showRental/{id}', 'OptionController@showRental');
    Route::get('showJadwalPaket/{id}', 'OptionController@showJadwalPaket');

    Route::get('sub_kategori_id/{id}', 'OptionController@showSubKategoriRental');
    //PPOB
    Route::get('PPOBPulsa/{type}/{val}', 'OptionController@PPOBPulsa');
    Route::get('PPOBPaket/{type}/{val}', 'OptionController@PPOBPulsa');

    // DARMAWISATA HOTEL
    Route::get('cityID/{id}', 'OptionController@darmawisataHotelKota');

    // DARMAWISATA TRAVEL
    Route::get('showTravelSub/{id}', 'OptionController@showTravelSub');

});

Route::get('/hapus-download-file/{id}', 'DownloadController@deleteFile');
Route::get('/hapus-download-attachment/{id}', 'DownloadController@deletePicture');
Route::get('/download-picture/{id}', 'DownloadController@picture');
Route::get('/download/{id}', 'DownloadController@index');
Route::get('/download-multiple-file/{id}/{type}', 'DownloadController@multipleDownloadFile');
Route::get('/download-multiple-picture/{id}/{type}', 'DownloadController@multipleDownloadPicture');

/* Lapak */
Route::group(['namespace' => 'BackEnd\Lapak', 'middleware' => 'guest'], function () {
    Route::get('settings-lapak/{id}/feedback', 'SettingLapakController@showFeedback');
    Route::get('settings-lapak/others', 'SettingLapakController@addBarang');
    Route::get('settings-lapak/show-kategori/{id}', 'SettingLapakController@ajlapak');

    Route::get('daftar-lapak','SettingLapakController@daftarLapak');
    Route::get('daftar-lapak/alamat','SettingLapakController@address');
    Route::get('daftar-lapak/bank','SettingLapakController@bank');
    Route::post('daftar-lapak','SettingLapakController@storeLapak');
    Route::post('daftar-lapak/address','SettingLapakController@storeAddress');
    Route::post('daftar-lapak/bank','SettingLapakController@storeBank');

    Route::get('settings-lapak/create-product', 'SettingLapakController@createProduct');
    Route::get('settings-lapak/history/trans-lapak', 'SettingLapakController@historyProduct');

    Route::get('settings-lapak/note','SettingLapakController@note');
    Route::post('settings-lapak/note','SettingLapakController@storeNote');
    Route::post('settings-lapak/kebijakan','SettingLapakController@storeKebijakan');
    Route::get('settings-lapak/address','SettingLapakController@setAddress');
    Route::resource('settings-lapak', 'SettingLapakController');
});
Route::group(['prefix' => 'settings-lapak', 'namespace' => 'BackEnd\Lapak', 'middleware' => 'guest'], function () {
    Route::get('pesanan/all', 'PesananController@index');
    Route::get('pesanan/pending', 'PesananController@pending');
    Route::get('pesanan/packing', 'PesananController@packing');
    Route::get('pesanan/set-tracking', 'PesananController@setTracking');
    Route::get('pesanan/tracking', 'PesananController@tracking');
    Route::get('pesanan/success', 'PesananController@success');
    Route::get('pesanan/cancel', 'PesananController@orderCanceled');
    Route::get('pesanan/pengembalian-barang', 'PesananController@returnProcess');
    Route::get('lapak/chat', 'PesananController@chat');
});

Route::group(['prefix' => 'settings-barang', 'namespace' => 'BackEnd\Lapak', 'middleware' => 'guest'],function () {
    Route::get('/','SettingLapakBarangController@index');
    Route::post('/', 'SettingLapakBarangController@store');
    Route::get('/show', 'SettingLapakBarangController@show');
    Route::put('/{id}', 'SettingLapakBarangController@update');
    Route::get('create/{id}', 'SettingLapakBarangController@create');
    Route::post('/hapus-barang', 'SettingLapakBarangController@delete');
    Route::get('/{id}/edit-barang', 'SettingLapakBarangController@edit');
});

Route::group(['namespace' => 'BackEnd\Brand', 'middleware' => 'guest'], function () {
    Route::get('settings-brand/product-brand','SettingBrandController@showProduct');
    Route::get('settings-brand/create-brand','SettingBrandController@craeteBrand');
    Route::post('settings-brand/create-product-brand','SettingBrandController@storeBrand');
    Route::resource('settings-brand', 'SettingBrandController');
});

Route::group(['prefix' => 'partner', 'namespace' => 'BackEnd\Partner', 'middleware' => 'guest'], function () {
    Route::resource('partner-kaki-lima', 'PartnerKakiLimaController');
});

Route::group(['prefix' => 'partner', 'namespace' => 'BackEnd\Partner', 'middleware' => 'guest'], function () {
    Route::resource('partner-kurir', 'PartnerKurirController');
});

/* Lapak */
Route::group(['namespace' => 'BackEnd\Rental', 'middleware' => 'guest'], function () {
    Route::get('settings-rental/{id}/detail', 'SettingsRentalController@showFeedback');
    Route::post('settings-rental/grid', 'SettingsRentalController@grid');
    Route::resource('settings-rental', 'SettingsRentalController');
});

// Route::group(['namespace' => 'Dashboard','middleware' => 'guest'], function(){
// //Dashboard
//     Route::resource('/dashboard', 'DashboardController');
// });

/* List Order */
Route::group(['namespace' => 'BackEnd\ListOrder', 'middleware' => 'guest'], function () {
    Route::get('list-order/{id}/detail', 'ListOrderController@show');
    Route::post('list-order/grid', 'ListOrderController@grid');
    Route::post('list-order/proses-barang/{id}', 'ListOrderController@prosesBarang');
    Route::resource('list-order', 'ListOrderController');
});

/* List Order Rental */
Route::group(['namespace' => 'BackEnd\ListOrder', 'middleware' => 'guest'], function () {
    Route::get('list-order-rental/{id}/detail', 'ListOrderRentalController@show');
    Route::post('list-order-rental/grid', 'ListOrderRentalController@grid');
    Route::resource('list-order-rental', 'ListOrderRentalController');
});

/* History Transaksi */
Route::group(['namespace' => 'BackEnd\HistoryTransaksi', 'middleware' => 'guest'], function () {
    Route::post('history-trans/refound/{id}', 'HistoryTransaksiController@refound');
    Route::get('history-trans/{id}/detail', 'HistoryTransaksiController@show');
    Route::post('history-trans/grid', 'HistoryTransaksiController@grid');
    Route::resource('history-trans', 'HistoryTransaksiController');
});


/* User Profile */
Route::group(['namespace' => 'BackEnd\Profile', 'middleware' => 'guest'], function () {
    Route::resource('myprofile', 'ProfileController');
    Route::post('profile-user/grid', 'UserProfileController@grid');
    Route::resource('profile-user', 'UserProfileController');
    Route::get('profile-bank', 'Bankcontroller@index');
    Route::post('profile-bank/rekening', 'Bankcontroller@storeRekening');
    Route::post('profile-bank/cart', 'Bankcontroller@storeCard');
    Route::get('ganti-pass', 'Bankcontroller@gantiPass');
    Route::post('ganti-pass/verivication', 'Bankcontroller@sendVerif');
    Route::post('ganti-pass/reset', 'Bankcontroller@resetPass');
});

Route::group(['namespace' => 'BackEnd\Pesanan', 'middleware' => 'guest'], function () {
    Route::get('pesanan','PesananController@index');
    Route::get('pesanan/pending','PesananController@pending');
    Route::get('pesanan/payment','PesananController@payment');
    Route::get('pesanan/packing','PesananController@packing');
    Route::get('pesanan/cancel','PesananController@orderCanceled');
    Route::get('pesanan/cron','PesananController@cronjob');
    Route::get('pesanan/history-order-transaksi','PesananController@history');
    Route::get('pesanan/search-histori','PesananController@search');
    Route::post('pesanan/grid','PesananController@grid');
});

Route::group(['namespace' => 'BackEnd\Profile', 'middleware' => 'guest'], function () {
    Route::get('myvoucher','VoucherController@index');
});

/* Haji & Umroh */
Route::group(['namespace' => 'BackEnd\HajiUmroh', 'middleware' => 'guest'], function () {
    //Berita Terbaru
    Route::post('haji-umroh/riwayat-pendaftaran/approve', 'RiwayatPendaftaranController@approve');
    Route::post('haji-umroh/riwayat-pendaftaran/grid', 'RiwayatPendaftaranController@grid');
    Route::resource('haji-umroh/riwayat-pendaftaran', 'RiwayatPendaftaranController');
});

/* Refound */
Route::group(['namespace' => 'BackEnd\Refound', 'middleware' => 'guest'], function () {
    Route::post('refounds/grid', 'RefoundController@grid');
    Route::resource('refounds', 'RefoundController');
});

////////////////////// ADMINISTRATOR //////////////////

/* Berita */
Route::group(['namespace' => 'BackEnd\Berita', 'middleware' => 'roleAdministration'], function () {
    Route::post('berita/grid', 'BeritaController@grid');
    Route::resource('berita', 'BeritaController');
});

Route::group(['namespace' => 'BackEnd\Kurir', 'middleware' => 'roleAdministration'], function () {
    Route::post('list-kurir/grid', 'KurirController@grid');
    Route::resource('list-kurir', 'KurirController');
});

/* All Lapak */
Route::group(['prefix' => 'data', 'namespace' => 'BackEnd\AllDataLapak', 'middleware' => 'roleAdministration'], function () {
    Route::post('data-lapak/grid', 'DataLapakController@grid');
    Route::resource('data-lapak', 'DataLapakController');
});

/* All Barang */
Route::group(['prefix' => 'data', 'namespace' => 'BackEnd\AllDataBarang', 'middleware' => 'roleAdministration'], function () {
    Route::post('data-barang/grid', 'AllDataBarangController@grid');
    Route::resource('data-barang', 'AllDataBarangController');
});

Route::group(['prefix' => 'master', 'namespace' => 'BackEnd\Master', 'middleware' => 'roleAdministration'], function () {

    //Kategori Barang
    Route::post('rajaongkir/grid', 'RajaongkirController@grid');
    Route::resource('template/chat', 'TemplateChatController');

    //Kategori Barang
    Route::post('barang/kategori-barang/grid', 'KategoriBarangController@grid');
    Route::resource('barang/kategori-barang', 'KategoriBarangController');

    Route::post('barang/sub-kategori-barang/grid', 'KategoriBarangSubController@grid');
    Route::resource('barang/sub-kategori-barang', 'KategoriBarangSubController');

    // update data kategori
    Route::get('barang/kategori-ayo/edit/{id}','KategoriBarangController@edit');
    Route::put('barang/kategori/{id}','KategoriBarangController@Update')->name('update');
    
    Route::post('barang/child-kategori-barang/grid', 'KategoriBarangChildController@grid');
    Route::resource('barang/child-kategori-barang', 'KategoriBarangChildController');

    Route::post('wilayah/negara/grid', 'WilayahNegaraController@grid');
    Route::resource('wilayah/negara', 'WilayahNegaraController');

    Route::post('wilayah/provinsi/grid', 'WilayahProvinsiController@grid');
    Route::resource('wilayah/provinsi', 'WilayahProvinsiController');

    Route::post('wilayah/kab-kota/grid', 'WilayahKotaController@grid');
    Route::resource('wilayah/kab-kota', 'WilayahKotaController');

    Route::post('wilayah/kecamatan/grid', 'WilayahKecamatanController@grid');
    Route::resource('wilayah/kecamatan', 'WilayahKecamatanController');

    Route::post('aplikasi/data/grid', 'AplikasiTentangController@grid');
    Route::resource('aplikasi/data', 'AplikasiTentangController');

    Route::post('aplikasi/panduan/grid', 'AplikasiPanduanController@grid');
    Route::resource('aplikasi/panduan', 'AplikasiPanduanController');

    Route::post('aplikasi/sosial/grid', 'AplikasiSosialController@grid');
    Route::resource('aplikasi/sosial', 'AplikasiSosialController');

    Route::post('ppob-pulsa/grid', 'PPOBPulsaController@grid');
    Route::resource('ppob-pulsa', 'PPOBPulsaController');

    Route::post('ppob-provider/grid', 'PPOBPulsaProviderController@grid');
    Route::resource('ppob-provider', 'PPOBPulsaProviderController');

    Route::post('ppob-pdam/grid', 'PPOBPdamController@grid');
    Route::resource('ppob-pdam', 'PPOBPdamController');

    Route::post('rental/kategori-rental/grid', 'KategoriRentalController@grid');
    Route::resource('rental/kategori-rental', 'KategoriRentalController');

    Route::post('rental/sub-kategori-rental/grid', 'KategoriRentalSubController@grid');
    Route::resource('rental/sub-kategori-rental', 'KategoriRentalSubController');

    Route::post('stasiun-kereta/grid', 'TicketingStasiunKeretaController@grid');
    Route::resource('stasiun-kereta', 'TicketingStasiunKeretaController');

    Route::post('airport/grid', 'AirportController@grid');
    Route::resource('airport', 'AirportController');

    Route::post('pelni/grid', 'TicketingPelniController@grid');
    Route::resource('pelni', 'TicketingPelniController');

    Route::post('gallery-zakat/grid', 'GalleryZakatController@grid');
    Route::resource('gallery-zakat', 'GalleryZakatController');

    //Rajaongkir
    Route::post('rajaongkir/grid', 'RajaongkirController@grid');
    Route::resource('rajaongkir', 'RajaongkirController');

    // Kategori Store
    Route::post('store/kategori-store/grid', 'KategoriStoreController@grid');
    Route::resource('store/kategori-store', 'KategoriStoreController');
});

/* User Management */
Route::group(['prefix' => 'user-management', 'namespace' => 'BackEnd\UserManagement', 'middleware' => 'roleAdministration'], function () {
    //User Administration
    Route::post('users-administrations/grid', 'UsersAdminsController@grid');
    Route::resource('users-administrations', 'UsersAdminsController');


    //User Pengguna
    Route::post('users-pengguna/grid', 'UsersPenggunaController@grid');
    Route::resource('users-pengguna', 'UsersPenggunaController');
});

/* Haji & Umroh */
Route::group(['prefix' => 'haji-umroh', 'namespace' => 'BackEnd\HajiUmroh', 'middleware' => 'roleAdministration'], function () {
    //Berita Terbaru
    Route::post('berita-terbaru/grid', 'BeritaTerbaruController@grid');
    Route::resource('berita-terbaru', 'BeritaTerbaruController');
    //Gallery
    Route::post('gallery/grid', 'GalleryController@grid');
    Route::resource('gallery', 'GalleryController');
    //Paket
    Route::post('haji-paket/grid', 'HajiPaketController@grid');
    Route::resource('haji-paket', 'HajiPaketController');

    //Jadwal
    Route::post('haji-jadwal/grid', 'HajiJadwalController@grid');
    Route::resource('haji-jadwal', 'HajiJadwalController');

    //Daftar
    Route::post('haji-daftar/grid', 'HajiDaftarController@grid');
    Route::resource('haji-daftar', 'HajiDaftarController');

    //Feedback
    Route::post('haji-feedback/grid', 'HajiFeedbackController@grid');
    Route::resource('haji-feedback', 'HajiFeedbackController');

    //Angsuran
    Route::post('haji-angsuran/grid', 'HajiAngsuranController@grid');
    Route::resource('haji-angsuran', 'HajiAngsuranController');

    //Rekap
    Route::post('haji-rekap/grid', 'HajiRekapController@grid');
    Route::resource('haji-rekap', 'HajiRekapController');
});

Route::group(['namespace' => 'BackEnd\KakiLima', 'middleware' => 'roleAdministration'], function () {
    Route::post('list-kaki-lima/grid', 'KakiLimaController@grid');
    Route::resource('list-kaki-lima', 'KakiLimaController');
});


Route::get('/logout', 'Auth\LoginController@logout');
Route::get('login/{provider}', 'Auth\LoginController@redirectToProvider');
Route::get('login/{provider}/callback', 'Auth\LoginController@handleProviderCallback');

Route::get('register/{provider}', 'Auth\RegisterController@redirectToProvider');
Route::get('register/{provider}/callback', 'Auth\RegisterController@handleProviderCallback');

// Route::get('/password/reset',function(){
//     Auth::logout();
//     return view('auth.reset');
// });

Route::post('password/email', 'Auth\ResetPasswordController@sendMail');

// forgout password
Route::post('password/change','Auth\ResetPasswordController@resetPassword');

// Route::get('password/email/change/{email}',function(){
//     Auth::logout();
//     return view('auth.passwords.reset');
// });

Route::get('password/reset', 'Auth\ResetPasswordController@index');
// // dashboard

// Route::group(['namespace' => 'Dashboard', 'middleware' => 'roleAdministration'], function () {
//     Route::get('dashboard/settings','DashboardController@coba');
// });

// official store
Route::group(['prefix' => 'official-store', 'namespace' => 'FrontEnd\OfficialStore',], function () {
    Route::get('/','OfficialStoreController@index');
    Route::get('/{slug}','OfficialStoreController@showBrand');
});