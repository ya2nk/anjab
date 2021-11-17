<form id="fm" class="form-horizontal form-label-left">
	<?= _input('id',[],$id,'hidden'); ?>
	<div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Kode<span class="required">*</span>
        </label>
        <div class="col-md-2 col-sm-2 col-xs-12">
			<?php $readonly = isset($row) ? ['readonly'=>'readonly'] : [] ; ?>
			<?= input_text('kode',array_merge(['class'=>'form-control col-md-12 col-xs-12'],$readonly),@$row->kode); ?>
		</div>
    </div>
	<div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Nama<span class="required">*</span>
        </label>
        <div class="col-md-6 col-sm-6 col-xs-12">
			<?= input_text('nama',['class'=>'form-control col-md-12 col-xs-12'],@$row->nama); ?>
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
				kode : {
					required:true,
					<?php if (!isset($row)) : ?>
					remote: {
						url : '<?= site_url('temperamen/cek_kode'); ?>',
						type : 'post',
						data : {
							kode : function() {
								return $('#kode').val();
							}
						}
					}
					<?php endif; ?>
				},
				bakat : {
					required:true
				},
				keterangan : {
					required:true
				}
			}
		})
	function saveForm()
	{
		if(form.valid()){
			$.post('<?= site_url('temperamen/save'); ?>',form.serialize()).done(function(result){
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