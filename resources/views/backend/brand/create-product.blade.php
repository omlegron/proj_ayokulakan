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
	.detail-pesanan{
		display: flex;
		margin-top: 10px;
	}
	.detail-pesanan .deskripsi-pesanan{
		padding: 12px; 
	}
	.detail-pesanan .deskripsi-pesanan h3{
		margin: 2px;
	}
	.detail-pesanan .pesanan-check{
		margin-left: auto;
	}
	.detail-pesanan input{
		margin-right: 10px;
	}
	.action-pesanan{
		display: flex;
		padding: 10px 15px;
		height: 50px;
	}
	.pesanan-kurir{
		border: 2px solid #000000;
		padding: 10px;
		margin: 5px;
	}
	.pesanan-kurir p{
		font-weight: 600;
		text-transform: capitalize;
	}
	.icon-belanja{
		width: 50px;
		height: 50px;
		border: 1px solid #ccc;
		border-radius: 50px;
		padding: 10px;
		text-align: center;
		margin-right: 10px;
	}
	.icon-belanja span{
		color: #db700c;
		font-size: 18px;
	}
	.action-pesanan .pesanan-icon{
		margin-left: auto;
	}
	.nice-number button{
		background: #db700c;
		color: #ffffff;
		padding: 0px 10px;
		border: none;
	}
	.buttons:hover {
		background:black;
	}
</style>
<div class="row">
	@include('backend.brand.partials.partials')
	<div class="col-md-8">
		<div class="scroll-tabs fadeinUp wow">
			<div class="more-info-tab clearfix" id="content">
				<div style="width: 100%; height: 20px; border-bottom: 1px solid black; margin-bottom: 20px; text-align: center">
					<span style="font-size: 22px; background-color: #FFFFFF; padding: 0 10px;">
						Setting Brand
					</span>
				</div><br>
				<a href="" class="btn btn-default">Informasi</a>
				<a href="" class="btn btn-default">Catatan</a>
				<form id="dataFormModal" action="{{ url($pageUrl.'create-product-brand') }}" method="POST" enctype="multipart/form-data">
					{!! csrf_field() !!}
					<input type="hidden" name="id_trans_lapak" value="{{ $record->id }}">
					<div class="row  wow fadeInUp animated" style="visibility: visible; animation-name: fadeInUp;">
						<div class="col-md-12 mt-5" style="margin-top: 30px">
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label for="">Satuan Barang</label>
										<select name="satuan_barang" class="form-control selectpicker" required="" data-dropup-auto="false" data-size="10" data-style="none" >
											<option>Pilih Satuan</option>
											<option value="Buah">Buah</option>
											<option value="Lusin">Lusin</option>
											<option value="Box">Box</option>
											<option value="Kodi">Kodi</option>
											<option value="Gross">Gross</option>
											<option value="Rim">Rim</option>
											<option value="Drum">Drum</option>
											<option value="Krat">Krat</option>
											<option value="Slop">Slop</option>
											<option value="Pcs">Pcs</option>
											<option value="Liter">Liter</option>
										</select>					
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label for="">Kondisi</label>
										<select name="kondisi_barang" id="" class="form-control">
											<option value="">Pilih Kondisi Barang</option>
											<option value="baru">Baru</option>
											<option value="bekas">Bekas</option>
										</select>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">	
									<div class="form-group">
										<label for="">Jumlah Barang</label>
										<input type="number" min="1" name="stock_barang" class="form-control" placeholder="Jumlah Barang" required="">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<div class="form-group">
											<label for="">Berat Barang</label>
											  <input type="number" min="1" name="berat_barang" class="form-control" placeholder="Berat Barang" required="">					
										</div>
									</div>	
								</div>	
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label for="">Kategori Brand</label>
										<select name="id_kategori" id="" class="form-control">
											<option value="">Pilih Kategori Brand</option>
											@foreach ($store as $item)
												<option value="{{ $item->id }}">{{ $item->kat_nama or '' }}</option>
											@endforeach
										</select>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label for="">Judul</label>
										<input type="text" name="nama_barang" class="form-control" placeholder="Nama" required="">
									</div>
								</div>
							</div>
							<div class="form-group">
								<label for="">Deskripsi</label>
								<textarea name="deskripsi_barang" class="form-control summernote" rows="2" placeholder="Deskripsi" required=""></textarea>
							</div>
							<div class="row">
								<div class="col-sm-6 col-md-6">
									<div class="form-group">
										<label for="">Minimum Pembelian</label>
										<input type="text" name="minimum_pembelian" class="form-control" aria-describedby="basic-addon3" placeholder="Minimum Pembelian" required="">
									</div>
								</div>
								<div class="col-sm-6 col-md-6">
									<div class="form-group">
										<label for="Discount">Merek Brand</label>
										<input type="text" class="form-control disc" name="merek"  >	
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-6 col-md-6">
									<div class="form-group">
										<label for="">Tentukan Harga</label>
										<input type="text" name="harga_normal" class="form-control change-money-modals key" aria-describedby="basic-addon3" placeholder="Harga Brand" required="">
									</div>
								</div>
								<div class="col-sm-6 col-md-6">
									<div class="form-group">
										<label for="Discount">Discount %</label>
										<input type="text" class="form-control disc" name="disc_barang"  >	
									</div>
								</div>
							</div>
							<div class="form-group">
								<label for="subTotal">Sub Total</label>
								<input type="text" name="harga_barang" class="form-control keys" aria-describedby="basic-addon3" readonly>
							</div>	
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label for="">Expired</label>
										<input type="text" name="expired" class="form-control" placeholder="Expired" required="">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										@include('partials.file-tab.attachment',[
											'foto' => 'Upload Foto Product (wajib)',
											'lapak' => true,
											'multi' => 'multiple'
										])
									</div>	
								</div>
							</div>
						</div>
					</div>
					<button type="button" class="btn btn-outline-success save-modal save-ayokulakan btn-success btn-block"><i class="ion-ios-paper"></i> Simpan</button>
				</form>
			</div>
		</div>	
	</div>
</div>
@endsection
@section('scripts-js')
	<script>
		function convertToMata(angka){
			var rupiah = '';
			var angkarev = angka.toString().split('').reverse().join('');
			for(var i = 0; i < angkarev.length; i++) if(i%3 == 0) rupiah += angkarev.substr(i,3)+'.';
				var hasil = ''+rupiah.split('',rupiah.length-1).reverse().join('');
			if(hasil == 'NaN'){
				hasil = '';
			}else{
				hasil = hasil+',00';
			}
			return 'Rp.'+hasil;
		}
		$(document).ready(function(){
			const anElement = AutoNumeric.multiple('.change-money-modals', {
				'digitGroupSeparator': '.',
				'decimalPlaces': '2',
				'decimalCharacter': ',',
				'currencySymbol': 'Rp.',
			});
			$('.key').keyup(function(){
				var value = $(this).val();
				$('.keys').val(value+',00');
			});
			$('.disc').keyup(function() {
				var isi = $(this).val();
				var val = $('.key').val();
				var pars = val.replace(/\D/g,'');
				var int = pars.substring(0, pars.length-2);
			
				var disc = isi * int /100;
				var hasil = int - disc ;
				var convert = convertToMata(hasil);
				$('.keys').val(convert);
			});
		});
	</script>
@endsection