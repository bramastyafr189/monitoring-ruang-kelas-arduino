
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Monitoring</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--
	<link href="<?php //echo base_url(); ?>assets\img\solo-technopark2.ico" rel="shortcut icon" /> -->
	<!-- Global stylesheets -->
	<link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url() ?>assets/template/limitless/assets/css/icons/icomoon/styles.css" rel="stylesheet" type="text/css">
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
	<script type="text/javascript" src="<?php echo base_url() ?>assets/template/limitless/assets/js/plugins/visualization/d3/d3.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url() ?>assets/template/limitless/assets/js/plugins/visualization/d3/d3_tooltip.js"></script>
	<script type="text/javascript" src="<?php echo base_url() ?>assets/template/limitless/assets/js/plugins/forms/styling/switchery.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url() ?>assets/template/limitless/assets/js/plugins/forms/styling/uniform.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url() ?>assets/template/limitless/assets/js/plugins/forms/selects/bootstrap_multiselect.js"></script>
	<script type="text/javascript" src="<?php echo base_url() ?>assets/template/limitless/assets/js/plugins/ui/moment/moment.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url() ?>assets/template/limitless/assets/js/plugins/pickers/daterangepicker.js"></script>

	<script type="text/javascript" src="<?php echo base_url() ?>assets/template/limitless/assets/js/core/app.js"></script>
	<script type="text/javascript" src="<?php echo base_url() ?>assets/template/limitless/assets/js/pages/dashboard.js"></script>
	<!-- /theme JS files -->

</head>
<?php 
date_default_timezone_set('Asia/Jakarta');
?>
<body>

	<!-- Main navbar -->
	<div class="navbar navbar-inverse">
		<div class="navbar-header">
			<a class="navbar-brand" href="dashboard.html" style="color:rgba(255,255,255,0.8);">Smart Class</a>

			<ul class="nav navbar-nav pull-right visible-xs-block">
				<li><a data-toggle="collapse" data-target="#navbar-mobile"><i class="icon-tree5"></i></a></li>
				<li><a class="sidebar-mobile-main-toggle"><i class="icon-paragraph-justify3"></i></a></li>
			</ul>
		</div>

		<div class="navbar-collapse collapse" id="navbar-mobile">
			<ul class="nav navbar-nav">
				<li>
					<a class="sidebar-control sidebar-main-toggle hidden-xs">
						<i class="icon-paragraph-justify3"></i>
					</a>
				</li>


			</ul>

			<ul class="nav navbar-nav navbar-right">
				<li class="dropdown dropdown-user">
					<a class="dropdown-toggle" data-toggle="dropdown">
						<img src="<?php echo base_url() ?>assets/template/limitless/assets/images/placeholder.jpg" alt="">
						<span><?php $this->load->library('session');
						echo $this->session->userdata('user_nama'); ?></span>
						<i class="caret"></i>
					</a>

					<ul class="dropdown-menu dropdown-menu-right">
						<li><a href="<?php echo base_url() ?>welcome/logout_user"><i class="icon-switch2"></i> Logout</a></li>
					</ul>
				</li>
			</ul>
		</div>
	</div>
	<!-- /main navbar -->


	<!-- Page container -->
	<div class="page-container">

		<!-- Page content -->
		<div class="page-content">

			<!-- Main sidebar -->
			<div class="sidebar sidebar-main">
				<div class="sidebar-content">

					<!-- User menu -->
					<div class="sidebar-user">
						<div class="category-content">
							<div class="media">
								<a href="#" class="media-left"><img src="<?php echo base_url() ?>assets/template/limitless/assets/images/placeholder.jpg" class="img-circle img-sm" alt=""></a>
								<div class="media-body">
									<span class="media-heading text-semibold"><?php $this->load->library('session');
									echo $this->session->userdata('user_nama'); ?></span>
									<div class="text-size-mini text-muted">
										<i class="icon-pin text-size-small"></i> &nbsp;Admin
									</div>
								</div>

								<div class="media-right media-middle">
									<ul class="icons-list">
										<li>
											
										</li>
									</ul>
								</div>
							</div>
						</div>
					</div>
					<!-- /user menu -->


					<!-- Main navigation -->
					<div class="sidebar-category sidebar-category-visible">
						<div class="category-content no-padding">
							<ul class="navigation navigation-main navigation-accordion">

								<!-- Main -->
								<li class="navigation-header"><span>Main</span> <i class="icon-menu" title="Main pages"></i></li>

								<li><a href="dashboard.html"><i class="icon-home4"></i> <span>Dashboard</span></a></li>
								<?php if($_SESSION['level'] == 'admin'){ ?>
									<li><a href="rfid.html"><i class="icon-book"></i> <span>Manajemen RFID</span></a></li>
									<li><a href="jadwal.html"><i class="icon-folder-open3"></i> <span>Manajemen Jadwal</span></a></li>
								<?php } //echo $_SESSION['level']; ?>
							</ul>
						</div>
					</div>
					<!-- /main navigation -->

				</div>
			</div>
			<!-- /main sidebar -->


			<!-- Main content -->
			<div class="content-wrapper">

				<!-- Page header -->
				<div class="page-header">
					<div class="page-header-content">
						<div class="page-title">
							<h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">SMART CLASS</span></h4>
						</div>


					</div>

					<div class="breadcrumb-line">
						<ul class="breadcrumb">
							<li><a href="index.html"><i class="icon-home2 position-left"></i> Home</a></li>
							<li><a href="google_scatter_bubble.html">Google</a></li>
							<li class="active">Scatter &amp; bubbles</li>
						</ul>

						
					</div>
				</div>
				<!-- /page header -->


				<!-- Content area -->
				<div class="content">

					<?php echo $_content; ?>


					<!-- Footer -->

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
