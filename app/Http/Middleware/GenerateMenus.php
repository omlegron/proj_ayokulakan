<?php

namespace App\Http\Middleware;

use Closure;
use Menu;
use Auth;

class GenerateMenus
{
     /**
      * Handle an incoming request.
      *
      * @param  \Illuminate\Http\Request  $request
      * @param  \Closure  $next
      * @return mixed
      */
     public function handle($request, Closure $next)
     {
          Menu::make('mainMenu', function ($menu) {
               if (Auth::check()) {
                    // $menu->add('Dashboard','dashboard')->data('icon', 'ion-ios-home')->data('tipe', 'width');

                    // $menu->add('My Account')
                    //          ->data('icon', 'file alternate')->data('tipe', 'width');
                    //     $menu->myAccount->add('Profiles', '#')->data('icon', 'edit');
                    //     $menu->myAccount->add('Barang', '#')->data('icon', 'edit');
                    //     $menu->myAccount->add('Barang', '#')->data('icon', 'edit');

                    if (Auth::check()) {
                         if (auth()->user()->status == 1010) {
                              $menu->add('All Berita', 'berita')->data('icon', 'ion-ios-home')->data('tipe', 'width');
                              $menu->add('All Kurir', 'list-kurir')->data('icon', 'ion-ios-shop')->data('tipe', 'width');
                              $menu->add('All Kaki Lima', 'list-kaki-lima')->data('icon', 'ion-ios-shop')->data('tipe', 'width');
                              $menu->add('All Lapak', 'data/data-lapak')->data('icon', 'file alternate')->data('tipe', 'width');
                              $menu->add('All Barang', 'data/data-barang')->data('icon', 'file alternate')->data('tipe', 'width');
                         }
                    }
                    $menu->add('Refound', 'refounds')->data('icon', 'ion-ios-shop')->data('tipe', 'width');
                    $menu->add('Data History Order & Transaksi', 'history-trans')->data('icon', 'ion-ios-shop')->data('tipe', 'width');
                    $menu->add('Pesanan Barang Masuk', 'list-order')->data('icon', 'ion-ios-shop')->data('tipe', 'width');
                    $menu->add('Pesanan Sewa Masuk', 'list-order-rental')->data('icon', 'ion-ios-shop')->data('tipe', 'width');
                    $menu->add('Partner')->data('icon', 'file alternate')->data('tipe', 'width');
                    $menu->partner->add('Partner Kaki Lima', 'partner/partner-kaki-lima')->data('icon', 'edit');
                    $menu->partner->add('Partner Kurir', 'partner/partner-kurir')->data('icon', 'edit');
                    $menu->add('Setting Lapak', 'settings-lapak')->data('icon', 'ion-ios-home')->data('tipe', 'width');
                    $menu->add('Setting Sewa', 'settings-rental')->data('icon', 'ion-ios-home')->data('tipe', 'width');
                    $menu->add('Setting Brand Store', 'settings-brand')->data('icon', 'ion-ios-home')->data('tipe', 'width');

                    $hajiUmroh = $menu->add('Haji & Umroh')->data('icon', 'users')->data('tipe', 'width');
                    $hajiUmroh->add('Riwayat Pendaftaran', 'haji-umroh/riwayat-pendaftaran/')->data('icon', 'edit');

                    if (Auth::check()) {
                         if (auth()->user()->status == 1010) {

                              $hajiUmroh->add('Berita Terbaru', 'haji-umroh/berita-terbaru')->data('icon', 'edit');
                              $hajiUmroh->add('Gallery Photo', 'haji-umroh/gallery/')->data('icon', 'edit');
                              // $hajiUmroh->add('Paket Haji', 'haji-umroh/haji-paket/')->data('icon', 'edit');
                              $hajiUmroh->add('Paket & Jadwal Haji', 'haji-umroh/haji-jadwal/')->data('icon', 'edit');
                              $hajiUmroh->add('Daftar Haji', 'haji-umroh/haji-daftar/')->data('icon', 'edit');
                              $hajiUmroh->add('Feedback Haji', 'haji-umroh/haji-feedback/')->data('icon', 'edit');
                              $hajiUmroh->add('Angsuran Haji', 'haji-umroh/haji-angsuran/')->data('icon', 'edit');
                              $hajiUmroh->add('Rekap Haji', 'haji-umroh/haji-rekap/')->data('icon', 'edit');


                              /* Haji & Umroh */

                              $menu->add('Master')
                                   ->data('icon', 'file alternate')->data('tipe', 'width');

                              // $menu->master->add('Template Chat', 'master/template/chat')->data('icon', 'edit');

                              $menu->master->add('Rajaongkir', 'master/rajaongkir');

                              $menu->master->add('Kategori Barang', 'master/barang/kategori-barang')
                                   ->data('icon', 'edit');
                              $menu->master->add('Sub Kategori Barang', 'master/barang/sub-kategori-barang')
                                   ->data('icon', 'edit');
                              $menu->master->add('Child Kategori Barang', 'master/barang/child-kategori-barang')->data('icon', 'edit');

                              $menu->master->add('PPOB List', 'master/ppob-pulsa')
                                   ->data('icon', 'edit');
                              $menu->master->add('PPOB Provider', 'master/ppob-provider')
                                   ->data('icon', 'edit');
                              $menu->master->add('PPOB Pdam', 'master/ppob-pdam')
                                   ->data('icon', 'edit');


                              $menu->master->add('Tiket Airport', 'master/airport')
                                   ->data('icon', 'edit');
                              $menu->master->add('Tiket Pelni', 'master/pelni')
                                   ->data('icon', 'edit');
                              $menu->master->add('Tiket Stasiun Kereta', 'master/stasiun-kereta')
                                   ->data('icon', 'edit');


                              $menu->master->add('Kategori Rental', 'master/rental/kategori-rental')
                                   ->data('icon', 'edit');
                              $menu->master->add('Sub Kategori Rental', 'master/rental/sub-kategori-rental')
                                   ->data('icon', 'edit');

                              $menu->master->add('Kategori Store', 'master/store/kategori-store')
                                   ->data('icon', 'edit');


                              $menu->master->add('Wilayah Negara', 'master/wilayah/negara')
                                   ->data('icon', 'edit');
                              $menu->master->add('Wilayah Provinsi', 'master/wilayah/provinsi')
                                   ->data('icon', 'edit');
                              $menu->master->add('Wilayah Kab / Kota', 'master/wilayah/kab-kota')
                                   ->data('icon', 'edit');
                              $menu->master->add('Wilayah Kecamatan', 'master/wilayah/kecamatan')
                                   ->data('icon', 'edit');

                              $menu->master->add('Aplikasi Data', 'master/aplikasi/data')
                                   ->data('icon', 'edit');
                              $menu->master->add('Aplikasi Panduan & Bantuan', 'master/aplikasi/panduan')
                                   ->data('icon', 'edit');
                              $menu->master->add('Aplikasi Sosial Media', 'master/aplikasi/sosial')
                                   ->data('icon', 'edit');

                              $menu->master->add('Galeri Zakat', 'master/gallery-zakat')
                                   ->data('icon', 'edit');
                              /* User Management */
                              $menu->add('User Management')
                                   ->data('icon', 'users')->data('tipe', 'width');
                              $menu->userManagement->add('Admin / Cs', 'user-management/users-administrations/')
                                   ->data('icon', 'edit');
                              $menu->userManagement->add('User Pembeli / Penjual / Kurir', 'user-management/users-pengguna/')
                                   ->data('icon', 'edit');
                              $menu->userManagement->add('Role & Permission', 'user-management/roles/')
                                   ->data('icon', 'edit');
                         }
                    }
               }
          });

          Menu::make('mainMenuFrontEnd', function ($menuFrontEnd) {
               $menuFrontEnd->add('Ayokulakan','#')->data('img', asset('img/pilihan/tentang.png'))->data('icon', 'fa fa-angle-down')
               ->data('tipe', 'two');
                   $menuFrontEnd->ayokulakan->add('Tentang ayokulakan', 'tentang')->data('img_cart', asset('img/pilihan/tentang-ayo.jpg'))
                        ->data('icon', 'edit');
                   $menuFrontEnd->ayokulakan->add('Tentang Kurir', 'yokuy-kurir/show')->data('img_cart', asset('img/pilihan/tentang-kurir.jpg'))
                        ->data('icon', 'edit');
                   $menuFrontEnd->ayokulakan->add('Tentang Kaki Lima', 'kaki-lima/show')->data('img_cart', asset('img/pilihan/tentang-kaki.jpg'))
                   ->data('icon', 'edit');
                   $menuFrontEnd->ayokulakan->add('Aturan Pengguna', 'aturan-pengguna')->data('img_cart', asset('img/pilihan/tentang-pengguna.jpg'))
                   ->data('icon', 'edit');
                   $menuFrontEnd->ayokulakan->add('Perjanjian', 'perjanjian')->data('img_cart', asset('img/pilihan/tentang-perjanjian.jpg'))
                   ->data('icon', 'edit');
                   $menuFrontEnd->ayokulakan->add('Syarat & Ketentuan', 'syarat-dan-ketentuan')->data('img_cart', asset('img/pilihan/tentang-syarat.jpg'))
                   ->data('icon', 'edit');
                   $menuFrontEnd->ayokulakan->add('Kebijakan Privasi', 'kebijakan-privasi')->data('img_cart', asset('img/pilihan/tentang-kebijakan.jpg'))
                   ->data('icon', 'edit');
                   $menuFrontEnd->ayokulakan->add('Kontak Kami', 'kontak-kami')->data('img_cart', asset('img/pilihan/tentang-kontak.jpg'))
                   ->data('icon', 'edit');

               $menuFrontEnd->add('Panduan', '#')->data('img', asset('img/pilihan/panduan.png'))->data('icon', 'fa fa-angle-down')->data('tipe', 'two');
               $menuFrontEnd->panduan->add('Panduan Pelapak', 'fitur/pelapak/panduan-pelapak')->data('img_cart', asset('img/pilihan/panduan-pelapak.jpg'))
                    ->data('icon', 'edit');
               $menuFrontEnd->panduan->add('Panduan Pembeli', 'fitur/pembeli/panduan-pembeli')->data('img_cart', asset('img/pilihan/panduan-pembeli.jpg'))
                    ->data('icon', 'edit');
               $menuFrontEnd->panduan->add('Panduan Sewa', 'fitur/rental/sewa')->data('img_cart', asset('img/pilihan/panduan-sewa.jpg'))
                    ->data('icon', 'edit');
               $menuFrontEnd->panduan->add('Panduan Kurir', 'fitur/kurir/panduan-kurir')->data('img_cart', asset('img/pilihan/panduan-kurir.jpg'))
                    ->data('icon', 'edit');
               $menuFrontEnd->panduan->add('Panduan Kaki Lima', 'fitur/kaki-lima/panduan-kaki-lima')->data('img_cart', asset('img/pilihan/panduan-kaki.jpg'))
                    ->data('icon', 'edit');
               $menuFrontEnd->panduan->add('Panduan Haji & Umroh', 'fitur/haji-umroh/panduan')->data('img_cart', asset('img/pilihan/panduan-haji.jpg'))
                    ->data('icon', 'edit');
               // $menuFrontEnd->add('Agroteknologi','agroteknologi')->data('icon', '')->data('tipe', 'one');

               $menuFrontEnd->add('Fitur', '#')->data('img', asset('img/pilihan/fitur.png'))->data('icon', 'fa fa-angle-down')->data('tipe', 'two');

               $menuFrontEnd->fitur->add('Peta Kaki Lima', 'cari-kaki-lima')->data('img_cart', asset('img/pilihan/fitur-peta.jpg'))
                    ->data('icon', 'edit');
               $menuFrontEnd->fitur->add('Peta Mesjid', 'cari-mesjid')->data('img_cart', asset('img/pilihan/fitur-masjid.jpg'))->data('icon', 'edit');

               $menuFrontEnd->fitur->add('Prakiraan Cuaca', 'perkiraan-cuaca')->data('img_cart', asset('img/pilihan/fitur-cuaca.jpg'))
                    ->data('icon', 'edit');
               $menuFrontEnd->fitur->add('Kalender Tanam', 'kalender-tanam')->data('img_cart', asset('img/pilihan/fitur-kalender.jpg'))
                    ->data('icon', 'edit');
               $menuFrontEnd->fitur->add('Peta Kurir', 'kurir')->data('img_cart', asset('img/pilihan/lok-kurir.jpg'))
                    ->data('icon', 'edit');
               $menuFrontEnd->fitur->add('Informasi Perikanan', 'informasi-ikan')->data('img_cart', asset('img/pilihan/fitur-ikan.jpg'))
                    ->data('icon', 'edit');
               // $menuFrontEnd->fitur->add('Musim Tanam', 'musim-tanam')->data('icon', 'edit');

               $menuFrontEnd->fitur->add('Kurs', 'konversi-mata-uang')->data('img_cart', asset('img/pilihan/fitur-kurs.jpg'))
                    ->data('icon', 'edit');

               $menuFrontEnd->add('KAKI LIMA', 'kaki-lima')->data('img', asset('img/pilihan/kaki-lima.png'))->data('icon', '')->data('tipe', 'one');

               // $menuFrontEnd->ayokulakan->add('FAQ', 'ayokulakan/faq')
               //      ->data('icon', 'edit');
               $menuFrontEnd->add('YoKuy Kurir', 'yokuy-kurir')->data('img', asset('img/pilihan/yokuy-kurir.png'))->data('icon', '')->data('tipe', 'one');
               
               
               
               $hajiUmroh = $menuFrontEnd->add('Ayo Hijrah', '#')->data('img', asset('img/pilihan/ayo-hijarah.png'))->data('icon', 'fa fa-angle-down')->data('tipe', 'two');
               $hajiUmroh->add('Gallery Sosial Keagamaan', 'gallery-photo/')->data('img_cart', asset('img/pilihan/sosial-agama.png'))->data('icon', 'edit');
               $hajiUmroh->add('Tentang Haji & Umroh', 'tentang-haji-umroh/')->data('img_cart', asset('img/pilihan/hijrah-tentang.jpg'))->data('icon', 'edit');
               $hajiUmroh->add('Daftar Haji & Umroh', 'daftar-haji-umroh/')->data('img_cart', asset('img/pilihan/hijrah-daftar.jpg'))->data('icon', 'edit');
               $hajiUmroh->add('Zakat & Infaq', 'zakat-info')->data('img_cart', asset('img/pilihan/hijrah-zakat.jpg'))->data('icon', 'edit');
               $hajiUmroh->add('Arah Qiblat', 'arah-qiblat')->data('img_cart', asset('img/pilihan/arah-qiblat.jpg'))->data('icon', 'edit');
               $hajiUmroh->add('Jadwal Sholat', 'jadwal-sholat')->data('img_cart', asset('img/pilihan/jadwal-sholat.jpeg'))->data('icon', 'edit');
               $hajiUmroh->add('Al-Quran', 'quran')->data('img_cart', asset('img/pilihan/quran.png'))->data('icon', 'edit');
               $hajiUmroh->add('Hadits-Bukhari', 'hadits')->data('img_cart', asset('img/pilihan/hadits.png'))->data('icon', 'edit');
               

               $kabar = $menuFrontEnd->add('Kabar Terbaru', '#')->data('img', asset('img/pilihan/kabar-terbaru.png'))->data('icon', '')->data('tipe', 'two');
               $kabar->add('Berita Perikanan','pencarian-ikan/')->data('img_cart',asset('img/pilihan/berita-perikanan.png'))->data('icon','edit');
               $kabar->add('Berita Haji Umroh','berita-terbaru/')->data('img_cart',asset('img/pilihan/haji-umroh.png'))->data('icon','edit');
               $kabar->add('Berita Pertanian','kabar-terbaru/')->data('img_cart',asset('img/pilihan/berita-pertanian.png'))->data('icon','edit');

            //   $hajiUmroh->add('Ayo Zakat & Infaq', 'zakat-info')
            //         ->data('icon', 'edit');
               // $hajiUmroh->add('Galeri Zakat & Infaq', 'gallery-zakat-infaq')
               //      ->data('icon', 'edit');
          });
          return $next($request);
     }
}
