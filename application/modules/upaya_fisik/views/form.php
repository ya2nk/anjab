<form id="fm" class="form-horizontal form-label-left">
	<?= _input('id',[],$id,'hidden'); ?>
	<div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Nama<span class="required">*</span>
        </label>
        <div class="col-md-8 col-sm-8 col-xs-12">
			<?php $readonly = [] ; ?>
			<?= input_text('nama',array_merge(['class'=>'form-control col-md-12 col-xs-12'],$readonly),@$row->nama); ?>
		</div>
    </div>
	
	<div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Keterangan <span class="required">*</span>
        </label>
        <div class="col-md-8 col-sm-8 col-xs-12">
			<?= textarea('keterangan',['class'=>'form-control col-md-12 col-xs-12'],@$row->keterangan); ?>
		</div>
    </div>
	
</form>

<script>
	var form = $('#fm');
		form.validate({
			rules:{
				nama : {
					required:true,
				},
				
				keterangan : {
					required:true
				}
			}
		})
	function saveForm()
	{
		if(form.valid()){
			$.post('<?= site_url('upaya_fisik/save'); ?>',form.serialize()).done(function(result){
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