@extends('layouts.scaffold')

@section('css')
<style>
	.outline-top {
		margin-top: 20px;
	}

	@media (max-width: 500px) {
		.outline-top {
			margin-top: 299px;
		}
	}
</style>
@endsection

@section('content-frontend')

	<div class="container outer-top">
		<div class="row">
			<div class="panel panel-default">
				<div class="panel-body">
					<div class="row">
						<h2>{{ $panduan->judul or 'Panduan' }}</h2>
						<hr>
						<p>
							{!! $panduan->deskripsi or 'Panduan' !!}
						</p>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection

@section('js')

@endsection
