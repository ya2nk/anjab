<form id="fm" class="form-horizontal form-label-left">
	<?= _input('id',[],$id,'hidden'); ?>
	
	<div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Keterampilan <span class="required">*</span>
        </label>
        <div class="col-md-8 col-sm-8 col-xs-12">
			<?= textarea('keterampilan',['class'=>'form-control col-md-12 col-xs-12'],@$row->keterampilan); ?>
		</div>
    </div>
	
</form>

<script>
	var form = $('#fm');
		form.validate({
			rules:{
				keterampilan : {
					required:true
				}
			}
		})
	function saveForm()
	{
		if(form.valid()){
			$.post('<?= site_url('keterampilan/save'); ?>',form.serialize()).done(function(result){
				if (result == 'success'){
					$.alert('Data Berhasil disimpan');
					$('#myModal').modal('hide');
					table.draw();
				} else {
					$.alert(result);
				}
			}).fail(function(xhr){
				$.alert(xhr.responseText);
			});
		}
	}
</script>