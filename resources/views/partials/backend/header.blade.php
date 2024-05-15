<header class="header-style-1" style="background-color: #fff200;border-top: 1px solid rgba(255, 174, 0, 0.754);border-bottom: 1px solid rgba(255, 174, 0, 0.754);">
	@if(\Auth::check())
	<div class="top-bar animate-dropdown">
		<div class="container">
			<div class="header-top-inner">
				<div class="cnt-block" style="float: none;">
					<center>
						<ul class="list-unstyled list-inline">
							<li class="dropdown dropdown-small" style="margin-left: 1px">
								<a href="{{ url('hotel/booking-list') }}" class="" >
									<i class="fa fa-building" style="color: #ff823e;text-shadow:0px 1px black;"></i>
									<span class="value" style="text-decoration: none; color: #ff823e;text-shadow:0px 1px black;">Booking Hotel </span>
								</a>
							</li>
							<li class="dropdown dropdown-small">
								<a href="{{ url('airlinee/booking') }}" class="" >
									<i class="fa fa-paper-plane" style="color: #ff823e;text-shadow:0px 1px black;"></i>
									<span class="value" style="text-decoration: none; color: #ff823e;text-shadow:0px 1px black;">Booking Pesawat </span>
								</a>
							</li>
							<li class="dropdown dropdown-small">
								<a href="{{ url('travel/list') }}" class="" >
									<i class="fa fa-car" style="color: #ff823e;text-shadow:0px 1px black;"></i>
									<span class="value" style="text-decoration: none; color: #ff823e;text-shadow:0px 1px black;">Booking Travel </span>
								</a>
							</li>


							<li class="dropdown dropdown-small">
								<a href="{{ url('check-ticket/list') }}" class="" >
									<i class="fa fa-star" style="color: #ff823e;text-shadow:0px 1px black;"></i>
									<span class="value" style="text-decoration: none; color: #ff823e;text-shadow:0px 1px black;">Booking Kereta </span>
								</a>
							</li>
							<li class="dropdown dropdown-small" id="cart">
								<a href="{{ url('keranjang') }}" class="show-front show" data-url="{{ url('keranjang/show') }}" >
									<i class="glyphicon glyphicon-shopping-cart" style="color: #ff823e;text-shadow:0px 1px black;"></i>
									<span class="value" style="text-decoration: none; color: #ff823e;text-shadow:0px 1px black;">Keranjang Barang </span>
								</a>
								<ul class="dropdown-menu" id="listorder" style="width: 300px">
								</ul>
							</li>
							<li class="dropdown dropdown-small">
								<a href="javascript:void(0)" class=" show-front shows" data-url="{{ url('favorit/-') }}" >
									<i class="fa fa-heart" style="color: #ff823e;text-shadow:0px 1px black;"></i>
									<span class="value" style="text-decoration: none; color: #ff823e;text-shadow:0px 1px black;">List Favorit </span>
								</a>
							</li>
						</ul>
					</center>

					<center>
						<ul class="list-unstyled list-inline">
							<li class="dropdown dropdown-small">
								<a href="{{ url('bus/list') }}" class="" >
									<i class="icon fa fa-car" style="color: #ff823e;text-shadow:0px 1px black;"></i>
									<span class="value" style="text-decoration: none; color: #ff823e;text-shadow:0px 1px black;">Booking Bus </span>
								</a>
							</li>
							<li class="dropdown dropdown-small">
								<a href="{{ url('tour/list') }}" class="" >
									<i class="icon fa fa-briefcase" style="color: #ff823e;text-shadow:0px 1px black;"></i>
									<span class="value" style="text-decoration: none; color: #ff823e;text-shadow:0px 1px black;">Booking Tour </span>
								</a>
							</li>
							<li class="dropdown dropdown-small">
								<a href="{{ url('kapal/booking-list') }}" class="" >
									<i class="fa fa-ship" style="color: #ff823e;text-shadow:0px 1px black;"></i>
									<span class="value" style="text-decoration: none; color: #ff823e;text-shadow:0px 1px black;">Booking Pelni </span>
								</a>
							</li>
							<li class="dropdown dropdown-small">
								<a href="javascript:void(0)" class=" show-front shows" data-url="{{ url('keranjang-sewa/show') }}" >
									<i class="glyphicon glyphicon-flash" style="color: #ff823e;text-shadow:0px 1px black;"></i>
									<span class="value" style="text-decoration: none; color: #ff823e;text-shadow:0px 1px black;">Keranjang Sewa </span>
								</a>
							</li>

							<li class="dropdown dropdown-small">
								<a href="javascript:void(0)" class="lnk-cart show-front shows" data-url="{{ url('mess-not/show-all') }}">
									<i class="icon fa fa-bell" style="color: #ff823e;text-shadow:0px 1px black;"></i>
									<span class="value" style="text-decoration: none; color: #ff823e;text-shadow:0px 1px black;">{{ count($notifFeedback) }} Notification</span>
								</a>
							</li>

							<li class="dropdown dropdown-small" id="pesan">
								<a href="{{ url('chat') }}" class="show-front pesan">
									<i class="icon fa fa-comment" style="color: #ff823e;text-shadow:0px 1px black;"></i>
										<span class="value" id="notifchat" style="text-decoration: none; color: #ff823e;text-shadow:0px 1px black;">
											Pesan
										</span>
								</a>
								<ul class="dropdown-menu">
									<li style="padding: 5px; font-size: 15px;">
										<a href="{{ url('chat') }}">
											@if (isset($chat))
												Chat <span class="count-chat">{{ $chat }}</span>
											@endif
										</a>
									</li>
									<li style="padding: 5px; font-size: 15px;">
										<a href="{{ url('chat/diskusi') }}">
											@if (isset($diskusi))
												Diskusi <span class="count-chat">{{ $diskusi }}</span>
											@endif
										</a>
									</li>
									<li style="padding: 5px; font-size: 15px;"><a href="{{ url('chat/ulasan') }}">Ulasan</a></li>
									<li style="padding: 5px; font-size: 15px;"><a href="">Pesan Bantuan</a></li>
									<li style="padding: 5px; font-size: 15px;"><a href="">Pesan Dikomplain</a></li>
								</ul>
							</li>
							<li id="my-account">
								<a href="javascript:void(0)" class="drop-akun"><span class="value" style="text-decoration: none; color: #ff823e;text-shadow:0px 1px black;">My Account <i class="fa fa-angle-down"></i></span></a>
								<div class="drodown-header" style="display: none">
									<ul class="list-unstyled">
										<li class="dropdown-body">
											<a href="javascript:void(0)" class="dropdown-text">Profile <i class="fa fa-angle-down"></i></a>
											<ul class="bg-secondary events" id="header-profile">
												<li class="list-unstyled"><a href="{{ url('/myprofile') }}">Profil</a></li>
												<li class="list-unstyled"><a href="{{ url('profile-bank') }}">Bank & Kartu</a></li>
												<li class="list-unstyled"><a href="{{ url('ganti-pass') }}">Ganti Password</a></li>
												<li class="list-unstyled"><a href="{{ url('/logout') }}">Logout</a></li>
											</ul>
										</li>
									</ul>
									<ul class="list-unstyled">
										<li class="dropdown-body">
											<a href="javascript:void(0)" class="dropdown-text">Pesanan <i class="fa fa-angle-down"></i></a>
											<ul class="bg-secondary events" id="header-pesanan">
												<li class=""><a href="{{ url('/pesanan') }}">Semua</a></li>
												<li class=""><a href="{{ url('/pesanan/pending') }}">Pesanan belum dibayar</a></li>
												<li class=""><a href="{{ url('/pesanan/packing') }}">Pesanan dikemas</a></li>
												<li class=""><a href="{{ url('/pesanan/set-tracking') }}">Atur pengiriman</a></li>
												<li class=""><a href="{{ url('/pesanan/tracking') }}">Pesanan dalam pengiriman</a></li>
												<li class=""><a href="{{ url('/pesanan/success') }}">Pesanan diterima</a></li>
												<li class=""><a href="{{ url('/pesanan/cancel') }}">Pesanan dibatalkan</a></li>
												<li class=""><a href="{{ url('/pesanan/pengembalian-barang') }}">Pengembalian barang/dana</a></li>
											</ul>
										</li>
									</ul>
									<ul class="list-unstyled">
										<li class="dropdown-body"><a href="" class="dropdown-text">Data history order & transaksi</a></li>
									</ul>
									<ul class="list-unstyled">
										<li class="dropdown-body"><a href="" class="dropdown-text">Notifikasi</a></li>
									</ul>
									<ul class="list-unstyled">
										<li class="dropdown-body"><a href="" class="dropdown-text">Voucher</a></li>
									</ul>
									@if (Auth::check())
										@if (isset($mainMenu))
											<ul class="list-unstyled">
												<li class="dropdown-body">
													<a href="#pengaturan" class="dropdown-text">Pengaturan <i class="fa fa-angle-down"></i></a>
													<ul class="events" id="pengaturan">
														@foreach ($mainMenu->roots() as $k => $item)
															@if (!$item->hasChildren())
																<li class="colapse-item">
																	<a href="{!! $item->url() !!}" class="">{{ $item->title }}</a>
																</li>
																@else
																<li class="colapse-item">
																	@php
																		$id = str_replace([' ','&'],['',''],$item->title)
																	@endphp
																	<a href="#{{ $id }}" class="dropdown-text" data-toggle="collapse" aria-expanded="false">{!! $item->title !!} <i class="fa fa-angle-down"></i></a>
																	<ul class="collapse list-untyled" id="{{ $id }}">
																		@foreach ($item->children() as $key => $value)
																			<li class="colapse-item"><a href="{!! $value->url() !!}">{!! $value->title !!}</a></li>
																		@endforeach
																	</ul>
																</li>
															@endif
														@endforeach
													</ul>
												</li>
											</ul>
										@endif
									@endif
								</div>
							</li>
							</ul>
						</center>
					</div>
					<div class="clearfix"></div>
				</div>
			</div>
		</div>
		@endif

		<div class="main-header" style="padding-bottom: 5px">
			<div class="container">
				<div class="row">
					@if(!\Auth::check())
					<div class="col-xs-12 col-sm-1 col-md-1">

					</div>
					<div class="col-xs-12 col-sm-2 col-md-2 logo-holder">
						<div class="row">
							<div class="col-xs-12 col-sm-12 col-md-12" style="">
								<div class="dropdown dropdown-cart">
									<a href="{{ url('/') }}">
										<img src="{{ asset('Untitled-1.png') }}" alt="" style="max-width: 180px">
									</a>
									<a id="covid" style="display: block; color: #67db14;" href="https://kawalcovid19.id/">
										<span> Informasi Covid-19 Disini </span>
									</a>
								</div>
							</div>
						</div>
					</div>
					<div class="col-xs-12 col-sm-12 col-md-6 top-search-holder">
						<div class="search-area" style="margin-right: 17px;margin-left: 15px;">
							<form action="{{ url('sc/barang') }}">
								<div class="control-group">

									<ul class="categories-filter animate-dropdown btn-kat" id="btn-kat">
										<li class="dropdown " style="background-color: #ec971f;border-color: #d58512;height: 45px">
											<a class="dropdown-toggle btn-kat" id="btn-kat" data-toggle="dropdown" href="javascript:void(0)">Kategori </a>
										</li>
									</ul>
									<input type="text" name="search_ampas" class="search-field" placeholder="Cari Produk..." style="">
									<button type="submit" class="search-button"></button>
								</div>
							</form>
						</div>
					</div>
					<div class="col-xs-12 col-sm-12 col-md-2 animate-dropdown top-cart-row">
						<div class="dropdown dropdown-cart">
							<center>
								<a href="{{ url('login') }}" class="btn btn-warning" style="width: 87px;height: 45px;font-variant-position: sub;font-size: 17px;margin-bottom: 10px">Login</a>
								<a href="{{ url('register') }}" class="btn btn-success" style="width: 87px;height: 45px;font-variant-position: sub;font-size: 17px;margin-bottom: 10px">Daftar</a>
							</center>
						</div>
					</div>
					@else
					<div class="col-md-12">
						<div class="col-xs-12 col-sm-2 col-md-2 top-search-holder ">

						</div>
						<div class="col-xs-12 col-sm-8 col-md-8 top-search-holder ">
							<div class="col-md-3 logo-holder">
								<div class="dropdown dropdown-cart">


									<a href="{{ url('/') }}">
										<img src="{{ asset('Untitled-1.png') }}" alt="" style="max-width: 180px">
									</a>
									<a id="covid" style="display: block; color: #67db14;" href="https://kawalcovid19.id/">
										<span> Informasi Covid-19 Disini </span>
									</a>
								</div>
							</div>
							<div class="col-md-9">
								@if (isset($rental))
								<div class="search-area" style="margin-left: 17px;margin-right: 15px;">
									<form action="{{ route('search-rental') }}">
										<div class="control-group">

											<ul class="categories-filter animate-dropdown btn-kat" id="btn-kat">
												<li class="dropdown " style="background-color: #ec971f;border-color: #d58512;height: 45px">
													<a class="dropdown-toggle btn-kat" id="btn-kat" data-toggle="dropdown" href="javascript:void(0)">Kategori </a>
												</li>
											</ul>

											<input type="text" name="search_rental" class="search-field" placeholder="Cari Produk Sewa" style="">
											<button type="submit" class="search-button"></button>
										</div>
									</form>
								</div>
								@else
								<div class="search-area" style="margin-right: 17px;margin-left: 15px;">
									<form action="{{ url('sc/barang') }}">
										<div class="control-group">

											<ul class="categories-filter animate-dropdown btn-kat" id="btn-kat">
												<li class="dropdown " style="background-color: #ec971f;border-color: #d58512;height: 45px">
													<a class="dropdown-toggle btn-kat" id="btn-kat" data-toggle="dropdown" href="javascript:void(0)">Kategori </a>
												</li>
											</ul>
											<input type="text" name="search_ampas" class="search-field" placeholder="Cari Produk..." style="">
											<button type="submit" class="search-button"></button>
										</div>
									</form>
								</div>
								@endif
							</div>
						</div>

					</div>
					@endif
				</div>

			</div>

		</div>

		
		<div class="yamm-content" id="icon-kat" style="background: #ffffff; display: none !important">
			<div class="container">
				<div class="row">
					<div style="display: flex">
						<h2 style="width: 80%">Kategori Barang</h2>
						<a href="" style="width: 20%; line-height: 63px; text-align: end;" id="close"><span class="glyphicon glyphicon-remove"></span></a>
					</div>
					<div class="col-sm-6 col-md-4 kat-barang" style="max-height:350px; overflow-y: scroll;">
						@if($kategoriBarang->count() > 0)
						@foreach($kategoriBarang->get() as $key => $val)
						<ul class="list-unstyled components border my-3" id="lapaks-barang" style=" width:100%">
							<li class="bg-dark text-white" id="kategori" style="padding: 10px 0px;">
								<a href="{{ url('sc/cat-barang/amps/'.slugify($val->kat_nama)) }}" id="links" data-url="{{ $val->id }}" class="h5" style="display: flex; width:100%;">
									<img src="{{ ($val->attachments) ? asset('storage/'.$val->attachments->url) : asset('img/no-images.png') }}" alt="" class="card-img-top" style="width:50px">
									<p style="line-height: 50px; padding-left: 10px">{{ $val->kat_nama }}</p>
									<span class="fa fa-angle-right" style="line-height: 50px; font-size:14px; margin-left:auto; margin-right:10px"></span>
								</a>
							</li>
						</ul>
						@endforeach
						@endif
					</div>
					<div class="col-sm-6 col-md-8 kat-barang" id="finds-kategori" style="max-height:350px; overflow-y: scroll;">

					</div>
					{{-- @if($kategoriBarang->count() > 0)
						@foreach($kategoriBarang->get() as $key => $val)
						<div class="col-6 col-xs-6 col-md-3 mb-3" id="togles-kategori">
							<div class="card">
								<div class="card-body text-center">
									<div class="card-text">
										<a href="{{ url('sc/cat-barang/amps/'.slugify($val->kat_nama)) }}"
											style="padding: 8px 0px">
											<img src="{{ ($val->attachments) ? url('storage/'.$val->attachments->url) : asset('img/no-images.png') }}" alt="" class="card-img-top" style="width:50px">
											<p class="title" style="font-size: 11px">{{ $val->kat_nama or '' }}</p>
										</a>
									</div>
								</div>
							</div>
						</div>
						@endforeach
						@endif --}}
					</div>
				</div>
			</div>
		</header>
