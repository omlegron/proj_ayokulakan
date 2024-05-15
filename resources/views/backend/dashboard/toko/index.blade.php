@extends('layouts.admin')
@section('content')
<div class="container-fluid">
    <!-- Small boxes (Stat box) -->
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
                    <form action="" method="post">
                        <div class="input-group">
                            <input type="text" class="form-control" id="input-serch" placeholder="Username">
                            <div class="input-group-prepend">
                                <button class="btn btn-warning" id="cari">Cari</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>Id Toko</th>
                    <th>Nama Toko</th>
                    <th>Bergabung</th>
                    <th>Rating</th>
                    <th>Aksi</th>
                </tr>
            </thead>
              <tbody class="body-isi">
                @foreach ($record as $item)
                  <tr>
                      <td>TAK{{ $item->id }}</td>
                      <td>{{ $item->nama_lapak }}</td>
                      <td>{{ $item->created_at }}</td>
                      <td><span>
                        <i class="fa fa-star" style="color:#ff7429;"></i>
                        <i class="fa fa-star" style="color:#ff7429;"></i>
                        <i class="fa fa-star" style="color:#ff7429;"></i>
                        <i class="fa fa-star" style="color:#ff7429;"></i>
                        <i class="fa fa-star" style="color:#ff7429;"></i>
                      </span></td>
                      <td>
                          <a href="{{ url('admin/toko',$item->id) }}" class="btn btn-sm"><i class="fas fa-eye"></i></a>
                      </td>
                  </tr>
                @endforeach
                <tr>
                  <td colspan="5"> {!! $record->links() !!}</td>
                </tr>
            </tbody>
        </table>
        {{-- <div class="pull-right">
          {!! $record->links() !!}
        </div> --}}
    </div>
</div><!-- /.container-fluid -->
@endsection
@section('script')
    <script type="text/javascript">
      $(document).ready(function(){
        $('#cari').on('click',function(e){
          e.preventDefault();
          var isi = $('#input-serch').val();
          $.ajax({
            type: 'GET',
            url: "{{ route('admin.toko.search') }}",
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
    </script>
@endsection
