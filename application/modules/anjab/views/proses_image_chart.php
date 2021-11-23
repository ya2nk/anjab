<!DOCTYPE html>
<html> 
<head>
<script src="<?= base_url('assets/js/dom-to-image.min.js'); ?>"></script>
<link href="<?= base_url('assets/css/treeflex.css') ?>" rel="stylesheet">



</head>
<body>
<div class="tf-tree example" id="my-node">
  <ul>
    <li>
      <span class="tf-nc"><?= $row->nama_jpt_madya; ?></span>
      <ul>
        <li>
			<span class="tf-nc"><?= $row->nama_jpt_pratama; ?></span>
			<ul>
				<li><span class="tf-nc">&nbsp;</span>
					<ul>
						<li><span class="tf-nc">&nbsp;</span></li>
					</ul>
				</li>
				<li><span class="tf-nc"><?= $row->nama_administrator; ?></span>
					<ul>
						<li><span class="tf-nc"><?= $row->nama_jabatan; ?></span></li>
					</ul>
				</li>
			</ul>
		</li>
	  </ul>
	</li>
  </ul>
  </div>
<form method="post" action="<?= site_url('anjab/formulir/'.$row->id); ?>" id="myForm">
	<input type="hidden" name="image" id="test">
</form>
<img id="image">
<script>
	
	
		var node = document.getElementById('my-node');
		

		domtoimage.toPng(node,{height:400,width:800})
			.then (function (dataUrl) {
				document.getElementById('test').value = dataUrl;
				document.getElementById('myForm').submit();
			})
			.catch(function (error) {
				console.error('oops, something went wrong!', error);
			});
	
	
</script>
</body>
</html>