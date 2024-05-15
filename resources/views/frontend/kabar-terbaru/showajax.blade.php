<div class="blog-page">
    <div class="col-md-12">
        @if($records->count() > 0)
        @foreach($records as $k => $v)
        <div class="blog-post  wow fadeInUp animated" style="visibility: visible; animation-name: fadeInUp;">
            @if($v->attachments->count() > 0)
                <center><a href="javascript:void(0)"><img class="img-responsive" src="{{ url('storage/'.$v->attachments->first()->url) }}" alt=""></a></center>
            @else
                <center><a href="javascript:void(0)"><img class="img-responsive" src="{{ asset('img/no-images.png') }}" alt="bege blog images"></a></center>
            @endif
            
            <h1><a href="{{ url($pageUrl.$v->id) }}/kabar-terbaru/{{slugify($v->judul)}}">{{ $v->judul or '' }}</a></h1>
            <span class="author">{{ $v->creatorName() }}</span>
            <span class="date-time">{{ DateToStringWday($v->created_at) }}</span>
                <p>{!! substr($v->deskripsi,0,100) !!}</p>
            <a href="{{ url($pageUrl.$v->id) }}/kabar-terbaru/{{slugify($v->judul)}}" class="btn btn-upper btn-primary read-more">read more</a>
        </div>
        <center><h6 class="section-title" style="padding-top: 2px"></h6></center>
        @endforeach
        @else
            <div class="blog-post  wow fadeInUp animated" style="visibility: visible; animation-name: fadeInUp;">
                <center>No Data Found</center>
            </div>
        @endif
    </div>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-12">
            {!! $records->links('partials.pagination.frontend-pagination') !!}
        </div>
    </div>
</div>