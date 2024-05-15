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

@section('content-frontend')
<style>
    p {
        margin-bottom: 0;
    }
    .terms-conditions-page{
        padding-top: 0px !important;
    }
</style>
   <div class="terms-conditions-page container">
    <a href="{{ url('/') }}" style="font-size:30px; color:orange !important"><i class="glyphicon glyphicon-arrow-left" style="padding: 20px"></i></a>
        <div class="row" style="padding: 20px">
            <div class="col-md-12 terms-conditions">
                <h2 class="heading-title">TENTANG HAJI & UMROH.</h2>
                <div class="contact-page-map">
                  <div class="container-fluid">
                    <div class="banner_h2__left_image">
                        <img alt="" class="img-responsive" src="http://3.bp.blogspot.com/-RkvloTb6gco/VSDwgrcj16I/AAAAAAAAcA4/g5jwa61YPLA/s1600/kaaba.JPG">
                    </div>
                    <div class="wpb_wrapper">
                        <p>{!! $record->deskripsi or '' !!}</p>
                    </div>
                    {{-- <div class="row">
                        <div class="col-md-12">
                            <h2>Syarat Daftar haji dan umroh</h2>
                            <p>
                                Silakan lakukan pendaftaran dengan menyertai dokumen sebagai berikut :
                            </p><br>
                            <p><b>Syarat Pendaftaran</b></p>
                            <p>1.	Passport (asli dan fotocopy 1 lembar).</p>
                            <p>2.	Buku suntik meningitis asli</p>
                            <p>3.	Foto fokus wajah 80% background putih (2 lembar ukuran 4x6 )</p>
                            <p>4.	Buku menikah (jika sudah menikah)</p>
                            <p>5.	Akte lahir (jika anak di bawah usia 16 tahun)</p>
                            <p>6.	1 lembar fotocopy ktp</p>
                            <p>7.	1 lembar fotocopy kk</p>
                            <p>8.	Surat bukti keterangan hamil (jika perempuan sedang mengadung )</p><br>
                            <p><b>Biaya sudah termasuk</b></p>
                            <p>1.	Visa </p>
                            <p>2.	Tiket pesawat pp</p>
                            <p>3.	Akomondasi hotel</p>
                            <p>4.	Transportasi bus</p>
                            <p>5.	Makan 3 kali sehari (menu Indonesia)</p>
                            <p>6.	Ziarah Madinah dan mekah </p>
                            <p>7.	Pembimbing  (muthowif) </p>
                            <p>8.	Air zam-zam 5l</p>
                            <p>9.	(Pasar ja’fariyah, thaif, jabal magnet)</p><br>
                            <p><b>Pembayaran </b></p>
                            <p>1.	Membayar administrasi 1.250.000,-</p>
                            <p>2.	Membayar uang muka sebesar 50% dari total biaya umroh</p>
                            <p>3.	Melunasi paling lambat 1 bulan sebelum keberangkatan </p>
                            <p>4.	Bagi calon jamaah yang membatalkan keberangkatan tetap terkena biaya admistrasi, sesuai dengan aturan yang berlaku </p>
                            <br>
                            <p>*Melayani pengurusan umroh rombongan, keluarga, kantor, Arisan dll.</p>
                            <p>*Aturan sewaktu – waktu dapat berubah </p><br>
                            <p><b>Panduan penggunaan</b></p><br>
                            <img src="{{ url('img/panduan_haji.jpg') }}" style="width: 100%;margin-bottom: 20px" alt="">
                            <p>Akan tampil syarat dan ketentuan, pengisian form data diri, pemilihan paket, dan pilih pemberangkatan. Agar pendaftar dapat ditindaklanjuti oleh ayokulakan, silakan lengkapi pemberkasan</p>
                        </div>
                    </div> --}}
                  </div>
              </div>
            </div>
            {{-- <div class="col-md-12">
                <div class="container-fluid">
                    <div class="alert alert-danger" role="alert" id="daftar-haji">
                        <p>Silahkan lakukan pendaftaran dengan menyertai unggah dokument sebagai berikut :</p>
                        <p>
                              {!! $record['detail']->deskripsi or '' !!}
                        </p>
                        <p>Agar pendaftar dapat ditindaklanjuti oleh ayokulakan, silakan lengkapi pemberkasan.</p>
                        <hr>
                        <p class="mb-0">Salam Hangat Ayokulakan.com</p>
                  </div>
            </div> --}}
        </div>
    </div>
<!--Start of Tawk.to Script-->
<script type="text/javascript">
    var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
    (function(){
    var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
    s1.async=true;
    s1.src='https://embed.tawk.to/5f5ad7524704467e89edfb44/default';
    s1.charset='UTF-8';
    s1.setAttribute('crossorigin','*');
    s0.parentNode.insertBefore(s1,s0);
    })();
    </script>
    <!--End of Tawk.to Script-->
@endsection
