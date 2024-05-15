@extends('layouts.admin')
@section('content')
    <div class="container-fluid">
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
        <div class="card">
            <div class="card-header">
                <a href="" class="btn btn-success btn-tambah" style="width: 100%; margin: 5px 0px"><i class="fas fa-plus"></i> Tambah Berita</a>
                <div class="row">
                    <div class="col-md-4">
                        <select name="" id="" class="form-control">
                            <option value="">Atur Berdasarkan</option>
                        </select>
                    </div>
                    <div class="col-md-8">
                        <form action="" method="post">
                            <div class="input-group">
                                <input type="text" class="form-control" id="search" placeholder="Search..">
                                <div class="input-group-prepend">
                                    <a href="javascript:void(0)" class="btn btn-warning btn-cari">Cari</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Judul</th>
                                <th>Image</th>
                                <th>Terbit</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="body-isi">
                        <?php 
                                for ($i=0; $i < $jumlah; $i++) { 
                        ?>
                            <tr>
                                <td>{{ $haji['judul'][$i] }}</td>
                                <td><img src="{{ $haji['gambar'][$i] }}" alt=""></td>
                                <td>{{ $haji['tgl'][$i] }}</td>
                                <td><a href="{{ $haji['href'][$i] }}" class="btn btn-sm"><i class="fas fa-eye"></i></a></td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
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