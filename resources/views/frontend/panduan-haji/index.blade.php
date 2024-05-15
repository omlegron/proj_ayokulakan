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
<style>
    .content {
        padding: 0 40px 40px 60px;
    }

    @media (max-width: 500px) {
        .outer-top {
            margin-top: 280px;
        }
    }
</style>
@endsection

@section('content-frontend')
<main class="outer-top"></main>
<div class="container">
    <a href="{{ url('/') }}" style="margin-left: 35px; font-size:30px; color:orange !important"><i class="glyphicon glyphicon-arrow-left"></i></a>
    <div class="row">
        <div class="col-md-12 terms-conditions">
            <div class="content">
                <h1 class="heading-title">Panduan Haji & Umroh</h1>
                <hr>
                <p>
                    1.	Pilih menu login Gambar seperti di bawah ini
                    <br>
                    <br>
                    <img src="{{ asset('img/panduan/1.jpg') }}"  text-align="center" class="img-responsive">
                    <br>
                    <br>
                    2.	Jika belum mempunyai akun kalian bisa klik menu daftar kalain bisa daftar melalui facebook , gmail dll. Seperti gambar di bawah ini.
                    <br>
                    <br>
                    <img src="{{ asset('img/panduan/2.jpg') }}"  text-align="center" class="img-responsive">
                    <br>
                    <br>
                    <br>3. Kalau sudah selesai daftar dan sudah verifikasi email juga kalian bisa login lagi dan Pilih menu haji dan umroh pilih menu daftar haji dan umroh seperti di bawah ini gambarnya .<br>
                    </b>
                    <br>
                    <img src="{{ asset('img/panduan/c1.jpg') }}"  text-align="center" class="img-responsive">
                    <br>
                    <br>4. Tampilan daftar haji umroh seperti di bawah ini ..<br>
                    <br>
                    <img src="{{ asset('img/panduan/c2.jpg') }}"  text-align="center" class="img-responsive">
                    <br>
                    <br>
                    <img src="{{ asset('img/panduan/c3.jpg') }}"  text-align="center" class="img-responsive">
                    <br>
                    <br>
                    <br>5. Kalian isikan form pendaftaran dan jangan lupa pilih paketnya juga datanya harus lengka dan klik simpan.</b>
                    <br>
                    <br>
                    <img src="{{ asset('img/panduan/c4.jpg') }}"  text-align="center" class="img-responsive">
                    <br>
                    <br>6. Kalau mau lihat Riwayat haji kalian pilih menu my account – Pengaturan – Haji dan Umroh – Riwayat haji.</b>
                    <br>
                    <br>
                    <img src="{{ asset('img/panduan/c5.jpg') }}"  text-align="center" class="img-responsive">
                    <br>
                    <br>
                    <br>7.  Tampilan dari Riwayat haji dan Umroh di bawah ini</b>
                    <br>
                    <br>
                    <img src="{{ asset('img/panduan/c6.jpg') }}"  text-align="center" class="img-responsive">
                    <br>
                    <br>8. Selamat mencoba<br>
                </p>
            </div>
        </div>
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
