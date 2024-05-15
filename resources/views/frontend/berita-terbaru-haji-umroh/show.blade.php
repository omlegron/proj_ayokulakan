@extends('layouts.scaffold-sidebar-right')

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

@section('content-frontend-left')
<div class="blog-page">
    <a href="{{ url('berita-terbaru') }}" style="margin-left: 20px; font-size:30px; color:orange !important"><i class="glyphicon glyphicon-arrow-left"></i></a>
    <div class="blog-post wow fadeInUp animated" style="visibility: visible; animation-name: fadeInUp;">
        @if($record)
        @if($record->attachments->count() > 0)
        <center><a href="javascript:void(0)"><img class="img-responsive" src="{{ url('storage/'.$record->attachments->first()->url) }}" alt=""></a></center>
        @else
        <center><a href="javascript:void(0)"><img class="img-responsive" src="{{ asset('img/no-images.png') }}" alt="bege blog images"></a></center>
        @endif
        <h1>{{ $record->judul or '' }}</h1>
        <span class="author">{{ $record->creatorName() }}</span>
        <span class="date-time">{{ DateToStringWday($record->created_at) }}</span>
        <p>{!! $record->deskripsi or '' !!}</p>
        <div class="social-media">
            <span>share post:</span>
            <a href="https://id-id.facebook.com/sharer.php?u={{url()->current()}}"><i class="fa fa-facebook"></i></a>
            <a href="https://twitter.com/share?url={{url()->current()}}"><i class="fa fa-twitter"></i></a>
        </div>
        <hr>
        <div id="disqus_thread">
            <a href="{{ url()->previous() }}" class="btn btn-primary " data-dismiss="modal" aria-label="Close"><i class="fa fa-arrow-circle-left"></i> Kembali</a>
        </div>
        @endif
    </div>

</div>
@endsection
