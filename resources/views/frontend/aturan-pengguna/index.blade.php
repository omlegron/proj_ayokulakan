@extends('layouts.scaffold')

@section('js-filters')
d.nama = $("input[name='filter[name]']").val();
@endsection

@section('rules')
<script type="text/javascript">
formRules = {
    judul: ['empty'],
};
</script>
@endsection

@section('css')
    <style type="text/css">
        .ft0{font: bold 32px 'Arial';color: #ffc000;line-height: 37px;}
        .ft1{font: bold 32px 'Arial';color: #00b050;line-height: 37px;}
        .ft2{font: bold 19px 'Arial';line-height: 22px;}
        .ft3{font: 15px 'Arial';color: #0000ee;line-height: 17px;}
        .ft4{font: 15px 'Arial';line-height: 17px;}
        .ft5{font: 15px 'Arial';margin-left: 20px;line-height: 17px;}
        .ft6{font: 15px 'Arial';line-height: 16px;}
        .ft7{font: 15px 'Arial';margin-left: 20px;line-height: 16px;}
        .ft8{font: 15px 'Arial';margin-left: 10px;line-height: 17px;}
        .ft9{font: 11px 'Arial';line-height: 14px;}
        .ft10{font: 15px 'Arial';color: #222222;line-height: 17px;}
        .ft11{font: bold 19px 'Arial';color: #222222; line-height: 22px;}
        .ft12{font: 15px 'Arial';color: #222222;background-color: #f8f9fa;line-height: 17px;}
        .ft13{font: bold 15px 'Arial';color: #0000ee;line-height: 18px;}

        .terms-conditions {
            margin-top: 120px;
            text-align: justify;
        }

        .terms-conditions-page{
            padding-top: 0px !important;
        }

        @media only screen and (max-width: 768px) {
            .terms-conditions {
                margin-top: 220px;
                padding: 0 20px 0 40px;
            }
        }

    </style>
@endsection

@section('content-frontend')
<div class="terms-conditions-page">
    <div class="row">
        <a href="{{ url('/') }}" style="font-size:30px; color:orange !important"><i class="glyphicon glyphicon-arrow-left" style="padding: 20px"></i></a>
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-3">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item">Aturan Pengguna</li>
                                        <li class="list-group-item">Pengiriman</li>
                                        <li class="list-group-item">Aktivitas Yang Dilarang dan Menggunakan</li>
                                        <li class="list-group-item">Penyalahgunaan sistem</li>
                                        <li class="list-group-item">Sumber daya Layanan</li>
                                        <li class="list-group-item">Tidak ada kebijakan spam</li>
                                        <li class="list-group-item">Pencemaran nama baik dan konten yang tidak pantas</li>
                                        <li class="list-group-item">Konten Berhak Cipta</li>
                                        <li class="list-group-item">Keamanan</li>
                                        <li class="list-group-item">Pelaksanaan</li>
                                        <li class="list-group-item">Melaporkan Pelanggaran</li>
                                        <li class="list-group-item">Perubahan Dan Amandemen</li>
                                        <li class="list-group-item">Penerimaan Kebijakan Ini</li>
                                        <li class="list-group-item">Menghubungi Kami</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="scroll-tabs">
                        <div class="more-info-tab clearfix">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card-header">
                                        <h3 class="text-center" style="font-weight: bold">ATURAN PENGGUNA <span style="color: chocolate">AYO</span><span style="color: #00b050">KULAKAN</span></h3>
                                    </div>
                                    <div class="card-body">
                                        <p class="card-text">Kebijakan penggunaan yang dapat diterima ini adalah perjanjian antara Kami (operator situs web) dan Anda (User). Kebijakan ini
                                        menetapkan Pedoman Umum dan penggunaan situs web ayokulakan.com yang dapat diterima dan dilarang, serta setiap produk atau
                                        layanannya (secara kolektif disebut, "situs web" atau "Layanan").</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="scroll-tabs">
                        <div class="more-info-tab clearfix">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card-header">
                                        <h3 class="" style="font-weight: bold">Metode Pengiriman</h3>
                                    </div>
                                    <div class="card-body">
                                        <p class="card-text">Metode pengiriman yang di gunakan saat ini, menggunakan permintaan / request dari customer dari hasil pemesanan barang, dan memulai dengan request permintaan pengiriman barang.</p>
                                    </div>
                                    <div class="card-header">
                                        <h3 class="" style="font-weight: bold">Biaya pengiriman</h3>
                                    </div>
                                    <div class="card-body">
                                        <p class="card-text">Biaya pengiriman akan di tanggung oleh customer dan masuk ke dalam hitungan transaksi / total harga.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="scroll-tabs">
                        <div class="more-info-tab clearfix">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card-header">
                                        <h3 class="" style="font-weight: bold">Aktivitas Yang Dilarang dan Menggunakan</h3>
                                    </div>
                                    <div class="card-body">
                                        <p class="card-text">Anda tidak boleh menggunakan layanan untuk mempublikasikan konten atau terlibat dalam aktivitas yang ilegal menurut hukum yang
                                        berlaku, yang berbahaya bagi orang lain, atau yang akan tunduk pada tanggung jawab kami, termasuk, tanpa batasan, sehubungan dengan
                                        salah satu hal berikut, yang masing-masing dilarang berdasarkan kebijakan ini:
                                        </p>
                                        <p class="p0 ft4"><span class="ft4">●</span><span class="ft5">Mendistribusikan malware atau kode berbahaya lainnya.</span></p>
                                        <p class="p0 ft4"><span class="ft4">●</span><span class="ft5">Mengungkapkan informasi pribadi yang sensitif tentang orang lain.</span></p>
                                        <p class="p3 ft4"><span class="ft4">●</span><span class="ft5">Mengumpulkan, atau mencoba untuk mengumpulkan, informasi pribadi tentang pihak ketiga tanpa sepengetahuan atau persetujuan mereka.</span></p>
                                        <p class="p0 ft6"><span class="ft6">●</span><span class="ft7">Menyebarkan pornografi atau konten terkait dewasa.</span></p>
                                        <p class="p0 ft4"><span class="ft4">●</span><span class="ft5">Mempromosikan atau memfasilitasi prostitusi atau layanan pendamping.</span></p>
                                        <p class="p3 ft4"><span class="ft4">●</span><span class="ft5">Menghosting, mendistribusikan, atau menautkan pornografi anak atau konten yang berbahaya bagi anak di bawah umur.</span></p>
                                        <p class="p3 ft4"><span class="ft4">●</span><span class="ft5">Mempromosikan atau memfasilitasi perjudian, kekerasan, kegiatan teroris atau menjual senjata atau amunisi.</span></p>
                                        <p class="p3 ft4"><span class="ft4">●</span><span class="ft5">Terlibat dalam distribusi melanggar hukum zat yang dikendalikan, obat selundupan atau obat resep.</span></p>
                                        <p class="p3 ft6"><span class="ft6">●</span><span class="ft7">Mengelola agregator pembayaran atau fasilitator seperti memproses pembayaran atas nama bisnis lain atau badan amal.</span></p>
                                        <p class="p4 ft4"><span class="ft4">●</span><span class="ft5">Memfasilitasi skema piramida atau model lain yang dimaksudkan untuk mencari pembayaran dari pelaku publik.</span></p>
                                        <p class="p0 ft4"><span class="ft4">●</span><span class="ft5">Mengancam membahayakan orang atau properti atau perilaku melecehkan lainnya.</span></p>
                                        <p class="p0 ft4"><span class="ft4">●</span><span class="ft5">Melanggar kekayaan intelektual atau hak kepemilikan lainnya dari pihak lain.</span></p>
                                        <p class="p3 ft4"><span class="ft4">●</span><span class="ft5">Memfasilitasi, membantu, atau mendorong salah satu kegiatan di atas melalui layanan kami.</span></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="scroll-tabs">
                        <div class="more-info-tab clearfix">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card-header">
                                        <h3 class="" style="font-weight: bold">Penyalahgunaan Sistem</h3>
                                    </div>
                                    <div class="card-body">
                                        <p class="p1 ft4">Setiap pengguna yang melanggar keamanan Layanan kami tunduk pada tanggung jawab pidana dan perdata, serta penghentian akun segera. Contohnya termasuk, namun tidak terbatas pada hal berikut:</p>
                                        <p class="p0 ft4"><span class="ft4">●</span><span class="ft8">Penggunaan atau distribusi alat yang dirancang untuk mengorbankan keamanan Layanan.</span></p>
                                        <p class="p0 ft4"><span class="ft4">●</span><span class="ft8">Sengaja atau lalai mentransmisikan file yang berisi virus komputer atau data yang rusak.</span></p>
                                        <p class="p7 ft4"><span class="ft4">●</span><span class="ft8">Mengakses jaringan lain tanpa izin, termasuk untuk menyelidiki atau memindai kerentanan atau pelanggaran keamanan atau tindakan otentikasi.</span></p>
                                        <p class="p8 ft4"><span class="ft4">●</span><span class="ft8">Pemindaian yang tidak sah atau pemantauan data pada jaringan atau sistem tanpa otorisasi yang tepat dari pemilik sistem atau jaringan.</span></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="scroll-tabs">
                        <div class="more-info-tab clearfix">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card-header">
                                        <h3 class="" style="font-weight: bold">Sumber Daya Layanan</h3>
                                    </div>
                                    <div class="card-body">
                                        <p class="p1 ft4">Anda tidak boleh mengonsumsi layanan secara berlebihan atau menggunakan layanan dengan cara apa pun yang menghasilkan masalah kinerja atau yang mengganggu Layanan bagi pengguna lain. Kegiatan yang dilarang yang berkontribusi terhadap penggunaan berlebihan, termasuk tanpa batasan:</p>
                                        <p class="p8 ft4"><span class="ft4">●</span><span class="ft8">Upaya yang disengaja untuk membebani layanan dan serangan siaran (yaitu penolakan serangan layanan).</span></p>
                                        <p class="p0 ft4"><span class="ft4">●</span><span class="ft8">Terlibat dalam kegiatan lain yang menurunkan kegunaan dan kinerja layanan kami.</span></p>
                                        <br/>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="scroll-tabs">
                        <div class="more-info-tab clearfix">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card-header">
                                        <h3 class="" style="font-weight: bold">Tidak Ada Kebijakan Spam</h3>
                                    </div>
                                    <div class="card-body">
                                        <p class="p1 ft6">Anda tidak boleh menggunakan layanan kami untuk mengirim spam atau pesan yang tidak diminta massal. Kami mempertahankan kebijakan nol toleransi untuk penggunaan Layanan kami dengan cara apa pun yang terkait dengan transmisi, distribusi, atau pengiriman email massal, termasuk massal yang tidak diminta atau <NOBR>e-mail</NOBR> komersial yang tidak diminta, atau pengiriman, bantuan, atau commissioning transmisi email komersial yang tidak sesuai dengan <NOBR>Undang-Undang</NOBR> yang berlaku.</p>
                                        <p class="p10 ft4">Produk atau layanan Anda yang diiklankan melalui SPAM (yaitu Spamvertised) tidak dapat digunakan bersamaan dengan layanan kami. Ketentuan ini mencakup, namun tidak terbatas pada, SPAM dikirim melalui Faks, telepon, Surat pos, email, pesan instan, atau newsgroup.</p>
                                        <br/>
                                        <br/>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="scroll-tabs">
                        <div class="more-info-tab clearfix">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card-header">
                                        <h3 class="" style="font-weight: bold">Pencemaran nama baik dan konten yang tidak pantas</h3>
                                    </div>
                                    <div class="card-body">
                                        <p class="p11 ft4">Kami menghargai kebebasan berekspresi dan mendorong pengguna untuk menghormati konten yang mereka posting. Kami bukan penerbit konten pengguna dan tidak berada dalam posisi untuk menyelidiki kebenaran klaim pencemaran nama baik individu atau untuk menentukan apakah materi tertentu, yang dapat kita temukan tidak pantas, harus disensor. Namun, kami berhak untuk memoderasi, menonaktifkan, atau menghapus konten apa pun untuk mencegah bahaya bagi orang lain atau kepada kami atau layanan kami, sebagaimana ditentukan dalam kebijakan kami sendiri.</p>
                                         <br/>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="scroll-tabs">
                        <div class="more-info-tab clearfix">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card-header">
                                        <h3 class="" style="font-weight: bold">Konten berhak cipta</h3>
                                    </div>
                                    <div class="card-body">
                                        <p class="p1 ft4">Materi yang dilindungi hak cipta tidak boleh dipublikasikan melalui layanan kami tanpa izin eksplisit dari pemilik hak cipta atau orang yang secara eksplisit berwenang untuk memberikan izin tersebut oleh pemilik hak cipta. Setelah menerima klaim atas pelanggaran hak cipta, atau</p>
                                        <p class="p12 ft9"></p>
                                        <p class="p13 ft4">pemberitahuan pelanggaran tersebut, kami akan segera menjalankan investigasi penuh dan, setelah konfirmasi, akan segera menghapus materi yang melanggar dari layanan. Kami dapat menghentikan layanan pengguna dengan pelanggaran hak cipta berulang. Prosedur lebih lanjut dapat dilakukan jika diperlukan. Kami tidak akan bertanggung jawab kepada pengguna layanan untuk menghapus materi tersebut.</p>
                                        <p class="p14 ft10">Jika Anda yakin bahwa hak cipta Anda dilanggar oleh seseorang atau beberapa orang yang menggunakan Layanan kami, silakan kirim laporan pelanggaran hak cipta ke detail kontak yang tercantum di bagian akhir Kebijakan ini.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="scroll-tabs">
                        <div class="more-info-tab clearfix">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card-header">
                                        <h3 class="" style="font-weight: bold">Keamanan</h3>
                                    </div>
                                    <div class="card-body">
                                        <p class="p16 ft10">Anda bertanggung jawab penuh untuk menjaga keamanan yang masuk akal untuk akun Anda. Anda bertanggung jawab untuk melindungi dan memperbarui akun login apa pun yang <span class="ft12">diberikan kepada Anda untuk Layanan kami.</span></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="scroll-tabs">
                        <div class="more-info-tab clearfix">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card-header">
                                        <h3 class="" style="font-weight: bold">Pelaksanaan</h3>
                                    </div>
                                    <div class="card-body">
                                        <p class="p1 ft10">Kami berhak untuk menjadi penengah tunggal dalam menentukan keseriusan setiap pelanggaran dan untuk segera mengambil tindakan korektif, termasuk tetapi tidak terbatas pada:</p>
                                        <p class="p18 ft4"><span class="ft4">●</span><span class="ft8">Menonaktifkan atau menghapus konten apa pun yang dilarang oleh kebijakan ini, termasuk untuk mencegah bahaya bagi orang lain atau kepada kami atau layanan kami, sebagaimana ditentukan oleh kami berdasarkan pertimbangan kami sendiri.</span></p>
                                        <p class="p7 ft4"><span class="ft4">●</span><span class="ft8">Melaporkan pelanggaran penegakan hukum sebagaimana ditentukan oleh kami berdasarkan pertimbangan kami sendiri.</span></p>
                                        <p class="p19 ft4"><span class="ft4">●</span><span class="ft8">Kegagalan untuk menanggapi email dari tim penyalahgunaan kami dalam waktu 2 hari, atau sebagaimana dinyatakan dalam komunikasi kepada Anda, dapat mengakibatkan penangguhan atau penghentian layanan Anda.</span></p>
                                        <p class="p20 ft4">Ditangguhkan dan diakhiri akun pengguna karena pelanggaran tidak akan diaktifkan kembali. Tidak ada yang terkandung dalam kebijakan ini yang akan ditafsirkan untuk membatasi tindakan atau upaya hukum kami dengan cara apa pun sehubungan dengan aktivitas yang dilarang. Selain itu, kami selalu mencadangkan semua hak dan upaya hukum yang tersedia bagi kami sehubungan dengan kegiatan yang dilakukan oleh <NOBR>undang-undangan</NOBR> atau ekuitas.</p>
                                        <br/>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="scroll-tabs">
                        <div class="more-info-tab clearfix">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card-header">
                                        <h3 class="" style="font-weight: bold">Melaporkan Pelanggaran</h3>
                                    </div>
                                    <div class="card-body">
                                        <p class="p21 ft4">Jika Anda telah menemukan dan ingin melaporkan pelanggaran kebijakan ini, silahkan hubungi kami segera. Kami akan menyelidiki situasi dan memberi Anda bantuan penuh.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="scroll-tabs">
                        <div class="more-info-tab clearfix">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card-header">
                                        <h3 class="" style="font-weight: bold">Perubahan Amandemen</h3>
                                    </div>
                                    <div class="card-body">
                                        <p class="p22 ft4">Kami berhak untuk mengubah kebijakan ini atau persyaratannya yang berkaitan dengan situs</p>
                                        <p class="p23 ft9"></p>
                                        <p class="p13 ft4">web atau layanan setiap saat, efektif setelah memposting versi terbaru kebijakan ini di situs web. Ketika kami melakukannya, kami akan mengirimkan email untuk memberitahu Anda. Terus menggunakan website setelah perubahan tersebut akan merupakan persetujuan Anda terhadap perubahan tersebut.</p>
                                        <br/>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="scroll-tabs">
                        <div class="more-info-tab clearfix">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card-header">
                                        <h3 class="" style="font-weight: bold">Penerimaan Kebijakan Ini</h3>
                                    </div>
                                    <div class="card-body">
                                        <p class="p1 ft4">Anda mengakui bahwa Anda telah membaca kebijakan ini dan menyetujui semua syarat dan ketentuannya. Dengan menggunakan situs web atau layanannya, Anda setuju untuk terikat dengan kebijakan ini. Jika Anda tidak setuju untuk mematuhi ketentuan kebijakan ini, Anda tidak berwenang untuk menggunakan atau mengakses situs web dan layanannya.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="scroll-tabs">
                        <div class="more-info-tab clearfix">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card-header">
                                        <h3 class="" style="font-weight: bold">Menghubungi Kami</h3>
                                    </div>
                                    <div class="card-body">
                                        <p class="p24 ft4">Jika Anda ingin menghubungi kami untuk memahami lebih lanjut tentang kebijakan ini atau ingin menghubungi kami mengenai masalah apapun yang berkaitan dengan hal itu, Anda dapat mengirim email ke <span class="ft3">Ayokulakan01@gmail.com</span><span class="ft10">.</span></p>
                                        <p class="p25 ft4">Dokumen ini terakhir diperbarui pada tanggal 6 Mei 2020.</p>
                                        <p class="p15 ft13"><a href="https://ayokulakan.com/">https://ayokulakan.com</a></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
