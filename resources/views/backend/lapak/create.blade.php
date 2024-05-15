
	@extends('layouts.grid')

    @section('js-filters')
    d.nama = $("input[name='filter[nama]']").val();
    @endsection
    
    
    
    @section('rules')
    <script type="text/javascript">
        formRules = {
            judul: ['empty'],
        };
    </script>
    @endsection
    @section('filters')
    
    @endsection
    @section('toolbars')
    
    @endsection
    @section('subcontent')
    <style type="text/css">
        .terms-conditions-page{
            padding-top: 0px !important;
            margin-top: -35px;
        }
        .detail-block{
            background-color: transparent;
        }
        .outer-top-vs {
            margin-top: 3px;
        }
        .scroll-tabs{
            margin-bottom: 5px;
        }
        .profile-img{
            width: 40px; height: 40px;
            float: left;
            margin-right: 20px;
        }
        .profile-name{
            font-size: 18px;
            font-weight: 600;
            color: #000;
            margin: 0px;
        }
        .profile-verif{
            font-size: 14px;
            font-weight: 300;
            color: #a09898;
    
		}
		.scroll-tabs{
			border-radius: 10px;
		}
        .components>li{
            padding: 10px;
        }
        .components > li > a{
            color: #000;
            font-size: 16px;
            font-weight: 400;
        }
        .colapse-item{
            padding: 10px !important;
        }
        .colapse-item{
            color: #a09898;
        }
        .colapse-item a{
            font-size: 15px
            font-weight: 300;
        }
        .colapse-item:hover{
            background: #d4bcbc;
            color: #ffffff !important;
		}
		.oprational{
			display: flex;
		}
		.oprational-body{
			padding: 10px;
		}
    </style>
    <div class="row">
        @include('backend.lapak.partials.partials')
        <div class="col-md-9">
			@if ($record)
				<form id="dataFormModal" action="{{ url($pageUrl.$record->id) }}" method="POST">
					<div class="scroll-tabs fadeinUp wow">
						<div class="more-info-tab clearfix" id="content">
						<p style="font-size: 20px; font-weight: 600;">Pengaturan Lapak</p>
						<a href="{{ url($pageUrl.'create') }}" class="btn-sm btn-default">Informasi</a>
						<a href="{{ url($pageUrl.'note') }}" class="btn-sm btn-default">Catatan</a>
						<a href="{{ url($pageUrl.'address') }}" class="btn-sm btn-default">Lokasi</a>
						<a href="" class="btn-sm btn-default">Pengiriman</a>
						{!! csrf_field() !!}
						@method('PUT')
							<input type="hidden" name="id" value="{{ $record->id }}">
							<div class="form-group">
								<label for="">Nama Lapak</label>
								<input type="text" name="nama_lapak" class="form-control" placeholder="Nama Lapak" value="{{ $record->nama_lapak }}" required="">
			
							</div>
							<div class="form-group">
								<label for="">Slogan</label>
								<input type="text" name="deskripsi" class="form-control" value="{{ $record->deskripsi }}">
							</div>
							<div class="form-group">
								<label for="">Deskripsi Lapak</label>
								<textarea name="deskripsi_lapak" class="form-control" rows="2" placeholder="Deskripsi Lapak">{!! $record->deskripsi_lapak !!}</textarea>
							</div>
							<div class="form-group">        
								<div class="col-sm-offset-9 col-sm-3 text-right">
									<button type="button" class="btn btn-warning save-modal save-ayokulakan"><i class="ion-ios-paper"></i> Simpan</button>
								</div>
							</div>
						</div>
						</div>
				</form>
				@else
				<form id="dataFormModal" action="{{ url($pageUrl) }}" method="POST">
					{!! csrf_field() !!}
					<div class="scroll-tabs fadeinUp wow">
						<div class="more-info-tab clearfix" id="content">
							<a href="" class="btn-sm btn-default">Informasi</a>
							<a href="" class="btn-sm btn-default">Catatan</a>
							<a href="" class="btn-sm btn-default">Lokasi</a>
							<a href="" class="btn-sm btn-default">Pengiriman</a>
							<div class="form-group">
								<label for="">Nama Lapak</label>
								<input type="text" name="nama_lapak" class="form-control" placeholder="Nama Lapak" required="">
			
							</div>
							<div class="form-group">
								<label for="">Slogan</label>
								<input type="text" name="deskripsi" class="form-control" placeholder="masukan slogan toko anda">
							</div>
							<div class="form-group">
								<label for="">Deskripsi Lapak</label>
								<textarea name="deskripsi_lapak" class="form-control" rows="2" placeholder="Deskripsi Lapak"></textarea>
							</div>
							<div class="form-group">        
								<div class="col-sm-offset-9 col-sm-3 text-right">
									<button type="button" class="btn btn-warning save-modal save-ayokulakan"><i class="ion-ios-paper"></i> Simpan</button>
								</div>
							</div>
						</div>
					</div>
				</form>
				@endif
				<form id="" action="" method="POST">
					{!! csrf_field() !!}
					<div class="scroll-tabs fadeinUp wow">
						<div class="more-info-tab clearfix" id="content">
							<div class="more-info-tab clearfix" id="content">
							<p style="font-size: 20px; font-weight: 600;">Status</p>
							<a href="" class="btn-sm btn-default">Buka Lapak</a>
							<a href="" class="btn-sm btn-default">Tutup Lapak</a>
							<div class="row" style="border: 1px solid #f5ecec; margin: 10px 2px;">
								<div class="col-md-7">
									<div style="padding: 10px 0px;">
										<label>Pilih Hari</label><br>
										<a href="" class="btn-sm btn-default">Senin</a>
										<a href="" class="btn-sm btn-default">Selasa</a>
										<a href="" class="btn-sm btn-default">Rabu</a>
										<a href="" class="btn-sm btn-default">Kamis</a>
										<a href="" class="btn-sm btn-default">Jumat</a>
										<a href="" class="btn-sm btn-default">Sabtu</a>
										<a href="" class="btn-sm btn-default">minggu</a>
									</div>
								</div>
								<div class="col-md-5">
									<div class="oprational">
										<div class="oprational-body">
											<label for="">Jam Buka</label><br>
											<select name="" id="">
												<option value="">Pilih</option>
											</select>
										</div>
										<div class="oprational-body">
											<label for="">Jam Buka</label><br>
											<select name="" id="">
												<option value="">Pilih</option>
											</select>
										</div>
										<div class="oprational-body">
											<label for="">Zona Waktu</label>
											<p>WIB</p>
										</div>
									</div>
								</div>
							</div>
							<div class="form-group">        
								<div class="col-sm-offset-9 col-sm-3 text-right">
									<button type="button" class="btn btn-warning save-modal save-ayokulakan"><i class="ion-ios-paper"></i> Simpan</button>
								</div>
							</div>
						</div>
					</div>
				</form>
        </div>
    </div>
    @endsection
    @section('scripts-js')
        
    @endsection