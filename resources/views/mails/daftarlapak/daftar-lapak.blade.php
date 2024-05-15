@component('mail::message')
<div style="display:flex; background-color: #000000; padding: 20px; border-radius: 10px;">
    <span style="font: bold 20px 'Arial';color: #ffc000;line-height: 37px;">Ayo</span><span style="font: bold 20px 'Arial';color: #00b050;line-height: 37px;">kulakan</span>
    {{-- <img src="{{ $detail['img'] }}" alt=""> --}}
    <img src="{{ $detail['img'] }}" alt="" width="70">
</div>
<p style="font-weight: 600; text-align: center; font-size: 25px; color: orange;">Selamat datang di Lapak Ayokulakan</p>

<p style="font-weight: 500; font-size: 20px;">Kelola Lapakmu Bersama Ayokulakan</p>
<p style="font-weight: 500; font-size: 20px;">Tebarkan Kesejahteraan dan Kedamaian Bersama AYOKULAKAN</p>
<span>Biar akun mu semakin aman</span><br>
<span>Jangan lupa baca panduan lapak kami <a href="{{ $detail['url'] }}">Di sini</a></span>

Salam Hangat {{ config('app.name') }}
@endcomponent
