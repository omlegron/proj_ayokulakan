@extends('layouts.admin')
@section('content')
<div class="container-fluid">
    <!-- Small boxes (Stat box) -->
    @if(Session::has('success'))
      <div class="flashdata" data-url="{{ Session::get('success') }}">
          
      </div>
    @endif
  <div class="row">
      <div class="col-lg-4 col-6">
        <!-- small box -->
        <div class="small-box bg-info">
          <div class="inner">
            <h3>150</h3>

            <p>Total Karyawan</p>
          </div>
          <div class="icon">
            <i class="ion ion-bag"></i>
          </div>
          <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-4 col-6">
        <!-- small box -->
        <div class="small-box bg-success">
          <div class="inner">
            <h3>53<sup style="font-size: 20px">%</sup></h3>

            <p>Laki-Laki</p>
          </div>
          <div class="icon">
            <i class="ion ion-stats-bars"></i>
          </div>
          <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-4 col-6">
        <!-- small box -->
        <div class="small-box bg-warning">
          <div class="inner">
            <h3>44</h3>

            <p>Perempuan</p>
          </div>
          <div class="icon">
            <i class="ion ion-person-add"></i>
          </div>
          <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
    </div>
    <!-- Button trigger modal -->
    <div class="box box-wrapper">
        <div class="mb-2">
            <div class="row">
                <div class="col-md-8">
                  <div class="input-group">
                      <input type="text" id="input-serch" class="form-control" placeholder="Search..">
                      <div class="input-group-prepend">
                          <a class="btn btn-warning" id="cari">Cari</a>
                      </div>
                  </div>
                </div>
                <div class="col-md-4">
                    <a href="" class="btn btn-warning w-100 btn-tambah">Tambah Karyawan</a>
                </div>
            </div>
        </div>
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Status</th>
                    <th>Bergabung</th>
                    <th>Role</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody class="body-isi">
                @foreach ($record as $item)
                    <tr>
                        <td>{{ $item->nama }}</td>
                        <td>{!! $item->getStatus() ?? '-' !!}</td>
                        <td>{{ $item->created_at }}</td>
                        <td>{{ $item->role or '-' }}</td>
                        <td>
                            <a href="javascript:void(0)" class="btn btn-sm mybtn" data-id="{{ $item->id }}"><i class="fas fa-eye"></i></a>
                            <a href="" class="btn btn-sm btn-edit" data-id="{{ $item->id }}"><i class="fas fa-edit"></i></a>
                            <a href="javascript:void(0)" class="btn btn-sm btn-dell" data-id="{{ $item->id }}"><i class="fas fa-trash text-danger"></i></a>
                        </td>
                    </tr>
                @endforeach
                <tr>
                  <td colspan="5"> {!! $record->links() !!}</td>
                </tr>
            </tbody>
          </table>
    </div>
    <div class="modal fade" id="myModal" role="dialog">
      <div class="modal-dialog">
      <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Data Karyawan</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
          <div class="form-data">
                        
          </div>
        </div>
    
    </div>
  </div>
</div><!-- /.container-fluid -->
@endsection
@section('script')
@include('backend.dashboard.script.modal')
    <script type="text/javascript">
      $(document).ready(function(){
        $('#cari').on('click',function(e){
          e.preventDefault();
          var isi = $('#input-serch').val();
          $.ajax({
            type: 'GET',
            url: "{{ route('admin.karyawan.search') }}",
            data: {isi:isi},
            success: function(resp){
              $('.body-isi').html(resp);
            },
            error: function(resp){
              $('.body-isi').html('data tidak d temukan');
            }
          });
        });
      });
      $(document).on('click','.mybtn',function(e){
          console.log('sie');
          var id = $(this).data('id');
          $.ajax({
            type: 'GET',
            url: "{{ url('admin/karyawan/show') }}/"+id,
            data: {id:id},
            success: function(resp){
              $('#myModal').modal('show');
              $('.form-data').html(resp);
            },
            error: function(resp){
              
            }
          });
        });
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
                url: "{{ url('admin/karyawan/') }}/"+id,
                data: {_token: "{{ csrf_token() }}", _method: "delete"},
                success: function(resp){
                  swal(
                    'Deleted!',
                    'Your file has been deleted.',
                    'success'
                  ).then(function(e){
                    if(resp){
                      var url = "{{ url('admin/karyawan') }}";
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
                      var url = "{{ url('admin/karyawan') }}";
                      window.location = url;
                    }
                  });
                }
              });
            }
          });
        });
      var flash = $('.flashdata').attr('data-url');
        if(flash){
          swal({
            title: 'Success',
            text: flash,
            type: 'success',
          });
        }
    </script>
@endsection