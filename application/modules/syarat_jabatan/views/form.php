<form id="fm" class="form-horizontal form-label-left">
	<?= _input('id',[],$id,'hidden'); ?>
	<div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Nama Jabatan <span class="required">*</span>
        </label>
        <div class="col-md-6 col-sm-6 col-xs-12">
			<?= generate_select_input($jabatan,'--Pilih Jabatan--',["name"=>"id_jabatan","class"=>"form-control select2",'style'=>'width:100%'],@$row->id_jabatan); ?>
		</div>
    </div>
	<div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">jenis <span class="required">*</span>
        </label>
        <div class="col-md-6 col-sm-6 col-xs-12">
			<?= generate_select_input(['Pangkat/Golongan' => 'Pangkat/Golongan',
										'Pendidikan'=>'Pendidikan',
									   'Diklat'=>'Diklat',
									   'Pengalaman'=>'Pengalaman']
									 ,'--Pilih Jenis--',
									 ["name"=>"jenis","class"=>"form-control"],
									 @$row->jenis); ?>
		</div>
    </div>
	<div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Deskripsi Jabatan <span class="required">*</span>
        </label>
        <div class="col-md-6 col-sm-6 col-xs-12">
			<?= textarea('syarat_jabatan',['class'=>'form-control col-md-12 col-xs-12'],@$row->syarat_jabatan); ?>
		</div>
    </div>
	
</form>

<script>
	var form = $('#fm');
		form.validate({
			rules:{
				id_jabatan : {
					required:true,
					
				},
				jenis : {
					required:true,
				},
				syarat_jabatan : {
					required:true
				},
				
			}
		})
		
	$('.select2').select2();
	function saveForm()
	{
		if(form.valid()){
			$.post('<?= site_url('syarat_jabatan/save'); ?>',form.serialize()).done(function(result){
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