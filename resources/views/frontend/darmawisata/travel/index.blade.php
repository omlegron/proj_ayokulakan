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

<form id="dataForm" action="{{ url('travel/booking') }}" method="POST">
    {!! csrf_field() !!}
    <div class="container outer-top">
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="">List Travel</label>
                          <select name="shuttleID" class="form-control child target selectpicker" required="" data-dropup-auto="false" data-size="10" data-style="none" data-child="showTravelSub" data-namas='directionID'>
                            {!! \App\Models\Master\DarmaTravelList::options('name', 'listID', [], ('Pilih Salah Satu')) !!}
                        </select>         
                        </div>    
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="">Route Travel</label>
                          <select class="form-control child target changeSelects selectpicker" required="" data-dropup-auto="false" data-size="10" data-style="none">
                          </select> 
                          <div id="showTravelSub">
                            
                          </div>          
                        </div>    
                      </div>
                      <div class="col-md-6">
                          <div class="form-group">
                            <label>Total Ticket</label>
                            <input type="text" name="totalTicket" class="form-control"  placeholder="Total Ticket"  oninput="this.value= this.value.replace(/[^0-9.,]/g, '').replace(/(\..*)\.,/g, '$1')">
                          </div>
                      </div>
                      <div class="col-md-6">
                          <div class="form-group">
                            <label>Tanggal Keberangkatan</label>
                            <input type="text" name="departDate" class="form-control  start-date"  placeholder="Tanggal Keberangkatan"  >
                          </div>
                      </div>

                      <div class="col-md-12">
                        <button type="button" class="pull-right btn btn-success search" data-form="dataForm" data-append="formAppend"><i class="ion-android-refresh"></i> Lihat Jadwal</button>
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
        url:"{{ url('travel/search') }}",
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
