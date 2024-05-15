@if($result)
@if($result->status == 'SUCCESS' && $result->isPackageDeal == false)
<b><u><h4 class="checkout-subtitle">*Informasi Tambahan : {!! $result->additionalInformation or '-' !!}</h4></u></b>
@if($result->specialRequestArrayRequired == true)
<h4 class="checkout-subtitle">Lengkapi Spesial Request</h4>
<input type="hidden" name="bedTypeBed">
@foreach($result->specialRequestArray as $k1 => $value1)
<div class="col-md-12" style="margin-bottom: 10px">
  <div class="panel panel-default panel panel-body" style="height: 110px">
    <div class="input-group">
      <span class="input-group-addon" >
        <input type="checkbox" class="specialReq specialReq{{$k1}}" name="specialRequestArray[{{ $k1 }}][special_id]" aria-label="..." value="{{ $value1->ID }}" data-k="{{$k1}}" style="transform: scale(1.4);">
      </span>
    </div>
    
      <h5 class="heading-title">{{ $value1->description }}</h5>
      <input type="checkbox" class="specialDesc{{$k1}}" name="specialRequestArray[{{ $k1 }}][description]" aria-label="..." value="{{ $value1->description or '' }}" style="transform: scale(1.4);display: none">

    </div>
  </div>
</div>
@endforeach
<br>
@endif

@if(isset($result->bedTypes) && (count($result->bedTypes) > 0))
<h4 class="checkout-subtitle">Pilih Kamar / Ruangan</h4>
<input type="hidden" name="bedTypeBed">
@foreach($result->bedTypes as $k1 => $value1)
<div class="col-md-4" style="">
  <div class="input-group">
    <span class="input-group-addon" >
      <input type="radio" class="bedID" data-bed="{{ $value1->bed }}" name="bedTypeID" aria-label="..." value="{{ $value1->ID }}" style="transform: scale(1.4);">
    </span>
  </div>
  <div class="panel panel-default panel panel-body" style="height: 70px">
    <h5 class="heading-title">Bed - {{ $value1->bed }}</h5>
  </div>
</div>
@endforeach
@endif
@endif
@endif

@if($result)
@if($result->status == 'SUCCESS' && $result->isPackageDeal == false)
<div class="panel-group">
  <div class="panel panel-default">
    <div class="panel-heading">
      <div class="col-md-4">
        <div class="form-group">
          <label style="font-size: 11px">Smooking Room ? </label>
          <select name="smookingRoom" class="form-control">
            <option value="true" selected="">Ya</option>
            <option value="false">TIdak</option>
          </select>
        </div>
      </div>
      <div class="col-md-4">
        <div class="form-group">
          <label style="font-size: 11px">Email Pemesan </label>
          <input type="text" name="email" placeholder="Email Pemesan" class="form-control" value="{{ $user->email }}">
        </div>
      </div>
      <div class="col-md-4">
        <div class="form-group">
          <label style="font-size: 11px">No Telp / Hp Pemesan </label>
          <input type="text" name="phone" placeholder="No Telp / Hp Pemesan" class="form-control" oninput="this.value= this.value.replace(/[^0-9.,]/g, '').replace(/(\..*)\.,/g, '$1')" maxlength="13" value="{{ $user->hp }}">
        </div>
      </div>
    </div>
    <div class="panel panel-body panel-content">
      <table class="table table-bordered" width="100%">
        <thead>
          <tr>
            <th colspan="" rowspan="" headers="" scope="">Title</th>
            <th colspan="" rowspan="" headers="" scope="">First Name</th>
            <th colspan="" rowspan="" headers="" scope="">Last Name</th>
            <th colspan="" rowspan="" headers="" scope="">Action</th>
          </tr>
        </thead>
        <tbody class="appendBody">
          <tr class="cekTr" data-no="0">
            <td colspan="" rowspan="" headers="">
              <div class="form-group">
                <select name="paxes[0][title]" class="form-control">
                  <option value="Mr" selected="">Mr</option>
                  <option value="Mrs">Mrs</option>
                  <option value="Ms">Ms</option>
                  <option value="Miss">Miss</option>
                </select>
              </div>
            </td>
            <td colspan="" rowspan="" headers="">
              <div class="form-group">
                <input type="text" name="paxes[0][firstName]" class="form-control" placeholder="First Name" value="{{ $user->nama }}">
              </div>
            </td>
            <td colspan="" rowspan="" headers="">
              <div class="form-group">
                <input type="text" name="paxes[0][lastName]" class="form-control" placeholder="Last Name">
              </div>
            </td>
            <td colspan="" rowspan="" headers="">
              <center>
                <button type="button" data-toggle="tooltip" data-placement="bottom" title="Tambah Data" class="btn btn-sm btn-success addData" data-no="0"><i class="fa fa-plus"></i></button>
              </center>
            </td> 
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>

<button type="button" class="pull-right btn btn-success pesanHotel2 darma-save-render" data-form="#dataFormPageCekHotel" ><i class="fa fa-save"></i> Pesan Hotel</button>
@else
<div class="panel panel-default" style="padding: 20px; overflow: hidden;">
    <div class="text-center">
        <b>Upss... Kamar sudah penuh!</b>
        <br>
        Silahkan pesan yang lain
    </div>
</div>
@endif
@endif

<script type="text/javascript">
  $(document).on('change','.specialReq',function(){
    var k = $(this).data('k');
    var check = $(this).prop("checked");

    if(check == true){
      $('.specialDesc'+k).attr('checked',true);
    }else{
      $('.specialDesc'+k).attr('checked',false);
    }
  });

  $(document).on('click','.addData',function(){
    var no = $('.cekTr').last().data('no')+1;
    console.log('no',no)
    if(no < 4){
      $('.appendBody').append(
        `<tr class="cekTr dataDelete`+no+`" data-no="`+no+`">
        <td colspan="" rowspan="" headers="">
        <div class="form-group">
        <select name="paxes[`+no+`][title]" class="form-control">
        <option value="Mr" selected="">Mr</option>
        <option value="Mrs">Mrs</option>
        <option value="Ms">Ms</option>
        <option value="Miss">Miss</option>
        </select>
        </div>
        </td>
        <td colspan="" rowspan="" headers="">
        <div class="form-group">
        <input type="text" name="paxes[`+no+`][firstName]" class="form-control" placeholder="First Name">
        </div>
        </td>
        <td colspan="" rowspan="" headers="">
        <div class="form-group">
        <input type="text" name="paxes[`+no+`][lastName]" class="form-control" placeholder="Last Name">
        </div>
        </td>
        <td colspan="" rowspan="" headers="">
        <center>
        <button type="button" data-toggle="tooltip" data-placement="bottom" title="Tambah Data" class="btn btn-sm btn-success addData" data-no="`+no+`"><i class="fa fa-plus"></i></button>
        <button type="button" data-toggle="tooltip" data-placement="bottom" title="Hapus Data" class="btn btn-sm btn-danger hapusData" data-hapus=".dataDelete`+no+`"><i class="fa fa-close"></i></button>
        </center>
        </td> 
        </tr>`
        );
    }else{
      swal(
        'data penghuni kamar !',
        'Data tidak boleh lebih dari 4 orang',
        'warning'
        )
    }
  });

  $(document).on('click','.hapusData',function(){
    var hapusData = $(this).data('hapus');
    $(hapusData).remove();
  });
</script>