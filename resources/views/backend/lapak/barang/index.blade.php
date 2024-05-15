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
    #image_preview{
	padding: 10px;

    }

    #image_preview img{

    width: 200px;

    padding: 5px;

    }
</style>
<div class="row">
	@include('backend.lapak.partials.partials')
	<div class="col-md-9">
		<div class="scroll-tabs fadeinUp wow">
			<div class="more-info-tab clearfix" id="content">
                <div class="row mt-2">
                    <div class="col-xl-12 col-sm-12 col-md-12" style="">
                        <h4>Tambah Produk</h4>
                        <p>Silahkan Pilih dan upload barang kategori yang mau anda jual</p>
                        <div class="col-xl-12 col-sm-12 col-md-4 p-0" style="padding: 0px; max-height:600px; overflow-y: scroll">
                            @foreach ($records as $item)
                                <ul class="list-unstyled components border my-3" id="lapak-barang" style=" width:100%; display:flex;">
                                    <li class="bg-dark text-white" style="padding: 10px 0px; border:1px solid black; width: 100%;">
                                        <a href="javascript:void(0)" id="link-lapak" class="h5" data-url="{{ $item->id }}" style="display: flex; width:100%;">
                                            <img src="{{ ($item->attachments) ? imgExist(url('storage/'.$item->attachments->url)) : asset('img/no-images.png') }}" alt="" class="card-img-top" style="width:50px">
                                            <p style="line-height: 50px; padding-left: 10px">{{ $item->kat_nama }}</p>
                                            <span class="fa fa-angle-right" style="line-height: 50px; font-size:14px; margin-left:auto; margin-right:10px"></span>
                                        </a>
                                    </li>
                                </ul>
                            @endforeach
                        </div>
                        <div class="col-xl-12 col-sm-12 col-md-8" style="max-height:600px; overflow-y: scroll">
                            <ul id="second-lapak" style="">
                                
                            </ul>
                        </div>
                    </div>
                </div>
			</div>
		</div>	
	</div>
</div>
@endsection
@section('scripts-js')
	
@endsection