@component('mail::message')
Halo User

<h1>Kode Verivication Ganti Password</h1>
<p>Sedikit Lagi proses ganti password akan aktif. Cukup memasukan kode verivikasi di bawah untuk mengubah password anda.</p>
<center><b><h1>{{ $kode->kode_verivikasi }}</h1></b></center>
<p>Mohon Jangan sebar luaskan kode ini kesiapapun , temasuk pihak yang mengatasnamakan ayokulakan</p>
<p>Terimakasih</p>

Salam Hangat {{ config('app.name') }}
@endcomponent
