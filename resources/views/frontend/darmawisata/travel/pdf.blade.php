<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<link rel="icon" href="" sizes="192x192">
	<title>Laporan Booking Travel</title>
	<style>
		body {
			font-family: "Times New Roman", Times, serif; 
		}

		@page {
			margin: 20px 0px;
		}


		body {
			margin-top: 5cm;
			margin-bottom: -20px;
      /*margin-left: 0cm;
      margin-right: 0cm;*/
      font-style: normal;

  }

  .ui.table.bordered {
  	border: solid black 2px;
  	border-collapse: collapse;
  	width: 100%;
  }

  .ui.table.bordered td {
  	border: solid black 1px;
  	border-collapse: collapse;
  	/*padding:10px;*/
  }

  .ui.table.bordered td img {
  	padding: 10px;
  }

  .ui.table.bordered td.center.aligned {
  	text-align : center;
  }


  header {
  	position: fixed;
  	top: 20px;
  	height: 50px;
  	text-align: center;
  	line-height: 35px;
  	margin-right:60px; 
  	margin-left:65px;
  }

  main {
  	position: sticky;
  	font-size : 12px;
  	margin-top : 5px;
  	margin-left: 50px;
  	margin-right: 50px;
  	border: solid white 1.5px !important; 
  	/*border-collapse: collapse;*/
  	width: 100%;
  }

  footer {
  	position: fixed;
  	bottom: -60px;
  	left: 0px;
  	right: 0px;
  	height: 50px;


  	text-align: center;
  	line-height: 35px;
  	clear: both;
  }
  .footer .page-number:after {
  	content: counter(page);
  }

  .col-6 {
  	-webkit-box-flex: 0;
  	-ms-flex: 20% 20% 50%;
  	flex: 20% 20% 50%;
  	max-width: 50%;
  }

  .row {
  	/*border: #c0c5c7 1px dashed;*/
  	margin: auto;
  	margin-right: 0px;
  	margin-left: 0px;
  	margin-top: auto;
  }
  .col-sm-4 {
  	width: 63.33333333%;
  }
  .col-sm-3 {
  	width: 27%;
  }
  .col-sm-1, .col-sm-10, .col-sm-11, .col-sm-12, .col-sm-2, .col-sm-3, .col-sm-4, .col-sm-5, .col-sm-6, .col-sm-7, .col-sm-8, .col-sm-9 {
  	float: left;
  }
  .col-lg-1, .col-lg-10, .col-lg-11, .col-lg-12, .col-lg-2, .col-lg-3, .col-lg-4, .col-lg-5, .col-lg-6, .col-lg-7, .col-lg-8, .col-lg-9, .col-md-1, .col-md-10, .col-md-11, .col-md-12, .col-md-2, .col-md-3, .col-md-4, .col-md-5, .col-md-6, .col-md-7, .col-md-8, .col-md-9, .col-sm-1, .col-sm-10, .col-sm-11, .col-sm-12, .col-sm-2, .col-sm-3, .col-sm-4, .col-sm-5, .col-sm-6, .col-sm-7, .col-sm-8, .col-sm-9, .col-xs-1, .col-xs-10, .col-xs-11, .col-xs-12, .col-xs-2, .col-xs-3, .col-xs-4, .col-xs-5, .col-xs-6, .col-xs-7, .col-xs-8, .col-xs-9 {
  	position: relative;
  	min-height: 1px;
  	padding-right: 15px;
  	padding-left: 15px;
  }

  /* Create three equal columns that floats next to each other */
  .column {
  	float: left;

  	height: 300px; /* Should be removed. Only for demonstration */
  }

  /* Clear floats after the columns */
  .row:after {
  	content: "";
  	display: table;
  	clear: both;
  }
</style>



</head>
<body>  
	<script type="text/php">
		if (isset($pdf)) {
			$font = $fontMetrics->getFont("Times New Romans", "bold");
			$pdf->page_text(425, 830, "Tebarkan Kesejahteraan dan Kedamaian Bersama AYOKULAKAN", $font, 6, array(0, 0, 0));
		}
	</script>  
@if($getBooking->status == 'SUCCESS')
	<header>
		<table class="ui table" style="width: 100%;">
			<tr>
				<td rowspan="" style="width: 250px;">
					<small>{{ \Carbon\Carbon::now()->format('Y/m/d') }}</small>
				</td>
				<td class="center aligned" style="">
					<center style="font-size: 13px"><b><small>Laporan Booking Travel</small></b></center>
				</td>
				<td colspan="" rowspan="" headers=""></td>
			</tr>
			<tr>
				<td rowspan="" style="width: 250px;text-align: left;">
					<span>{{ $getBooking->bookingCode or '' }}</span>
				</td>
				<td colspan="" rowspan="" headers=""></td>
				<td class="center aligned" colspan="" style="text-align: right;">
					<img src="{{ asset('ayoLogo.png') }}" style="max-width: 100px;">
				</td>
			</tr>
		</table>
	</header>

	<main>
		<fieldset style="border:none">
			<legend><b>Detail Pemesanan</b></legend>
			<table class="ui table" style="font-size:12px;width: 100%;border-collapse: collapse;border:1px solid black !important;">
				<tr>
					<td style="width:250px;" align="middle">
						<center style="padding-top: 18px"><small><b>KODE BOOKING</b></small></center>
						<center><h2><b>{{ $getBooking->bookingCode or '' }}</b></h2></center>
					</td>
					<td style="width: 150px">
						<span>TANGGAL BOOKING</span><br>
						<span>NAMA</span><br>
						<span>TELEPON</span>
					</td>
					<td >
						: <span>{{ isset($getBooking->bookingDate) ? \Carbon\Carbon::parse($getBooking->bookingDate)->format('d F Y H:i') : '' }}</span><br>
						: <span>{{ $getBooking->contactName or '-' }}</span><br>
						: <span>{{ $getBooking->contactPhone or '-' }}</span>
					</td>
				</tr>
			</table>
		</fieldset><br>

		<fieldset style="border:none">
			<legend><b>Detail Perjalanan</b></legend>
			<table class="ui table" style="font-size:12px;width: 100%;border-collapse: collapse;border:1px solid black !important;">
				<tbody>
					<tr>
						<td style="width:100px;height:60px;">
							<span><small><b>TANGGAL BERANGKAT<b></small></span><br>
								<span><small>{{ isset($getBooking->departTime) ? \Carbon\Carbon::parse($getBooking->departTime)->format('d F Y H:i') : '-' }}</small></span>
							</td>
							<td style="width:100px;height:60px;">
								<span><small><b>TRAVEL<b></small></span><br>
									<span><small>{{ $getBooking->origin or '-' }}</small></span>
								</td>
								<td style="width:100px;height:60px;">
									<span><small><b>Dari</b></small></span><br>
									<span><small>{{ $getBooking->origin or '-' }}, {{ $getBooking->originAddress or '-' }}</small></span>
								</td>
								<td style="width:100px;height:60px;">
									<span><small><b>Tujuan</b></small></span><br>
									<span><small>{{ $getBooking->destination or '-' }}, {{ $getBooking->destinationAddress or '-' }}</small></span>
								</td>
							</tr>
						</tbody>
					</table>
				</fieldset><br>

				@php
			$Infant = 0;
			$Adult = 0;
			$Child = 0;
			$cekTiketPrice = ($getBooking->ticketPrice) ? $getBooking->ticketPrice : 0;
			$cekTiketTotal = ($getBooking->totalTicket) ? $getBooking->totalTicket : 0;
			$price = $cekTiketPrice / $cekTiketTotal;
			@endphp
			<fieldset style="border:none">
				<legend><b>Detail Penumpang</b></legend>
				<table class="ui table" style="font-size:12px;width: 100%;border-collapse: collapse;border:1px solid black !important;">
					<thead>
						<tr>
							<th colspan="" rowspan="" headers="" scope="">NAMA PENUMPANG</th>
							<th colspan="" rowspan="" headers="" scope="">NOMOR KURSI</th>
							<th colspan="" rowspan="" headers="" scope="">NOMOR TIKET</th>
							<th colspan="" rowspan="" headers="" scope="">QR</th>
						</tr>
					</thead>
					@if(($getBooking->status == 'SUCCESS') && !is_null($getBooking->passengerInfos) && (count($getBooking->passengerInfos) > 0))
					@foreach($getBooking->passengerInfos as $k => $value)
					@php
					$codekBook = isset($value->ticketNo) ? $value->ticketNo : $k ;
					$QrCode = \QrCode::format('png')->size(100)->generate($codekBook);

		@endphp
		<tbody>
			<tr>
				<td style="width:150px;height:60px;">
					<center>
						{{ $value->name or '-' }}
					</center>

				</td>
				
				<td style="width:100px;height:60px;">
					<center>
						{{ $value->seatNo or '-' }}
					</center>
				</td>
				<td style="width:100px;height:60px;">
					<center>
						{{ $value->ticketNo or '-' }}
					</center>
				</td>
				<td style="width:100px;height:60px;">
					<center>
						<img src="data:image/png;base64, {!! base64_encode($QrCode) !!}" style="max-width: 220px;">
					</center>
				</td>

			</tr>
		</tbody>
		@endforeach
		@endif
	</table>
</fieldset><br>

<fieldset style="border:none">
	<legend><b>Detail Perjalanan</b></legend>
	<table class="ui table" style="font-size:12px;width: 100%;border-collapse: collapse;border:1px solid black !important;">
		<tbody>
			<tr>
				<td style="width:100px;height:60px;">
					<span><small><b>RINCIAN BIAYA<b></small></span><br>
						<span><small>Tiket Penumpang</small></span>
					</td>
					<td style="width:100px;height:60px;">
						<span><small><b>JUMLAH<b></small></span><br>
							<span><small>{{ $getBooking->totalTicket or '0' }} </small></span><br>
						</td>
						<td style="width:100px;height:60px;">
							<span><small><b>HARGA SATUAN</b></small></span><br>
							<span><small>{{ $price }}</small></span><br>
						</td>
						<td style="width:100px;height:60px;">
							<span><small><b>SUB TOTAL</b></small></span><br>
							<span><small>{{ moneyFormat($getBooking->ticketPrice) }}</small></span>
						</td>
					</tr>
				</tbody>
				<tfoot style="border:1px solid black !important;">
					<tr>
						<td colspan="3" rowspan="" headers=""><b>TOTAL</b></td>
						<td colspan="" rowspan="" headers="">{{ moneyFormat($getBooking->ticketPrice) }}</td>
					</tr>
				</tfoot>
			</table>
			<table width="100%">
				<tr>
					<td colspan="" rowspan="" headers="" style="text-align: right;">
						Print Date : {{\Carbon\Carbon::now()->format('d F Y H:i')}}
					</td>
				</tr>
			</table>
		</fieldset>

	</main>
</body>
@endif
</html>

