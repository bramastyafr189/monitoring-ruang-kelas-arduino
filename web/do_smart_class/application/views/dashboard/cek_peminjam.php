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
<?php
	//error_reporting("Jadwal tidak ada");
?>
</head>

<body>
	<?php 
		foreach ($data_ruang as $data) {
			$id 	= $data->ruang_id;
			$nama 	= $data->ruang_nama;
		}

		foreach ($jadwal_sekarang as $now) {
			$nama_makul = $now->makul_nama;
			$mulai 		= $now->jadwal_jam_mulai;
			$selesai 	= $now->jadwal_jam_akhir;
			$kelas 		= $now->kelas_nama;
			$semester 	= $now->jadwal_semester_id;
			$dosen 		= $now->dosen_nama;
		}

		$cek_mulai = is_null($now->jadwal_jam_mulai);
		//echo "selesai : ".$selesai."<br>";
		//echo($cek_mulai);

		foreach ($jadwal_selesai as $end) {
			$nama_makul_end = $end->makul_nama;
			$mulai_end 		= $end->jadwal_jam_mulai;
			$selesai_end 	= $end->jadwal_jam_akhir;
			//$selesai_end 	= date('11:05:00');
			$kelas_end 		= $end->kelas_nama;
			$semester_end 	= $end->jadwal_semester_id;
			$dosen_end 		= $end->dosen_nama;
		}

		//echo "Makul adalah ".$nama_makul_end."<br>";
		//echo "Rampung jam ".$selesai_end."<br>";

		foreach ($log_peminjaman as $pj) {
			$id_pj 		= $pj->rfid_id;
			$nama_pj 	= $pj->rfid_penanggung_jawab;
			$telp_pj 	= $pj->rfid_no_handpon_pj;
			$kelas_pj	= $pj->kelas_nama;
			$smt_pj		= $pj->semester_nama;
			$makul_pj 	= $pj->makul_nama;
			$jam_mulai_pj = $pj->log_jam_masuk;
			//$kelas 		= $pj->kelas_id;
		}
		//echo "Nama PJ : ".$nama_pj;
		/*echo($nama_makul);
		echo($mulai);
		echo($dosen);*/
		//$jam_sekarang = date('12:00:00');
		$jam_sekarang = date('G:i:s');
		$batas = date('12:00:00');
		//echo "Saiki jam : ".$jam_sekarang."<br>";
		//echo "Rampung jam ".$selesai_end."<br>";

        //echo "sekarang jam : ".$time_input."<br>";
        if ( $jam_sekarang != $batas) {
            //echo "belum tengah hari";
            $jam_sekarang = date('H:i:s');
            //echo "Convert = ".$jam_sekarang;
        }else{
            if ($jam_sekarang > $batas) {
                //echo "Sudah tengah hari";
                $jam_sekarang = date('G:i:s');
                // echo "Convert = ".$jam_sekarang;
            }
        }

		//$jam_sekarang = date('09:10:00');
		//echo $jam_sekarang;
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

	                	<form class="stepy-basic" action="dashboard.html" method="">
							<fieldset title="1">
								<legend class="text-semibold"><b><?php echo $nama; ?></b></legend>

								<div class="row">
									<div class="col-md-3">
										<div class="form-group">
											<label><b>Nama Peminjam:</b></label>
											<input type="text" disabled="disable" name="nama_peminjam" value="<?php echo $nama_pj; ?>" class="form-control" placeholder="Tidak ada peminjam" required>
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label><b>No HP Peminjam:</b></label>
											<input type="text" disabled="disable" name="nama_peminjam" value="<?php echo $telp_pj; ?>" class="form-control" placeholder="Tidak ada peminjam" required>
										</div>
									</div>

									<div class="col-md-3">
										<div class="form-group">
											<label><b>Kelas:</b> </label>
											<input type="text" disabled="disable" name="nama_peminjam" value="<?php echo $kelas_pj; ?>" class="form-control" placeholder="Tidak ada kelas yang menggunakan" required>
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label><b>Semester:</b> </label>
											<input type="text" disabled="disable" name="nama_peminjam" value="<?php echo $smt_pj; ?>" class="form-control" placeholder="Tidak ada semester yang menggunakan" required>
										</div>
									</div>
								</div>

								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label><b>Nama Makul:</b></label>
											<input type="text" disabled="disable" name="nama_peminjam" value="<?php echo $makul_pj; ?>" class="form-control" placeholder="Tidak ada mata kuliah" required>
										</div>
									</div>

									<div class="col-md-6">
										<div class="form-group">
											<label><b>Dosen:</b></label>
											<input type="text" disabled="disable" name="nama_peminjam" value="<?php echo $dosen; ?>" class="form-control" placeholder="Tidak ada dosen yang mengajar" required>
										</div>
									</div>
								</div>

								<div class="row">
									<div class="col-md-3">
										<div class="form-group">
											<label><b>Mulai:</b></label>
											<?php
												if ($cek_mulai == 1) { ?>
													<input type="text" disabled="disable" name="nama_peminjam" value="<?php echo $jam_mulai_pj; ?>" class="form-control" placeholder="-" required>
													
											<?php	}else{ ?>
													<input type="text" disabled="disable" name="nama_peminjam" value="<?php echo $mulai; ?>" class="form-control" placeholder="-" required>
											<?php	}
											?>
											
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label><b>Selesai:</b></label>
											<?php 
											if ($cek_mulai == 1) { ?>
												<input type="text" disabled="disable" name="nama_peminjam" class="form-control" placeholder="-" required>
										<?php	}else{ ?>
											<input type="text" disabled="disable" name="nama_peminjam" value="<?php echo $selesai_end; ?>" class="form-control" placeholder="-" required> 
										<?php  } ?>
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label><b>Jam sekarang:</b></label>
											<input type="text" disabled="disable" name="nama_peminjam" value="<?php echo $jam_sekarang; ?>" class="form-control" placeholder="Tidak ada dosen yang mengajar" required>
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label><b>Keterangan:</b></label>
											<?php
												if ($cek_mulai == 1) { ?>
													<input type="text" disabled="disable" name="nama_peminjam" value="Peminjaman dilakukan di luar jadwal" class="form-control" placeholder="Tidak ada dosen yang mengajar" required>
											<?php	} else if ( $jam_sekarang < $selesai_end) { ?>
													<input type="text" disabled="disable" name="nama_peminjam" value="Ruang masih dapat dipinjam" class="form-control" placeholder="Tidak ada dosen yang mengajar" required>
											<?php }else{ ?>
												<input type="text" disabled="disable" name="nama_peminjam" value="Jam peminjaman melebihi batas" class="form-control" placeholder="Tidak ada dosen yang mengajar" required>
											<?php } ?>
										</div>
									</div>
								</div>

							</fieldset>
							<button type="submit" class="btn btn-primary stepy-finish">Kembali <i class="icon-check position-right"></i></button>
						</form>
		            </div>
		            <!-- /basic setup -->
	</div>
</body>