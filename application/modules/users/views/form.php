<form id="fm" class="form-horizontal form-label-left">
	<?= _input('id',[],$id,'hidden'); ?>
	<div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Username<span class="required">*</span>
        </label>
        <div class="col-md-8 col-sm-8 col-xs-12">
			<?php $readonly = isset($row) ? ['readonly'=>'readonly'] : [] ; ?>
			<?= input_text('username',array_merge(['class'=>'form-control col-md-12 col-xs-12'],$readonly),@$row->username); ?>
		</div>
    </div>
	<div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Password<span class="required">*</span>
        </label>
        <div class="col-md-8 col-sm-8 col-xs-12">
			<?= _input('password',['class'=>'form-control col-md-12 col-xs-12'],"",'password'); ?>
		</div>
    </div>
	<div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Nama<span class="required">*</span>
        </label>
        <div class="col-md-8 col-sm-8 col-xs-12">
			<?= input_text('nama',['class'=>'form-control col-md-12 col-xs-12'],@$row->nama); ?>
		</div>
    </div>
	<div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Role <span class="required">*</span>
        </label>
        <div class="col-md-8 col-sm-8 col-xs-12">
			<?= generate_select_input(['1'=>'Admin',
									   '2'=>'Users']
									 ,'--Pilih Role--',
									 ["name"=>"role","class"=>"form-control"],
									 @$row->role); ?>
		</div>
    </div>
	<div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Unit Kerja <span class="required">*</span>
        </label>
        <div class="col-md-8 col-sm-8 col-xs-12">
			<?= generate_select_input($unit_kerja
									 ,'--Pilih Unit Kerja--',
									 ["name"=>"id_unit_kerja","class"=>"form-control"],
									 @$row->id_unit_kerja); ?>
		</div>
    </div>
	
</form>

<script>
	var form = $('#fm');
		form.validate({
			rules:{
				username : {
					required:true,
					
				},
				nama : {
					required:true
				},
				status : {
					required:true
				}
			}
		})
	function saveForm()
	{
		if(form.valid()){
			$.post('<?= site_url('users/save'); ?>',form.serialize()).done(function(result){
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