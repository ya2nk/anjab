<?= load_datatable(); ?>
<div class="page-title">
    <div class="title_left">
        <h3>DATA JABATAN</h3>
    </div>
	
</div>
<div class="clearfix"></div>

<div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Data Jabatan</h2>
                    <ul class="nav navbar-right panel_toolbox">
						<li><a href="javascript:void(0)" onclick="$('#modal-filter').modal('show')"  class="btn btn-success"><i class="fa fa-search"></i> Cari</a></li>
						<li><a href="#" onclick="history.back()" class="btn btn-warning"><i class="fa fa-arrow-left"></i> Kembali</a></li>
                    </ul>
					<div class="clearfix"></div>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    
                    <table id="myTable" class="table table-striped table-bordered dt-responsive" width="100%">
                      <thead>
                        <tr>
                          <th>No</th>
                          <th>Nama Jabatan</th>
						   <th>Unit Kerja</th>
                          <th>Aksi</th>
                        </tr>
                      </thead>
					  
					</table>
				  </div>
				</div>
	</div>
</div>

<div class="modal fade" id="modal-filter" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<a href="javascript:void(0)" class="modal-close pull-right" data-dismiss="modal" aria-label="Close">
						<i class="fa fa-times"></i>
					</a>
					<h4 class="modal-title" id="myModalLabel">FILTER</h4>
				</div>
			<div class="modal-body">
				<form id="fm" class="form-horizontal form-label-left">	
					<div class="form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Unit Kerja</label>
							<div class="col-md-6 col-sm-6 col-xs-12">
								<?= generate_select_input($unit_kerja,'--Pilih Unit Kerja--',["name"=>"unit_kerja",'id'=>'unit_kerja',"class"=>"form-control",'onchange'=>'unitKerjaSelect(this,"#jpt_pratama")'],@$row->jpt_madya); ?>
							</div>
								
						</div>
						<div class="form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">JPT Pratama</label>
							<div class="col-md-6 col-sm-6 col-xs-12">
								<select class="form-control" name="jpt_pratama" id="jpt_pratama" onchange="unitKerjaSelect(this,'#administrator')" >
								</select>
							</div>
								
						</div>
						
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-rounded btn-default" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-rounded btn-primary" onclick="doFilter()">Lihat</button>
			</div>
			</div>
		</div>
	</div><!--.modal-->
<script>
	
	$(function(){
		$('#modal-filter').modal('show');
		table = $('#myTable').DataTable({
			"processing": true,
			"serverSide": true,
			"ajax": {
				"url": "<?= site_url('anjab/data'); ?>",
				"type":"POST",
				"data": function ( d ) {
					d.unit_kerja  = $('#unit_kerja').val();
					d.jpt_pratama = $('#jpt_pratama').val();
					
				}
			},
			"columns": [
				{ "data": "no","orderable":false},
				{ "data": "nama_jabatan" },
				{ "data": "unit_kerja" },
				{ "data": "action" ,"orderable":false}
			],
			"initComplete": function(settings, json) {
				$('[data-toggle="tooltip"]').tooltip();
			},
			"order": [[0, 'asc']],
		});
	});
	
	
	
	function deleteData(id)
	{
		$_confirm(function(){
			$.post('<?= site_url('anjab/delete'); ?>',{id:id},function(result){
				if (result == 'success'){
					$.alert('Data Berhasil Dihapus');
					table.draw();
				} else {
					$.alert(result,'ERROR');
				}
			})
		})
	}
	
	function unitKerjaSelect(that,target,$value=0)
	{
		idUnit = that.value;
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
		
	}
	
	function doFilter()
	{
		table.draw();
		$('#modal-filter').modal('hide')
	}
</script>