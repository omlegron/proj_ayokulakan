@extends('layouts.scaffold')

@section('js-filters')
d.nama = $("input[name='filter[name]']").val();
@endsection

@section('rules')
<script type="text/javascript">
    formRules = {
        judul: ['empty'],
    };
</script>
@endsection



@section('scripts')
<script type="text/javascript">
    $(document).on('change','select[name="id_jadwal"]', function(){
        var vv = this.value;
        if(vv)
        {
            $.ajax({
                url : "{{ url('daftar-haji-umroh/jadwal') }}"+'/'+ vv,
                method : 'get',
                success : function(data){
                    $('#keterangan').html(data);
                },

                error: function(){
                    console.log('error')
                }

            })
        }else{
            $('#keterangan').html('');
        }
    });


    $('.nomor').on('keyup', function(){
        var v = this.value;
        if(v){
            this.value = v.replace(/[^0-9]/g, '');
        }

    })
    $('.dropify').dropify();
</script>
@append


@section('content-frontend')
<style type="text/css">
    #daftar-haji 
    {
        background-color: #ffffff !important;
        color: #000 !important;
    }
    .terms-conditions-page{
      padding-top: 0px !important;
  }

</style>
<div class="terms-conditions-page container">
    <div class="row" style="padding: 20px">
        <a href="{{ url('/') }}" style="margin-left: 20px; font-size:30px; color:orange !important"><i class="glyphicon glyphicon-arrow-left"></i></a>
        <div class="col-md-12 terms-conditions">
          <div class="row">
            <div class="col-md-12">
                <h2>Syarat Daftar haji dan umroh</h2>
                <p>
                    Silakan lakukan pendaftaran dengan menyertai dokumen sebagai berikut :
                </p><br>
                <p><b>Syarat Pendaftaran</b></p>
                <p>1.	Passport (asli dan fotocopy 1 lembar).</p>
                <p>2.	Buku suntik meningitis asli</p>
                <p>3.	Foto fokus wajah 80% background putih (2 lembar ukuran 4x6 )</p>
                <p>4.	Buku menikah (jika sudah menikah)</p>
                <p>5.	Akte lahir (jika anak di bawah usia 16 tahun)</p>
                <p>6.	1 lembar fotocopy ktp</p>
                <p>7.	1 lembar fotocopy kk</p>
                <p>8.	Surat bukti keterangan hamil (jika perempuan sedang mengadung )</p><br>
                <p><b>Biaya sudah termasuk</b></p>
                <p>1.	Visa </p>
                <p>2.	Tiket pesawat pp</p>
                <p>3.	Akomondasi hotel</p>
                <p>4.	Transportasi bus</p>
                <p>5.	Makan 3 kali sehari (menu Indonesia)</p>
                <p>6.	Ziarah Madinah dan mekah </p>
                <p>7.	Pembimbing  (muthowif) </p>
                <p>8.	Air zam-zam 5l</p>
                <p>9.	(Pasar ja’fariyah, thaif, jabal magnet)</p><br>
                <p><b>Pembayaran </b></p>
                <p>1.	Membayar administrasi 1.250.000,-</p>
                <p>2.	Membayar uang muka sebesar 50% dari total biaya umroh</p>
                <p>3.	Melunasi paling lambat 1 bulan sebelum keberangkatan </p>
                <p>4.	Bagi calon jamaah yang membatalkan keberangkatan tetap terkena biaya admistrasi, sesuai dengan aturan yang berlaku </p>
                <br>
                <p>*Melayani pengurusan umroh rombongan, keluarga, kantor, Arisan dll.</p>
                <p>*Aturan sewaktu – waktu dapat berubah </p><br>
                <p><b>Panduan penggunaan</b></p><br>
                <img src="{{ url('img/panduan_haji.jpg') }}" style="width: 100%;margin-bottom: 20px" alt="">
                <p>Akan tampil syarat dan ketentuan, pengisian form data diri, pemilihan paket, dan pilih pemberangkatan. Agar pendaftar dapat ditindaklanjuti oleh ayokulakan, silakan lengkapi pemberkasan</p>
            </div>
        </div>
            <h2 class="heading-title">Daftar Haji & Umroh</h2>
            <div class="contact-page-map">
                <div class="content-ayokulakan">
                      <form id="dataFormPage" action="{{ url($pageUrl.'store') }}" method="POST" autocomplete="off">
                        {!! csrf_field() !!}
                        <div class="row">
                          @if(Auth::check())
                            <div class="col-md-4">
                             <div class="form-group">
                                 <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                                 <label for="">Nama Pemesan</label>
                                 <input type="text" readonly class="form-control" value="{{auth()->user()->username}}" />
                             </div>
                            </div>
                            <div class="col-md-4">
                              <div class="form-group">
                                  <label for="">Nama Peserta</label>
                                  <input type="text" name="name" placeholder="Nama Peserta" class="form-control">
                              </div>
                            </div>
                            <div class="col-md-4">
                              <div class="form-group">
                                 <label for="">NIK</label>
                                 <input type="text" name="nik" class="form-control nomor" required minlength="16" maxlength="16" placeholder="NIK" />
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group">
                                 <label for="">No. KK</label>
                                 <input type="text" name="kk" class="form-control nomor" required minlength="16" maxlength="16" placeholder="No. KK" />
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group">
                                 <label for="">No. Passport</label>
                                 <input type="text" name="passport" class="form-control nomor" required minlength="16" maxlength="16" placeholder="No. Passport" />
                              </div>
                            </div>
                            <div class="col-md-12">
                              <div class="form-group">
                                 <label rows="5">Keterangan Penyakit</label>
                                 <textarea rows="4" placeholder="" class="form-control"></textarea>
                              </div>
                            </div>
                            <div class="col-md-12">
                              <div class="panel-group">
                                <div class="panel panel-default">
                                  <div class="panel-heading">
                                    <div class="form-group">
                                      <label>Pilih Paket & Jadwal Keberangkatan</label>
                                      <select class="form-control selectpicker" name="id_jadwal" required="" data-dropup-auto="false" data-size="10" data-style="none">
                                        {!! \App\Models\HajiUmroh\HajiJadwal::options('judul', 'id', [], 'Pilih Paket & Jadwal Keberangkatan') !!}
                                      </select>
                                    </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-12" id="keterangan">
                                        
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="col-md-6"> 
                              @include('partials.component.single-attachment',[
                                'attName' => 'file[passport]',
                                'fileTitle' => 'Upload Foto Copy Dokumen Passport',
                                'fileType' => 'pdf doc png gif docx',
                                'fileSize' => '3M',
                                'fileUrl' => '',
                              ])
                            </div>
                            <div class="col-md-6"> 
                              @include('partials.component.single-attachment',[
                                'attName' => 'file[miningitis]',
                                'fileTitle' => 'Upload Foto Copy Dokumen Buku Suntik Miningitis Asli',
                                'fileType' => 'pdf doc png gif docx',
                                'fileSize' => '3M',
                                'fileUrl' => '',
                              ])
                            </div>
                            <div class="col-md-6"> 
                              @include('partials.component.single-attachment',[
                                'attName' => 'file[foto]',
                                'fileTitle' => 'Upload Foto Fokus Wajah Background Putih (Ukuran 4x6)',
                                'fileType' => 'pdf doc png gif docx',
                                'fileSize' => '3M',
                                'fileUrl' => '',
                              ])
                            </div>
                            <div class="col-md-6"> 
                              @include('partials.component.single-attachment',[
                                'attName' => 'file[menikah]',
                                'fileTitle' => 'Upload Foto Copy Buku Menikah (Jika Sudah Menikah)',
                                'fileType' => 'pdf doc png gif docx',
                                'fileSize' => '3M',
                                'fileUrl' => '',
                              ])
                            </div>
                            <div class="col-md-6"> 
                              @include('partials.component.single-attachment',[
                                'attName' => 'file[akte]',
                                'fileTitle' => 'Upload Foto Copy Akte Lahir (Jika Usia Dibawah 16 Tahun)',
                                'fileType' => 'pdf doc png gif docx',
                                'fileSize' => '3M',
                                'fileUrl' => '',
                              ])
                            </div>
                            <div class="col-md-6"> 
                              @include('partials.component.single-attachment',[
                                'attName' => 'file[ktp]',
                                'fileTitle' => 'Upload Foto Copy Dokumen KTP',
                                'fileType' => 'pdf doc png gif docx',
                                'fileSize' => '3M',
                                'fileUrl' => '',
                              ])
                            </div>
                            <div class="col-md-6"> 
                              @include('partials.component.single-attachment',[
                                'attName' => 'file[kk]',
                                'fileTitle' => 'Upload Foto Copy Dokumen KK',
                                'fileType' => 'pdf doc png gif docx',
                                'fileSize' => '3M',
                                'fileUrl' => '',
                              ])
                            </div>
                            <div class="col-md-6"> 
                              @include('partials.component.single-attachment',[
                                'attName' => 'file[hamil]',
                                'fileTitle' => 'Upload Foto Copy Surat Bukti Keterangan Hamil (Jika Perempuan Sedang Mengandung).',
                                'fileType' => 'pdf doc png gif docx',
                                'fileSize' => '3M',
                                'fileUrl' => '',
                              ])
                            </div>
                            <div class="col-md-12">
                              <div class="order-button-payment">
                                <button type="button" class="btn btn-success save-page save-ayokulakan btn-lg btn-block" data-title="Anda yakin data sudah lengkap?" data-confirm="Daftar" data-batal="Batal">Daftar</button>
                              </div>
                            </div>  
                          @else
                            <center><h1>Anda belum Login, silahkan login terlebih dahulu, atau registrasi</h1></center>
                          @endif
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
@endsection
