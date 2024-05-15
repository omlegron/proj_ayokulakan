@extends('layouts.scaffold')

@section('js-filters')
d.nama = $("input[name='filter[name]']").val();
@endsection

@section('rules')
<script type="text/javascript">
    formRules = {
        judul: ['empty']
    , };

</script>
@endsection

@section('css')
<style>
    .outer-top {
        margin-top: 188px;
    }
    .terms-conditions-page{
        padding-top: 0px !important;
    }
    .col-md-5{
        margin: 20px 29%;
    }
    .jad-header{
        background-color: #53c426;
        height: 200px;
        padding: 20px;
        text-align: center;
        overflow: hidden;
    }
    .jad-header h5{
        font-weight: bold;
        font-size: 30px;
    }
    .jad-header select, option{
       width: 100%;
    }
    @media only screen and (max-width: 768px) {
        .outer-top {
            margin-top: 387px;
        }
        .frame{
            margin-left: -30px;
            overflow-x: auto;
        }
    }
    @media (max-width: 575.98px) { 
        .jad-header h5{
            font-size: 18px;
        }
        .col-md-5{
            margin: 10 10%;
        }
     }

</style>
@endsection

@section('content-frontend')
<div class="terms-conditions-page">
    <a href="{{ url('/') }}" style="font-size:30px; color:orange !important"><i class="glyphicon glyphicon-arrow-left" style="padding: 20px"></i></a>
    <div class="body-content">
        <div class="col-md-5">
            <div class="jad-header">
                <h5>Jadwal Sholat</h5>
                <select name="kota" id="">
                    @foreach ($kota as $item)
                        <option value="{{ $item->id }}" {{ ($item->id == $sholat->query->kota) ? 'selected' : '' }} >{{ $item->nama }}</option>
                        
                    @endforeach
                </select>
            </div>
            <table class="table">
                <thead>
                    <th colspan="2">{{ $sholat->jadwal->data->tanggal }}</th>
                </thead>
                <tbody>
                    <tr>
                        <th>Shubuh</th>
                        <td style="text-align: right; color: #53c426">{{ $sholat->jadwal->data->subuh }}</td>
                    </tr>
                    <tr>
                        <th>Duha</th>
                        <td style="text-align: right; color: #53c426">{{ $sholat->jadwal->data->terbit }}</td>
                    </tr>
                    <tr>
                        <th>Dzuhur</th>
                        <td style="text-align: right; color: #53c426">{{ $sholat->jadwal->data->dzuhur }}</td>
                    </tr>
                    <tr>
                        <th>Ashar</th>
                        <td style="text-align: right; color: #53c426">{{ $sholat->jadwal->data->ashar }}</td>
                    </tr>
                    <tr>
                        <th>Magrib</th>
                        <td style="text-align: right; color: #53c426">{{ $sholat->jadwal->data->maghrib }}</td>
                    </tr>
                    <tr>
                        <th>Isya</th>
                        <td style="text-align: right; color: #53c426">{{ $sholat->jadwal->data->isya }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    Sumber: <a href="https://fathimah.docs.apiary.io">https://fathimah.docs.apiary.io
    </a>
</div>
@endsection

@section('scripts')
    <script>
        $(document).on('change','select[name="kota"]',function(){
            var id = $(this).val();
            $.ajax({
                type: 'GET',
                url: "{{ url('ajx-kota') }}",
                data: {id:id},
                success: function(resp){
                  $('.table').html(resp);
                },
                error: function(resp){
                  
                }
            });

        });
    </script>
@endsection
