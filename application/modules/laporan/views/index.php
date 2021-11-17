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
				<div class="form-horizontal">
				<div class="form-group">
					<label class="col-md-2 col-sm-2 col-xs-12" for="first-name">Unit Kerja</label>
					<div class="col-md-6 col-sm-6 col-xs-12">
						<?= generate_select_input($unit_kerja,'--Pilih Unit Kerja--',["name"=>"unit_kerja","id"=>"unit_kerja","class"=>"form-control","onchange"=>'unitKerjaSelect(this,"#jpt_pratama")']); ?>
					</div>
				</div>
					<div class="form-group">
						<label class="col-md-2 col-sm-2 col-xs-12" for="first-name">JPT Pratama</label>
							<div class="col-md-6 col-sm-6 col-xs-12">
								<select class="form-control" name="jpt_pratama" id="jpt_pratama">
								</select>
							</div>
								
					</div>
				<div class="form-group">
					<button class="btn btn-primary" onclick="petaJabatan()">Lihat Peta jabatan</button>
				</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script>

	function petaJabatan()
	{
		var unit_kerja = $('#unit_kerja').val();
		if (unit_kerja == ''){
			$.alert('Unit Kerja Belum dipilih')
			return;
		}
		window.open('<?= site_url('laporan/peta_jabatan'); ?>/'+unit_kerja+'/'+$('#jpt_pratama').val(),'Peta Jabatan','width=1100');
	}
	
	function unitKerjaSelect(that,target,$value=0)
	{
		$.post('<?= site_url('unit_kerja/select'); ?>',{id:that.value},function(result){
			$(target).empty();
			$(target).html('<option value="">-- Pilih Unit Kerja --</option>');
			if (result.length > 0){
				
				
				$.each(result,function(k,v){
					var selected = "";
					if (v.value == $value){
						selected = "selected";
					}
					$(target).append('<option value="'+v.value+'" '+selected+'>'+v.text+'</option>');
				});
			}
		},'json');
		$('#unit_kerja').val(that.value);
	}
</script>