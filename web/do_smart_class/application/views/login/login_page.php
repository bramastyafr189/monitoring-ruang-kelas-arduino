<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Monitoring | Login</title>
	<!-- 
	<link href="<?php //echo base_url(); ?>assets\img\solo-technopark2.ico" rel="shortcut icon" /> Global stylesheets -->

	<!-- Global stylesheets -->
	<link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url() ?>assets/template/limitless/assets/css/icons/icomoon/styles.css" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url() ?>assets/template/limitless/assets/css/minified/bootstrap.min.css" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url() ?>assets/template/limitless/assets/css/minified/core.min.css" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url() ?>assets/template/limitless/assets/css/minified/components.min.css" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url() ?>assets/template/limitless/assets/css/minified/colors.min.css" rel="stylesheet" type="text/css">
	<!-- /global stylesheets -->

	<!-- Core JS files -->
	<script type="text/javascript" src="<?php echo base_url() ?>assets/template/limitless/assets/js/plugins/loaders/pace.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url() ?>assets/template/limitless/assets/js/core/libraries/jquery.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url() ?>assets/template/limitless/assets/js/core/libraries/bootstrap.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url() ?>assets/template/limitless/assets/js/plugins/loaders/blockui.min.js"></script>
	<!-- /core JS files -->

	<!-- Theme JS files -->
	<script type="text/javascript" src="<?php echo base_url() ?>assets/template/limitless/assets/js/plugins/forms/styling/uniform.min.js"></script>

	<script type="text/javascript" src="<?php echo base_url() ?>assets/template/limitless/assets/js/core/app.js"></script>
	<script type="text/javascript" src="<?php echo base_url() ?>assets/template/limitless/assets/js/pages/login.js"></script>
	<!-- /theme JS files -->

</head>

<body class="bg-slate-800">

	<!-- Page container -->
	<div class="page-container login-container">

		<!-- Page content -->
		<div class="page-content">

			<!-- Main content -->
			<div class="content-wrapper">

				<!-- Content area -->
				<div class="content">

					<!-- Advanced login -->
				
						<div class="panel panel-body login-form">
							<div class="text-center">
								<!--
								<img src="<?php //echo base_url(); ?>assets/img/solo-technopark1.png" style='text-align: center;width: 50%'> -->
								<br>
								<h5 class="content-group-lg">Login <small class="display-block">Sistem Monitoring Ruangan</small></h5>
							</div>
							<div id="pesan">
				<!-- Isinya nanti pesan apa login sukses atau tidak -->			
			</div>

			<div class="form-group has-feedback has-feedback-left">
				<div class="form-control-feedback">
					<i class="icon-user text-muted"></i></div>
					<input type="text" class="form-control" placeholder="Username" name="username">
			</div>

							<div class="form-group has-feedback has-feedback-left">
								<input type="password" class="form-control" placeholder="Password" name=password onkeydown='if (event.keyCode == 13){
                        document.getElementById("login").click();}'>
								<div class="form-control-feedback">
									<i class="icon-lock2 text-muted"></i>
								</div>
							</div>


							<div class="form-group">
								<button type="button" onclick='login()'; class="btn bg-blue btn-block" id='login'>Login <i class="icon-circle-right2 position-right"></i></button>
							</div>
		

							
							<span class="help-block text-center no-margin"> <br>
						</div>
					</form>
					<!-- /advanced login -->


					<!-- Footer -->
					<div class="footer text-white">
						&copy; 2019. <a href="#" class="text-white">Created</a> by <a href="" class="text-white" target="_blank">Naomi Nindytasari</a>
					</div>
					<!-- /footer -->

				</div>
				<!-- /content area -->

			</div>
			<!-- /main content -->

		</div>
		<!-- /page content -->

	</div>
	<!-- /page container -->

</body>
</html>
 <script type="text/javascript">
            function login(){
            
                         var user = $('div :input').serialize();
                           jQuery.ajax({
                              url: '<?php echo site_url("Welcome/login_user"); ?>',
                              type: 'POST',
                              data: user,
                               beforeSend: function() {
                     //alert('sebelum ngirim');
         $('#login').html('<div style="text-align:center;"><i class="icon-spinner3 spinner position-left" ></i> Sedang Memproses</div>');
          $('#login').prop('disabled', true);
          },
          success: function(data) {
          	
        if(data=="ok"){
        	window.location = '<?php echo base_url(); ?>dashboard.html';
        }else if(data=="gagal"){
        $('#login').html('<div style="text-align:center;">Coba Lagi <i class="icon-circle-right2 position-right"></div>');
        $('#login').prop('disabled', false);
                //Cetak peringatan untuk username & password salah
                //$('#pesan').fadeOut(100, "swing");
                $('#pesan').html('<div class="alert alert-danger alert-dismissable" style="text-align:center;">Login Gagal,<br> Silahkan Coba Lagi</div>');
                $("#pesan").fadeIn(1000,'swing').delay(2000).hide(0);
                //$('#pesan').fadeOut(7000, "swing");
                //alert('gagal');
        }else if(data=='percobaan_max'){
                 $('#masuk').html('Masuk');
                //alert("percobaan max");
                $('#pesan').fadeOut(100, "swing");
                 $('#pesan').html('<div class="alert alert-danger alert-dismissable" style="text-align:center;">Silahkan Tunggu 5 menit<br> Anda mencapai batas maksimal login<br><a href="login_page.html"><i class="fa fa-refresh"></i> Muat Ulang Halaman</a></div>');
                $("#pesan").fadeIn(1000,"swing");
                //$('#pesan').fadeOut(7000, "swing");
            	        $('#login').html('<div style="text-align:center;">Coba Lagi <i class="icon-circle-right2 position-right"></div>');
        $('#login').prop('disabled', false);
            } else {alert(data);}
          },
          error: function(xhr, textStatus, errorThrown) {
            alert('Gagal Menyimpan Silahkan Hubungi Admin');
        $('#login').html('<div style="text-align:center;">Coba Lagi <i class="icon-circle-right2 position-right"></div>');
        $('#login').prop('disabled', false);
          }
        });
    }
                </script>