<?= load_datatable(); ?>
<div class="page-title">
    <div class="title_left">
        <h3>MASTER SYARAT JABATAN</h3>
    </div>
	
</div>
<div class="clearfix"></div>

<div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Data Syarat jabatan</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a href="javascript:void(0)" onclick="loadForm(0)" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah</a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <div class="panel panel-default">
						<div class="panel-body">
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Jabatan <span class="required">*</span>
								</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<?= generate_select_input($jabatan,'--Pilih Jabatan--',["name"=>"id_jabatan","id"=>"id_jab","class"=>"form-control select2"],@$row->id_jabatan); ?>
								</div>
							</div>
						</div>
						<div class="panel-footer">
							<button class="btn btn-primary" type="button" onclick="doSearch()"><i class="fa fa-search"></i> Cari</button>
						</div>
					</div>
                    <table id="myTable" class="table table-striped table-bordered dt-responsive" width="100%">
                      <thead>
                        <tr>
                          <th>No</th>
                          <th>Nama jabatan</th>
                          <th>Jenis</th>
                          <th>Syarat Jabatan</th>
                          <th>Aksi</th>
                        </tr>
                      </thead>
					  
					</table>
				  </div>
				</div>
	</div>
</div>

<div class="modal fade" id="myModal"  role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<a href="javascript:void(0)" class="modal-close pull-right" data-dismiss="modal" aria-label="Close">
						<i class="fa fa-times"></i>
					</a>
					<h4 class="modal-title" id="myModalLabel">Form Master Syarat Jabatan</h4>
				</div>
			<div class="modal-body">
								...
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-rounded btn-default" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-rounded btn-primary" onclick="saveForm()">Save changes</button>
			</div>
			</div>
		</div>
	</div><!--.modal-->

<script>
	$(function(){
		table = $('#myTable').DataTable({
			"processing": true,
			"serverSide": true,
			"ajax": {
				"url": "<?= site_url('syarat_jabatan/data'); ?>",
				"type":"POST",
				"data": function ( d ) {
					d.id_jabatan = $('#id_jab').val();
					
				}
			},
			"columns": [
				{ "data": "no","orderable":false},
				{ "data": "nama_jabatan" },
				{ "data": "jenis" },
				{ "data": "syarat_jabatan" },
				{ "data": "action" ,"orderable":false}
			],
			"initComplete": function(settings, json) {
				$('[data-toggle="tooltip"]').tooltip();
			},
			"order": [[0, 'asc']],
		});
		
		$('.select2').select2();
	});
	
	function loadForm(id)
	{
		$('.modal-body').html('');
		$.post('<?= site_url('syarat_jabatan/form'); ?>',{id:id}).done(function(result){
			$('.modal-body').html(result);
			$('#myModal').modal('show');
		}).fail(function(xhr){
			alert(xhr.responseText);
		});
	}
	
	function doSearch()
	{
		table.draw();
	}
	
	function deleteData(id)
	{
		$_confirm(function(){
			$.post('<?= site_url('syarat_jabatan/delete'); ?>',{id:id},function(result){
				if (result == 'success'){
					$.alert('Data Berhasil Dihapus');
					table.draw();
				} else {
					$.alert(result,'ERROR');
				}
			})
		})
	}
</script>