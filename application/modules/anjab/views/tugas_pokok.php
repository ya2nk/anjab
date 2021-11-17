<form id="fm-tugas" class="form-horizontal form-label-left">
	<?= _input('id',[],$id,'hidden'); ?>
	<?= _input('id_master_tugas_pokok',[],@$row->id_master_tugas_pokok,'hidden'); ?>
	
	<div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Hasil Kerja <span class="required">*</span>
        </label>
        <div class="col-md-6 col-sm-6 col-xs-12">
			<?= generate_select_input(['Data'=>'Data',
									   'Kegiatan'=>'Kegiatan',
									   'Laporan'=>'Laporan',
									   'Dokumen'=>'Dokumen',
									   'Berkas'=>'Berkas']
									 ,'--Pilih Hasil Kerja--',
									 ["name"=>"hasil_kerja","class"=>"form-control"],
									 @$row->hasil_kerja); ?>
		</div>
    </div>
	<div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Jumlah Beban <span class="required">*</span>
        </label>
        <div class="col-md-6 col-sm-6 col-xs-12">
			<?= _input('jumlah_beban',['class'=>'form-control col-md-12 col-xs-12'],@$row->jumlah_beban,'number'); ?>
		</div>
    </div>
	<div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Waktu Penyelesaian <span class="required">*</span>
        </label>
        <div class="col-md-6 col-sm-6 col-xs-12">
			<?= _input('waktu_penyelesaian',['class'=>'form-control col-md-12 col-xs-12'],@$row->waktu_penyelesaian,'number'); ?>
		</div>
    </div>
</form>

<script>
	var formx = $('#fm-tugas');
	var id_jabatan = '<?= @$row->id_jabatan;?>';
	var ex = {params:{data:{id:id_jabatan}}};
	function saveForm()
	{
		if(formx.valid()){
			$.post('<?= site_url('anjab/save_tugas_pokok'); ?>',formx.serialize()).done(function(result){
				if (result == 'success'){
					$.alert('Data Berhasil diubah');
					$('#myModal').modal('hide');
					onSelectSelect2(ex);
    
				} else {
					$.alert(result);
				}
			}).fail(function(xhr){
				$.alert(xhr.responseText);
			});
		}
	}
</script>