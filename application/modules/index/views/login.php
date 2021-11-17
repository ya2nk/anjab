<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>E-ANJAB Pemerintah Kabupaten Kerinci </title>

    <!-- Bootstrap -->
    <link href="<?= base_url('assets/vendors/bootstrap/dist/css/bootstrap.min.css'); ?>" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?= base_url('assets/vendors/font-awesome/css/font-awesome.min.css'); ?>" rel="stylesheet">
    <!-- NProgress -->
    <link href="<?= base_url('assets/vendors/nprogress/nprogress.css'); ?>" rel="stylesheet">
    <!-- Animate.css -->
    <link href="<?= base_url('assets/vendors/animate.css/animate.min.css'); ?>" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="<?= base_url('assets/build/css/custom.min.css'); ?>" rel="stylesheet">
	<script src="<?= base_url('assets/vendors/jquery/dist/jquery.min.js'); ?>"></script>
	<script src="<?= base_url('assets/vendors/jqueryvalidate/additional-methods.min.js'); ?>"></script>
    <script src="<?= base_url('assets/vendors/jqueryvalidate/jquery.validate.min.js'); ?>"></script>
  </head>

  <body class="login" style="background-color: #2E75B6;">
    <div>
      <div class="login_wrapper" style="max-width: 450px">
        <div class="animate form login_form">
          <section class="login_content" style="border: #ccc solid 1px; background-color: white; padding-left: 25px; padding-right: 25px;">
	          <img src="<?= base_url('assets/images/kab_tolikara.png'); ?>" width="100">
            <form id="fm">
              <h1>Login Untuk Bekerja</h1>
              <div>
                <input type="text" class="form-control" placeholder="Username" required="" name="username"/>
              </div>
              <div>
                <input type="password" class="form-control" placeholder="Password" required="" name="password"/>
              </div>
              <div>
                <button class="btn btn-default submit" type="button" onclick="loginForm()">Log in</button>
                
              </div>

              <div class="clearfix"></div>

              <div class="separator">
               

                <div class="clearfix"></div>
                <br />

                <div>
                  <h1><i class="fa fa-sitemap"></i> E-ANJAB</h1>
                  <p>©2021 Pemerintah Kabupaten Tolikara<br>Dikelola oleh Bagian Organisasi Setda Tolikara</p>
                </div>
              </div>
            </form>
          </section>
        </div>

        
      </div>
    </div>
	<script>
	 var form = $('#fm');
	 $(function(){
		form.validate(); 
	 });
		function loginForm()
		{
			if(form.valid()){
				$.post('<?= site_url('index/login'); ?>',form.serialize()).done(function(result){
					if (result == 'success'){
						location.reload();
					} else {
						alert(result);
					}
				}).fail(function(xhr){
					alert(xhr.responseText);
				})
			}
			
		}
	</script>
  </body>
</html>