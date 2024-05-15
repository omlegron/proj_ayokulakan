
<style type="text/css" media="screen">
	/* Absolute Center Spinner */
	.loadings {
		position: fixed;
		z-index: 999;
		height: 2em;
		width: 2em;
		overflow: visible;
		margin: auto;
		top: 0;
		left: 0;
		bottom: 0;
		right: 0;
	}

	/* Transparent Overlay */
	.loadings:before {
		content: '';
		display: block;
		position: fixed;
		top: 0;
		left: 0;
		width: 100%;
		height: 100%;
		background-color: rgba(0,0,0,0.3);
	}

	/* :not(:required) hides these rules from IE9 and below */
	.loadings:not(:required) {
		/* hide "loadings..." text */
		font: 0/0 a;
		color: transparent;
		text-shadow: none;
		background-color: transparent;
		border: 0;
	}

	.loadings:not(:required):after {
		content: '';
		display: block;
		font-size: 10px;
		width: 1em;
		height: 1em;
		margin-top: -0.5em;
		-webkit-animation: spinner 1500ms infinite linear;
		-moz-animation: spinner 1500ms infinite linear;
		-ms-animation: spinner 1500ms infinite linear;
		-o-animation: spinner 1500ms infinite linear;
		animation: spinner 1500ms infinite linear;
		border-radius: 0.5em;
		-webkit-box-shadow: rgba(0, 0, 0, 0.75) 1.5em 0 0 0, rgba(0, 0, 0, 0.75) 1.1em 1.1em 0 0, rgba(0, 0, 0, 0.75) 0 1.5em 0 0, rgba(0, 0, 0, 0.75) -1.1em 1.1em 0 0, rgba(0, 0, 0, 0.5) -1.5em 0 0 0, rgba(0, 0, 0, 0.5) -1.1em -1.1em 0 0, rgba(0, 0, 0, 0.75) 0 -1.5em 0 0, rgba(0, 0, 0, 0.75) 1.1em -1.1em 0 0;
		box-shadow: rgba(0, 0, 0, 0.75) 1.5em 0 0 0, rgba(0, 0, 0, 0.75) 1.1em 1.1em 0 0, rgba(0, 0, 0, 0.75) 0 1.5em 0 0, rgba(0, 0, 0, 0.75) -1.1em 1.1em 0 0, rgba(0, 0, 0, 0.75) -1.5em 0 0 0, rgba(0, 0, 0, 0.75) -1.1em -1.1em 0 0, rgba(0, 0, 0, 0.75) 0 -1.5em 0 0, rgba(0, 0, 0, 0.75) 1.1em -1.1em 0 0;
	}

	/* Animation */

	@-webkit-keyframes spinner {
		0% {
			-webkit-transform: rotate(0deg);
			-moz-transform: rotate(0deg);
			-ms-transform: rotate(0deg);
			-o-transform: rotate(0deg);
			transform: rotate(0deg);
		}
		100% {
			-webkit-transform: rotate(360deg);
			-moz-transform: rotate(360deg);
			-ms-transform: rotate(360deg);
			-o-transform: rotate(360deg);
			transform: rotate(360deg);
		}
	}
	@-moz-keyframes spinner {
		0% {
			-webkit-transform: rotate(0deg);
			-moz-transform: rotate(0deg);
			-ms-transform: rotate(0deg);
			-o-transform: rotate(0deg);
			transform: rotate(0deg);
		}
		100% {
			-webkit-transform: rotate(360deg);
			-moz-transform: rotate(360deg);
			-ms-transform: rotate(360deg);
			-o-transform: rotate(360deg);
			transform: rotate(360deg);
		}
	}
	@-o-keyframes spinner {
		0% {
			-webkit-transform: rotate(0deg);
			-moz-transform: rotate(0deg);
			-ms-transform: rotate(0deg);
			-o-transform: rotate(0deg);
			transform: rotate(0deg);
		}
		100% {
			-webkit-transform: rotate(360deg);
			-moz-transform: rotate(360deg);
			-ms-transform: rotate(360deg);
			-o-transform: rotate(360deg);
			transform: rotate(360deg);
		}
	}
	@keyframes spinner {
		0% {
			-webkit-transform: rotate(0deg);
			-moz-transform: rotate(0deg);
			-ms-transform: rotate(0deg);
			-o-transform: rotate(0deg);
			transform: rotate(0deg);
		}
		100% {
			-webkit-transform: rotate(360deg);
			-moz-transform: rotate(360deg);
			-ms-transform: rotate(360deg);
			-o-transform: rotate(360deg);
			transform: rotate(360deg);
		}
	}
</style>
<div class="loadings" style="display: none">Loading&#8230;</div>
<script src="{{ env('MIDTRANS_PLUGIN') }}" data-client-key="{{ config('services.midtrans.clientKey') }}"></script>
<script type="text/javascript">
	$(document).on('click', '.others-add.button', function(e){
		var url = "{{ url($pageUrl.'others') }}";
		var id = $(this).data('id');
		var titlemodal = $(this).data('titlemodal');
		var obj = {};
		obj.titlemodal = titlemodal;
		loadModal(url,id,obj);
	});

	$(document).on('click', '.voc-add.button', function(e){
		var url = "{{ url($pageUrl.'voucher') }}";
		var id = $(this).data('id');
		var titlemodal = $(this).data('titlemodal');
		var obj = {};
		obj.titlemodal = titlemodal;
		loadModal(url,id,obj);
	});

	$(document).on('click', '.edit-vouc', function(e){
		var id = $(this).data('id');
		var urls = $(this).data('urls');
		var url = "{{ url($pageUrl) }}/"+id+"/"+urls
		var titlemodal = $(this).data('titlemodal');
		var obj = {};
		obj.titlemodal = titlemodal;
		loadModal(url,id,obj);
	});

	$(document).on('click', '.add-low.button', function(e){
		var id = $(this).data('id');
		console.log(id);
		var url = "{{ url($pageUrl.'create') }}/"+id;
	// var id = $(this).data('id');
	var titlemodal = $(this).data('titlemodal');
	var obj = {};
	obj.titlemodal = titlemodal;
	loadModal(url,id,obj);
});

	$(document).on('click', '.others-edit.button', function(e){
		var id = $(this).data('id');
		var urls = $(this).data('urls');
		var url = "{{ url($pageUrl) }}/"+id+"/"+urls;
		var titlemodal = $(this).data('titlemodal');
		var obj = {};
		obj.titlemodal = titlemodal;
		loadModal(url,id,obj);
	});

	$(document).on('click', '.btn.detail.button', function(e){
		var id = $(this).data('id');
		var url = "{{ url($pageUrl) }}/"+id+"/detail";

		loadModal(url);
	});

	$(document).on('click', '.btn.others-deletes', function(e){
		var id = $(this).data('id');
		var urls = $(this).data('url');
		var url = null;
		if(urls){
			url = '{{ url($pageUrl) }}/'+urls;
		}else{
			url = '{{ url($pageUrl) }}/'+id;
		}

		swal({
			title: 'Apa Anda Yakin?',
			text: "Data Yang Di Hapus Tidak Dapat Di Kembalikan!",
			type: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Delete',
			cancelButtonText: 'Cancel'
		}).then((result) => {
			if (result) {
				$.ajax({
					url: url,
					type: 'POST',
					data: {_token: "{{ csrf_token() }}", _method: "POST", id:id},
					success: function(resp){
						swal(
							'Terhapus!',
							'Data Berhasil Di Hapus.',
							'success'
							).then(function(e){
								if(resp.url == true){
									var url = "{{ url($pageUrl) }}";
									window.location = url;
								}
								dt.draw();
							});
						},
						error : function(resp){
							swal(
								'Gagal!',
								'Data gagal dihapus, karena sedang dipakai',
								'error'
								).then(function(e){
									dt.draw();
								});
							}
						});

			}
		})
	});

// END OTHERS
$(document).on('click', '.add.button', function(e){
	var url = "{{ url($pageUrl) }}/create";
	loadModal(url);
});


$(document).on('click', '.btn.edit.button', function(e){
	var id = $(this).data('id');
	var url = "{{ url($pageUrl) }}/"+id+"/edit";
	var titlemodal = $(this).data('titlemodal');
	var obj = {};
	obj.titlemodal = titlemodal;
	loadModal(url,id,obj);
});

$(document).on('click', '.btn.approve.button', function(e){
	var data = {};
	data.id = $(this).data('id');
	data.title = $(this).data('title');
	data.text = $(this).data('text');
	data.status = $(this).data('status');
	data.url = $(this).data('url');
	data._token = "{{ csrf_token() }}";
	approve(data);
});




$(document).on('click', '.btn.deletes', function(e){
	var id = $(this).data('id');
	url = '{{ url($pageUrl) }}/'+id;
	console.log(url);
	swal({
		title: 'Apa Anda Yakin?',
		text: "Data Yang Di Hapus Tidak Dapat Di Kembalikan!",
		type: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		confirmButtonText: 'Delete',
		cancelButtonText: 'Cancel'
	}).then((result) => {
		if (result) {
			$.ajax({
				url: url,
				type: 'POST',
				data: {_token: "{{ csrf_token() }}", _method: "delete"},
				success: function(resp){
					swal(
						'Terhapus!',
						'Data Berhasil Di Hapus.',
						'success'
						).then(function(e){
							if(resp.url == true){
								var url = "{{ url($pageUrl) }}";
								window.location = url;
							}
							dt.draw();
						});
					},
					error : function(resp){
						swal(
							'Gagal!',
							'Data gagal dihapus, karena sedang dipakai',
							'error'
							).then(function(e){
								dt.draw();
							});
						}
					});

		}
	})
});

function approve(data){
	swal({
		title: data.title,
		text: data.text,
		type: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		confirmButtonText: 'Ya',
		cancelButtonText: 'Tidak'
	}).then((result) => {
		if (result) {
			$.ajax({
				url: data.url,
				type: 'POST',
				data: data,
				success: function(resp){
					swal(
						'Sukses!',
						'Status Telah Di Ubah',
						'success'
						).then(function(e){
							location.href = '{{ url($pageUrl) }}';

						});
					},
					error : function(resp){
						console.log('consol',resp);
						swal(
							'Gagal!',
							resp.responseJSON.message,
							'error'
							).then(function(e){
								location.href = '{{ url($pageUrl) }}';

							});
						}
					});

		}
	})
}

function loadModal(url, id = '',data = '') {
	console.log('asd')
	$.get(url, { _token: "{{ csrf_token() }}", id:id } )
	.done(function( response ) {
		if(data.titlemodal !== ''){
			console.log('title',data)
			$('.modal-title').text(data.titlemodal);

		}
		$('.dropify').dropify();
		$('#formData').html(response);
		$('#formModals').modal('show');

		$('.selectpicker').selectpicker();
		$('.summernote').summernote({
			height : 270,
			toolbar: [
			['style', ['bold', 'italic', 'underline', 'clear']],
			['font', ['strikethrough', 'superscript', 'subscript']],
			['fontsize', ['fontsize']],
			['color', ['color']],
			['para', ['ul', 'ol', 'paragraph']],
			['height', ['height']]
			]
		});
		initModal();
	});
}

function saveFormModal(form)
{
	if($("#"+form).form('is valid')){
		$("#"+form).ajaxSubmit({
			success: function(resp){
				console.log('resp',resp)
				$("#formModals").modal('hide');
				swal(
					'Tersimpan!',
					'Data Berhasil Di Simpan.',
					'success'
					).then((result) => {
						if(resp.url){
							var url = "{{ url($pageUrl) }}";
							window.location = url;
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
}

function upperCase(data){
	var result = data.toLowerCase().replace(/\b[a-z]/g, function(letter) {
		return letter.toUpperCase();
	});
	return result;
}

function showBoxValidation(resp){
	var temp = ``;
	if(resp.statusText = 'Unprocessable Entity'){
		temp += `<div class="sidebar-widget wow fadeInUp outer-top-vs animated" style="visibility: visible; animation-name: fadeInUp;"><h3 class="section-title text-warning">Informasi</h3><div class="sidebar-widget-body" ><div class="compare-report"><ul class="list text-left bold" style="font-size:16px;list-style:inside;">`;
		if(resp.responseJSON){
			if(resp.responseJSON.errors){
				var data = resp.responseJSON.errors;
				$.each(data,function(key,value){
					temp += `<li><small>`+upperCase(key.replace("_", " "))+` : ` +value[0]+ `</small></li>`;
				});
			}
		}
		temp += `</ul></div></div></div>`;
	}else{
		temp = 'Terjadi Kesalahan Sistem';
	}
	console.log('temp',temp);
	return temp;
}

function saveGoToPage()
{

	if($("#dataFormModal").form('is valid')){
		$("#dataFormModal").ajaxSubmit({
			success: function(resp){
				$("#formModals").modal('hide');
				if(resp.url){
					var url = resp.url;
					window.location = url;
				}
			},
			error: function(resp){
					// clearAllErrorModel('#contentBody');
					if(resp.status == 500)
					{
						clearQueryErrorModal('#contentBody');
						showQueryErrorModal('#contentBody',resp.responseJSON.message);
						$.each(resp.responseJSON, function(index, val) {
							// clearFormErrorModal(index,val);
							showFormErrorModal(index,val);
						});
						swal(
							'Gagal!',
							'Isi Data Dengan Lengkap. / Pilih Salah Satu Isian Untuk Lanjut Pembayaran',
							'error'
							);
						time = 5;
						interval = setInterval(function(){
							time--;
							if(time == 0){
								clearInterval(interval);
								$('.text-danger.errors.labels').remove();
								$('.error').each(function (index, val) {
									$(val).removeClass('error');
								});
							}
						},1000)
					}else if(resp.responseJSON.status == 'message'){
						swal(
							'Gagal!',
							''+resp.responseJSON.message,
							'error'
							);
					}else{
						$.each(resp.responseJSON, function(index, val) {
							// clearFormErrorModal(index,val);
							showFormErrorModal(index,val);
						});
						swal(
							'Gagal!',
							'Isi Data Dengan Lengkap. / Pilih Salah Satu Isian Untuk Lanjut Pembayaran',
							'error'
							);
						time = 5;
						interval = setInterval(function(){
							time--;
							if(time == 0){
								clearInterval(interval);
								$('.text-danger.errors.labels').remove();
								$('.error').each(function (index, val) {
									$(val).removeClass('error');
								});
							}
						},1000)
					}
				}
			});
	}
}

function saveFormPage()
{

	if($("#dataFormPage").form('is valid')){
		$("#dataFormPage").ajaxSubmit({
			success: function(resp){
				// console.log('resp',resp)
				swal(
					'Tersimpan!',
					'Data Berhasil Di Simpan.',
					'success'
					).then((result) => {
						if(resp.url){
							var url = "{{ url($pageUrl) }}";
							window.location = url;
						}
						dt.draw();
					})
				},
				error: function(resp){
					// clearAllErrorModel('#contentBody');
					if(resp.status == 500)
					{
						clearQueryErrorPage('.content-ayokulakan');
						showQueryErrorPage('.content-ayokulakan',resp.responseJSON.message);
					}
					$.each(resp.responseJSON, function(index, val) {
						clearFormErrorPage(index,val);
						showFormErrorPage(index,val);
					});
					swal(
						'Gagal Menyimpan Data!',
						showBoxValidation(resp),
						'error'
						);
					time = 5;
					interval = setInterval(function(){
						time--;
						if(time == 0){
							clearInterval(interval);
							$('.text-danger.errors.labels').remove();
							$('.error').each(function (index, val) {
								$(val).removeClass('error');
							});
						}
					},1000)
				}
			});
	}
}


function saveFormTransaksi(param = [])
{
	var formId = (typeof param['formId'] === 'undefined') ? 'dataFormPage' : param['formId'];
	if($('#'+formId).form('is valid')){
		$('#'+formId).ajaxSubmit({
			success: function(resp){
				console.log('resp',resp)
				snap.pay(resp.record.snap_token, {
	                // Optional
	                onSuccess: function (result) {
	                	swal(
	                		'Sukses!',
	                		'Transaksi Berhasil.',
	                		'success'
	                		)

	                	if(resp.url){
	                		window.location = resp.url;
	                	}else{
	                		window.location = "{{ url($pageUrl) }}";
	                	}
	                },
	                // Optional
	                onPending: function (result) {
	                	console.log('pending',result)

	                	swal(
	                		'Silahkan Lanjutkan Pembayaran!',
	                		''+result.status_message+'',
	                		'success'
	                		)

	                	if(resp.url){
	                		window.location = resp.url;
	                	}else{
	                		window.location = "{{ url($pageUrl) }}";
	                	}
	                },
	                // Optional
	                onError: function (result) {
	                	console.log('Onerror',result)
	                	swal(
	                		'Gagal!',
	                		''+result.status_message+'',
	                		'error'
	                		)
	                	if(resp.url){
	                		window.location = resp.url;
	                	}else{
	                		window.location = "{{ url($pageUrl) }}";
	                	}
	                },onClose: function(result){
	                	$.ajax({
	                		url: "{{ url('transaksi/delete') }}",
	                		type: 'POST',
	                		data: {_token: "{{ csrf_token() }}", _method: "POST", id:resp.record.id},
	                		success: function(resp){
	                			if(resp.url){
	                				window.location = resp.url;
	                			}else{
	                				window.location = "{{ url($pageUrl) }}";
	                			}
	                		},
	                		error : function(resp){
	                		}
	                	});
	                }
	            });
			},
			error: function(resp){
				if(resp.status == 500)
				{
					swal(
						'Gagal!',
						''+resp.responseJSON.data.message,
						'error'
						);
					clearQueryErrorPage('.content-ayokulakan');
					showQueryErrorPage('.content-ayokulakan',resp.responseJSON.data.message);
				}else if(resp.responseJSON.status == 'kurir'){
					console.log('a')
					swal(
						'Gagal!',
						'Silahkan Pilih Kurir Pengiriman',
						'error'
						);
				}else if(resp.responseJSON.status == 'kurir_tipe'){
					console.log('b')

					swal(
						'Gagal!',
						'Silahkan Pilih Tipe Pengiriman',
						'error'
						);
				}else if(resp.responseJSON.status == 'message'){
					swal(
						'Gagal!',
						''+resp.responseJSON.message,
						'error'
						);
				}else{
					swal(
						'Gagal Melakukan Transaksi, Silahkan Lengkapi Data Pemesanan / Data Diri!',
						''+showBoxValidation(resp),
						'error'
						);
				}
				time = 5;
				interval = setInterval(function(){
					time--;
					if(time == 0){
						clearInterval(interval);
						$('.text-danger.errors.labels').remove();
						$('.error').each(function (index, val) {
							$(val).removeClass('error');
						});
					}
				},1000)
			}
		});
	}
}

function appendPage(param = [])
{
	var formId = (typeof param['formId'] === 'undefined') ? 'dataFormPage' : param['formId'];
	var formAppend = (typeof param['formAppend'] === 'undefined') ? 'dataFormPage' : param['formAppend'];
	$('#'+formId).append(`
		<div class="loadings" >Loading&#8230;</div>
		`);
	if($('#'+formId).form('is valid')){
		$('#'+formId).ajaxSubmit({
			success: function(resp){
				$('.loadings').hide();
				$('.'+formAppend).html(resp);
			},error: function(resp){
				$('.loadings').hide();
				console.log('error',resp)
				if(resp.status == 500)
				{
					swal(
						'Gagal!',
						''+resp.responseJSON.data.message,
						'error'
						);
					clearQueryErrorPage('.content-ayokulakan');
					showQueryErrorPage('.content-ayokulakan',resp.responseJSON.data.message);
				}else if(resp.responseJSON.status == 'kurir'){
					console.log('a')
					swal(
						'Gagal!',
						'Silahkan Pilih Kurir Pengiriman',
						'error'
						);
				}else if(resp.responseJSON.status == 'kurir_tipe'){
					console.log('b')

					swal(
						'Gagal!',
						'Silahkan Pilih Tipe Pengiriman',
						'error'
						);
				}else if(resp.responseJSON.status == 'message'){
					swal(
						'Gagal!',
						''+resp.responseJSON.message,
						'error'
						);
				}else{
					$.each(resp.responseJSON.errors, function(index, val) {
						clearFormErrorFrontEnd(formId, index,val);
						showFormErrorFrontEnd(formId, index,val);
					});
				}
				time = 5;
				interval = setInterval(function(){
					time--;
					if(time == 0){
						clearInterval(interval);
						$('.text-danger.errors.labels').remove();
						$('.error').each(function (index, val) {
							$(val).removeClass('error');
						});
					}
				},1000)
			}
		});
	}
}

function clearFormErrorModalTwo(key, value, formData) {
	if (key.includes(".")) {
		res = key.split('.');
		key = res[0] + '[' + res[1] + ']';
		if (res[1] == 0) {
			key = res[0] + '\\[\\]';
		}
            // 
        }
        var elm = $(formData).find('[name="' + key + '"]');
        $(elm).removeClass('has-error');
        var showerror = $(formData).find('[name="' + key + '"]').find('.control-label.error-label.font-bold').remove();
    }

    function showFormErrorModalTwo(resp, formid){
    	var response = resp.responseJSON;
    	var addErr = {};

    	$.each(response.errors, function (index, val) {
    		var response = resp.responseJSON;
    		if (index.includes(".")) {
    			res = index.split('.');
    			index = '';
    			for (i = 0; i < res.length; i++) {
    				if (i == 0) {
    					res[i] = res[i];
    				} else {
    					if (res[i] == 0) {
    						res[i] = '[0]';
    					} else {
    						res[i] = '[' + res[i] + ']';
    					}
    				}
    				index += res[i];
    			}
    		}
    		clearFormErrorModalTwo(index,val,formid);
    		var name = index.split('.').reduce((all, item) => {
    			all += (index == 0 ? item : '[' + item + ']');
    			return all;
    		});

    		console.log('index',index)
    		console.log('name',name)
    		var fg = $('[name="' + name + '"], [name="' + name + '[]"]');
    		fg.addClass('has-error');

    		fg.after('<small class="control-label error-label font-bold" style="margin-top: 0.25rem;font-size: smaller;color: #ea5455;">' + val + '</small>')
    	});
    	$("html, body").animate({ scrollTop: 0 }, "slow");
    	var intrv = setInterval(function(){
    		$('.error-label').slideUp(500, function(e) {
    			$(this).remove();
    			$('.has-error').removeClass('has-error');
    			clearTimeout(intrv);
    		});
    	}, 14000)
    }
    
    $(document).on('click','.btn.save-modal.save-ayokulakan',function(){
    	var form = $(this).data('form');
    	console.log(form);
    	if(!form){
    		var form = 'dataFormModal';
    	}
    	saveFormModal(form);
    });

    $(document).on('click','.btn.save-modal.save-frontend.next-page',function(){
    	saveGoToPage();
    });

    $(document).on('click', '.btn.save-page.save-ayokulakan', function(e){
    	var ampsTitle = $(this).data('title');
    	var ampsConfirm = $(this).data('confirm');
    	var ampsBatal = $(this).data('batal');
    	if(ampsTitle == undefined){ ampsTitle = 'Yakin Untuk Menyimpan Data Ini' }
    		if(ampsConfirm == undefined){ ampsConfirm = 'Simpan' }
    			if(ampsBatal == undefined){ ampsBatal = 'Batal' }
    				swal({
    					title: ampsTitle,
    					type: 'warning',
    					showCancelButton: true,
    					confirmButtonColor: '#3085d6',
    					cancelButtonColor: '#d33',
    					confirmButtonText: ampsConfirm,
    					cancelButtonText: ampsBatal
    				}).then((result) => {
    					if (result) {
    						saveFormPage();
    					}
    				})
    			});
    $(document).on('click', '.btn.save-page.save-frontend', function(e){
    	var params = [];
    	params['formId'] = $(this).data('forms');
    	swal({
    		title: $(this).data('title'),
    		type: 'warning',
    		showCancelButton: true,
    		confirmButtonColor: '#3085d6',
    		cancelButtonColor: '#d33',
    		confirmButtonText: $(this).data('confirm'),
    		cancelButtonText: $(this).data('batal')
    	}).then((result) => {
    		if (result) {
    			saveFormTransaksi(params);
    		}
    	})
    });

    $(document).on('click', '.check.append.page', function(e){
    	var params = [];
    	params['formId'] = $(this).data('form');
    	params['formAppend'] = $(this).data('append');
    	appendPage(params);
    });


    $(document).on('change', '.child.target', function () {
    	var elemchild = $(this).find('select').data('child');
    	var name = $(this).find('select').data('namas');
    	var id = $(this).find('select').val();
    	if(id != null)
    	{
    		console.log(elemchild);
    		$.ajax({
    			url: '{{ url("option") }}/'+ elemchild +'/'+ id,
    			type: 'GET',
    			success: function(resp){
    				console.log('asd',resp)
    				$('body').find('.changeSelects').remove();
    				$('#'+elemchild).html('<select name="'+name+'" class="form-control selectpicker" required="" data-dropup-auto="false" data-size="10" data-style="none" data-live-search="true">'+ resp +'</select>');

    				$('.selectpicker').selectpicker();

    			},
    			error : function(resp){

    			}
    		});
    	}
    });

    $(document).on('change', '.child-new.target-new.dynamic-more-than-5-select', function () {
    	var elemchild = $(this).data('arraynama');
	// console.log('elemchild',elemchild,'val',$(this).val(),'this',$(this).data('arraynama'))
	if(elemchild != undefined){
		var ampas = elemchild.split(',');
		var sliceAmpas = ampas.slice(1);
		var resultAmpas = '';
		$.each(sliceAmpas,function(v,k){
			resultAmpas += k+',';
		});
		var name = ampas[0];
		var id = $(this).val();
		if(id != null)
		{
			$.ajax({
				url: '{{ url("option") }}/'+ name +'/'+ id,
				type: 'GET',
				success: function(resp){
					$('body').find('.'+name).remove();
					$('#'+name).html('<select name="'+name+'" class="form-control child-new target-new dynamic-more-than-5-select custom-select '+name+'" required="" data-dropup-auto="false" data-size="10" data-style="none" data-arraynama="'+resultAmpas+'" data-live-search="true">'+ resp +'</select>');

					$('.selectpicker').selectpicker();

				},
				error : function(resp){

				}
			});
		}
	}
});

    $(document).on('change', '.child.target.dynamic-more-than-5-select', function () {
    	var elemchild = $(this).find('select').data('arraynama');
    	console.log('elemchild',elemchild,'val',$(this).val(),'this',$(this).data('arraynama'))
    	if(elemchild != undefined){
    		var ampas = elemchild.split(',');
    		var sliceAmpas = ampas.slice(1);
    		var resultAmpas = '';
    		$.each(sliceAmpas,function(v,k){
    			resultAmpas += k+',';
    		});
    		var name = ampas[0];
    		var id = $(this).find('select').val();
    		if(id != null)
    		{
    			$.ajax({
    				url: '{{ url("option") }}/'+ name +'/'+ id,
    				type: 'GET',
    				success: function(resp){
    					$('body').find('.'+name).remove();
    					$('#'+name).html('<select name="'+name+'" class="form-control child target dynamic-more-than-5-select selectpicker '+name+'" required="" data-dropup-auto="false" data-size="10" data-style="none" data-arraynama="'+resultAmpas+'" data-live-search="true">'+ resp +'</select>');

    					$('.selectpicker').selectpicker();

    				},
    				error : function(resp){

    				}
    			});
    		}
    	}
    });

    $(document).ready(function(){

    	$('.date').calendar({
    		type: 'date',
    		text: {
    			months: ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"],
    		},
    	});
    	$('.year').calendar({
    		type: 'year',
    	});
    	$('.month').calendar({
    		type: 'month',
    		disableMonth: false,
    	});
    	$('.summernote').summernote({
    		height: 50,
    	});

    	function convertToRupiah(angka)
    	{
    		var rupiah = '';
    		var angkarev = angka.toString().split('').reverse().join('');
    		for(var i = 0; i < angkarev.length; i++) if(i%3 == 0) rupiah += angkarev.substr(i,3)+'.';
    			var hasil = ''+rupiah.split('',rupiah.length-1).reverse().join('');
    		if(hasil == 'NaN'){
    			hasil = '';
    		}else{
    			hasil = hasil+',00';
    		}
    		return hasil;
    	}

    	function convertToAngka(rupiah)
    	{	
    		var ret = 0;
    		if(rupiah){
    			ret = parseInt(rupiah.replace(/,.*|[^0-9]/g, ''), 10);
    		}
    		return ret;
    	}

	// $(document).on('keyup','.change-money-page',function(){
	// 	var val = $(this).val();
	// 	var id = $(this).data('money');
	//     console.log('mone');
	//     var convert = convertToRupiah(convertToAngka(val));
	//     $('input[data-money='+id+']').val(convert);

	// });
	const anElement = AutoNumeric.multiple('.change-money-page', {
		'digitGroupSeparator': '.',
		'decimalPlaces': '2',
		'decimalCharacter': ',',
		'currencySymbol': 'Rp.',
	});

	// $(window).keydown(function(event){
	// 	if(event.keyCode == 13) {
	// 		console.log('asd')
	// 		event.preventDefault();
	// 		return false;
	// 	}
	// });

	clearQueryErrorModal =  function (formName)
	{
		$(formName).find('.content-ayokulakan').find(`.error.500`).remove();
	}

	showQueryErrorModal =  function (formName, message)
	{

		$(formName).find('.content-ayokulakan').prepend(`<div class="ui negative message error 500">
			<div class="alert alert-danger" role="alert">
			<h4 class="alert-heading">Warning!</h4>
			<p>`+ message +`</p>
			<hr>
			<p class="mb-0">Sorry Trouble Comes up, call the developer to fix it!</p>
			</div>`);
	}

	showFormErrorModal = function(key, value)
	{
		console.log('keys',key,'value',value)

		if(key.includes("."))
		{
			res = key.split('.');
			key = res[0] + '[' + res[1] + ']';

			if(res[1] == 0)
			{
				key = res[0] + '\\[\\]';
			}else if($.isNumeric(res[2])){
				key = '"'+ res[0] + '[' + res[1] + ']' + '[]"';
			}
		}
		var elm = $('#dataFormModal' + ' [name=' + key + ']').closest('.form-group');

		$(elm).addClass('error');
		var message = `<p class="text-danger errors labels" style="position: relative;bottom: 2px;">` + value + `</p>`;

		var showerror = $('#dataFormModal' + ' [name=' + key + ']').closest('.form-group');
		$(showerror).append('<p class="text-danger errors labels" style="position: relative;bottom: 2px;">' + value + '</p>');


	}

	clearFormErrorModal = function(key, value)
	{
		if(key.includes("."))
		{
			res = key.split('.');
			key = res[0] + '[' + res[1] + ']';
			if(res[1] == 0)
			{
				key = res[0] + '\\[\\]';
			}else if($.isNumeric(res[2])){
				key = '"'+ res[0] + '[' + res[1] + ']' + '[]"';
			}
		}
		var elm = $('#dataFormModal' + ' [name=' + key + ']').closest('.form-group');
		$(elm).removeClass('error');

		var showerror = $('#dataFormModal' + ' [name=' + key + ']').closest('.form-group').find('.text-danger.errors.labels').remove();
	}

	 // FOR FORM PAGE ERROR

	 clearQueryErrorPage =  function (formName)
	 {
	 	$(formName).find('.content-ayokulakan').find(`.error.500`).remove();
	 }

	 showQueryErrorPage =  function (formName, message)
	 {

	 	$(formName).find('.content-ayokulakan').prepend(`<div class="ui negative message error 500">
	 		<div class="alert alert-danger" role="alert">
	 		<h4 class="alert-heading">Warning!</h4>
	 		<p>`+ message +`</p>
	 		<hr>
	 		<p class="mb-0">Sorry Trouble Comes up, call the developer to fix it!</p>
	 		</div>`);
	 }

	 showFormErrorPage = function(key, value)
	 {
	 	if(key.includes("."))
	 	{
	 		res = key.split('.');
	 		key = res[0] + '[' + res[1] + ']';
	 		if(res[1] == 0)
	 		{
	 			key = res[0] + '\\[\\]';
	 		}
	 	}
	 	var elm = $('#dataFormPage' + ' [name=' + key + ']').closest('.form-group');
	 	$(elm).addClass('error');
	 	var message = `<p class="text-danger errors labels" style="position: relative;bottom: 2px;">` + value + `</p>`;

	 	var showerror = $('#dataFormPage' + ' [name=' + key + ']').closest('.form-group');
	 	$(showerror).append('<p class="text-danger errors labels" style="position: relative;bottom: 2px;">' + value + '</p>');
	 }

	 clearFormErrorPage = function(key, value)
	 {
	 	if(key.includes("."))
	 	{
	 		res = key.split('.');
	 		key = res[0] + '[' + res[1] + ']';
	 		if(res[1] == 0)
	 		{
	 			key = res[0] + '\\[\\]';
	 		}
	 	}
	 	var elm = $('#dataFormPage' + ' [name=' + key + ']').closest('.form-group');
	 	$(elm).removeClass('error');

	 	var showerror = $('#dataFormPage' + ' [name=' + key + ']').closest('.form-group').find('.text-danger.errors.labels').remove();
	 }


	 $(document).on('click','.show.front-load-show', function(e){
	    // console.log('asdasdasdas')

	    // var titlemodal = $(this).data('titlemodal');
	    // var obj = {};
	    // obj.titlemodal = titlemodal;


	    var id = $(this).data('id');
	    // var name = $(this).data('name');
	    var url = "{{ url('sc/barang') }}/"+id;
		window.location.href = url;
	    // loadModal(url,id,obj);
	});

	 $(document).on('click','.show.custom-front-load-show', function(e){
	    // console.log('asdasdasdas')

	    var titlemodal = $(this).data('titlemodal');
	    var obj = {};
	    obj.titlemodal = titlemodal;

	    var url = $(this).data('url');

	    loadModal(url,$(this).data('id'),obj);
	});



	 $(document).on('click','.product-details-small a', function(e) {
	 	e.preventDefault();

	 	var $href = $(this).attr('href');

	 	$('.product-details-small a').removeClass('active');
	 	$(this).addClass('active');

	 	$('.product-details-large .tab-pane').removeClass('active');
	 	$('.product-details-large ' + $href).addClass('active');
	 });
	});


</script>
