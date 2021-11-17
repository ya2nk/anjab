<?= load_datatable(); ?>
<link href="<?= base_url('assets/vendors/jquery-ui/jquery-ui.min.css'); ?>" rel="stylesheet">
<script src="<?= base_url('assets/vendors/jquery-ui/jquery-ui.min.js'); ?>"></script>
<div class="page-title">
    <div class="title_left">
        <h3>MASTER TUGAS POKOK JABATAN</h3>
    </div>
	
</div>
<div class="clearfix"></div>

<div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Data Tugas Pokok jabatan</h2>
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
                          <th>Kode jabatan</th>
                          <th>Uraian Tugas</th>
                          <th>Hasil kerja</th>
						 
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
					<h4 class="modal-title" id="myModalLabel">Form Tugas Pokok Jabatan</h4>
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
				"url": "<?= site_url('tugas_pokok_jabatan/data'); ?>",
				"type":"POST",
				"data": function ( d ) {
					d.id_jabatan = $('#id_jab').val();;
					
				}
			},
			"columns": [
				{ "data": "no","orderable":false},
				{ "data": "kode_jabatan" },
				{ "data": "tugas_pokok" },
				{ "data": "hasil_kerja_asli" },
				
				{ "data": "action" ,"orderable":false}
			],
			"initComplete": function(settings, json) {
				$('[data-toggle="tooltip"]').tooltip();
				prettyTable('#myTable');
			},
			"order": [[0, 'asc']],
		});
		$('.select2').select2();
		
	});
	
	function loadForm(id)
	{
		$('.modal-body').html('');
		$.post('<?= site_url('tugas_pokok_jabatan/form'); ?>',{id:id}).done(function(result){
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
			$.post('<?= site_url('tugas_pokok_jabatan/delete'); ?>',{id:id},function(result){
				if (result == 'success'){
					$.alert('Data Berhasil Dihapus');
					table.draw();
				} else {
					$.alert(result,'ERROR');
				}
			})
		})
	}
	
	function prettyTable(tableId)
	{
		var span = 1;
		var prevTD = "";
		var prevTDVal = "";
		var span1 = 1;
		var prevTD1 = "";
		var prevTDVal1 = "";
		var span2 = 1;
		var prevTD2 = "";
		var prevTDVal2 = "";
		var span3 = 1;
		var prevTD3 = "";
		var prevTDVal3 = "";
		var span4 = 1;
		var prevTD4 = "";
		var prevTDVal4 = "";
		var span5 = 1;
		var prevTD5 = "";
		var prevTDVal5 = "";
		var span6 = 1;
		var prevTD6 = "";
		var prevTDVal6 = "";
		var span7 = 1;
		var prevTD7 = "";
		var prevTDVal7 = "";
		var span8 = 1;
		var prevTD8 = "";
		var prevTDVal8 = "";
		
		console.log($(tableId));
		$(tableId+" tr").each(function() { 
			
			var $this  = $(this).find("td:first-child");
			var $this1 = $(this).find("td:nth-child(2)");
			var $this2 = $(this).find("td:nth-child(3)");
			var $this3 = $(this).find("td:nth-child(4)");
			var $this4 = $(this).find("td:nth-child(5)");
			var $this5 = $(this).find("td:nth-child(6)");
			var $this6 = $(this).find("td:nth-child(7)");
			var $this7 = $(this).find("td:nth-child(8)");
			var $this8 = $(this).find("td:nth-child(11)");
			
			if ($this.text() == prevTDVal) { 
				span++;
				if (prevTD != "") {
					prevTD.attr("rowspan", span); 
					$this.remove(); 
				}
				
				
			} else {
				prevTD     = $this;  
				prevTDVal  = $this.text();
				span       = 1;
			}
			
			if ($this1.text() == prevTDVal1 && span > 1) { 
				span1++;
				if (prevTD1 != "") {
					prevTD1.attr("rowspan", span1); 
					$this1.remove(); 
				}
			} else {
				prevTD1     = $this1;  
				prevTDVal1  = $this1.text();
				span1       = 1;
			} 
			
			if ($this2.text() == prevTDVal2 && span1 > 1) { 
				span2++;
				if (prevTD2 != "") {
					prevTD2.attr("rowspan", span2); 
					$this2.remove(); 
				}
			} else {
				prevTD2     = $this2;  
				prevTDVal2  = $this2.text();
				span2       = 1;
			}
			
			if ($this3.text() == prevTDVal3 && span2 > 1) { 
				span3++;
				if (prevTD3 != "") {
					prevTD3.attr("rowspan", span3); 
					$this3.remove(); 
				}
			} else {
				prevTD3     = $this3;  
				prevTDVal3  = $this3.text();
				span3       = 1;
			}
			
			if ($this4.text() == prevTDVal4 && span3 > 1) { 
				span4++;
				if (prevTD4 != "") {
					prevTD4.attr("rowspan", span4); 
					$this4.remove(); 
				}
			} else {
				prevTD4     = $this4;  
				prevTDVal4  = $this4.text();
				span4       = 1;
			}
			
			if ($this5.text() == prevTDVal5 && span4 > 1) { 
				span5++;
				if (prevTD5 != "") {
					prevTD5.attr("rowspan", span5); 
					$this5.remove(); 
				}
			} else {
				prevTD5     = $this5;  
				prevTDVal5  = $this5.text();
				span5       = 1;
			}
			
			if ($this6.text() == prevTDVal6 && span5 > 1) { 
				span6++;
				if (prevTD6 != "") {
					prevTD6.attr("rowspan", span6); 
					$this6.remove(); 
				}
			} else {
				prevTD6     = $this6;  
				prevTDVal6  = $this6.text();
				span6       = 1;
			}
			
			if ($this7.text() == prevTDVal7 && span6 > 1) { 
				span7++;
				if (prevTD7 != "") {
					prevTD7.attr("rowspan", span7); 
					$this7.remove(); 
				}
			} else {
				prevTD7     = $this7;  
				prevTDVal7  = $this7.text();
				span7       = 1;
			}
			
			if ($this8.text() == prevTDVal8 && span7 > 1) { 
				span8++;
				if (prevTD8 != "") {
					prevTD8.attr("rowspan", span8); 
					$this8.remove(); 
				}
			} else {
				prevTD8     = $this8;  
				prevTDVal8  = $this8.text();
				span8       = 1;
			}
			
			 
		});
		
		
	}
</script>