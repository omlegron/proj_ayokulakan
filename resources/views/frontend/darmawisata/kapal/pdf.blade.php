<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<link rel="icon" href="" sizes="192x192">
	<title>Laporan Booking Kapal</title>
	<style>
		body {
			font-family:  Arial, Helvetica, sans-serif; 
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
  	margin-right:50px; 
  	margin-left:50px;
  }

  main {
  	position: sticky;
  	font-size : 11px;
  	margin-top : 50px;
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
			$font = $fontMetrics->getFont("Arial", "bold");
			$pdf->page_text(425, 835, "Tebarkan Kesejahteraan dan Kedamaian Bersama AYOKULAKAN", $font, 6, array(0, 0, 0));
		}
	</script>
	<header>
		<table class="ui table" style="width: 100%;">

			<tr>
				<td colspan="4" style="">
					<span style="font-size: 14px">Bukti pembayaran tiket pelni <b>dicetak oleh : PT. DARMAWISATA INDONESIA</b></span><br>
					<span style="font-size: 14px;margin-top: -50px;">Bukti ini harus sesuai dengan kartu identitas (KTP, SIM atau Passport)</span>
				</td>
			</tr>
			<tr>
				<td colspan="" rowspan="" headers="" style="width: 100px">
					<img src="data:image/png;base64, {!! base64_encode($QrCode) !!}" style="max-width: 220px;">
				</td>
				<td colspan="" rowspan="" headers="" style="width: 120px">
					Kode Booking : <br>
					{{ $getBooking->bokingNumber or '-' }}
				</td>
				<td colspan="" rowspan="" headers="" style="width: 230px;text-align: right;">
					<img src="{{ asset('pelni2.jpg') }}" style="width: 170px;">
				</td>
				<td colspan="" rowspan="" headers="" style="text-align: right;">
					<img src="{{ asset('ayoLogo.png') }}" style="max-width: 110px;">
				</td>
			</tr>
		</table>
	</header>

	<main>
		<table class="ui table" style="font-size:12px;width: 100%;border-collapse: collapse;">
			<thead>
				<tr>
					<th colspan="2" rowspan="" headers="" style="font-size: 14px;text-align: left">
						<h2>Pemesanan</h2>
					</th>
					<th colspan="2" rowspan="" headers="" style="font-size: 14px;text-align: left">Jadwal Keberangkatan</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td colspan="" rowspan="" headers="">Tanggal Issued</td>
					<td colspan="" rowspan="" headers="">{{ isset($getBooking->issuedDateTime) ? \Carbon\Carbon::parse($getBooking->issuedDateTime)->format('Y-m-d H:i:s') : '-' }}</td>

					<td colspan="" rowspan="" headers="">Kapal</td>
					<td colspan="" rowspan="" headers="">{{ $getBooking->shipNumber }} - {{ $getBooking->shipName or '-' }}</td>
				</tr>
				<tr>
					<td colspan="" rowspan="" headers="">Nama Pemesan</td>
					<td colspan="" rowspan="" headers="">{{ ($getBooking->paxBookingDetails && (count($getBooking->paxBookingDetails) > 0)) ? $getBooking->paxBookingDetails[0]->paxName : '-' }}</td>

					<td colspan="" rowspan="" headers="">Kelas</td>
					<td colspan="" rowspan="" headers="">{{ $record->kelasKapal or '-' }}</td>
				</tr>
				<tr>
					<td colspan="" rowspan="" headers="">Nomor Telepon Pemesan</td>
					<td colspan="" rowspan="" headers="">{{ ($getBooking->paxBookingDetails && (count($getBooking->paxBookingDetails) > 0)) ? $getBooking->paxBookingDetails[0]->phone : '-' }}</td>

					<td colspan="" rowspan="" headers="">Tgl / Jam ETD</td>
					<td colspan="" rowspan="" headers="">{{ isset($getBooking->departDateTime) ? \Carbon\Carbon::parse($getBooking->departDateTime)->format('Y-m-d H:i:s') : '-' }}</td>
				</tr>
				<tr>
					<td colspan="" rowspan="" headers=""></td>
					<td colspan="" rowspan="" headers=""></td>
					<td colspan="" rowspan="" headers="">Tgl / Jam ETA</td>
					<td colspan="" rowspan="" headers="">{{ isset($getBooking->arrivalDateTime) ? \Carbon\Carbon::parse($getBooking->arrivalDateTime)->format('Y-m-d H:i:s') : '-' }}</td>
				</tr>
				<tr>
					<td colspan="" rowspan="" headers=""></td>
					<td colspan="" rowspan="" headers=""></td>
					<td colspan="" rowspan="" headers="">Embarkasi</td>
					<td colspan="" rowspan="" headers="">{{ ($origin) ? $origin->originName : '-' }} - {{ $getBooking->originCall or '-' }}</td>
				</tr>
				<tr>
					<td colspan="" rowspan="" headers=""></td>
					<td colspan="" rowspan="" headers=""></td>
					<td colspan="" rowspan="" headers="">Debarkasi</td>
					<td colspan="" rowspan="" headers="">{{ ($deperature) ? $deperature->originName : '-' }} - {{ $getBooking->destinationCall or '-' }}</td>
				</tr>
			</tbody>	
		</table><br>	

		<table class="ui table" style="font-size:12px;width: 100%;border-collapse: collapse;border:1px solid black !important;">
			<thead>
				<tr>
					<th colspan="" rowspan="" headers="" scope="" style="border:1px solid black !important;">Pax</th>
					<th colspan="" rowspan="" headers="" scope="" style="border:1px solid black !important;">Nama</th>
					<th colspan="" rowspan="" headers="" scope="" style="border:1px solid black !important;">Nomor ID</th>
					<th colspan="" rowspan="" headers="" scope="" style="border:1px solid black !important;">Jenis Kelamin</th>
					<th colspan="" rowspan="" headers="" scope="" style="border:1px solid black !important;">Kategori</th>
					<th colspan="" rowspan="" headers="" scope="" style="border:1px solid black !important;">Usia</th>
					<th colspan="" rowspan="" headers="" scope="" style="border:1px solid black !important;">Deck</th>
					<th colspan="" rowspan="" headers="" scope="" style="border:1px solid black !important;">Nomor Kabin</th>
					<th colspan="" rowspan="" headers="" scope="" style="border:1px solid black !important;">Harga Tiket</th>
					<th colspan="" rowspan="" headers="" scope="" style="border:1px solid black !important;">Biaya Admin</th>
					<th colspan="" rowspan="" headers="" scope="" style="border:1px solid black !important;">Total Harga</th>
				</tr>
			</thead>
			@php
				$total = 0;
			@endphp
			@if($getBooking->paxBookingDetails)
				@if(count($getBooking->paxBookingDetails) > 0)
					@foreach($getBooking->paxBookingDetails as $k => $value)
					@php
						$hitung = $value->fare+$getBooking->shipMarkup;
						$total += $hitung;
					@endphp
						<tbody>
							<tr>
								<td colspan="" rowspan="" style="border:1px solid black !important;text-align: center;">
									{{ $k+1 }}
								</td>
								<td colspan="" rowspan="" style="border:1px solid black !important;text-align: center;">
									{{ $value->paxName or '' }}
								</td>
								<td colspan="" rowspan="" style="border:1px solid black !important;text-align: center;">
									{{ $value->ID or '-' }}
								</td>
								<td colspan="" rowspan="" style="border:1px solid black !important;text-align: center;">
									{{ ($value->paxGender == 'M') ? 'Male' : 'Female' }}
								</td>
								<td colspan="" rowspan="" style="border:1px solid black !important;text-align: center;">
									{{ $value->paxType or '' }}
								</td>
								<td colspan="" rowspan="" style="border:1px solid black !important;text-align: center;">
									{{ isset($value->birthDate) ? \Carbon\Carbon::parse($value->birthDate)->age : '-' }}
								</td>
								<td colspan="" rowspan="" style="border:1px solid black !important;text-align: center;">
									{{ $value->deck or '' }}
								</td>
								<td colspan="" rowspan="" style="border:1px solid black !important;text-align: center;">
									{{ $value->cabin or '' }}
								</td>
								<td colspan="" rowspan="" style="border:1px solid black !important;text-align: center;">
									{{ moneyFormat($value->fare) }}
								</td>
								<td colspan="" rowspan="" style="border:1px solid black !important;text-align: center;">
									{{ moneyFormat($getBooking->shipMarkup) }}
								</td>
								<td colspan="" rowspan="" style="border:1px solid black !important;text-align: center;">
									{{ moneyFormat($value->fare+$getBooking->shipMarkup) }}
								</td>
							</tr>
						</tbody>
					@endforeach
				@endif
			@endif
			<tfoot>
				<tr>
					<td colspan="10" rowspan="" style="border:1px solid black !important;"><b>TOTAL</b></td>
					<td colspan="" rowspan="" style="border:1px solid black !important;text-align: center;">{{ moneyFormat($total) }}</td>
				</tr>
			</tfoot>
		</table><br>
		<table class="ui table" style="font-size:12px;width: 100%;border-collapse: collapse;">
			<thead>
				<tr>
					<th colspan="" rowspan="" headers="" scope="" style="text-align: left;">SYARAT dan KETENTUAN</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td colspan="" rowspan="" headers="">
						<ol>
							<li>
								Bukti pembayaran ini <b>tidak berlaku sebagai tiket untuk naik ke atas kapal, wajib ditukar menjadi tiket</b> selambat-lambatnya 3 (tiga) jam sebelum keberangkatan kapal di cabang PT. PELNI (Persero)..
							</li>
							<li>
								Kode booking yang tertera pada bukti pembayaran adalah bersifat rahasia, PT. PELNI tidak bertanggung jawab apabila terjadi penyalahgunaan kode booking yang digunakan pihak lain.
							</li>
							<li>
								PT. PELNI tidak bertanggung jawab atas kerugian yang ditimbulkan akibat pembatalan/keterlambatan calon penumpang.
							</li>
							<li>
								Pembatalan tiket atas kehendak penumpang dapat dilakukan selambat-lambatnya 2 (dua) jam sebelum keberangkatan kapal dan penumpang belum melakukan boarding di terminal.
							</li>
							<li>								
								Bagi penumpang yang sedang hamil lebih dari 7 (tujuh) bulan tidak diizinkan untuk berlayar.
							</li>
							<li>
								Penumpang dilarang berjudi, mengkonsumsi minuman keras, berdagang diatas kapal, dan membawa barang-barang terlarang selama pelayaran.
							</li>
							<li>
								Barang-barang terlarang yang dimaksud adalah sebagai berikut:
								<ul style="list-style-type: lower-alpha;">
									<li>
										Petasan, bahan peledak, senjata tajam, senjata api dan senjata lainnya
									</li>
									<li>
										Barang-barang berbau	
									</li>
									<li>
										Barang-barang yang berbahaya
									</li>
									<li>
										Barang-barang yang mengotori
									</li>
									<li>
										Hewan dan Tumbuhan
									</li>
									<li>
										Narkoba
									</li>
									<li>
										Barang-barang yang dilarang sesuai dengan perundang-undangan yang berlaku
									</li>
								</ul>
							</li>
							<li>
								Setiap penumpang dapat membawa barang bagasi cuma-cuma maksimal 50 (lima puluh) kg dengan dimensi ukuran 30 cm x 30 cm x 30 cm atau setaradengan 0,175 m3.
							</li>
							<li>
								Setiap kelebihan barang bawaan sebagaimana ketentuan diatas maka dikenakan tarif over bagasi sesuai dengan syarat dan ketentuan yang berlaku.
							</li>
							<li>
								PT. PELNI tidak bertanggung jawab atas hilang/rusaknya tiket dan barang-barang bawaan penumpang.
							</li>
							<li>
								Penumpang diharapkan untuk mengikuti perubahan waktu keberangkatan kapal yang mungkin terjadi dan selambat-lambatnya 2 (dua) jam sebelum keberangkatan kapal sudah berada di terminal penumpang.
							</li>
							<li>
								Informasi syarat dan ketentuan yang berlaku dapat diperoleh di Kantor Cabang <b>PT. PELNI</b>atau website <b>www.pelni.co.id</b> atau call center PT.PELNI <b>162/021-162</b>.
							</li>
						</ol>
					</td>
				</tr>
			</tbody>
		</table>
	</main>
</body>
</html>
