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
                                        <li class="list-group-item">Perjanjian</li>
                                        <li class="list-group-item">Konten Dan Postingan</li>
                                        <li class="list-group-item">Kompensasi Dan Sponsor</li>
                                        <li class="list-group-item">Perjanjian Kebugaran Dan Medis</li>
                                        <li class="list-group-item">Bukan Nasihat Hukum</li>
                                        <li class="list-group-item">Bukan Nasihat Keuangan</li>
                                        <li class="list-group-item">Bukan Saran Investasi</li>
                                        <li class="list-group-item">Ganti Rugi Dan Jaminan</li>
                                        <li class="list-group-item">Penerimaan Perjanjian Ini</li>
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
                                        <h3 class="text-center" style="font-weight: bold">Perjanjian <span style="color: chocolate">AYO</span><span style="color: #00b050">KULAKAN</span></h3>
                                    </div>
                                    <div class="card-body">
                                        <p class="p1 ft4">Perjanjian ini adalah kesepakatan antara CV. AYOKULAKAN dan Anda (User). Perjanjian ini menetapkan pedoman umum, syarat dan ketentuan penggunaan situs <a href="https://ayokulakan.com/"><span class="ft3">ayokulakan.com </span></a>dan salah satu produk atau layanannya (secara kolektif, situs web atau Layanan).</p>
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
                                        <h3 class="" style="font-weight: bold">Representasi</h3>
                                    </div>
                                    <div class="card-body">
                                        <p class="p3 ft4">Setiap pandangan atau pendapat yang diwakili di situs web bersifat pribadi dan <nobr>semata-mata</nobr> milik CV. AYOKULAKAN dan tidak mewakili orang, lembaga atau organisasi yang pemiliknya mungkin atau mungkin tidak terkait dalam kapasitas profesional atau pribadi kecuali dinyatakan secara eksplisit. Setiap pandangan atau pendapat tidak dimaksudkan untuk memfitnah agama apapun, kelompok etnis, klub, organisasi, perusahaan, atau individu.</p>
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
                                        <h3 class="" style="font-weight: bold">Konten dan postingan</h3>
                                    </div>
                                    <div class="card-body">
                                        <p class="p3 ft4">Anda tidak diperkenankan mengubah, mencetak, atau menyalin bagian apa pun dari situs web. Penyertaan bagian mana pun dari situs web ini dalam karya lain, baik dalam bentuk cetak atau elektronik atau formulir lain atau penyertaan bagian mana pun dari situs web di situs web lain dengan menyematkan, membingkai, atau lainnya tanpa izin CV. AYOKULAKAN dilarang.</p>
                                        <p class="p5 ft4">Anda dapat mengirimkan komentar untuk konten yang tersedia di situs web. Dengan mengunggah atau menyediakan informasi apa pun kepada CV. AYOKULAKAN, Anda memberikan CV. AYOKULAKAN hak yang tidak terbatas dan <nobr>terus-menerus</nobr> untuk mendistribusikan, menampilkan, mempublikasikan, memperbanyak, menggunakan kembali dan menyalin informasi yang terkandung didalamnya. Anda tidak boleh meniru identitas orang lain melalui situs web. Anda tidak boleh memposting konten yang memfitnah, menipu, cabul, mengancam, invasif hak privasi orang lain atau yang melanggar hukum. Anda tidak boleh memposting konten yang melanggar hak kekayaan intelektual orang atau entitas lain. Anda tidak boleh memposting konten apa pun yang mencakup virus komputer atau kode lain yang dirancang untuk mengganggu, merusak, atau membatasi fungsi perangkat lunak atau perangkat keras komputer. Dengan mengirimkan atau memposting konten pada situs web, Anda memberikan CV. AYOKULAKAN hak untuk mengedit dan, jika perlu, menghapus setiap konten setiap saat dan untuk alasan apapun.</p>
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
                                        <h3 class="" style="font-weight: bold">Kompensasi dan sponsor</h3>
                                    </div>
                                    <div class="card-body">
                                        <p class="p3 ft4">Website ini menerima bentuk iklan, sponsor, dibayar insersi atau bentuk lain dari kompensasi. CV. AYOKULAKAN dikompensasi untuk memberikan pendapat tentang produk, Layanan,</p>
                                        <p class="p7 ft6"></p>

                                        <p class="p8 ft4">website dan berbagai topik lainnya. Kompensasi yang diterima dapat memengaruhi konten iklan, topik, atau postingan yang dibuat di situs web. Konten Bersponsor, ruang iklan, atau postingan akan selalu diidentifikasi seperti itu.</p>
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
                                        <h3 class="" style="font-weight: bold">Perjanjian kebugaran dan medis</h3>
                                    </div>
                                    <div class="card-body">
                                        <p class="p3 ft4">Informasi yang tersedia di website adalah untuk informasi kesehatan umum saja dan tidak dimaksudkan untuk menjadi pengganti nasihat medis profesional, diagnosis atau pengobatan. Anda tidak boleh bergantung secara eksklusif pada informasi yang disediakan di situs web untuk kebutuhan kesehatan mereka sendiri. Semua pertanyaan medis tertentu harus disampaikan kepada penyedia layanan kesehatan Anda sendiri dan Anda harus mencari nasihat medis mengenai kesehatan Anda dan sebelum memulai apapun gizi, berat badan atau jenis lain dari program latihan.</p>
                                        <p class="p9 ft4">Jika Anda memilih untuk menggunakan informasi yang tersedia di situs web tanpa konsultasi sebelumnya dengan dan persetujuan dari dokter Anda, Anda setuju untuk menerima tanggung jawab penuh atas keputusan Anda dan menyetujui untuk membebaskan CV. AYOKULAKAN, agen, karyawan, kontraktor, dan perusahaan afiliasi manapun dari segala tanggung jawab sehubungan dengan cedera atau penyakit kepada Anda atau properti Anda yang timbul dari atau berhubungan dengan penggunaan Anda atas informasi ini.</p>
                                        <p class="p9 ft4">Mungkin ada risiko yang terkait dengan berpartisipasi dalam kegiatan yang disajikan pada situs web untuk orang dalam kesehatan yang baik atau buruk atau dengan <nobr>pra-ada</nobr> kondisi kesehatan fisik atau mental. Jika Anda memilih untuk berpartisipasi dalam risiko ini, Anda melakukannya dari kehendak bebas Anda sendiri dan sesuai, secara sadar dan sukarela dengan asumsi semua risiko yang terkait dengan kegiatan tersebut.</p>
                                        <p class="p5 ft4">Hasil yang diperoleh dari informasi yang tersedia di situs web dapat bervariasi, dan akan didasarkan pada latar belakang individu Anda, kesehatan fisik, pengalaman sebelumnya, kapasitas, kemampuan untuk bertindak, motivasi dan variabel lainnya. Tidak ada jaminan mengenai tingkat keberhasilan yang mungkin Anda alami.</p>
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
                                        <h3 class="" style="font-weight: bold">Bukan nasihat hukum</h3>
                                    </div>
                                    <div class="card-body">
                                        <p class="p1 ft4">Informasi yang disediakan di situs web adalah untuk tujuan informasi umum saja dan bukan merupakan alternatif untuk nasihat hukum dari pengacara Anda, penyedia layanan profesional lainnya, atau ahli. Hal ini tidak dimaksudkan untuk memberikan nasihat hukum atau pendapat apapun. Anda tidak boleh bertindak, atau menahan diri dari bertindak, hanya berdasarkan informasi yang diberikan di situs web tanpa terlebih dahulu mencari nasihat hukum atau profesional yang sesuai. Jika Anda memiliki pertanyaan spesifik tentang masalah hukum, Anda harus berkonsultasi dengan pengacara Anda, penyedia layanan profesional lainnya, atau ahli. Anda tidak boleh menunda mencari nasihat hukum, mengabaikan nasihat hukum, atau memulai atau menghentikan tindakan hukum apa pun karena informasi di situs web.</p>
                                        <p class="p1 ft4">Informasi di situs web disediakan hanya untuk kenyamanan Anda. Informasi ini mungkin tidak memiliki nilai pembuktian dan harus diperiksa terhadap sumber resmi sebelum digunakan untuk tujuan apapun. Adalah tanggung jawab Anda untuk menentukan apakah informasi ini dapat</p>
                                        <p class="p10 ft6"></p>

                                        <p class="p8 ft4">diterima dalam persidangan peradilan atau administratif tertentu dan apakah ada persyaratan pembuktian atau pengarsipan lain. Penggunaan Anda atas informasi ini adalah risiko Anda sendiri.</p>
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
                                        <h3 class="" style="font-weight: bold">Bukan nasihat keuangan</h3>
                                    </div>
                                    <div class="card-body">
                                        <p class="p3 ft4">Informasi di Situs web disediakan hanya untuk kenyamanan Anda dan tidak dimaksudkan untuk diperlakukan sebagai keuangan, investasi, pajak, atau saran lainnya. Tidak ada yang terkandung di Situs Web yang merupakan ajakan, rekomendasi, dukungan, atau penawaran oleh CV. AYOKULAKAN, agennya, karyawan, kontraktor, dan perusahaan afiliasi apa pun untuk membeli atau menjual sekuritas atau instrumen keuangan lainnya.</p>
                                        <p class="p1 ft4">Semua Konten di situs ini adalah informasi yang bersifat umum dan tidak membahas keadaan individu atau entitas tertentu. Tidak ada sesuatu pun di Situs Web yang merupakan nasihat profesional dan / atau keuangan, dan informasi di Situs Web ini tidak merupakan pernyataan komprehensif atau lengkap dari <nobr>hal-hal</nobr> yang dibahas atau hukum yang berkaitan dengannya. Anda sendiri yang memikul tanggung jawab tunggal untuk mengevaluasi manfaat dan risiko yang terkait dengan penggunaan informasi apa pun atau konten lain di Situs Web sebelum membuat keputusan apa pun berdasarkan informasi tersebut. Anda setuju untuk tidak memiliki CV. AYOKULAKAN, agennya, karyawannya, kontraktornya, dan perusahaan terafiliasinya bertanggung jawab atas segala klaim kerusakan yang timbul dari keputusan apa pun yang Anda buat berdasarkan informasi yang disediakan untuk Anda melalui Situs web.</p>
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
                                        <h3 class="" style="font-weight: bold">Bukan saran investasi</h3>
                                    </div>
                                    <div class="card-body">
                                        <p class="p1 ft4">Semua investasi bersifat sangat spekulatif dan melibatkan risiko kerugian yang substansial. Kami mendorong semua orang untuk berinvestasi dengan sangat <nobr>hati-hati.</nobr> Kami juga mendorong investor untuk mendapatkan nasihat pribadi dari penasihat investasi profesional Anda dan melakukan penyelidikan independen sebelum bertindak berdasarkan informasi yang ditemukan di Situs Web. Kami tidak dengan cara apa pun menjamin atau menjamin keberhasilan tindakan apa pun yang Anda lakukan dengan mengandalkan pernyataan atau informasi yang tersedia di Situs Web.</p>
                                        <p class="p3 ft4">Kinerja masa lalu tidak selalu menunjukkan hasil di masa mendatang. Semua investasi membawa risiko signifikan dan semua keputusan investasi individu tetap menjadi tanggung jawab spesifik individu tersebut. Tidak ada jaminan bahwa sistem, indikator, atau sinyal akan menghasilkan keuntungan atau bahwa mereka tidak akan menghasilkan kerugian penuh atau sebagian. Semua investor disarankan untuk sepenuhnya memahami semua risiko yang terkait dengan jenis investasi apa pun yang mereka pilih untuk lakukan.Reviews and testimonials</p>
                                        <p class="p3 ft4">Testimoni diterima dalam berbagai bentuk melalui berbagai metode pengiriman. Mereka adalah pengalaman individu, yang mencerminkan pengalaman mereka yang telah menggunakan produk atau layanan di Situs Web dengan cara tertentu. Namun, mereka adalah hasil individual dan hasilnya sangat bervariasi. Kami tidak mengklaim bahwa itu adalah hasil khas yang umumnya dicapai konsumen. Kesaksian tidak selalu mewakili semua orang yang akan menggunakan produk atau layanan kami. CV. AYOKULAKAN tidak bertanggung jawab atas pendapat atau komentar yang diposting di Situs, dan tidak <nobr>serta-merta</nobr> membagikannya. Orang</p>
                                        <p class="p11 ft6"></p>
                                        <p class="p12 ft4">yang memberikan testimoni di Situs Web mungkin telah dikompensasi dengan produk atau diskon gratis untuk penggunaan pengalaman mereka. Semua pendapat yang dikemukakan sepenuhnya merupakan pandangan dari poster atau pengulas.</p>
                                        <p class="p1 ft4">Kesaksian yang ditampilkan diberikan kata demi kata kecuali untuk koreksi kesalahan tata bahasa atau pengetikan. Beberapa testimonial mungkin telah diedit untuk kejelasan, atau disingkat dalam kasus di mana testimonial asli termasuk informasi asing yang tidak ada relevansinya dengan masyarakat umum. Testimonial dapat ditinjau keasliannya sebelum diposting untuk dilihat publik.</p>
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
                                        <h3 class="" style="font-weight: bold">Ganti rugi dan jaminan</h3>
                                    </div>
                                    <div class="card-body">
                                        <p class="p1 ft4">CV. AYOKULAKAN menjamin keakuratan, keandalan, dan kelengkapan informasi dan konten pada, didistribusikan melalui atau ditautkan, diunduh atau diakses dari Situs Web ini. Selain itu, informasi yang terkandung di Situs Web dan halaman apa pun yang ditautkan ke dan darinya dapat berubah <nobr>sewaktu-waktu</nobr> dan tanpa peringatan.</p>
                                        <p class="p3 ft4">Kami berhak untuk mengubah Perjanjian ini terkait dengan Situs Web, produk atau layanan kapan saja, efektif setelah memposting versi terbaru Perjanjian ini di Situs Web. Ketika kami melakukannya, kami akan merevisi tanggal yang diperbarui di bagian bawah halaman ini. Terus menggunakan Situs Web setelah perubahan tersebut merupakan persetujuan Anda untuk perubahan tersebut.</p>
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
                                        <h3 class="" style="font-weight: bold">Penerimaan Perjanjian ini</h3>
                                    </div>
                                    <div class="card-body">
                                        <p class="p1 ft4">Anda mengakui bahwa Anda telah membaca Perjanjian ini dan menyetujui semua syarat dan ketentuannya. Dengan mengakses Situs Web Anda setuju untuk terikat oleh Perjanjian ini. Jika Anda tidak setuju untuk mematuhi ketentuan Perjanjian ini, Anda tidak berwenang untuk menggunakan atau mengakses Situs Web.</p>
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
                                        <p class="p5 ft4">Jika Anda ingin menghubungi kami untuk memahami lebih lanjut tentang Perjanjian ini atau ingin menghubungi kami mengenai masalah apa pun yang berkaitan dengannya, Anda dapat melakukannya dengan mengirim email ke <a href="mailto:ayokulakan01@gmail.com"><span class="ft7">ayokulakan01@gmail.com</span></a><a href="mailto:ayokulakan01@gmail.com">.</a></p>
                                        <p class="p13 ft4">Dokumen ini terakhir diperbarui pada tanggal 6 Mei 2020.</p>
                                        <p class="p14 ft8"><a href="https://ayokulakan.com/">https://ayokulakan.com</a></p>
                                        <p class="p15 ft6"></p>
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
