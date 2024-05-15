<script type="text/javascript">
    function loadModal(url, id = '',data = '') {
	console.log('asd')
        $.get(url, { _token: "{{ csrf_token() }}", id:id } )
        .done(function( response ) {
            if(data.titlemodal !== ''){
                console.log('title',data)
                $('.modal-title').text(data.titlemodal);

            }
            // $('.dropify').dropify();
            $('.form-data').html(response);
            $('#myModal').modal('show');

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
    function saveFormModal(form)
    {
        $(form).ajaxSubmit({
            success: function(resp){
                console.log('resp',resp)
                $("#myModal").modal('hide');
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
    $(document).on('click','.btn-tambah',function(e){
        e.preventDefault();
        var url = "{{ url($pageUrl) }}/create";
        loadModal(url);
    });
    $(document).on('click','.btn-edit',function(e){
        e.preventDefault();
        var id = $(this).data('id');
        console.log(id);
        var url = "{{ url($pageUrl) }}/"+id+"/edit";
        loadModal(url,id);
    });
    $(document).on('click','.btn-simpan',function(){
        var form = '#dataFormModal';
        console.log(form);
        
        saveFormModal(form);   
    });
    $(document).on('click','.btn-edit-simpan',function(){
        var form = '#dataFormModal';
        saveFormModal(form);   
    });
    $(document).ready(function(){
        $('.summernote').summernote();
    });
</script>