<link href="<?= base_url('assets/vendors/treegrid/css/jquery.treegrid.css'); ?>" rel="stylesheet">
<script src="<?= base_url('assets/vendors/treegrid/js/jquery.treegrid.min.js'); ?>"></script>
<div class="page-title">
    <div class="title_left">
        <h3>MASTER UNIT KERJA</h3>
    </div>
	
</div>
<div class="clearfix"></div>

<div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Data Master Unit Kerja</h2>
                    <ul class="nav navbar-right panel_toolbox">
						<li><a href="javascript:void(0)" onclick="doSearch()" class="btn btn-info"><i class="fa fa-search"></i> Filter</a>
					   <li><a href="javascript:void(0)" onclick="loadTable()" class="btn btn-success"><i class="fa fa-arrow-left"></i> Kembali</a>
                      <li><a href="javascript:void(0)" onclick="loadForm(0)" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah</a>
                      </li>
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

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<a href="javascript:void(0)" class="modal-close pull-right" data-dismiss="modal" aria-label="Close">
						<i class="fa fa-times"></i>
					</a>
					<h4 class="modal-title" id="myModalLabel">Form Unit Kerja</h4>
				</div>
			<div class="modal-body modal-body-content">
								...
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-rounded btn-default" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-rounded btn-primary" onclick="saveForm()">Save changes</button>
			</div>
			</div>
		</div>
	</div><!--.modal-->
	
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
								<?= generate_select_input($unit_kerja,'--Pilih Unit Kerja--',["name"=>"unit_kerja","class"=>"form-control",'onchange'=>'unitKerjaSelect(this,"#jpt_pratama")'],@$row->jpt_madya); ?>
							</div>
								
						</div>
						<div class="form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">JPT Pratama</label>
							<div class="col-md-6 col-sm-6 col-xs-12">
								<select class="form-control" name="jpt_pratama" id="jpt_pratama" onchange="unitKerjaSelect(this,'#administrator')" >
								</select>
							</div>
								
						</div>
						<div class="form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Administrator</label>
							<div class="col-md-6 col-sm-6 col-xs-12">
								<select class="form-control" name="administrator" id="administrator" onchange="unitKerjaSelect(this,'#pengawas')" >
								</select>
							</div>
								
						</div>
						<div class="form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Pengawas</label>
							<div class="col-md-6 col-sm-6 col-xs-12">
								<select class="form-control" name="pengawas" id="pengawas" onchange="unitKerjaSelect(this,'#pelaksana')" >
								</select>
							</div>
								
						</div>
						<div class="form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Pelaksana</label>
							<div class="col-md-6 col-sm-6 col-xs-12">
								<select class="form-control" name="pelaksana" id="pelaksana">
								</select>
							</div>
								
						</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-rounded btn-default" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-rounded btn-primary" onclick="doFilter()">Filter</button>
			</div>
			</div>
		</div>
	</div><!--.modal-->

<script>
	var idUnit;
	
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
	
	function loadForm(id)
	{
		$('.modal-body-content').html('');
		$.post('<?= site_url('unit_kerja/form'); ?>',{id:id}).done(function(result){
			$("#myModalLabel").text('Form Unit Kerja');
			$('.modal-body-content').html(result);
			$('#myModal').modal('show');
		}).fail(function(xhr){
			alert(xhr.responseText);
		});
	}
	
	function loadDetail(id)
	{
		$('.modal-body').html('');
		$.post('<?= site_url('unit_kerja/detail'); ?>',{id:id}).done(function(result){
			$("#myModalLabel").text('Detail Unit Kerja');
			$('.modal-body').html(result);
			$('#myModal').modal('show');
			$('.tree-detail').treegrid();
		}).fail(function(xhr){
			alert(xhr.responseText);
		});
	}
	
	function deleteData(id)
	{
		$_confirm(function(){
			$.post('<?= site_url('unit_kerja/delete'); ?>',{id:id},function(result){
				if (result == 'success'){
					$.alert('Data Berhasil Dihapus');
					loadTable();
				} else {
					$.alert(result,'ERROR');
				}
			})
		})
	}
	
	function doSearch()
	{
		$('#modal-filter').modal('show');
	}
	
	function unitKerjaSelect(that,target,$value=0)
	{
		idUnit = that.value;
		$.post('<?= site_url('unit_kerja/select'); ?>',{id:that.value},function(result){
			$(target).empty();
			if ($value == 0){
				if (target == '#jpt_pratama'){
					$('#administrator').empty();
					$('#pengawas').empty();
					$('#pelaksana').empty();
				}
			
				if (target == '#administrator'){
					$('#pengawas').empty();
					$('#pelaksana').empty();
				}
			
				if (target == '#pengawas'){
					$('#pelaksana').empty();
				}
			}
			
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
		loadTable(idUnit);
		$('#modal-filter').modal('hide');
	}
</script>