@extends('layouts.scaffold')

@section('styles')
<meta name="asset-url" content="{{ config('app.url') }}">
<link rel="stylesheet" type="text/css" href="{{ url('/plugins/datepicker/datepicker3.css') }}">

@endsection

@section('scripts')
{{-- <script src="{{ asset('js/vueapp.js') }}" defer></script> --}}
<script type="text/javascript" src="{{ url('/plugins/datepicker/bootstrap-datepicker.js') }}"></script>

<script>
    $(document).ready(function() {
        $('.bots-date').datepicker({
            format: 'yyyy-mm-dd',
            todayHighlight: true,
            autoclose: true,
        });
    });
</script>
@endsection

@section('content-frontend')
<form action="{{ url('airlinee/schedule') }}" method="GET">

<div class="terms-conditions-page container" >
    <div class="panel panel-default" style="padding: 20px; overflow: hidden;">
        @foreach($request->all() as $k => $value)
            <input type="hidden" name="{{ $k }}" value="{{ $value }}">
        @endforeach
        <input type="hidden" name="accessToken" class="form-control" placeholder="Re-Captcha" value="{{ $result->accessToken or '' }}">
        @if($capth != null)
        <div class="col-md-6">
            <img src="{{ $capth }}">
            <input type="text" name="airlineAccessCode" class="form-control" placeholder="Re-Captcha">
        </div>
        @endif


        <div class="col-md-12" style="padding-top: 5px">
            <button type="submit" class="btn btn-primary pull-right">Submit</button>
        </div>
    </div>
</div>
</form>
@endsection

@section('js')
    <script type="text/javascript">

@endsection