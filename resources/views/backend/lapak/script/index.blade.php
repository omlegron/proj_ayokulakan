<script type="text/javascript">
function convertToRupiah(angka)
{
	var rupiah = '';    
	var angkarev = angka.toString().split('').reverse().join('');
	for(var i = 0; i < angkarev.length; i++) if(i%3 == 0) rupiah += angkarev.substr(i,3)+'.';
		return rupiah.split('',rupiah.length-1).reverse().join('');
}

function convertToAngka(rupiah)
{
	return parseInt(rupiah.replace(/,.*|[^0-9]/g, ''), 10);
}
function showBarang(judul = '',length = '', order = '', url = ''){
	var id_lapak = $('input[name="id_lapaks"]').val();
	if(judul == ''){
		judul = '';
	}else{
		judul = judul;
	}
	if(url == ''){
		url = '{{ url($pageUrl."show-barang") }}';
	}else{
		url = url;
	}


	$.ajax({
		url: url,
		data:{id_lapak:id_lapak,judul:judul,length:length,order:order,},
		type: 'GET',
		success: function(resp){
			$('.show-barang').html(resp);
		},
		error : function(resp){
			$('.show-barang').html('Data Tidak Ditemukan');
		}
	});

}

$('body').on('click', '.page-numbers li a', function(e) {
	e.preventDefault();

	$('#load a').css('color', '#dfecf6');
	$('#load').append('<img style="position: absolute; left: 0; top: 0; z-index: 100000;" src="/images/loading.gif" />');

	var url = $(this).attr('href');
	showBarang('','','',url);
	window.history.pushState("", "");
});

$(document).on('click','.filter.btn',function(){
	var name = $('input[name="filter[nama]"]').val();
	var sort = $('select[name="filter[sort]"]').val();
	var tampilkan = $('select[name="filter[tampilkan]"]').val();
	showBarang(name,tampilkan,sort,'')
});
$('.reset.button').on('click', function(e) {
	setTimeout(function(){
		showBarang();
	}, 100);
});
$(document).on('change','#inputGroupFile01',function(){
	$('#image_preview').html("");
	var total_file=document.getElementById("inputGroupFile01").files.length;
	for(var i=0;i<total_file;i++)
     {

      $('#image_preview').append("<img src='"+URL.createObjectURL(event.target.files[i])+"'>");

     }
});
{{--  $(document).ready(function(){
	showBarang();
	var uangs = $('.duits').text()
	var converts = convertToRupiah(convertToAngka(uangs));
	$('.duits').val(converts);  
});  --}}
// form-input lapak
// $(document).ready(function(){
// 	$('ul#lapak-barang').each(function(){
//       var $dropdown = $(this);
//       $("a#link-lapak",$dropdown).on('click',function(){
// 		  console.log('lapak');
//           	$("a#link-lapak").addClass('active');
// 			$("ul#second-lapak",$dropdown).toggle().stop(true,false,true);
// 			$("ul#second-lapak").addClass('abs');
// 			return false;
//         });
//     });
//     $('html').click(function(){
//     	$("ul#second-lapak").hide().stop(true,false,true);
//     	$("a#links").removeClass('active');
//     });
// });
$(document).ready(function(){
    $('ul#lapak-barang').each(function(){
      var $dropdown = $(this);
      $("a#link-lapak",$dropdown).on('click',function(){
          var id = $(this).attr('data-url');
          $.ajax({
            type: 'GET',
            url: "{{ url('settings-lapak/show-kategori') }}/" + id,
            success: function(resp){
              $('#second-lapak').html(resp);
            },
          });
		$("a#link-lapak").addClass(['active']);
		$("#second-lapak").show(2000);
		return false;
        });
    });
    $('html').on('click',function(){
    	$("#second-lapak").hide(2000);
    	$("link-lapak").removeClass('active');
    });
});

$(document).on('keyup','.key',function(){
	var value = $(this).val();
	var id = $(this).data('id');
	console.log(value);
	$('.keys'+id).val(value+',00');
});
function convertToMata(angka){
	var rupiah = '';
	var angkarev = angka.toString().split('').reverse().join('');
	for(var i = 0; i < angkarev.length; i++) if(i%3 == 0) rupiah += angkarev.substr(i,3)+'.';
		var hasil = ''+rupiah.split('',rupiah.length-1).reverse().join('');
	if(hasil == 'NaN'){
		hasil = '';
	}else{
		hasil = hasil+',00';
	}
	return 'Rp.'+hasil;
}
function savedata(form){
	$("#"+form).ajaxSubmit({
		success: function(resp){
			$("#formModals").modal('hide');
			swal(
				'Tersimpan!',
				'Data Berhasil Di Simpan.',
				'success'
				).then((result) => {
					if(resp.url){
						location.reload();
					}
					dt.draw();
				})
			},
			error: function(resp){
				swal(
					'Gagal Menyimpan Data!',
					showBoxValidation(resp),
					'error'
					);
				showFormErrorModalTwo(resp,form);
			}
	});
}
$(document).on('keyup','.disc',function() {
	var id = $(this).data('id');
	var isi = $(this).val();
	var val = $('.key').val();
	var pars = val.replace(/\D/g,'');
	var int = pars.substring(0, pars.length-2);

	var disc = isi * int /100;
	var hasil = int - disc ;
	var rupiah = '100000';
	var convert = convertToMata(hasil);
	console.log(convert);
	$('.keys'+id).val(convert);
});
//daftar lapak  
$(document).on('click','.check-daftar',function(){
	$("input[type=checkbox]").prop('checked', $(this).prop('checked'));
	if($("input[type=checkbox]").is(':checked')){
		$('.btn-save').removeClass('disabled');
	}else{
		$('.btn-save').addClass('disabled');
	}
});

$(document).on('click','.btn-batal',function(){
	const type = $("input[type=text]").val();
	if(type){
		$("input[type=text]").val('');
		$("input[name=phone]").focus();
	}else{
		location.reload();
	}

});

$(document).on('click','.btn-save',function(){
	const form = 'dataSave';
	savedata(form);
});

</script>