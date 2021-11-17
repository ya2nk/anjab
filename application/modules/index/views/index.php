<link href="<?= base_url('assets/vendors/treegrid/css/jquery.treegrid.css'); ?>" rel="stylesheet">
<script src="<?= base_url('assets/vendors/treegrid/js/jquery.treegrid.min.js'); ?>"></script>
<div class="page-title">
    <div class="title_left">
        <h3>UNIT KERJA</h3>
    </div>
	
</div>
<div class="clearfix"></div>

<div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Unit Kerja</h2>
                    <ul class="nav navbar-right panel_toolbox">
					   <li><a href="javascript:void(0)" onclick="loadTable()" class="btn btn-success"><i class="fa fa-arrow-left"></i> Kembali</a></li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    
                   <table class="tree table table-bordered table-striped table-hover">
						<thead>
							<tr>
								<th>Unit Kerja</th>
								<th>Aksi</th>
							</tr>
						</thead>
						<tbody>
   
						</tbody>
					</table>
				  </div>
				</div>
	</div>
</div>

<script>
	$(function(){
		loadTable();
		
	});
	
	function loadTable(id=null)
	{
		$('.tree tbody > tr').detach();
		var url = '<?= site_url('unit_kerja/data'); ?>'
		if (id != null){
			url = '<?= site_url('unit_kerja/detail'); ?>/'+id;
		}
		$.post(url,{},function(result){
			$('.tree tbody').html(result);
			$('.tree').unbind();
			$('.tree').treegrid();
		});
	}
</script>