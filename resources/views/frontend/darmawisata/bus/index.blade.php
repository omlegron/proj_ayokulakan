@extends('layouts.scaffold')

@section('css')
<style>
    /*.outline-top {
        margin-top: 20px;
    }

    @media (max-width: 500px) {
        .outline-top {
            margin-top: 299px;
        }
    }*/
</style>
@endsection

@section('content-frontend')

<form id="dataFormPage" action="{{ url('bus/seat') }}" method="GET">
    <div class="container outer-top">
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="row">
                        
                        <div class="col-md-6">
                                <div class="form-group">
                                  <label>Pilih Bus</label>
                                  <select name="bus" class="form-control selectpicker " required="" data-live-search="true" data-dropup-auto="false" data-size="10" >
                                    {!! App\Models\Master\DarmaBusList::options('name', 'name', [], 'Pilih Salah Satu') !!}
                                  </select> 
                            </div>
                        </div>


                        <div class="col-md-6">
                            <div class="form-group">
                              <label>Tanggal Keberangkatan</label>
                              <input type="text" name="departDate" class="form-control start-date" placeholder="Tanggal Keberangkatan" readonly="">   
                            </div>
                        </div>

                       
                        <div class="col-md-6">
                            <div class="form-group">
                              <label>Jumlah Penumpang Dewasa</label>
                              <small>*Minimum Penumpang = 1, Maximum Penumpang = 5</small>
                              <input type="number" name="paxAdult" class="form-control" placeholder="Jumlah Penumpang Dewasa" min="1" max="5" oninput="this.value= this.value.replace(/[^0-9.,]/g, '').replace(/(\..*)\.,/g, '$1')">   
                            </div>
                        </div>


                        <div class="col-md-6">
                            <div class="form-group">
                              <label>Jumlah Penumpang Anak</label>
                              <small>*Minimum Penumpang = 1, Maximum Penumpang = 5</small>
                              <input type="number" name="paxChild" class="form-control" placeholder="Jumlah Penumpang Anak" min="1" max="5" oninput="this.value= this.value.replace(/[^0-9.,]/g, '').replace(/(\..*)\.,/g, '$1')">   
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                              <label>Jumlah Penumpang Balita</label>
                              <small>*Minimum Penumpang = 1, Maximum Penumpang = 5</small>
                              <input type="number" name="paxInfant" class="form-control" placeholder="Jumlah Penumpang Balita" min="1" max="5" oninput="this.value= this.value.replace(/[^0-9.,]/g, '').replace(/(\..*)\.,/g, '$1')">   
                            </div>
                        </div>

                        <div class="col-md-12">
                          <!-- <a href="{{ url('/') }}" class="pull-left btn btn-warning "><i class="ion-android-left"></i> Kembali Ke Halaman Utama</a> -->
                          <button type="button" class="pull-right btn btn-success getRoute" data-append="formAppend"><i class="ion-android-refresh"></i> Lihat Rute</button>
                        </div>
                    
                    </div>   
                </div>

            </div>
            <div class="formAppend">
                
            </div>
            <div class="appendSchedule" >
                  
            </div>
        </div>
    </div>
</form>
@endsection

@section('js')

<script>
    $(document).on('click','.getRoute',function(){
      $('.loadings').show();
      $('#dataFormPage').ajaxSubmit({
        url:"{{ url('bus/rute') }}",
        method:"GET",
        success: function(resp){
          $('.loadings').hide();
          $('.formAppend').html(resp);
        },error: function(resp){
          $('.loadings').hide();
          swal(
            'Gagal',
            ''+resp.responseJSON.message,
            'error'
          );
        }
      });
    });

    // get schedule
    $(document).on('change','select[name="originTerminal"]',function(){
      var destination = $(this).find(':selected').data('destination');
      $('input[name="destinationTerminal"]').val(destination);
      $('.loadings').show();
      $('#dataFormPage').ajaxSubmit({
        url:"{{ url('bus/schedule') }}",
        method:"GET",
        success: function(resp){
          $('.loadings').hide();
          $('.appendSchedule').html(resp);
        },error: function(resp){
          $('.loadings').hide();
          if(resp.responseJSON.check){
            swal(
              'Gagal',
              ''+resp.responseJSON.message,
              'error'
            );
          }else{
            swal(
              'Gagal',
              showBoxValidation(resp),
              'error'
            );
          }
          showFormErrorDarma(resp,'dataFormPage');
        }
      });
    });

    $(document).on('click','.subClassFare',function(){
      var checked = $(this).data('checked');
      $('.directCodeClear').attr('checked',false);
      $('.'+checked).attr('checked','checked');
    });

    //
</script>

<script type="text/javascript" src="{{ url('/plugins/datepicker/bootstrap-datepicker.js') }}"></script>

<script type="text/javascript">
months = [ "January", "February", "March", "April", "May", "June",
"July", "August", "September", "October", "November", "December" ];
$.fn.datepicker.dates['id'] = {
    days: ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"],
    daysShort: ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"],
    daysMin: ["Su", "Mo", "Tu", "We", "Th", "Fr", "Sa"],
    months: ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"],
    monthsShort: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
    today: "Today",
    clear: "Clear",
    format: "mm/dd/yyyy",
    titleFormat: "MM yyyy", /* Leverages same syntax as 'format' */
    weekStart: 0
};
$('.bots-month').datepicker({
    autoclose: true,
    minViewMode: 1,
    format: 'MM',
    language:'id'
});
$('.bots-date').datepicker({
    format: 'yyyy-mm-dd',
    todayHighlight: true,
    autoclose: true,
});
var date = new Date();
var today = new Date(date.getFullYear(), date.getMonth(), date.getDate());
var end = new Date(date.getFullYear(), date.getMonth(), date.getDate());

$('.start-date').datepicker({
    format: 'yyyy-mm-dd',
    todayHighlight: true,
    startDate: today,
    autoclose: true,
}).on('changeDate', function (selected) {
    var minDate = new Date(selected.date.valueOf());
    $('.end-date').datepicker('setStartDate', minDate);
});

$('.end-date').datepicker({
    format: 'yyyy-mm-dd',
    todayHighlight: true,
    autoclose: true
}).on('changeDate', function (selected) {
    var maxDate = new Date(selected.date.valueOf());
    $('.start-date').datepicker('setEndDate', maxDate);
});
$('.input-daterange').datepicker({
    format: 'yyyy-mm-dd',
    todayHighlight: true,
    startDate: today,
    autoclose: true,

});
</script>
@endsection
