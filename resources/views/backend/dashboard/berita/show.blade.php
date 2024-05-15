@extends('layouts.admin')
@section('content')
    <div class="card">
        <div class="card-body">
            <center>
                <h3>{{ $record->judul }}</h3>
                <p>{{ $record->creator->nama }}</p>
                <p>{{ $record->created_at->format('d -M -Y') }}</p>
            </center>
            @if($record->attachments->count() > 0)
            <center><a href="javascript:void(0)"><img class="img-responsive" src="{{ url('storage/'.$record->attachments->first()->url) }}" alt=""></a></center>
            @else
            <center><a href="javascript:void(0)"><img class="img-responsive" src="{{ asset('img/no-images.png') }}" alt="bege blog images"></a></center>
            @endif
            <p>{!! $record->deskripsi !!}</p>
        </div>
    </div>
@endsection