@extends('layouts.scaffold')

@section('styles')
<style>

</style>
@endsection

@section('scripts')

@endsection

@section('content-frontend')
<main class="outer-top"></main>
<div class="container outline-top">
  <div class="row">
    @if (!$record || !isset($record['schedule']))
    <div class="panel panel-default" style="padding: 20px; overflow: hidden;">
      <div class="text-center">
        <b>Upss... Maaf untuk saat ini jadwal tidak tersedia!</b>
        <br>
        Silahkan ulangi pencarian
      </div>
    </div>
    @else
    <form action="{{ url('check-ticket/check-kursi') }}" method="POST">
      {!! csrf_field() !!}
      <div>
        <div class="col-md-1">
          <input type="hidden" name="org" value="{{ $request['rute_asal'] }}">
          <input type="hidden" name="dewasa" value="{{ $request['dewasa'] }}">
          <input type="hidden" name="anak" value="{{ $request['anak'] }}">
          <input type="hidden" name="org" value="{{ $request['rute_asal'] }}">
          <input type="hidden" name="dest" value="{{ $request['rute_tujuan'] }}">
          <input type="hidden" name="date" value="{{ $request['tanggal_berangkat'] }}">
          <input type="hidden" name="tanggal_kepulangan" value="{{ $request['tanggal_kepulangan'] or '-' }}">
          <input type="hidden" name="pulang_pergi" value="{{ $request['pulang_pergi'] or '-' }}">
        </div>
        <div class="checkout-box ">
          <div class="row single-product">
            <div class="detail-block" style="overflow: unset;">
              <h3 class="section-title">Isi Data Penumpang</h3>

              <div class="tab-content">
                <div class="row">
                  <div class="col-md-12">
                    @if($request['dewasa'] > 0)
                    @for($i=0;$i<$request['dewasa'];$i++)
                    <div class="card">
                      <div class="card-header">
                        Penumpang Dewasa (17 tahun ke atas)
                      </div>
                      <div class="card-body">
                        <div class="row">
                          <div class="col-md-4">
                            <div class="form-group">
                              <label>Title</label>
                              <select name="berangkat[passenger][adult][{{ $i+1 }}][title]" class="form-control selectpicker" required="" data-dropup-auto="false" data-size="10">
                                <option value="">Title</option>
                                <option value="Tuan">Tuan</option>
                                <option value="Nyonya">Nyonya</option>
                                <option value="Nona">Nona</option>
                              </select>
                            </div>
                          </div>
                          <div class="col-md-8">
                            <div class="form-group">
                              <label>Nama Penumpang</label>
                              <input type="text" name="berangkat[passenger][adult][{{ $i+1 }}][name]" class="form-control" placeholder="Nama Sesuai KTP" required="">
                            </div>
                          </div>
                          <div class="col-md-4">
                            <div class="form-group">
                              <label>Tanda Pengenal</label>
                              <select name="berangkat[passenger][adult][{{ $i+1 }}][tanda_pengenal]" class="form-control selectpicker" required="" data-dropup-auto="false" data-size="10">
                                <option value="">Tanda Pengenal</option>
                                <option value="KTP">KTP</option>
                                <option value="Passpor">Passpor</option>
                                <option value="SIM">SIM</option>
                                <option value="Lainnya">Lainnya</option>
                              </select>
                            </div>
                          </div>
                          <div class="col-md-8">
                            <div class="form-group">
                              <label>No. Tanda Pengenal</label>
                              <input type="text" name="berangkat[passenger][adult][{{ $i+1 }}][id]" class="form-control" placeholder="Umur dibawah 18 (isi:akta lahir / kartu pelajar)" required="">
                            </div>
                          </div>
                          <div class="col-md-4">
                            <div class="form-group">
                              <label>Tanggal Lahir</label>
                              <input type="text" name="berangkat[passenger][adult][{{ $i+1 }}][dob]" class="bots-date form-control" placeholder="Tanggal Lahir" required="">
                            </div>
                          </div>
                          <div class="col-md-8">
                            <div class="form-group">
                              <label>No Hp</label>
                              <input type="text" name="berangkat[passenger][adult][{{ $i+1 }}][phone]" class="form-control" placeholder="No Hp" required="">
                            </div>
                          </div>
                        </div>
                      </div>
                    </div><br>
                    @endfor
                    @endif

                    @if($request['anak'] > 0)
                    @for($i=0;$i<$request['anak'];$i++)
                    <div class="card">
                      <div class="card-header">
                        Penumpang Bayi (Di Bawah 3 tahun)
                      </div>
                      <div class="card-body">
                        <div class="row">
                          <div class="col-md-4">
                            <div class="form-group">
                              <label>Title</label>
                              <select name="berangkat[passenger][infant][{{ $i+1 }}][title]" class="form-control selectpicker" required="" data-dropup-auto="false" data-size="10">
                                <option value="">Title</option>
                                <option value="Tuan">Tuan</option>
                                <option value="Nona">Nona</option>
                              </select>
                            </div>
                          </div>
                          <div class="col-md-8">
                            <div class="form-group">
                              <label>Nama Penumpang</label>
                              <input type="text" name="berangkat[passenger][infant][{{ $i+1 }}][name]" class="form-control" placeholder="Nama Penumpang" required="">
                            </div>
                          </div>
                          <div class="col-md-4">
                            <div class="form-group">
                              <label>Tanggal Lahir</label>
                              <input type="text" name="berangkat[passenger][infant][{{ $i+1 }}][dob]" class="bots-date form-control" placeholder="Tanggal Lahir" required="">
                            </div>
                          </div>
                        </div>
                      </div>
                    </div><br>
                    @endfor
                    @endif
                  </div>
                </div>
              </div>

            </div>
          </div>
        </div>

        <div class="checkout-box ">
          <div class="row single-product">
            <div class="detail-block">
              <h3 class="section-title">Pesan Kereta</h3>

              <div class="tab-content">
                <div class="panel panel-default" style="height: 40px">
                  <div class="col-md-3 text-center">
                    <b>Nama</b>
                  </div>

                  <div class="col-md-3 text-center">
                    <b>Waktu Keberangkatan</b>
                  </div>

                  <div class="col-md-3 text-center">
                    <b>Harga</b>
                  </div>

                  <div class="col-md-3 text-center">
                    <b>Pilih</b>
                  </div>
                </div>
                <div role="tabpanel" id="depart" class="tab-pane fade in active">
                  @if(isset($record['schedule']) && (count($record['schedule']) > 0))
                  @foreach($record['schedule'] as $k => $value)
                  @php
                  $start = Carbon\Carbon::parse($value->departTime);
                  $end = Carbon\Carbon::parse($value->arriveTime);
                  $final = $start->diff($end)->format('%hj %Im');
                  @endphp
                  <div class="panel panel-default" style="padding: 20px; overflow: hidden;">
                    <div class="col-md-3 text-center">
                      <b>
                        {{ $value->class or '' }} ({{ $value->subClass or '' }}) - {{ $value->trainName or '' }}
                      </b>
                    </div>

                    <div class="col-md-3 text-center">
                      <b>{{ $value->departTime or '' }} - {{ $value->arriveTime or '' }} ({{ $final or '' }})</b>
                    </div>

                    <div class="col-md-3 text-center">
                      {{ moneyFormat($value->nominal) }}
                    </div>

                    <div class="col-md-3 text-center">
                      <center>
                        <div class="input-group mb-3">
                          <div class="form-group ">
                            <div class="input-group">
                              <div class="input-group-addon">
                                @if(($value->availability > 0) || ($value->availability == 'tersedia'))
                                <input type="radio" class="custom-control-input" id="customControlValidation{{$k}}" name="berangkat[trainNo]" value="{{ $value->fareId or '' }}" data-subclassbr="{{ $value->subClass or '' }}" data-class="{{ $value->class or '' }}" required style="transform: scale(1.4);">
                                <label><i> Pesan Sekarang</i></label>
                                @else
                                <label><i> Tidak Tersedia</i></label>
                                @endif
                              </div>
                            </div>
                          </div>
                        </div>
                      </center>
                    </div>
                  </div>
                  @endforeach
                  @endif
                </div>
              </div>
              <div class="col-md-12">
                <button type="submit" class="pull-right btn btn-success"><i class="ion-android-refresh"></i> Cek Keberangkatan</button>
              </div>
            </div>
          </div>
        </div>
      </div>

    </form>
    @endif
  </div>
</div>
@endsection

