@extends('layouts.admin')
@section('content')
    
    <div class="card ">
        <div class="card-body">
            <a href="javscript:void(0)" class="float-right btn btn-success btn-tambah my-3">Tambah Galeri</a>
            <table class="table table-bordered">
                <div class="table-responsive">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Description</th>
                            <th>Image</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $angka = 1; ?>
                        @foreach ($record as $item)
                            <tr>
                                <td><center>{{ $angka }}</center></td>
                                <td>{{ $item->deskripsi or '' }}</td>
                                <td>
                                    @if ($item->attachments->count() > 0)
                                    <center>
                                        <img src="{{ imgExist(url('storage/'.$item->attachments->first()->url )) }}" alt="" width="50px">
                                    </center>
                                    @else
                                        <img src="{{ asset('img/no-images.png') }}" alt="" style="max-height: 150px">
                                    @endif
                                </td>
                                <td>
                                    <a href="javascript:void(0)" data-id="{{ $item->id }}" class="btn btn-sm btn-edit"><i class="fas fa-edit"></i></a>
                                    <a href="javascript:void(0)" class="btn btn-sm btn-dell" data-id="{{ $item->id }}"><i class="fas fa-trash text-danger"></i></a>
                                </td>
                            </tr>
                            <?php $angka++ ?>
                        @endforeach
                    </tbody>
                </div>
            </table>
        </div>
        <div class="modal fade" id="myModal" role="dialog">
            <div class="modal-dialog">
            <!-- Modal content-->
              <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title">Data Galeri Keagamaan</h4>
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="form-data">
                              
                </div>
            </div>
          
        </div>
    </div>

@endsection 
@section('script')
    @include('backend.dashboard.script.modal')
    <script type="text/javascript">
        $(document).on('click','.btn-dell',function(e){
          e.preventDefault();
          var id = $(this).data('id');
          console.log(id);
          swal({
            title: 'Apa Anda Yakin?',
            text: "Data Yang Di Hapus Tidak Dapat Di Kembalikan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Delete',
            cancelButtonText: 'Cancel'
          }).then((result) => {
            if (result) {
              $.ajax({
                type: 'POST',
                url: "{{ url($pageUrl) }}/"+id,
                data: {_token: "{{ csrf_token() }}", _method: "delete"},
                success: function(resp){
                  swal(
                    'Deleted!',
                    'Your file has been deleted.',
                    'success'
                  ).then(function(e){
                    if(resp){
                      var url = "{{ url($pageUrl) }}";
                      window.location = url;
                    }
                  });
                },
                error: function(resp){
                  swal(
                    'Gagal!!',
                    'Data gagal dihapus, karena sedang dipakai',
                    'error'
                  ).then(function(e){
                    if(resp){
                      var url = "{{ url($pageUrl) }}";
                      window.location = url;
                    }
                  });
                }
              });
            }
          });
        });
    </script>
@endsection