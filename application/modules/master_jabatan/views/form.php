<form id="fm" class="form-horizontal form-label-left">
	<?= _input('id',[],$id,'hidden'); ?>
	<div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Kode Jabatan <span class="required">*</span>
        </label>
        <div class="col-md-3 col-sm-3 col-xs-12">
			<?php $readonly = isset($row) ? [] : [] ; ?>
			<?= input_text('kode_jabatan',array_merge(['class'=>'form-control col-md-7 col-xs-12'],$readonly),@$row->kode_jabatan); ?>
		</div>
    </div>
	<div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Nama Jabatan <span class="required">*</span>
        </label>
        <div class="col-md-6 col-sm-6 col-xs-12">
			<?= input_text('nama_jabatan',['class'=>'form-control col-md-12 col-xs-12'],@$row->nama_jabatan); ?>
		</div>
    </div>
	<div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Deskripsi Jabatan <span class="required">*</span>
        </label>
        <div class="col-md-6 col-sm-6 col-xs-12">
			<?= textarea('deskripsi_jabatan',['class'=>'form-control col-md-12 col-xs-12'],@$row->deskripsi_jabatan); ?>
		</div>
    </div>
	<div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Eselon <span class="required">*</span>
        </label>
        <div class="col-md-6 col-sm-6 col-xs-12">
			<?= generate_select_input(master_eselon(),'--Pilih Eselon--',["name"=>"eselon","class"=>"form-control"],@$row->eselon); ?>
		</div>
    </div>
</form>

<script>
	var form = $('#fm');
		form.validate({
			rules:{
				kode_jabatan : {
					required:true,
					<?php if (!isset($row)) : ?>
					remote: {
						url : '<?= site_url('master_jabatan/cek_kode'); ?>',
						type : 'post',
						data : {
							kode_jabatan : function() {
								return $('#kode_jabatan').val();
							}
						}
					}
					<?php endif; ?>
				},
				nama_jabatan : {
					required:true,
				},
				deskripsi_jabatan : {
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
			$.post('<?= site_url('master_jabatan/save'); ?>',form.serialize()).done(function(result){
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