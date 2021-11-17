<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" href="images/favicon.ico" type="image/ico" />

    <title>Admin Panel</title>

    <!-- Bootstrap -->
    <link href="<?= base_url('assets/vendors/bootstrap/dist/css/bootstrap.min.css'); ?>" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?= base_url('assets/vendors/font-awesome/css/font-awesome.min.css'); ?>" rel="stylesheet">
	<link href="<?= base_url('assets/vendors/nprogress/nprogress.css'); ?>" rel="stylesheet">
    <!-- iCheck -->
    <link href="<?= base_url('assets/vendors/iCheck/skins/flat/green.css'); ?>" rel="stylesheet">
	<!-- Switchery -->
    <link href="<?= base_url('assets/vendors/switchery/dist/switchery.min.css'); ?>" rel="stylesheet">
	<link href="<?= base_url('assets/vendors/pnotify/dist/pnotify.css'); ?>" rel="stylesheet">
    <link href="<?= base_url('assets/vendors/pnotify/dist/pnotify.buttons.css'); ?>" rel="stylesheet">
    <link href="<?= base_url('assets/vendors/pnotify/dist/pnotify.nonblock.css'); ?>" rel="stylesheet">
	<link href="<?= base_url('assets/vendors/jquery-confirm/jquery-confirm.min.css'); ?>" rel="stylesheet">
	<!-- Custom Theme Style -->
    <link href="<?= base_url('assets/build/css/custom.min.css'); ?>" rel="stylesheet">
	 <link href="<?= base_url('assets/vendors/bootstrap-multiselect/dist/css/bootstrap-multiselect.css'); ?>" rel="stylesheet">
	 <link href="<?= base_url('assets/vendors/select2/dist/css/select2.min.css'); ?>" rel="stylesheet">
	 <script src="<?= base_url('assets/vendors/jquery/dist/jquery.min.js'); ?>"></script>
	<style>
		
		.error {
			color: #a94442;
		}
	</style>
  </head>
  <body class="nav-md">
	<div class="container body">
		<div class="main_container">
			<?= $header; ?>
			<!-- page content -->
        <div class="right_col" role="main">
			<?= $content; ?>
		</div>
	</div>
	</div>
	
	 <!-- jQuery -->
   
    <!-- Bootstrap -->
    <script src="<?= base_url('assets/vendors/bootstrap/dist/js/bootstrap.min.js'); ?>"></script>
	<script src="<?= base_url('assets/vendors/fastclick/lib/fastclick.js'); ?>"></script>
    <!-- NProgress -->
    <script src="<?= base_url('assets/vendors/nprogress/nprogress.js'); ?>"></script>
    <!-- iCheck -->
    <script src="<?= base_url('assets/vendors/iCheck/icheck.min.js'); ?>"></script>
	<!-- Switchery -->
    <script src="<?= base_url('assets/vendors/switchery/dist/switchery.min.js'); ?>"></script>
	 <!-- PNotify -->
    <script src="<?= base_url('assets/vendors/pnotify/dist/pnotify.js'); ?>"></script>
    <script src="<?= base_url('assets/vendors/pnotify/dist/pnotify.buttons.js'); ?>"></script>
    <script src="<?= base_url('assets/vendors/pnotify/dist/pnotify.nonblock.js'); ?>"></script>
	<!-- Parsley -->
	<script src="<?= base_url('assets/vendors/jqueryvalidate/additional-methods.min.js'); ?>"></script>
    <script src="<?= base_url('assets/vendors/jqueryvalidate/jquery.validate.min.js'); ?>"></script>
	<script src="<?= base_url('assets/vendors/jquery-confirm/jquery-confirm.min.js'); ?>"></script>
	 <script src="<?= base_url('assets/vendors/bootstrap-multiselect/dist/js/bootstrap-multiselect.js'); ?>"></script>
	  <script src="<?= base_url('assets/vendors/select2/dist/js/select2.full.min.js'); ?>"></script>
	<!-- Custom Theme Scripts -->
	<script src="<?= base_url('assets/build/js/custom.min.js'); ?>"></script>
	<script>
		function slugify(text)
		{
			return text.toString().toLowerCase()
				.replace(/\s+/g, '-')           // Replace spaces with -
				.replace(/[^\w\-]+/g, '')       // Remove all non-word chars
				.replace(/\-\-+/g, '-')         // Replace multiple - with single -
				.replace(/^-+/, '')             // Trim - from start of text
				.replace(/-+$/, '');            // Trim - from end of text
		}
		
		function $_confirm(callback)
		{
			$.confirm({
				title: 'Konfirmasi!',
				content: 'Apakah anda yakin akan menghapus data ini?',
				theme: 'supervan',
				buttons: {
					confirm: callback,
					cancel: function () {
					
					},
			
				}
			});
		}
		
		jQuery.validator.setDefaults({
			highlight: function(element) {
			$(element).closest('.form-group').removeClass('has-success').addClass('has-error');
			},
			unhighlight: function(element) {
				$(element).closest('.form-group').removeClass('has-error').addClass('has-success');
			}
		});
		
		$(function(){
			$('.multiselect').multiselect({
				enableFiltering: true,
				buttonWidth: '100%',
				nonSelectedText: 'Belum dipilih',
				nSelectedText: 'dipilih',
				allSelectedText: 'Semua dipilih',
				maxHeight: 300,
			});
		});
	</script>
  </body>
</html>
