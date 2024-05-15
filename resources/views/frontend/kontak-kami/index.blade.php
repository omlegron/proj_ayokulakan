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
<div class="contact-page">
    <a href="{{ url('/') }}" style="margin-left: 35px; font-size:30px; color:orange !important"><i class="glyphicon glyphicon-arrow-left"></i></a>
    <div class="row" style="margin: 60px 0 0">
        <div class="col-md-8 contact-map outer-bottom-vs">
            <iframe src="https://maps.google.com/maps?q=Jl.%20Raya%20Kembiritan%2C%20Genteng.%20Kabupaten%20Banyuwangi-Jawa%20Timur%2068465Jl.%20Raya%20Kembiritan%2C%20Genteng.%20Kabupaten%20Banyuwangi-Jawa%20Timur%2068465&t=&z=13&ie=UTF8&iwloc=&output=embed" style="border:0" width="600" height="450"></iframe>
        </div>
        <div class="col-md-4">
            @if(Session::has('success'))
                <div class="alert alert-success">
                    {{ Session::get('success') }}
                </div>
            @endif
            <form action="{{ route('kontak') }}" method="POST">
                @csrf
                <div class="form-group">
                    <input type="text" name="nama" class="form-control" placeholder="Nama">
                    @if ($errors->has('nama'))
                        {{ $errors->first('nama') }}
                    @endif
                </div>
                <div class="form-group">
                    <input type="email" name="email" class="form-control" placeholder="Email">
                    @if ($errors->has('email'))
                        {{ $errors->first('email') }}
                    @endif
                </div>
                <div class="form-group">
                    <input type="text" name="subject" class="form-control" placeholder="Subject">
                    @if ($errors->has('subject'))
                        {{ $errors->first('subject') }}
                    @endif
                </div>
                <div class="form-group">
                    <input type="text" name="telphone" class="form-control" placeholder="No Telp">
                    @if ($errors->has('telphone'))
                        {{ $errors->first('telphone') }}
                    @endif
                </div>
                <div class="form-group">
                    <textarea name="saran" id="" cols="30" rows="10" class="form-control" placeholder="Pertanyaan Atau saran"></textarea>
                </div>
                <button class="btn-xl btn-warning" type="submit" style="width: 100%">Kirim</button>
            </form>
        </div>
    </div>
</div>
@endsection
