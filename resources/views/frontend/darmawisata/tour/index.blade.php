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

<form id="dataForm" action="{{ url('tour/booking') }}" method="POST">
    {!! csrf_field() !!}
    <div class="container outer-top">
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-6">
                                <div class="form-group">
                                  <label>Pilih Type</label>
                                  <select name="TourType" class="form-control " required="" data-live-search="true" data-dropup-auto="false" data-size="10" >
                                    {!! App\Models\Master\DarmaTourType::options('Type', 'Type', [], 'Pilih Salah Satu') !!}
                                  </select> 
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                              <label>Pilih Kategori</label>
                              <select name="Category" class="form-control" required="" data-live-search="true" data-dropup-auto="false" data-size="10">
                                    {!! App\Models\Master\DarmaTourCategorie::options('Category', 'Category', [], 'Pilih Salah Satu') !!}
                              </select> 
                            </div>
                        </div>

                        <!-- <div class="col-md-6">
                            <div class="form-group">
                              <label>Pilih Tujuan Daerah</label>
                              <select name="Province" class="form-control" required="" data-live-search="true" data-dropup-auto="false" data-size="10">
                                    {!! App\Models\Master\WilayahProvinsi::options('provinsi', 'provinsi', [], 'Pilih Salah Satu') !!}
                              </select> 
                            </div>
                        </div> -->

                        <div class="col-md-6">
                            <div class="form-group">
                              <label>Ketik Pencarian</label>
                              <input type="text" name="Keyword" class="form-control" placeholder="Pencarian" >   
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                              <label>Minimum Harga</label>
                              <input type="text" name="MinPrice" class="form-control"  placeholder="Minimum Harga"  oninput="this.value= this.value.replace(/[^0-9.,]/g, '').replace(/(\..*)\.,/g, '$1')">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                              <label>Maximum Harga</label>
                              <input type="text" name="MaxPrice" class="form-control"  placeholder="Maximum Harga"  oninput="this.value= this.value.replace(/[^0-9.,]/g, '').replace(/(\..*)\.,/g, '$1')">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                              <label>Durasi Perjalanan</label>
                              <input type="text" name="Duration" class="form-control"  placeholder="Durasi Perjalanan"  oninput="this.value= this.value.replace(/[^0-9.,]/g, '').replace(/(\..*)\.,/g, '$1')">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                              <label>Jumlah Orang</label>
                              <input type="text" name="MinimumPax" class="form-control"  placeholder="Jumlah Orang"  oninput="this.value= this.value.replace(/[^0-9.,]/g, '').replace(/(\..*)\.,/g, '$1')">
                            </div>
                        </div>

                        <div class="col-md-12">
                          <button type="button" class="pull-right btn btn-success search" data-form="dataForm" data-append="formAppend"><i class="ion-android-refresh"></i> Lihat Tour</button>
                        </div>
                    
                    </div>   
                </div>

            </div>
            <div class="formAppend" style="max-height: 600px;overflow-y: visible;overflow-x: hidden;">
              
            </div>
        </div>
    </div>
</form>
@endsection

@section('js')

<script>
  $(document).on('click','.search',function(){
    $('#dataForm').append(`
      <div class="loadings" >Loading&#8230;</div>
    `);
    if($('#dataForm').form('is valid')){
      $('#dataForm').ajaxSubmit({
        url:"{{ url('tour/search') }}",
        // data:$('#dataForm').serialize(),
        method:"GET",
        success: function(resp){
          $('.loadings').hide();
          $('.formAppend').html(resp);
        },error: function(resp){
          $('.loadings').hide();
          if(resp.responseJSON.check){
            swal(
              ''+resp.responseJSON.messTitle,
              ''+resp.responseJSON.messSub,
              'warning'
            );
          }else{
            swal(
              'Lengkapi Data Anda',
              showBoxValidation(resp),
              'warning'
            );
          }

          showFormErrorDarma(resp,'#dataForm');
        }
      });
    }
  });
</script>
@endsection
