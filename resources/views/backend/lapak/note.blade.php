
	@extends('layouts.grid')

    @section('js-filters')
    d.nama = $("input[name='filter[nama]']").val();
    @endsection
    
    @section('scripts')
    @include('backend.lapak.script.index')
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
			<form id="dataFormModal" action="{{ url($pageUrl.'note') }}" method="POST">
                {!! csrf_field() !!}
                <input type="hidden" name="lapak_id" value="{{ auth()->user()->lapak->id ?? '' }}">
				<div class="scroll-tabs fadeinUp wow">
					<div class="more-info-tab clearfix" id="content">
						<p style="font-size: 20px; font-weight: 600;">Pengaturan Lapak</p>
						<a href="{{ url($pageUrl.'create') }}" class="btn-sm btn-default">Informasi</a>
						<a href="{{ url($pageUrl.'note') }}" class="btn-sm btn-default">Catatan</a>
						<a href="{{ url($pageUrl.'address') }}" class="btn-sm btn-default">Lokasi</a>
						<a href="" class="btn-sm btn-default">Pengiriman</a>
                        <br><br>
						<label for="">Catatan Lapak</label>
						<div class="form-group">
							<label for="">Judul Catatan</label>
							<input type="text" name="judul_catatan" class="form-control" placeholder="Judul Catatan" required="">
		
						</div>
						<div class="form-group">
							<label for="">Isi catatan</label>
							<textarea name="isi_catatan" class="form-control" rows="2" placeholder="Isi catatan"></textarea>
						</div>
						<div class="form-group">        
                            <div class="col-sm-offset-9 col-sm-3 text-right">
                                <button type="button" class="btn btn-warning save-modal save-ayokulakan"><i class="ion-ios-paper"></i> Simpan</button>
                            </div>
                        </div>
					</div>
				</div>
			</form>
			<form id="dataSave" action="{{ url($pageUrl.'kebijakan') }}" method="POST">
                {!! csrf_field() !!}
                <input type="hidden" name="lapak_id" value="{{ auth()->user()->lapak->id ?? '' }}">
				<div class="scroll-tabs fadeinUp wow">
					<div class="more-info-tab clearfix" id="content">
						<div class="more-info-tab clearfix" id="content">
						<p style="font-size: 20px; font-weight: 600;">Kebijakan Lapak</p>
						<div class="form-group">
							<label for="">Judul Kebijakan</label>
							<input type="text" name="judul_kebijakan" class="form-control" placeholder="Judul Kebijakan" required="">
		
						</div>
						<div class="form-group">
							<label for="">Isi Kebijakan</label>
							<textarea name="isi_kebijakan" class="form-control" rows="2" placeholder="Isi Kebijakan"></textarea>
						</div>
						<div class="form-group">        
                            <div class="col-sm-offset-9 col-sm-3 text-right">
                                <button type="button" class="btn btn-warning btn-save"><i class="ion-ios-paper"></i> Simpan</button>
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