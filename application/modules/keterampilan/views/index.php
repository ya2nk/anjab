<?= load_datatable(); ?>
<div class="page-title">
    <div class="title_left">
        <h3>MASTER KETERAMPILAN</h3>
    </div>
	
</div>
<div class="clearfix"></div>

<div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Data Master Keterampilan Kerja</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a href="javascript:void(0)" onclick="loadForm(0)" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah</a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    
                    <table id="myTable" class="table table-striped table-bordered dt-responsive" width="100%">
                      <thead>
                        <tr>
                          <th>No</th>
                          <th>Keterampilan</th>
                          <th>Aksi</th>
                        </tr>
                      </thead>
					  
					</table>
				  </div>
				</div>
	</div>
</div>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<a href="javascript:void(0)" class="modal-close pull-right" data-dismiss="modal" aria-label="Close">
						<i class="fa fa-times"></i>
					</a>
					<h4 class="modal-title" id="myModalLabel">Form Keterampilan</h4>
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
				"url": "<?= site_url('keterampilan/data'); ?>",
				"type":"POST",
				"data": function ( d ) {
					d.myKey = "myValue";
					
				}
			},
			"columns": [
				{ "data": "no","orderable":false},
				{ "data": "keterampilan" },
				{ "data": "action" ,"orderable":false}
			],
			"initComplete": function(settings, json) {
				$('[data-toggle="tooltip"]').tooltip();
			},
			"order": [[0, 'asc']],
		});
	});
	
	function loadForm(id)
	{
		$('.modal-body').html('');
		$.post('<?= site_url('keterampilan/form'); ?>',{id:id}).done(function(result){
			$('.modal-body').html(result);
			$('#myModal').modal('show');
		}).fail(function(xhr){
			alert(xhr.responseText);
		});
	}
	
	function deleteData(id)
	{
		$_confirm(function(){
			$.post('<?= site_url('keterampilan/delete'); ?>',{id:id},function(result){
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