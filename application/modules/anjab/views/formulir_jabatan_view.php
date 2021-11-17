<div class="page-title">
    <div class="title_left">
        <h3>PETA JABATAN</h3>
    </div>
	
</div>
<div class="clearfix"></div>

<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
			<div class="x_content">
				<form class="form-horizontal" target="_blank" action="<?= site_url('laporan/jabatan'); ?>">
				<div class="form-group">
					<label class="col-md-2 col-sm-2 col-xs-12" for="first-name">JABATAN</label>
					<div class="col-md-6 col-sm-6 col-xs-12">
						<?= generate_select_input([],'--Pilih jabatan--',["name"=>"id_jabatan","id"=>"unit_kerja","class"=>"form-control select2"]); ?>
					</div>
				</div>
					
				<div class="form-group">
					<button class="btn btn-primary" onclick="lapJabatan()">Lihat Laporan</button>
				</div>
				</form>
			</div>
		</div>
	</div>
</div>

<script>
$(function(){
	$('.select2').select2({
		ajax: {
			url: '<?= site_url('master_jabatan/select'); ?>',
			delay: 350,
			dataType: 'json',
		}
	});
});


	
</script>