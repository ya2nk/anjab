<form id="fm" class="form-horizontal form-label-left">
	<?= _input('id',[],$id,'hidden'); ?>
	
	<div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Jabatan <span class="required">*</span>
        </label>
        <div class="col-md-6 col-sm-6 col-xs-12">
			<?= generate_select_input($jabatan,'--Pilih Jabatan--',["name"=>"id_jabatan","class"=>"form-control select2",'style'=>'width:100%'],@$row->id_jabatan); ?>
		</div>
    </div>
	<div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Tugas Pokok <span class="required">*</span>
        </label>
        <div class="col-md-6 col-sm-6 col-xs-12">
			<?= textarea('tugas_pokok',['class'=>'form-control col-md-12 col-xs-12'],@$row->tugas_pokok); ?>
		</div>
    </div>
	
		<div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Hasil Kerja <span class="required">*</span>
        </label>
        <div class="col-md-6 col-sm-6 col-xs-12">
			<?= textarea('hasil_kerja_asli',['class'=>'form-control col-md-12 col-xs-12'],@$row->hasil_kerja_asli); ?>
		</div>
    </div>
	
	<div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Tahapan Kerja <span class="required">*</span>
        </label>
		<div class="col-md-2">
				<button class="btn btn-success add-tahapan" type="button"><span class="fa fa-plus"></span></button>
		</div>
	</div>
	<div id="tagsForm" class="sortable">
		<?php if (isset($row)) : $tahapan = json_decode($row->tahapan_kerja); if (is_array($tahapan)) : if (count($tahapan) > 0) : foreach ($tahapan as $thp) : ?>
			<div class="form-group">
				<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
					<input type="text" name="tahapan_kerja[]" class="form-control" placeholder="Tahapan Kerja" value="<?= $thp; ?>">
				</div>
				<div class="col-md-2">
					<button class="btn btn-danger deleteGroup" type="button"><span class="fa fa-trash"></span></button>
					<span class="btn btn-default move" type="button"><span class="fa fa-arrows"></span></span>
				</div>
			</div>
		<?php endforeach; endif; endif; endif; ?>
    </div>
	
	
	
</form>
<style>
	 .ui-state-highlight { height: 2em; line-height: 1.2em;width:60%;margin:auto}
</style>
<script>
	var form = $('#fm');
		form.validate({
			rules:{
				id_jabatan : {
					required:true,
					
				},
				tugas_pokok : {
					required:true,
				},
				hasil_kerja : {
					required:true
				},
				jumlah_beban : {
					required:true,
					number:true
				},
				waktu_penyelesaian : {
					required:true,
					number:true
				},
				
			}
		});
	$('.select2').select2();
	$( "#tagsForm" ).sortable({connectWith: ".sortable",placeholder: "ui-state-highlight"});
	$('.add-tahapan').click(function(){
		$( "#tagsForm" ).append('<div class="form-group">'+
									'<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">'+
										'<input type="text" name="tahapan_kerja[]" class="form-control" placeholder="Tahapan Kerja">'+
									'</div>'+
									'<div class="col-md-2">'+
									'<button class="btn btn-danger deleteGroup" type="button"><span class="fa fa-trash"></span></button>'+
									'<span class="btn btn-default move" type="button"><span class="fa fa-arrows"></span></span>'+
									'</div></div>');
	});
	$(document).on('click', '.deleteGroup', function(event) {
		$(this).closest('.form-group').remove();
	})
	function saveForm()
	{
		if(form.valid()){
			$.post('<?= site_url('tugas_pokok_jabatan/save'); ?>',form.serialize()).done(function(result){
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