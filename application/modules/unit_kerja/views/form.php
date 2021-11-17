<form id="fm" class="form-horizontal form-label-left">
	<?= _input('id',[],$id,'hidden'); ?>
	<div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Unit Kerja<span class="required">*</span>
        </label>
        <div class="col-md-9 col-sm-9 col-xs-12">
			
			<?= input_text('unit_kerja',['class'=>'form-control col-md-7 col-xs-12'],@$row->unit_kerja); ?>
		</div>
    </div>
	<div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Parent<span class="required">*</span>
        </label>
        <div class="col-md-9 col-sm-9 col-xs-12">
			<select name="parent" class="form-control" onchange="changeParent()" id="parent">
			<option value="0">--Pilih Parent--</option>
			<?= printTree(buildTree($parent),0,null,@$row->parent,['id','unit_kerja']); ?>
			</select>
		</div>
    </div>
	<div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Status Madya
        </label>
        <div class="col-md-9 col-sm-9 col-xs-12">
			<div class="checkbox">
				<label><input type="checkbox" name="status_madya" value="1" id="status_madya" <?php if(isset($row)){if($row->status_madya == 1){echo 'checked';}}; ?>> Ya</label>
			</div>
		</div>
    </div>
</form>

<script>
	changeParent();
	var form = $('#fm');
		form.validate({
			rules:{
				unit_kerja : {
					required:true,
				},
				
			}
		})
	function saveForm()
	{
		if(form.valid()){
			$.post('<?= site_url('unit_kerja/save'); ?>',form.serialize()).done(function(result){
				if (result == 'success'){
					$.alert('Data Berhasil disimpan');
					$('#myModal').modal('hide');
					loadTable();
				} else {
					$.alert(result);
				}
			}).fail(function(xhr){
				$.alert(xhr.responseText);
			});
		}
	}
	
	function changeParent()
	{
		if($('#parent').val() != 0){
			$('#status_madya').prop('disabled',true);
		} else {
			$('#status_madya').prop('disabled',false);
		}
	}
</script>