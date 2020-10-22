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

	                	<form class="stepy-basic" action="pinjam_fix.html" method="post">
							<fieldset title="1">
								<legend class="text-semibold">Pilih Mata Kuliah</legend>

								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label><b>Nama Peminjam:</b></label>
											<input type="text" disabled="disable" name="nama_peminjam" value="<?php echo $nama_pj; ?>" class="form-control" placeholder="Nama lengkap peminjam" required>
										</div>
									</div>

									<div class="col-md-6">
										<div class="form-group">
											<label><b>Pilih Mata Kuliah:</b> <i>*)Harus diisi</i></label>
											<select class="form-control" name="mapel" id="mapel" required>
                                                    <?php
                                                    foreach ($makul as $mpl) { ?>
                                                        <option value="<?php echo $mpl->jadwal_id; ?>"><?php echo $mpl->makul_nama;?></option>
                                                 <?php   } ?>
                                                        
                                                    </select>
										</div>
									</div>
								</div>

								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label><b>Nomor Telepon:</b></label>
											<input type="number"  disabled="disable" name="no_telp" value="<?php echo $no_telp; ?>" class="form-control" placeholder="Nomor telepon yang dapat dihubungi" required>
										</div>
									</div>
								</div>

								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											
											<input type="hidden" name="id_ruang" class="form-control" placeholder="id_ruang" value="<?php echo $id; ?>" required>
											<input type="hidden" name="semester" class="form-control" placeholder="semester" value="<?php echo $semester; ?>" required>
											<input type="hidden" name="kelas" class="form-control" placeholder="kelas" value="<?php echo $kelas; ?>" required>
											<input type="hidden" name="nama_peminjam" value="<?php echo $nama_pj; ?>" class="form-control" placeholder="Nama lengkap peminjam" required>
											<input type="hidden" name="no_telp" value="<?php echo $no_telp; ?>" class="form-control" placeholder="Nomor telepon yang dapat dihubungi" required>
										</div>
									</div>
								</div>

							</fieldset>
							<button type="submit" class="btn btn-primary stepy-finish">Submit <i class="icon-check position-right"></i></button>
						</form>
		            </div>
		            <!-- /basic setup -->
	</div>
</body>