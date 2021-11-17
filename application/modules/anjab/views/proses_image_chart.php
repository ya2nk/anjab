<!DOCTYPE html>
<html> 
<head>
<script src="<?= base_url('assets/js/html2canvas.min.js'); ?>"></script>



</head>
<body>

<form method="post" action="<?= site_url('anjab/formulir/'.$row->id); ?>" id="myForm">
	<input type="hidden" name="image" id="test">
</form>

<script>
	window.onload = function(){
		var html_string = "<html><head><link href='<?= base_url('assets/css/list17_chart.css'); ?>' rel='stylesheet'></head><?= listTree($tree,true,$row->id); ?></html>";
		var iframe=document.createElement('iframe');
		iframe.width = '600px';
		iframe.style.height = '0px';
		document.body.appendChild(iframe);
		setTimeout(function(){
			var iframedoc=iframe.contentDocument||iframe.contentWindow.document;
			iframedoc.body.innerHTML=html_string;
			html2canvas(iframedoc.body).then(function(canvas) {
				// Export the canvas to its data URI representation
				var base64image = canvas.toDataURL("image/jpeg");
				//location.href = '<?= site_url('anjab/formulir/'.$row->id); ?>?image='+JSON.stringify(base64image);
				// Open the image in a new window
				//window.open(base64image , "_blank");
				document.getElementById("test").value = base64image;
				document.getElementById("myForm").submit(); 
		
			});
		}, 10);
	}
</script>
</body>
</html>