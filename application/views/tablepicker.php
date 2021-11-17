<div class="input-group">
	<?php if ($type == 'text') : ?>
	<input type="text" class="form-control" aria-describedby="button-<?=$id?> " value="<?= @$value_text ?>" name="<?=$name?>_detail" <?= isset($readonly) && $readonly == "0" ? '' : 'readonly'; ?> id="<?=$id?>_input_text">
	<?php else : ?>
	  <textarea class="form-control" aria-describedby="button-<?= $id ?>" name="<?= $name ?>_detail" <?= isset($readonly) && $readonly == "0" ? '' : 'readonly' ?> id="<?= $id ?>_input_text"></textarea>
  	<?php endif; ?>
	  <input type="hidden" class="form-control" name="<?= $name ?>" id="<?= $id ?>_input_value" value="<?= @$value ?>">
	   <div class="input-group-btn">
		<button class="btn btn-outline-primary tablepicker--pilih-<?= $id ?>" type="button" id="button-<?= $id ?>" >PILIH</button>
	  </div>
</div>

<div class="modal" id="<?= $id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
	<div class="modal-content">
	  <div class="modal-header">
		<h5 class="modal-title" id="exampleModalLabel">DATA</h5>
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
		  <span aria-hidden="true">&times;</span>
		</button>
	  </div>
	  <div class="modal-body">
		<div class="form-group row">
			<div class="col-md-12">
				<div class="input-group">
				  <input type="text" class="form-control" placeholder="Cari.." id="search-<?= $id ?>">
				  
				 <div class="input-group-btn">
					<button class="btn btn-outline-primary tablepicker--search-<?= $id ?>" type="button" ><i class="fa fa-search"></i> CARI</button>
				  </div>
				</div>
			</div>
		</div>
		<hr>
		
		<div class="table-responsive">
			<table id="<?= $id ?>-datatable" class="table table-bordered" style="width:100%">
				<thead>
					<tr>
						<?php foreach($columns as $key=>$col) : ?>
						<th><?= $col ?></th>
						<?php if($key > 1) : break; endif; ?>
							
						<?php endforeach; ?>
						<th>Aksi</th>
					</tr>
				</thead>
			</table>
		</div>
	  </div>
	  <div class="modal-footer">
		<button type="button" class="btn btn-outline-secondary" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
	  </div>
	</div>
  </div>
</div>


<script>
	
	$(function() {
		var tablepicker
		var dataSlot = [];
		$('.tablepicker--pilih-<?= $id ?>').on('click',function(e){
			$("#<?= $id ?>").modal('show');
				$('#search-<?= $id ?>').val('')
				if ( ! $.fn.DataTable.isDataTable( "#<?= $id ?>-datatable" ) ) {
					tablepicker = $("#<?= $id ?>-datatable").DataTable({
						serverSide:true,
						processing:true,
						searching:false,
						ajax: {
							url:"<?= $url ?>",
							type:"POST",
							data: ( d ) => {
								d.search_param = $('#search-<?= $id ?>').val()
								if (dataSlot.length > 0 ){
									dataSlot.forEach( (val) => {
										d[val] = $('#'+val).val();
									});
								}
								
							}
						},
						columns:[
							{data:'value',orderable:false},
							{data:'text',orderable:false},
							{data:'aksi',orderable:false,render:function(data,type,row){
								return '<button type="button" class="btn btn-outline-success btn-sm"><i class="fa fa-check"></i></button>';
							}},
						],

					});
				}			
		});
		
		$('.tablepicker--search-<?= $id ?>').on('click',function(e){
			tablepicker.draw();
		})
		
		$("#<?= $id ?>").on('hidden.bs.modal', function (e) {
			tablepicker = null;
			$("#<?= $id ?>-datatable").dataTable().fnDestroy();
		});
		
		$("#<?= $id?>-slot input, #<?= $id ?>-slot select").each(function (e) {
			dataSlot.push(input.attr('id'));
		});
		
		$('#<?= $id ?>').on('tablepicker:clear',function(e){
			$('#<?= $id ?>_input_value').val('');
			$('#<?= $id ?>_input_text').val('');
			document.getElementById("<?= $id ?>_input_value").dispatchEvent(new CustomEvent("input",{ detail: "", bubbles: true }));
		});
		
		$('#<?= $id ?>_input_text').on('input',function(e){
			$('#<?= $id ?>_input_value').val(this.value);
			document.getElementById("<?= $id ?>_input_value").dispatchEvent(new CustomEvent("input",{ detail: this.value, bubbles: true }));
		});
		
		$('#<?= $id ?>-datatable').on( 'click', 'button', function () {
       	 	var data = tablepicker.row( $(this).parents('tr') ).data();
        	$('#<?= $id ?>_input_value').val(data.id);
			<?php if (isset($readonly)) : ?>
				$('#<?= $id ?>_input_text').val(data.text);
			<?php else : ?>
				$('#<?= $id ?>_input_text').val(`${data.value} [ ${data.text} ]`);
			<?php endif; ?>
			
			$('#<?= $id ?>').trigger("tablepicker:pick",[data]);
			//console.log(data);
			
			document.getElementById("<?= $id ?>_input_value").dispatchEvent(new CustomEvent("input",{ detail: data.id, bubbles: true }));
			$("#<?= $id ?>").modal('hide');
   		 } );
		
		
	});
	
	
	
</script>