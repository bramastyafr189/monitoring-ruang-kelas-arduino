<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>themelock.com - Limitless - Responsive Web Application Kit by Eugene Kopyov</title>

	<!-- Global stylesheets -->
	<link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url(); ?>assets/template/limitless/assets/css/icons/icomoon/styles.css" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url(); ?>assets/template/limitless/assets/css/minified/bootstrap.min.css" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url(); ?>assets/template/limitless/assets/css/minified/core.min.css" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url(); ?>assets/template/limitless/assets/css/minified/components.min.css" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url(); ?>assets/template/limitless/assets/css/minified/colors.min.css" rel="stylesheet" type="text/css">
	<!-- /global stylesheets -->

	<!-- Core JS files -->
	<script type="text/javascript" src="<?php echo base_url() ?>assets/template/limitless/assets/js/plugins/loaders/pace.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url() ?>assets/template/limitless/assets/js/core/libraries/jquery.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url() ?>assets/template/limitless/assets/js/core/libraries/bootstrap.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url() ?>assets/js/plugins/loaders/blockui.min.js"></script>
	<!-- /core JS files -->

	<!-- Theme JS files -->
	<script type="text/javascript" src="<?php echo base_url() ?>assets/template/limitless/assets/js/plugins/forms/wizards/stepy.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url() ?>assets/template/limitless/assets/js/plugins/forms/selects/select2.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url() ?>assets/template/limitless/assets/js/plugins/forms/styling/uniform.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url() ?>assets/template/limitless/assets/js/core/libraries/jasny_bootstrap.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url() ?>assets/template/limitless/assets/js/plugins/forms/validation/validate.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url() ?>assets/template/limitless/assets/js/plugins/extensions/cookie.js"></script>

	<script type="text/javascript" src="<?php echo base_url() ?>assets/template/limitless/assets/js/core/app.js"></script>
	<script type="text/javascript" src="<?php echo base_url() ?>assets/template/limitless/assets/js/pages/wizard_stepy.js"></script>
	<!-- /theme JS files -->

</head>

<body>
	<?php 
		foreach ($data_ruang as $data) {
			$id 	= $data->ruang_id;
			$nama 	= $data->ruang_nama;
		}
	?>
<div class="content">
	<!-- Basic setup -->
	              <!-- Basic setup -->
		            <div class="panel panel-white">
						<div class="panel-heading">
							<h6 class="panel-title"><b><?php echo $nama; ?></b></h6>
							<div class="heading-elements">
		                	</div>
						</div>

	                	<form class="stepy-basic" action="get_jadwal.html" method="post">
							<fieldset title="1">
								<legend class="text-semibold"><?php echo $nama; ?></legend>

								<div class="row">
									<div class="col-md-3"> </div>
									<div class="col-md-3">
										<div class="form-group">
											<label><b>Tahun Ajaran:</b></label>
											<select class="form-control" name="tahun" required>
												<?php foreach ($list_tahun as $thn) { ?>
                                                    <option value="<?php echo $thn->tahun_ajaran_id; ?>" 
                                                       <?php if($tahun_ajaran_aktif == $thn->tahun_ajaran_id){
                                                                echo "selected='selected'"; }
                                                            ?>>
                                                            <?php echo $thn->tahun_ajaran_nama;?> 
                                                        </option>
                                                    <?php   } ?> 
											</select>
										</div>
									</div>

									<div class="col-md-3">
										<div class="form-group">
											<label><b>Semester</b></label>
											<select class="form-control" name="smt" required>
											<?php foreach ($list_semester as $smt) { ?>
                                                    <option value="<?php echo $smt->tahun_semester_id; ?>" 
                                                       <?php if($tahun_semester_aktif == $smt->tahun_semester_id){
                                                                echo "selected='selected'"; }
                                                            ?>>
                                                            <?php echo $smt->tahun_semester_nama;?> 
                                                        </option>
                                                    <?php   } ?> 
                                            </select>
										</div>
									</div>
									<div class="col-md-3"> </div>
								</div>
								
							</fieldset>
							<div class="row">
								<div class="form-group">
									<div class="col-md-5">
										<div class="form-group">
											<label><b></b></label>
											<input type="hidden" name="id_ruang" value="<?php echo $id; ?>">
										</div>
									</div>
									<div class="col-md-1"></div>
									<button type="submit" class="btn btn-primary stepy-finish">Submit <i class="icon-check position-left"></i></button>
								</div>
							</div>
							
						</form>
		            </div>
		            <!-- /basic setup -->
	</div>
</body>