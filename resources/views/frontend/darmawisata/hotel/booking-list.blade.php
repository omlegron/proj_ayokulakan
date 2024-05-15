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

@section('toolbars')

@endsection

@section('filters')
<div class="btn-toolbar mb-3" role="toolbar" aria-label="Toolbar with button groups">
    <div class="input-group">
        <input type="text" name="filter[hotelName]" class="form-control" placeholder="Nama Hotel" aria-label="" aria-describedby="">
    </div>&nbsp;
    <div class="input-group">
        <input type="text" name="filter[roomName]" class="form-control" placeholder="Nama Kamar" aria-label="" aria-describedby="">
    </div>&nbsp;
    <div class="input-group">
        <input type="text" name="filter[bookingDate]" class="form-control bots-date" placeholder="Booking Date" aria-label="" aria-describedby="">
    </div>&nbsp;
    <!-- <div class="input-group">
        <input type="text" name="filter[nama]" class="form-control" placeholder="Nama Kecamatan" aria-label="" aria-describedby="">
    </div>&nbsp;
    <div class="input-group">
        <input type="text" name="filter[nama]" class="form-control" placeholder="Nama Kecamatan" aria-label="" aria-describedby="">
    </div>&nbsp; -->
    
    <div class="btn-group mr-2" role="group" >
        <button type="button" class="btn btn-primary filter button" data-toggle="tooltip" data-placement="bottom" title="Cari Data"><i class="fa fa-search"></i></button>
        <button type="reset" class="btn btn-danger reset button" data-toggle="tooltip" data-placement="bottom" title="Refresh"><i class="fa fa-close"></i></button>
    </div>
</div>
@endsection

@section('js')

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
</script>
@endsection