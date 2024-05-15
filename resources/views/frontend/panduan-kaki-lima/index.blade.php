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
<main class="outer-top"></main>
<div class="container">
    <a href="{{ url('/') }}" style="font-size:30px; color:orange !important"><i class="glyphicon glyphicon-arrow-left"></i></a>
    <div class="row">
        <div class="col-md-12 terms-conditions">
            <div class="content">
                <h1 class="heading-title">Panduan Kaki Lima</h1>
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
                <br>3. Kalau sudah selesai daftar dan sudah verifikasi email juga kalian bisa login lagi dan Pilih menu Kaki lima seperti gambar dibawah ini .<br>
                </b>
                <br>
                <img src="{{ asset('img/panduan/d1.jpg') }}"  text-align="center" class="img-responsive">
                <br>
                <br>4.  Tampilan awal menu kaki lima di bawah ini dan tekan bergabung.<br>
                <br>
                <img src="{{ asset('img/panduan/d2.jpg') }}"  text-align="center" class="img-responsive">
                <br>
                <br>
                <br>5. Isikan form inputan pengisian data kaki lima kalian dengan sebenar – benarnya seperti gambar dibawah ini.</b>
                <br>
                <br>
                <img src="{{ asset('img/panduan/d3.jpg') }}"  text-align="center" class="img-responsive">
                <br>
                <br>
                <img src="{{ asset('img/panduan/d4.jpg') }}"  text-align="center" class="img-responsive">
                <br>
                <br>
                <img src="{{ asset('img/panduan/d5.jpg') }}"  text-align="center" class="img-responsive">
                <br>
                <br>6.  Tekan bergabung kaki  lima seperti di bawah ini</b>
                <br>
                <br>
                <img src="{{ asset('img/panduan/d6.jpg') }}"  text-align="center" class="img-responsive">
                <br>
                <br>
                <br>7.  Kalau sudah nanti tampil gambar download kalian tekan download dan cetak kartu kaki limanya</b>
                <br>
                <br>
                <img src="{{ asset('img/panduan/d7.jpg') }}"  text-align="center" class="img-responsive">
                <br>
                <br>8.  Tampilan kartu kaki lima seperti di bawah ini.<br>
                <br>
                <br>
                <img src="{{ asset('img/panduan/d8.jpg') }}"  text-align="center" class="img-responsive">
                <br>
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
