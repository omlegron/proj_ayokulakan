@extends('layouts.scaffold')

@section('js-filters')
d.nama = $("input[name='filter[name]']").val();
@endsection

@section('scripts')
<script type="text/javascript">
    $('.dropify').dropify();
</script>
@append

@section('css')
    <style type="text/css">
        .terms-conditions-page{
            padding-top: 0px !important;
        }
    </style>
@endsection
@section('content-frontend')
<main class="outer-top" style="padding-top: 50px"></main>
<div class="terms-conditions-page container">
    <a href="{{ url('/') }}" style="margin-left: 20px; font-size:30px; color:orange !important"><i class="glyphicon glyphicon-arrow-left"></i></a>
    <div class="row" style="max-height: 700px;overflow-x: hidden;overflow-y: scroll;">
        @if($record->count() > 0)
            @foreach($record as $k => $value)
                @if($value->attachments->count() > 0)
                    @foreach($value->attachments as $k1 => $value1)
                        @php
                            $no = $k+1;
                        @endphp
                        <div class="col-md-4" style="height: 370px">
                            <div class="panel-group">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <label class="unicase-checkout-title"><b><small>{!! $value->deskripsi !!}</b></small></label>
                                    </div>
                                    <div class="panel-body">
                                        @include('partials.component.single-attachment',[
                                            'fileTitle' => 'Dokumentasi Foto '.$no,
                                            'fileUrl' => url('storage/'.$value1->url),
                                            'disable' => 'true'
                                        ])
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif   
            @endforeach
        @endif
    </div>
</div>

@endsection
