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
    .ft3{font: 15px 'Arial';line-height: 17px;}
    .ft4{font: 15px 'Times New Roman';line-height: 17px;}
    .ft5{font: 15px 'Arial';margin-left: 12px;line-height: 17px;}
    .ft6{font: 11px 'Arial';line-height: 14px;}
    .ft7{font: 15px 'Arial';line-height: 16px;}
    .ft8{font: 15px 'Arial';margin-left: 16px;line-height: 17px;}
    .ft9{font: 15px 'Arial';margin-left: 13px;line-height: 17px;}
    .ft10{font: 15px 'Arial';margin-left: 14px;line-height: 17px;}
    .ft11{font: 15px 'Arial';margin-left: 10px;line-height: 17px;}
    .ft12{font: 15px 'Arial';margin-left: 8px;line-height: 17px;}
    .ft13{font: 15px 'Arial';margin-left: 9px;line-height: 17px;}
    .ft14{font: 15px 'Arial';color: #0000ee;line-height: 17px;}
    .ft15{font: 15px 'Arial';color: #222222;line-height: 17px;}
    .ft16{font: bold 15px 'Arial';color: #0000ee;line-height: 18px;}

    .terms-conditions {
        margin-top: 120px;
        text-align: justify;
    }

    .terms-conditions-page{
        padding-top: 0px !important;
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
                                        <li class="list-group-item">Kebijakan Privasi</li>
                                        <li class="list-group-item">Pengumpulan informasi otomatis</li>
                                        <li class="list-group-item">Pengumpulan informasi pribadi</li>
                                        <li class="list-group-item">Mengelola informasi pribadi</li>
                                        <li class="list-group-item">Menyimpan informasi pribadi</li>
                                        <li class="list-group-item">Penggunaan dan pemrosesan informasi yang dikumpulkan</li>
                                        <li class="list-group-item">Transfer dan penyimpanan informasi</li>
                                        <li class="list-group-item">Hak-hak Pengguna</li>
                                        <li class="list-group-item">Cara menggunakan hak-hak ini</li>
                                        <li class="list-group-item">Hak privasi</li>
                                        <li class="list-group-item">Penagihan dan pembayaran</li>
                                        <li class="list-group-item">Penyedia produk dan layanan</li>
                                        <li class="list-group-item">Privasi anak-anak</li>
                                        <li class="list-group-item">Nawala</li>
                                        <li class="list-group-item">Pemasaran ulang</li>
                                        <li class="list-group-item">Tautan ke aplikasi seluler lainnya</li>
                                        <li class="list-group-item">Informasi keamanan</li>
                                        <li class="list-group-item">Pelanggaran data</li>
                                        <li class="list-group-item">Pengungkapan hukum</li>
                                        <li class="list-group-item">Perubahan dan amandemen</li>
                                        <li class="list-group-item">Penerimaan kebijakan ini</li>
                                        <li class="list-group-item">Menghubungi kami</li>
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
                                        <h3 class="text-center" style="font-weight: bold">Kebijakan Privasi <span style="color: chocolate">AYO</span><span style="color: #00b050">KULAKAN</span></h3>
                                    </div>
                                    <div class="card-body">
                                        <p class="p1 ft3">Kebijakan Privasi ini menjelaskan bagaimana CV. AYOKULAKAN mengumpulkan, melindungi dan menggunakan informasi pribadi Anda (User) dan dapat menyediakan dalam aplikasi mobile ayokulakan dan setiap produk atau jasa (secara kolektif, "aplikasi mobile" atau "Layanan").</p>
                                        <p class="p2 ft3">Hal ini juga menjelaskan pilihan yang tersedia bagi Anda mengenai penggunaan informasi pribadi Anda dan bagaimana Anda dapat mengakses dan memperbarui informasi ini. Kebijakan ini tidak berlaku untuk praktik perusahaan yang tidak kami miliki atau kendalikan, atau kepada individu yang tidak kami pekerjakan atau kelola.</p>
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
                                        <h3 class="" style="font-weight: bold">Pengumpulan informasi otomatis</h3>
                                    </div>
                                    <div class="card-body">
                                        <p class="p1 ft3">Ketika Anda membuka aplikasi mobile server kami secara otomatis merekam informasi yang dikirim perangkat Anda. Data ini dapat mencakup informasi seperti alamat IP dan lokasi perangkat Anda, nama dan versi perangkat, jenis dan versi sistem operasi, preferensi bahasa, informasi yang Anda Cari di aplikasi seluler kami, waktu akses, dan tanggal, serta Statistik lainnya.</p>
                                        <p class="p2 ft3">Informasi yang dikumpulkan secara otomatis hanya digunakan untuk mengidentifikasi potensi kasus pelecehan dan membuat informasi statistik mengenai lalu lintas aplikasi mobile dan penggunaan. Informasi statistik ini tidak sebaliknya digabungkan sedemikian rupa yang akan mengidentifikasi pengguna tertentu dari sistem.</p>
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
                                        <h3 class="" style="font-weight: bold">Pengumpulan informasi pribadi</h3>
                                    </div>
                                    <div class="card-body">
                                        <p class="p1 ft3">Anda dapat mengunjungi aplikasi mobile tanpa memberitahu kami siapa Anda atau mengungkapkan informasi apapun dengan mana seseorang bisa mengidentifikasi Anda sebagai spesifik, individu yang dapat diidentifikasi. Namun, jika Anda ingin menggunakan beberapa fitur aplikasi mobile, Anda akan diminta untuk memberikan informasi pribadi tertentu (misalnya, nama dan alamat email Anda). Kami menerima dan menyimpan informasi yang Anda berikan kepada kami secara sengaja saat Anda membuat akun, melakukan pembelian, atau mengisi formulir online apa pun di aplikasi seluler. Bila diperlukan, informasi ini dapat meliputi berikut ini :</p>
                                        <p class="p4 ft3"><span class="ft4">∙</span><span class="ft5">Rincian pribadi seperti nama, negara kediaman, dll.</span></p>
                                        <p class="p5 ft3"><span class="ft4">∙</span><span class="ft5">Informasi kontak seperti alamat email, alamat, dll.</span></p>
                                        <p class="p5 ft3"><span class="ft4">∙</span><span class="ft5">Rincian akun seperti nama pengguna, user ID unik, password, dll.</span></p>
                                        <p class="p5 ft3"><span class="ft4">∙</span><span class="ft5">Bukti identitas seperti Fotokopi KTP pemerintah.</span></p>
                                        <p class="p5 ft3"><span class="ft4">∙</span><span class="ft5">Informasi pembayaran seperti rincian kartu kredit, rincian bank, dll.</span></p>
                                        <p class="p0 ft3"><span class="ft4">∙</span><span class="ft5">Data geolokasi dari perangkat seluler seperti garis lintang dan garis bujur.</span></p>
                                        <p class="p5 ft3"><span class="ft4">∙</span><span class="ft5">Fitur tertentu pada perangkat mobile seperti kontak, kalender, Galeri, dll.</span></p>
                                        <p class="p6 ft6"></p>
                                        <p class="p7 ft3">Anda dapat memilih untuk tidak memberikan informasi pribadi Anda kepada kami, tetapi kemudian Anda mungkin tidak dapat mengambil keuntungan dari beberapa fitur aplikasi mobile. Pengguna yang tidak yakin tentang informasi apa yang wajib dipersilahkan untuk menghubungi kami.</p>
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
                                        <h3 class="" style="font-weight: bold">Mengelola informasi pribadi</h3>
                                    </div>
                                    <div class="card-body">
                                        <p class="p1 ft3">Anda dapat menghapus informasi pribadi tertentu yang kami miliki tentang Anda. Informasi pribadi yang dapat Anda hapus dapat berubah karena perubahan aplikasi seluler atau layanan. Namun, bila Anda menghapus informasi pribadi, kami dapat menyimpan salinan informasi pribadi yang tidak direvisi dalam catatan kami selama durasi yang diperlukan untuk mematuhi kewajiban kami kepada afiliasi dan mitra kami, dan untuk tujuan yang dijelaskan di bawah ini. Jika Anda ingin menghapus informasi pribadi Anda atau menghapus akun Anda secara permanen, Anda dapat melakukannya pada halaman pengaturan akun Anda di aplikasi mobile.</p>
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
                                        <h3 class="" style="font-weight: bold">Menyimpan informasi pribadi</h3>
                                    </div>
                                    <div class="card-body">
                                        <p class="p8 ft3">Kami akan menyimpan dan menggunakan informasi pribadi Anda untuk jangka waktu yang diperlukan untuk mematuhi kewajiban hukum kami, menyelesaikan sengketa, dan menegakkan Perjanjian kami kecuali jika periode retensi lebih lama diperlukan atau diizinkan oleh hukum. Kami dapat menggunakan data agregat apa pun yang berasal dari atau menggabungkan informasi pribadi Anda setelah Anda memperbarui atau menghapusnya, tetapi tidak dengan cara yang akan mengidentifikasi Anda secara pribadi. Setelah periode retensi berakhir, informasi pribadi akan dihapus. Oleh karena itu, hak untuk mengakses, hak untuk menghapus, hak untuk rektifikasi dan hak untuk data portabilitas tidak dapat diberlakukan setelah berakhirnya periode retensi.</p>
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
                                        <h3 class="" style="font-weight: bold">Penggunaan dan pemrosesan informasi yang dikumpulkan</h3>
                                    </div>
                                    <div class="card-body">
                                        <p class="p10 ft7">Dalam rangka untuk membuat aplikasi mobile kami dan layanan yang tersedia untuk Anda, atau untuk memenuhi kewajiban hukum, kami perlu mengumpulkan dan menggunakan informasi pribadi tertentu. Jika Anda tidak memberikan informasi yang kami minta, kami mungkin tidak dapat menyediakan produk atau layanan yang diminta kepada Anda. Beberapa informasi yang kami kumpulkan langsung dari Anda melalui aplikasi mobile kami. Namun, kami juga dapat mengumpulkan informasi pribadi tentang Anda dari sumber lain seperti media sosial, email, dll. Setiap informasi yang kami kumpulkan dari Anda dapat digunakan untuk tujuan berikut :</p>
                                        <p class="p11 ft3"><span class="ft4">∙</span><span class="ft5">Membuat dan mengelola akun pengguna</span></p>
                                        <p class="p5 ft3"><span class="ft4">∙</span><span class="ft5">Memenuhi dan kelola pesanan</span></p>
                                        <p class="p5 ft3"><span class="ft4">∙</span><span class="ft5">memberikan produk atau layanan</span></p>
                                        <p class="p5 ft3"><span class="ft4">∙</span><span class="ft5">Meningkatkan produk dan layanan</span></p>
                                        <p class="p0 ft3"><span class="ft4">∙</span><span class="ft5">Kirim informasi administrasi</span></p>
                                        <p class="p5 ft3"><span class="ft4">∙</span><span class="ft5">Kirim komunikasi pemasaran dan promosi</span></p>
                                        <p class="p5 ft3"><span class="ft4">∙</span><span class="ft5">Menanggapi pertanyaan dan menawarkan dukungan</span></p>
                                        <p class="p0 ft3"><span class="ft4">∙</span><span class="ft5">Minta umpan balik pengguna</span></p>
                                        <p class="p5 ft3"><span class="ft4">∙</span><span class="ft5">Tingkatkan pengalaman pengguna</span></p>
                                        <p class="p0 ft3"><span class="ft4">∙</span><span class="ft5">Posting testimonial pelanggan</span></p>
                                        <p class="p5 ft3"><span class="ft4">∙</span><span class="ft5">Memberikan iklan bertarget</span></p>
                                        <p class="p5 ft3"><span class="ft4">∙</span><span class="ft5">Mengelola undian hadiah dan kompetisi</span></p>
                                        <p class="p5 ft3"><span class="ft4">∙</span><span class="ft5">Menegakkan syarat dan ketentuan dan kebijakan</span></p>
                                        <p class="p5 ft3"><span class="ft4">∙</span><span class="ft5">Lindungi dari penyalahgunaan dan pengguna jahat</span></p>
                                        <p class="p5 ft3"><span class="ft4">∙</span><span class="ft5">Menanggapi permintaan hukum dan mencegah bahaya</span></p>
                                        <p class="p5 ft3"><span class="ft4">∙</span><span class="ft5">Jalankan dan operasikan Aplikasi dan Layanan Seluler kamiProcessing your Personal</span></p>
                                        <p class="p13 ft3">Informasi tergantung pada bagaimana Anda berinteraksi dengan Aplikasi Seluler kami, di mana Anda berada di dunia dan jika salah satu dari yang berikut ini berlaku:</p>
                                        <p class="p14 ft3"><span class="ft3">(i)</span><span class="ft8">Anda telah memberikan persetujuan Anda untuk satu atau beberapa tujuan spesifik. Namun, ini tidak berlaku, kapan pun pemrosesan Informasi Pribadi tunduk pada Undang- Undang Privasi Konsumen dan </span><nobr>Undang-Undang</nobr> Perlindungan Data.</p>
                                        <p class="p15 ft3"><span class="ft3">(ii)</span><span class="ft9">Penyediaan informasi diperlukan untuk pelaksanaan perjanjian dengan Anda dan / atau untuk kewajiban </span><nobr>pra-kontraknya.</nobr></p>
                                        <p class="p16 ft3"><span class="ft3">(iii)</span><span class="ft10">Pemrosesan diperlukan untuk kepatuhan dengan kewajiban hukum yang menjadi subjek Anda.</span></p>
                                        <p class="p16 ft3"><span class="ft3">(iv)</span><span class="ft5">Pemrosesan terkait dengan tugas yang dilakukan untuk kepentingan publik atau dalam menjalankan wewenang resmi yang berada di tangan kami.</span></p>
                                        <p class="p16 ft3"><span class="ft3">(v)</span><span class="ft5">Pemrosesan diperlukan untuk tujuan kepentingan sah yang dilakukan oleh kami atau oleh pihak ketiga.</span></p>
                                        <p class="p17 ft3">Perhatikan bahwa di bawah beberapa <nobr>undang-undang</nobr> kami mungkin diizinkan untuk memproses informasi sampai Anda keberatan dengan pemrosesan tersebut (dengan memilih tidak), tanpa harus bergantung pada persetujuan atau basis hukum berikut di bawah ini. Dalam hal apa pun, kami akan dengan senang hati menjelaskan dasar hukum spesifik yang berlaku untuk pemrosesan, dan khususnya apakah penyediaan Informasi Pribadi merupakan persyaratan hukum atau kontrak, atau persyaratan yang diperlukan untuk masuk ke dalam kontrak.</p>
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
                                        <h3 class="" style="font-weight: bold">Transfer dan penyimpanan informasi</h3>
                                    </div>
                                    <div class="card-body">
                                        <p class="p8 ft3">Bergantung pada lokasi Anda, transfer data mungkin melibatkan pemindahan dan penyimpanan informasi Anda di negara selain negara Anda. Anda berhak mempelajari dasar hukum transfer informasi ke negara lain atau ke organisasi internasional yang diatur oleh hukum internasional publik atau yang didirikan oleh dua atau lebih negara, seperti PBB, dan tentang langkah- langkah keamanan yang diambil oleh kami untuk menjaga informasi Anda. Jika ada transfer seperti itu terjadi, Anda dapat mengetahui lebih lanjut dengan memeriksa bagian yang relevan dari dokumen ini atau bertanya kepada kami menggunakan informasi yang disediakan di bagian kontak.</p>
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
                                        <h3 class="" style="font-weight: bold">Hak-hak Pengguna</h3>
                                    </div>
                                    <div class="card-body">
                                        <p class="p20 ft3">Anda dapat menggunakan hak tertentu mengenai informasi Anda yang diproses oleh kami. Secara khusus, Anda memiliki hak untuk melakukan <nobr>hal-hal</nobr> berikut:</p>
                                        <p class="p16 ft3"><span class="ft3">(i)</span><span class="ft8">Anda memiliki hak untuk menarik persetujuan di mana sebelumnya Anda telah memberikan izin untuk pemrosesan informasi Anda;</span></p>
                                        <p class="p15 ft3"><span class="ft3">(ii)</span><span class="ft9">Anda memiliki hak untuk menolak pemrosesan informasi Anda jika pemrosesan dilakukan atas dasar hukum selain persetujuan;</span></p>
                                        <p class="p21 ft3"><span class="ft3">(iii)</span><span class="ft11">Anda memiliki hak untuk mengetahui apakah informasi sedang diproses oleh kami, mendapatkan pengungkapan mengenai </span><nobr>aspek-aspek</nobr> tertentu dari pemrosesan dan mendapatkan salinan dari informasi yang sedang diproses;</p>
                                        <p class="p16 ft3"><span class="ft3">(iv)</span><span class="ft12">Anda memiliki hak untuk memverifikasi keakuratan informasi Anda dan memintanya diperbarui atau diperbaiki;</span></p>
                                        <p class="p21 ft3"><span class="ft3">(v)</span><span class="ft8">Anda memiliki hak, dalam keadaan tertentu, untuk membatasi pemrosesan informasi Anda, dalam hal ini, kami tidak akan memproses informasi Anda untuk tujuan apa pun selain menyimpannya;</span></p>
                                        <p class="p15 ft3"><span class="ft3">(vi)</span><span class="ft13">Anda memiliki hak, dalam keadaan tertentu, untuk mendapatkan penghapusan Informasi Pribadi Anda dari kami;</span></p>
                                        <p class="p21 ft3"><span class="ft3">(vii)</span><span class="ft13">Anda memiliki hak untuk menerima informasi Anda dalam format yang terstruktur, umum digunakan dan dapat dibaca mesin dan, jika secara teknis memungkinkan, untuk mengirimkannya ke pengontrol lain tanpa hambatan. Ketentuan ini berlaku dengan ketentuan bahwa informasi Anda diproses dengan cara otomatis dan bahwa pemrosesan didasarkan pada persetujuan Anda, pada kontrak yang menjadi bagian Anda atau pada kewajiban </span><nobr>pra-kontraknya.</nobr> Hak untuk menolak pemrosesan.</p>
                                        <p class="p22 ft3">Jika Informasi Pribadi diproses untuk kepentingan publik, dalam pelaksanaan otoritas resmi yang diberikan kepada kami atau untuk tujuan kepentingan sah yang kami lakukan, Anda dapat keberatan dengan pemrosesan tersebut dengan memberikan landasan terkait dengan situasi khusus Anda untuk membenarkan keberatan. Anda harus tahu bahwa, jika Informasi Pribadi Anda diproses untuk tujuan pemasaran langsung, Anda dapat keberatan dengan pemrosesan itu kapan saja tanpa memberikan alasan apa pun. Untuk mengetahui, apakah kami memproses Informasi Pribadi untuk tujuan pemasaran langsung, Anda dapat merujuk ke bagian yang relevan dari dokumen ini.</p>
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
                                        <h3 class="" style="font-weight: bold">Cara menggunakan <nobr>hak-hak</nobr> ini</h3>
                                    </div>
                                    <div class="card-body">
                                        <p class="p17 ft3">Segala permintaan untuk menggunakan hak Pengguna dapat diarahkan ke CV. AYOKULAKAN melalui detail kontak yang disediakan dalam dokumen ini. Permintaan ini dapat dilakukan secara gratis dan akan ditangani oleh CV. AYOKULAKAN sedini mungkin.</p>
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
                                        <h3 class="" style="font-weight: bold">Hak privasi</h3>
                                    </div>
                                    <div class="card-body">
                                        <p class="p1 ft3">Selain <nobr>hak-hak</nobr> sebagaimana dijelaskan dalam Kebijakan Privasi ini, masyarakat yang memberikan Informasi Pribadi (sebagaimana didefinisikan dalam <nobr>undang-undang)</nobr> untuk mendapatkan produk atau layanan untuk penggunaan pribadi, keluarga, atau rumah tangga berhak meminta dan memperoleh dari kami, setelah kalender tahun, informasi tentang Informasi Pribadi yang kami bagikan, jika ada, dengan bisnis lain untuk penggunaan pemasaran. Jika berlaku, informasi ini akan mencakup kategori Informasi Pribadi dan nama dan alamat bisnis yang kami bagikan informasi pribadi tersebut untuk tahun kalender segera sebelum (misalnya, permintaan yang dibuat pada tahun berjalan akan menerima informasi tentang tahun sebelumnya) . Untuk mendapatkan informasi ini, silakan hubungi kami.</p>
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
                                        <h3 class="" style="font-weight: bold">Penagihan dan pembayaran</h3>
                                    </div>
                                    <div class="card-body">
                                        <p class="p17 ft3">Kami menggunakan pemroses pembayaran pihak ketiga untuk membantu kami memproses informasi pembayaran Anda dengan aman. Penggunaan informasi pribadi Anda oleh pihak ketiga tersebut diatur oleh kebijakan privasi <nobr>masing-masing</nobr> yang mungkin atau mungkin tidak mengandung perlindungan privasi yang protektif seperti Kebijakan Privasi ini. Kami menyarankan Anda meninjau kebijakan privasi <nobr>masing-masing.</nobr></p>
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
                                        <h3 class="" style="font-weight: bold">Penyedia produk dan layanan</h3>
                                    </div>
                                    <div class="card-body">
                                        <p class="p1 ft3">Kami dapat membuat kontrak dengan perusahaan lain untuk menyediakan produk dan layanan tertentu. Penyedia layanan ini tidak berwenang untuk menggunakan atau mengungkapkan informasi kecuali sebagaimana diperlukan untuk melakukan layanan atas nama kami atau mematuhi persyaratan hukum. Kami dapat membagikan Informasi Pribadi untuk tujuan ini hanya dengan pihak ketiga yang kebijakan privasinya konsisten dengan kebijakan kami atau yang setuju untuk mematuhi kebijakan kami sehubungan dengan Informasi Pribadi Penyedia layanan kami diberikan informasi yang mereka butuhkan untuk melakukan fungsi yang telah ditentukan, dan kami jangan beri wewenang kepada mereka untuk menggunakan atau mengungkapkan Informasi Pribadi untuk tujuan pemasaran mereka sendiri atau lainnya.</p>
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
                                        <h3 class="" style="font-weight: bold">Privasi <nobr>anak-anak</nobr></h3>
                                    </div>
                                    <div class="card-body">
                                        <p class="p1 ft3">Kami tidak secara sadar mengumpulkan Informasi Pribadi apa pun dari <nobr>anak-anak</nobr> di bawah usia 16 tahun. Jika Anda berusia di bawah 16 tahun, jangan mengirimkan Informasi Pribadi apa pun melalui Aplikasi atau Layanan Seluler kami. Kami mendorong orang tua dan wali hukum untuk memantau penggunaan Internet <nobr>anak-anak</nobr> mereka dan untuk membantu menegakkan Kebijakan ini dengan menginstruksikan <nobr>anak-anak</nobr> mereka untuk tidak pernah memberikan Informasi Pribadi melalui Aplikasi atau Layanan Seluler kami tanpa izin mereka.</p>
                                        <p class="p17 ft3">Jika Anda memiliki alasan untuk meyakini bahwa seorang anak di bawah usia 16 tahun telah memberikan Informasi Pribadi kepada kami melalui Aplikasi atau Layanan Seluler kami, silakan hubungi kami. Anda juga harus berusia setidaknya 16 tahun untuk menyetujui pemrosesan Informasi Pribadi Anda di negara Anda (di beberapa negara kami memungkinkan orang tua</p>
                                        <p class="p24 ft6"></p>

                                        <p class="p0 ft3">atau wali Anda melakukannya atas nama Anda).</p>
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
                                        <h3 class="" style="font-weight: bold">Nawala</h3>
                                    </div>
                                    <div class="card-body">
                                        <p class="p1 ft3">Kami menawarkan buletin elektronik di mana Anda dapat secara sukarela berlangganan kapan saja. Kami berkomitmen untuk menjaga kerahasiaan alamat email Anda dan tidak akan mengungkapkan alamat email Anda kepada pihak ketiga mana pun kecuali sebagaimana diizinkan dalam bagian penggunaan dan pemrosesan informasi atau untuk tujuan memanfaatkan penyedia pihak ketiga untuk mengirim email tersebut. Kami akan menjaga informasi yang dikirim melalui email sesuai dengan hukum dan peraturan yang berlaku.</p>
                                        <p class="p17 ft3">Sesuai dengan <nobr>CAN-SPAM</nobr> Act, semua <nobr>e-mail</nobr> yang dikirim dari kami akan dengan jelas menyatakan dari siapa <nobr>e-mail</nobr> itu berasal dan memberikan informasi yang jelas tentang cara menghubungi pengirim</p>
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
                                        <h3 class="" style="font-weight: bold">Pemasaran ulang</h3>
                                    </div>
                                    <div class="card-body">
                                        <p class="p1 ft3">Kami juga dapat mengizinkan perusahaan pihak ketiga tertentu untuk membantu kami menyesuaikan iklan yang menurut kami mungkin menarik bagi pengguna dan untuk mengumpulkan dan menggunakan data lain tentang aktivitas pengguna dalam Aplikasi Seluler. <nobr>Perusahaan-perusahaan</nobr> ini dapat menayangkan iklan yang mungkin menempatkan cookie dan melacak perilaku pengguna.</p>
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
                                        <h3 class="" style="font-weight: bold">Tautan ke aplikasi seluler lainnya</h3>
                                    </div>
                                    <div class="card-body">
                                        <p class="p17 ft3">Aplikasi Seluler kami berisi tautan ke aplikasi seluler lain yang tidak dimiliki atau dikendalikan oleh kami. Perlu diketahui bahwa kami tidak bertanggung jawab atas praktik privasi aplikasi seluler lain atau pihak ketiga tersebut. Kami mendorong Anda untuk waspada ketika Anda meninggalkan Aplikasi Seluler kami dan membaca pernyataan privasi <nobr>masing-masing</nobr> dan setiap aplikasi seluler yang dapat mengumpulkan Informasi Pribadi.</p>
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
                                        <h3 class="" style="font-weight: bold">Informasi keamanan</h3>
                                    </div>
                                    <div class="card-body">
                                        <p class="p17 ft3">Kami mengamankan informasi yang Anda berikan di server komputer dalam lingkungan yang terkendali dan aman, terlindung dari akses, penggunaan, atau pengungkapan yang tidak sah. Kami menjaga pengamanan administrasi, teknis, dan fisik yang wajar dalam upaya melindungi terhadap akses, penggunaan, modifikasi, dan pengungkapan Informasi Pribadi yang tidak sah dalam kendali dan pengawasannya. Namun, tidak ada transmisi data melalui Internet atau jaringan nirkabel yang dapat dijamin. Karena itu, sementara kami berupaya melindungi Informasi Pribadi Anda, Anda mengakui bahwa :</p>
                                        <p class="p26 ft3"><span class="ft3">(i)</span><span class="ft8">ada batasan keamanan dan privasi dari Internet yang berada di luar kendali kami.</span></p>
                                        <p class="p27 ft6"></p>

                                        <p class="p28 ft3"><span class="ft3">(ii)</span><span class="ft9">keamanan, integritas, dan privasi dari setiap dan semua informasi dan data yang dipertukarkan antara Anda dan Aplikasi Seluler kami tidak dapat dijamin. dan</span></p>
                                        <p class="p16 ft3"><span class="ft3">(iii)</span><span class="ft11">informasi dan data tersebut dapat dilihat atau dirusak dalam perjalanan oleh pihak ketiga, meskipun ada upaya terbaik.</span></p>
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
                                        <h3 class="" style="font-weight: bold">Pelanggaran data</h3>
                                    </div>
                                    <div class="card-body">
                                        <p class="p17 ft3">Jika kami mengetahui bahwa keamanan Aplikasi Seluler telah dikompromikan atau informasi Pribadi pengguna telah diungkapkan kepada pihak ketiga yang tidak terkait sebagai akibat dari aktivitas eksternal, termasuk, tetapi tidak terbatas pada, serangan keamanan atau penipuan, kami berhak untuk mengambil <nobr>langkah-langkah</nobr> yang pantas secara wajar, termasuk, tetapi tidak terbatas pada, penyelidikan dan pelaporan, serta pemberitahuan dan kerja sama dengan otoritas penegak hukum. Dalam hal terjadi pelanggaran data, kami akan melakukan upaya yang wajar untuk memberi tahu <nobr>orang-orang</nobr> yang terkena dampak jika kami percaya bahwa ada risiko yang wajar akan merugikan pengguna sebagai akibat dari pelanggaran atau jika pemberitahuan sebaliknya diharuskan oleh hukum. Ketika kami melakukannya, kami akan memposting pemberitahuan di Aplikasi Seluler, mengirimi Anda email, menghubungi Anda melalui telepon, mengirimkan surat kepada Anda.</p>
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
                                        <h3 class="" style="font-weight: bold">Pengungkapan hukum</h3>
                                    </div>
                                    <div class="card-body">
                                        <p class="p29 ft3">Jika kami mengalami transisi bisnis, seperti merger atau akuisisi oleh perusahaan lain, atau penjualan semua atau sebagian asetnya, akun pengguna Anda, dan Informasi Pribadi kemungkinan akan berada di antara aset yang ditransfer.</p>
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
                                        <h3 class="" style="font-weight: bold">Perubahan dan amandemen</h3>
                                    </div>
                                    <div class="card-body">
                                        <p class="p1 ft3">Kami dapat memperbarui Kebijakan Privasi ini dari waktu ke waktu atas kebijakan kami dan akan memberi tahu Anda tentang setiap perubahan materi dengan cara kami memperlakukan Informasi Pribadi. Ketika perubahan dilakukan, kami akan mengirimkan Anda email untuk memberi tahu Anda. Kami juga dapat memberikan pemberitahuan kepada Anda dengan cara lain dalam kebijaksanaan kami, seperti melalui informasi kontak yang Anda berikan. Setiap versi terbaru dari Kebijakan Privasi ini akan efektif segera setelah posting Kebijakan Privasi yang direvisi kecuali dinyatakan sebaliknya. Kelanjutan penggunaan Aplikasi atau Layanan Seluler Anda setelah tanggal efektif Kebijakan Privasi yang direvisi (atau tindakan lain yang disebutkan pada waktu itu) akan merupakan persetujuan Anda terhadap perubahan tersebut. Namun, kami tidak akan, tanpa persetujuan Anda, menggunakan Data Pribadi Anda dengan cara yang berbeda dari apa yang dinyatakan pada saat Data Pribadi Anda dikumpulkan.</p>
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
                                        <h3 class="" style="font-weight: bold">Penerimaan kebijakan ini</h3>
                                    </div>
                                    <div class="card-body">
                                        <p class="p1 ft3">Anda mengakui bahwa Anda telah membaca Kebijakan ini dan menyetujui semua syarat dan ketentuannya. Dengan menggunakan Aplikasi Seluler atau Layanannya, Anda setuju untuk terikat oleh Kebijakan ini. Jika Anda tidak setuju untuk mematuhi ketentuan Kebijakan ini, Anda tidak berwenang untuk menggunakan atau mengakses Aplikasi Seluler dan Layanannya.</p>
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
                                        <h3 class="" style="font-weight: bold">Menghubungi kami</h3>
                                    </div>
                                    <div class="card-body">
                                        <p class="p31 ft3">Jika Anda ingin menghubungi kami untuk memahami lebih lanjut tentang Kebijakan ini atau ingin menghubungi kami mengenai masalah apa pun yang berkaitan dengan hak individu dan Informasi Pribadi Anda, Anda dapat melakukannya dengan mengirim email ke <span class="ft14">ayokulakan01@gmail.com</span><span class="ft15">.</span></p>
                                        <p class="p32 ft3">Dokumen ini terakhir diperbarui pada tanggal 6 Mei 2020.</p>
                                        <p class="p33 ft16"><a href="https://ayokulakan.com/">https://ayokulakan.com</a></p>
                                        <p class="p34 ft6"></p>
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
{{-- <embed src="{{ asset('documents/ayokulakan.com-kebijakan-privasi .pdf') }}#zoom=150&toolbar=0&navpanes=0&scrollbar=0" type="application/pdf" width="100%" height="800px" /> --}}
@endsection
