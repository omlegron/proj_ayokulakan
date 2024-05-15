
    <center><h3 style="background: #ffffff; margin-bottom: 0px; padding-bottom: 50px">Berita Terkait Haji Dan Umrah</h3></center>
    @if($record->count() > 0)
    @foreach($record as $k => $v)
    <div class="col-md-12 kabar-terbaru-sortir" style="background: #ffffff; border:1px solid #2422223e; margin-bottom: 10px">
        <div class="row no-gutters">
            <div class="col-md-8">
                <h3 style="color: orange; font-weight: bold; float: left; margin-right: 30px">Haji</h3>
                <h3 style="color: orange; font-weight: bold;">Umrah</h3>
                <h1><a href="{{ url($pageUrl.$v->id) }}">{{ $v->judul or '' }}</a></h1>
                <span class="author">{{ $v->creatorName() }}</span>
                <span class="date-time">{{ DateToStringWday($v->created_at) }}</span>
                    <p>{!! substr($v->deskripsi,0,100) !!}</p>
                <a href="{{ url($pageUrl.$v->id) }}" class="btn btn-upper btn-primary read-more">read more</a>
            </div>
            <div class="col-md-4">
                @if($v->attachments->count() > 0)
                    <center><a href="javascript:void(0)"><img class="img-responsive" src="{{ url('storage/'.$v->attachments->first()->url) }}" alt=""></a></center>
                @else
                    <center><a href="javascript:void(0)"><img class="img-responsive" src="{{ asset('img/no-images.png') }}" alt="bege blog images"></a></center>
                @endif
            </div>
        </div>
    </div>
    @endforeach
    @else
                <div class="blog-post  wow fadeInUp animated" style="visibility: visible; animation-name: fadeInUp;">
                    <center>No Data Found</center>
                </div>
            @endif
    
    <div class="row">
        <div class="col-lg-12 col-md-12 col-12">
            {!! $record->links('partials.pagination.frontend-pagination') !!}
        </div>
    </div>