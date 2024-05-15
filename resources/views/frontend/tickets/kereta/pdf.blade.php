<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<link rel="icon" href="" sizes="192x192">
	<title>Laporan Transaksi Booking Kereta</title>
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
  	top: 10px;
  	height: 50px;
  	text-align: center;
  	line-height: 35px;
  	margin-right:50px; 
  	margin-left:50px;
  }

  main {
  	position: sticky;
  	font-size : 12px;
  	/*margin-top : 1px;*/
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
			$pdf->page_text(265, 540, "Tebarkan Kesejahteraan dan Kedamaian Bersama AYOKULAKAN", $font, 6, array(0, 0, 0));
		}
	</script>
	<header>
		<table class="ui table" style="width: 100%;">
			<tr>
				
				<td class="center aligned" style="">
					<center style="font-size: 13px"><b><small>Laporan Booking Kerta</small></b></center>
					<center><img src="{{ asset('ayoLogo.png') }}" style="max-width: 110px;"></center>
					<center style="font-size: 13px"><b><small>CV.AYOKULAKAN</small></b></center>
				</td>
			</tr>
			<tr>
				<td colspan="" rowspan="" headers="" style="background-color:black;"></td>
			</tr>
			<tr>
				<td colspan="" rowspan="" headers="" style="background-color:black;height: 2px"></td>
			</tr>
		</table>
	</header>

	<main>
		<fieldset>
			<legend><b>Data Booking Kereta </b></legend>
			<table class="ui table" style="font-size:12px;width: 100%;border-collapse: collapse;">
				<tr>
					<td style="width:150px;">
						<b>TR ID</b>
					</td>
					<td colspan="3" >
						: {{ $record->tr_id or '-' }}
					</td>
				</tr>
				<tr>
					<td style="width:150px;">
						<b>Kode</b>
					</td>
					<td colspan="3" >
						: {{ $record->code or '-' }}
					</td>
				</tr>
				<tr>
					<td style="width:150px;">
						<b>Booking Code</b>
					</td>
					<td colspan="3" >
						: {{ $record->bookingCode or '-' }}
					</td>
				</tr>
				<tr>
					<td style="width:150px;">
						<b>Booking Date</b>
					</td>
					<td colspan="3" >
						: {{ $record->bookingDateTime or '-' }}
					</td>
				</tr>
				<tr>
					<td style="width:150px;">
						<b>Nama Kereta</b>
					</td>
					<td colspan="3" >
						: {{ $record->trainName or '-' }}
					</td>
				</tr>
				<tr>
					<td style="width:150px;">
						<b>Nomor Kereta</b>
					</td>
					<td colspan="3" >
						: {{ $record->trainNumber or '-' }}
					</td>
				</tr>
				<tr>
					<td style="width:150px;">
						<b>Kelas</b>
					</td>
					<td colspan="3" >
						: {{ $record->class or '-' }}
					</td>
				</tr>
				<tr>
					<td style="width:150px;">
						<b>Sub Kelas</b>
					</td>
					<td colspan="3" >
						: {{ $record->subClass or '-' }}
					</td>
				</tr>
				<tr>
					<td style="width:150px;">
						<b>Keberangkatan</b>
					</td>
					<td colspan="3" >
						: {{ $record->org or '-' }}
					</td>
				</tr>
				<tr>
					<td style="width:150px;">
						<b>Tujuan</b>
					</td>
					<td colspan="3" >
						: {{ $record->dest or '-' }}
					</td>
				</tr>
				<tr>
					<td style="width:150px;">
						<b>Waktu Keberangkatan </b>
					</td>
					<td colspan="3" >
						: {{ $record->departDate or '-' }} - {{ $record->departTime or '-' }}
					</td>
				</tr>
				<tr>
					<td style="width:150px;">
						<b>Total Tiket </b>
					</td>
					<td colspan="3" >
						: {{ $record->passenger->count() }}
					</td>
				</tr>
				<tr>
					<td style="width:150px;">
						<b>Total Harga </b>
					</td>
					<td colspan="3" >
						: {{ moneyFormat($record->price) }}
					</td>
				</tr>
				<tr>
					<td style="width:150px;">
						<b>Biaya Admin </b>
					</td>
					<td colspan="3" >
						: {{ ($record->admin) ? moneyFormat((int)$record->admin + 500) : moneyFormat(0) }}
					</td>
				</tr>
				<tr>
					<td style="width:150px;">
						<b>Biaya Admin </b>
					</td>
					<td colspan="3" >
						: {{ $record->message or '' }}
					</td>
				</tr>
				<tr>
					<td style="width:150px;">
						<b>Biaya Admin </b>
					</td>
					<td colspan="3">
						<img src="{{ $capthSche }}" style="max-width: 350px;max-height: 500px;">
					</td>
				</tr>
			</table><br>
		</fieldset>
		<table class="ui table" style="font-size:12px;width: 100%;border-collapse: collapse;border:1px solid black !important;page-break-before: always;">
		@if(!is_null($record->passenger) && (count($record->passenger) > 0))
		@foreach($record->passenger as $k => $value)
			<tbody>
				<tr>
					<td style="width:100px;border:1px solid black !important;">
						<ul>
							<li>- Id : {{ $value->trID or '-' }}</li>
							<li>- Full Name : {{ $value->name or '-' }}</li>
							<li>- Kode Wagon : {{ $value->wagonCode or '-' }}</li>
							<li>- Tempat Duduk : {{ $value->seat or '-' }}</li>
							<li>- Nomer Tiket : {{ $value->ticketNumber or '-' }}</li>
						</ul>
					</td>
				</tr>
			</tbody>
		@endforeach
		@endif
		</table>
	</main>
</body>
</html>
