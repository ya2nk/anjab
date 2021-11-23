<form id="fm" class="form-horizontal form-label-left">
	<?= _input('id',[],$id,'hidden'); ?>
	<div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Eselon <span class="required">*</span>
        </label>
        <div class="col-md-6 col-sm-6 col-xs-12">
			<?= generate_select_input(master_eselon(),'--Pilih Eselon--',["name"=>"eselon","class"=>"form-control"],@$row->eselon); ?>
		</div>
    </div>
	<div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Aspek <span class="required">*</span>
        </label>
        <div class="col-md-8 col-sm-8 col-xs-12">
			
			<?= textarea('aspek',['class'=>'form-control col-md-7 col-xs-12'],@$row->aspek); ?>
		</div>
    </div>
	<div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Faktor <span class="required">*</span>
        </label>
        <div class="col-md-8 col-sm-8col-xs-12">
			<?= textarea('faktor',['class'=>'form-control col-md-12 col-xs-12'],@$row->faktor); ?>
		</div>
    </div>
	
	
</form>

<script>
	var form = $('#fm');
		form.validate({
			rules:{
				
				aspek : {
					required:true,
				},
				faktor : {
					required:true
				},
				eselon : {
					required:true
				}
			}
		})
	function saveForm()
	{
		if(form.valid()){
			$.post('<?= site_url('lingkungan_kerja/save'); ?>',form.serialize()).done(function(result){
				if (result == 'success'){
					$.alert('Data Berhasil disimpan');
					$('#myModal').modal('hide');
					table.draw(false);
				} else {
					$.alert(result);
				}
			}).fail(function(xhr){
				$.alert(xhr.responseText);
			});
		}
	}
</script>