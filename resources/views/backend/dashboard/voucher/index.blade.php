@extends('layouts.admin')
@section('content')
    <div class="card">
        <div class="card-body">
            <a href="javascript(0)" class="float-right btn btn-success btn-tambah my-3">Tambah Voucher</a> 
            <table class="table table-bordered">
                <div class="table-responsive">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode Voucher</th>
                            <th>Nominal Voucher</th>
                            <th>Keterangan</th>
                            <th>Expire Voucher</th>
                            <th>Created By</th>
                            <th>action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($record->count() > 0)
                        <?php $no=1 ?>
                            @foreach ($record as $item)
                                <tr>
                                    <td>{{ $no }}</td>
                                    <td>{{ $item->kode_voucher or '' }}</td>
                                    <td>{{ number_format($item->nominal_voucher ,2 ,',','.')  }}</td>
                                    <td>{{ $item->desc_voucher or '' }}</td>
                                    <td>{{ $item->expire_date or '' }}</td>
                                    <td>{{ $item->creatorName()  }}</td>
                                    <td>
                                        <a href="javascript:void(0)" data-id="{{ $item->id }}" class="btn btn-sm btn-edit"><i class="fas fa-edit"></i></a>
                                        <a href="javascript:void(0)" data-id="{{ $item->id }}" class="btn btn-sm btn-dell"><i class="fas fa-trash text-danger"></i></a>
                                    </td>
                                </tr>
                              <?php $no++ ?>
                            @endforeach
                            @else
                            <tr>
                                <td colspan="6"><center><h1>Data Belum Ada</h1></center></td>
                            </tr>
                        @endif
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