
<div class="content-ayokulakan" style="padding-top: 12px">
  <form id="dataFormInqueryPascaPDAM" action="{{ url('ppob-pasca/store') }}" method="POST">
   {!! csrf_field() !!}
   <div class="row">
   <div class="col-md-12">
             <div class="form-group">
               <h4 style="color: green;font-family: arial">PDAM</h4>
             </div>
           </div>
     <div class="col-md-12">
       <div class="row">
         <div class="col-md-6">
           <div class="form-group">
             <input type="hidden" name="tpe" value="pdam">
             <label for="">Pilih Tempat</label>
             <select name="type" class="form-control selectpicker" required="" data-dropup-auto="false" data-size="10" data-live-search="true">
               {!! App\Models\Master\PPOBPdam::options('name','code', [], 'Choose One') !!}
             </select> 
           </div>    
         </div>
         <div class="col-md-6">
           <div class="form-group">
             <label>Nomor Pelanggan</label>
             <input type="text" name="ppob_pelanggan" class="form-control" placeholder="Nomor Pelanggan">
           </div>
         </div>
         
         <div class="col-md-12" style="padding-top: 13px;margin-bottom: 15px">
            <button type="button" class="btn btn-success check-inquiry ppob-pdam pull-right" data-url="check-pdam" data-form="dataFormInqueryPascaPDAM" data-show="show-inquiry-pdam"><i class="ion-android-refresh"></i> Cek Tagihan</button>
           {{-- @if(\Auth::check())
             <button type="button" class="btn btn-success save-page save-frontend" data-title="Beli Pulsa Sekarang ? Pastikan Nomor Sudah Benar." data-confirm="Pesan" data-batal="Batal" data-forms="dataFormInqueryPascaPDAM"><i class="ion-ios-plus"></i> Beli Pulsa</button>
           @else
           @endif --}}
           
         </div>
       </div>    
     </div>
   </div>
 </form>
</div>
<div class="show-inquiry-pdam">
   
</div>