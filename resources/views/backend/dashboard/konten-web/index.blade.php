@extends('layouts.admin')
@section('content')
    <div class="container-fluid">
        <div class="box box-wrapper" id="myTab" role="tablist">
            <ul class="nav nav-tabs" style="padding-bottom: 20px">
                <li class="nav-item" style="width:30%; padding-right: 10px">
                    <a href="#slider" class="nav-link active btn btn-success" id="slide-tab" data-toggle="tab" role="tab" aria-controls="sider" aria-selected="true">Slider</a>
                </li>
                <li class="nav-item" style="width:30%; padding-right: 10px">
                    <a href="#promo" class="nav-link btn btn-success" id="promo-tab" data-toggle="tab" role="tab" aria-controls="promo" aria-selected="false">Promo</a>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="slider" role="tabpanel" aria-labelledby="slide-tab">
                    <div class="card">
                        <div class="card-body">
                            @foreach ($record as $item)
                            <form action="{{ url('admin/konten-web',$item->id) }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="_method" value="PUT">
                                <input type="hidden" name="id" value="{{ $item->id or ''}}">
                                <div class="form-group">
                                    <label for="judul">Judul</label>
                                    <input type="text" name="judul" id="" class="form-control" value="{{ $item->judul }}">
                                </div>
                                @foreach ($item->attachments as $file)
                                    <div class="form-group">
                                        <input type="hidden" class="form-control" name="attachment_exists[{{$file->id or ''}}]" autocomplete="off" accept="image/*">
                                        <center><div class="card" style="width: 13rem;">
                                            <a href="{{ url('storage/'.$file->url) }}">
                                                <img class="card-img-top" src="{{ imgExist(url('storage/'.$file->url)) }}" alt="Card image cap" style="max-width:150px;max-height: 150px">
                                            </a>
                                        </div></center>
                                    </div>
                                @endforeach
                                <div class="form-group">
                                    <div class="custome-file">
                                        <label for="">Upload File</label>
                                        <input type="file" class="form-control" id="inputGroupFile01" name="attachment[]" autocomplete="off" accept="image/png, image/gif, image/jpeg, image/jpg" {{ $multi or '' }} data-url="{{ $url or '' }}">
			                            {{-- <label class="custom-file-label" for="inputGroupFile01">Upload File</label> --}}
                                    </div>
                                </div>
                                {{-- <div class="form-group">
                                    @include('partials.file-tab.attachment')
                                </div> --}}
                                <input type="hidden" name="kategori" value="Slider">
                                <button type="submit" class="btn btn-primary mb-5">Add</button>
                            </form>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="promo" role="tabpanel" aria-labelledby="slide-tab">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Dibuat Oleh</th>
                                            <th>Judul</th>
                                            <th>Gambar</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody class="body-isi">
                                        @if ($promo->count() > 0)
                                            @foreach ($record as $item => $v)
                                            <tr>
                                                <td>{{ $v->creator->nama }}</td>
                                                <td>{{ $v->judul }}</td>
                                                <td>
                                                    @if($v->attachments->count() > 0)
                                                    <img src="{{ url('storage/'.$v->attachments->first()->url) }}" alt="" style="max-height: 150px">
                                                    @else
                                                    <img src="{{ asset('img/no-images.png') }}" alt="" style="max-height: 150px">
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="" data-id="{{ $v->id }}" class="btn btn-sm btn-edit"><i class="fas fa-edit"></i></a>
                                                </td>
                                            </tr>
                                            @endforeach
                                            @else
                                            <tr>
                                                <td colspan="4"><center>Data Kosong</center></td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade bd-example-modal-lg" id="myModal" role="dialog">
            <div class="modal-dialog modal-lg">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Berita</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="form-data">
                        
                    </div>
                </div>
            
            </div>
        </div>
    </div>
@endsection
@section('script')
@include('backend.dashboard.script.modal')
    <script type="text/javascript">
        $(document).on('click','.btn-cari',function(e){
            var cari = $('#search').val();
            $.ajax({
                type: 'GET',
                url: "{{ url('admin/berita/ajax/search') }}",
                data: {cari:cari},
                success: function(resp){
                $('.body-isi').html(resp);
                },
                error: function(resp){
                $('.body-isi').html('data tidak d temukan');
                }
          });
        });
    </script>
@endsection