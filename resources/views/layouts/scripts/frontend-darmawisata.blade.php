<script src="{{ env('MIDTRANS_PLUGIN') }}" data-client-key="{{ config('services.midtrans.clientKey') }}"></script>
<script type="text/javascript">
	function clearFormErrorDarma(key, value, formData) {
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

    function showFormErrorDarma(resp, formid){
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
            clearFormErrorDarma(index,val,formid);
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

	function darmaSaveRender(dataForm = null)
	{	
		if(dataForm == null){
			dataForm = '#FormPage';
		}
		console.log('dataForm',dataForm)
		if($(""+dataForm).form('is valid')){
			$(""+dataForm).ajaxSubmit({
				success: function(resp){
					if(resp.url){
						window.location = resp.url;
					}
				},
				error: function(resp){
					if(resp.responseJSON.check){
						swal(
							''+resp.responseJSON.messTitle,
							''+resp.responseJSON.messSub,
							'warning'
						);
					}else{
						swal(
							''+resp.messTitle,
							showBoxValidation(resp),
							'warning'
						);
					}

					showFormErrorDarma(resp,dataForm);
				}
			});
		}
	}

	function darmaSaveDynamic(dataForm = null)
	{

		if(dataForm == null){
			dataForm = '#FormPage';
		}

		if($(""+dataForm).form('is valid')){
			$(""+dataForm).ajaxSubmit({
				success: function(resp){
					if(resp.transaksi){
						swal(
							'Booked!',
							'Sukses membayar.',
							'success'
						).then((result) => {
							if(resp.url){
								window.location = resp.url;
							}
						})
					}else{
						swal(
							'Tersimpan!',
							'Data Berhasil Di Simpan.',
							'success'
						).then((result) => {
							if(resp.url){
								window.location = resp.url;
							}
						})
					}
				},
				error: function(resp){
					if(resp.check){
						swal(
							''+resp.messTitle,
							''+resp.messSub,
							'warning'
						);
					}else{
						swal(
							''+resp.messTitle,
							showBoxValidation(resp),
							'warning'
						);
					}

					showFormErrorDarma(resp,dataForm);

				}
			});
		}
	}

	function darmaFormTransaksi(dataForm = [])
	{
		if(dataForm == null){
			dataForm = '#FormPage';
		}
		console.log('dataForm',dataForm)
		if($(""+dataForm).form('is valid')){
			$(""+dataForm).ajaxSubmit({
				success: function(resp){
					snap.pay(resp.record.snap_token, {
		                // Optional
		                onSuccess: function (result) {
		                    swal(
							'Sukses!',
							'Transaksi Berhasil.',
							'success'
							).then((result) => {
								if(resp.url){
									window.location = resp.url;
								}
							})
		                },
		                // Optional
		                onPending: function (result) {
						console.log('pendinf',result)

		                    swal(
							'Silahkan Lanjutkan Pembayaran!',
				            ''+result.status_message+'',
				            'success'
							).then((result) => {
								if(resp.url){
									window.location = resp.url;
								}
							})
		                },
		                // Optional
		                onError: function (result) {
						console.log('Onerror',result)
		                    swal(
							'Gagal!',
				            ''+result.status_message+'',
				            'warning'
							).then((result) => {
								if(resp.url){
									window.location = resp.url;
								}
							})
		                },onClose: function(result){
		                	$.ajax({
								url: "{{ url('transaksi/delete') }}",
								type: 'POST',
								data: {_token: "{{ csrf_token() }}", _method: "POST", id:resp.record.id},
								success: function(resp){
									if(resp.url){
										window.location = resp.url;
									}
								},
								error : function(resp){
								}
							});
		                }
		            });
				},
				error: function(resp){
					if(resp.responseJSON.check){
						swal(
							''+resp.responseJSON.messTitle,
							''+resp.responseJSON.messSub,
							'warning'
						);
					}else{
						swal(
							''+resp.messTitle,
							showBoxValidation(resp),
							'warning'
						);
					}

					showFormErrorDarma(resp,dataForm);
				}
			});
		}
	}

	$(document).on('click','.darma-save-dynamic',function(){
		var form = $(this).data('form');
		darmaSaveDynamic(form);
	});

	$(document).on('click','.darma-save-render',function(){
		var form = $(this).data('form');
		darmaSaveRender(form);
	});

	$(document).on('click','.darma-save-transaksi-render',function(){
		var form = $(this).data('form');
		darmaFormTransaksi(form);
	});


</script>