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
      <ul class="nav nav-tabs" id="myTab" role="tablist" style="padding-bottom: 20px">
        <li class="nav-item" style="width:30%; padding-right: 10px">
          <a class="nav-link active btn btn-success" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Semua</a>
        </li>
        <li class="nav-item" style="width:30%; padding-right: 10px !important">
          <a class="nav-link btn bg-green" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Belum Verivikasi</a>
        </li>
        <li class="nav-item" style="width:30%;">
          <a class="nav-link btn bg-green" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Anggota</a>
        </li>
      </ul>
      <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
            <form action="" method="post">
              <div class="input-group">
                  <input type="text" class="form-control" id="input-serch" placeholder="Username">
                  <div class="input-group-prepend">
                      <button type="button" class="btn btn-warning" id="cari">Cari</button>
                  </div>
              </div>
          </form>
          <table class="table table-bordered table-hover">
              <thead>
                  <tr>
                      <th>Id Kurir</th>
                      <th>Nama Kurir</th>
                      <th>Register</th>
                      <th>Aksi</th>
                  </tr>
              </thead>
              <tbody class="body-isi">
                  @foreach ($semua as $item)
                      <tr>
                          <td>KAK{{ $item->id }}</td>
                          <td>{{ $item->namadepan .' '. $item->namabelakang}}</td>
                          <td>{{ $item->created_at }}</td>
                          <td class="text-right">
                              <a href="{{ route('admin.kurir.show',$item->id) }}" class="btn btn-sm"><i class="fas fa-eye"></i></a>
                              {!! $item->getStatus() ?? '-' !!}
                          </td>
                      </tr>
                  @endforeach
              </tbody>
          </table>
          <div class="pull-right">
            {!! $semua->links() !!}
          </div>
        </div>
        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
            <form action="" method="post">
              <div class="input-group">
                  <input type="text" class="form-control" id="input-serch" placeholder="Username">
                  <div class="input-group-prepend">
                      <button class="btn btn-warning" id="cari">Cari</button>
                  </div>
              </div>
          </form>
          <table class="table table-bordered table-hover">
              <thead>
                  <tr>
                      <th>Id Kurir</th>
                      <th>Nama Kurir</th>
                      <th>Register</th>
                      <th>Aksi</th>
                  </tr>
              </thead>
              <tbody class="body-isi">
                  @foreach ($verif as $item)
                      <tr>
                          <td>KAK{{ $item->id }}</td>
                          <td>{{ $item->namadepan .' '. $item->namabelakang}}</td>
                          <td>{{ $item->created_at }}</td>
                          <td class="text-right">
                            <a href="{{ route('admin.kurir.show',$item->id) }}" class="btn btn-sm"><i class="fas fa-eye"></i></a>
                              {!! $item->getStatus() ?? '-' !!}
                          </td>
                      </tr>
                  @endforeach
              </tbody>
          </table>
          <div class="pull-right">
            {!! $verif->links() !!}
          </div>
        </div>
        <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
            <form action="" method="post">
              <div class="input-group">
                  <input type="text" class="form-control" id="input-serch" placeholder="Username">
                  <div class="input-group-prepend">
                      <button class="btn btn-warning" id="cari">Cari</button>
                  </div>
              </div>
          </form>
          <table class="table table-bordered table-hover">
              <thead>
                  <tr>
                      <th>Id Kurir</th>
                      <th>Nama Kurir</th>
                      <th>Register</th>
                      <th>Aksi</th>
                  </tr>
              </thead>
              <tbody class="body-isi">
                  @foreach ($anggota as $item)
                      <tr>
                          <td>KAK{{ $item->id }}</td>
                          <td>{{ $item->namadepan .' '. $item->namabelakang}}</td>
                          <td>{{ $item->created_at }}</td>
                          <td class="text-right">
                            <a href="{{ route('admin.kurir.show',$item->id) }}" class="btn btn-sm"><i class="fas fa-eye"></i></a>
                              {!! $item->getStatus() ?? '-' !!}
                          </td>
                      </tr>
                  @endforeach
              </tbody>
          </table>
          <div class="pull-right">
            {!! $anggota->links() !!}
          </div>
        </div>
      </div>
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
            url: "{{ url('admin/kurir/show/search') }}",
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
