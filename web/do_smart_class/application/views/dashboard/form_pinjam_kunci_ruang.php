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
		error_reporting(0);
		foreach ($data_ruang as $data) {
			$id 	= $data->ruang_id;
			$nama 	= $data->ruang_nama;
		}

		
		foreach ($now as $cetes) {
			$id_jadwal 	= $cetes->jadwal_id;
			$jam_mulai 	= $cetes->jadwal_jam_mulai;
			$jam_selesai= $cetes->jadwal_jam_akhir;
			$makul 		= $cetes->makul_nama;
			$kelas_nama = $cetes->kelas_nama;
			$kelas_id 	= $cetes->kelas_id;
			$smt 		= $cetes->jadwal_semester_id;
			$dosen 		= $cetes->dosen_nama;
			$smt 		= $cetes->jadwal_tahun_semester_id;
			$sesi 		= $cetes->jadwal_sesi;
		}
		//echo "Sekarang : ".$jam_sekarang = date('07:31:00')."<br>";
		//echo "ID jadwa : ".$id_jadwal."<br>";
		//echo "Jam mulai : ".$jam_mulai."<br>";
		
		//$jam_sekarang = date('11:11:11');
		$jam_sekarang = date('G:i:s');
		//echo  "Sekarang : ".$jam_sekarang."<br>";

		//echo is_null($id_jadwal);

		//echo "Jam mulai : ".$jam_mulai."<br>";
		//echo $jam_sekarang = date('08:38:00');
		/*echo "ID jadwal : ".$id_jadwal."<br>";
		echo "Jam mulai : ".$jam_mulai."<br>";
		echo "Makul : ".$makul."<br>";
		echo "Kelas ID : ".$kelas_id."<br>";
		echo "Kelas : ".$kelas_nama."<br>";
		echo "Semester : ".$smt."<br>";
		echo "Jam sekarang : ".$jam_sekarang."<br>";*/



		$jam_boleh_pinjam = date('G:i:s',strtotime('+20 minutes',strtotime($jam_mulai)));
		//$jam_boleh_pinjam = date('07:50:00');
		//echo "Jam boleh pinjam : ".$jam_boleh_pinjam."<br>";
		

		//echo "apakah ada jadwal ? ".$cek_pj;

		foreach ($pj_sekarang as $key ) {
			$nama_peminjam = $key->rfid_penanggung_jawab;
			$no_telp 		= $key->rfid_no_handpon_pj;
		}
		//echo $nama_peminjam;
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


	                	<form class="stepy-basic" action="form_pinjam_2.html" method="post">
							<fieldset title="1">
								<legend class="text-semibold">Data Peminjam</legend>

								<div class="row" style="margin-bottom: 10px">
                        			<div class="col-md-4"> </div>
                        			<div class="col-md-4 text-center">
                            			<div style="margin-top: 8px" id="message">
                                			<?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                            			</div>
                        			</div>
                        			<div class="col-md-1 text-right">
                        			</div>
                    			</div>

								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label><b>Nama Peminjam:</b></label>

											<?php
												if (is_null($nama_peminjam)) { ?>
													<input type="text" name="nama_peminjam" class="form-control" placeholder="Nama lengkap peminjam" required>
											<?php
												}else if ($jam_sekarang < $jam_boleh_pinjam) { ?>
													<input type="text" disabled="disable" name="nama_peminjam" class="form-control" value="<?php echo $nama_peminjam ?>" placeholder="Nama lengkap peminjam" required>
													<input type="hidden" name="nama_peminjam" class="form-control" value="<?php echo $nama_peminjam ?>" placeholder="Nama lengkap peminjam" required>
											<?php }else{ ?>
													<input type="text" name="nama_peminjam" class="form-control" placeholder="Nama lengkap peminjam" required>
												<?php } ?>
											
										</div>
									</div>

									<div class="col-md-6">
										<div class="form-group">
											<label>Kelas:</label>
												<?php if (is_null($nama_peminjam)) { ?>
													<select class="form-control" name="kelas" id="kelas" required >
													
														<?php
						                            foreach ($list_kelas as $kls) { ?>
						                                <option value="<?php echo $kls->kelas_id; ?>">
						                                	<?php echo $kls->kelas_nama;?>
						                                </option>
						                            
						                         <?php   }
						                        ?>
													</select>
													
												<?php }else  if ($jam_sekarang < $jam_boleh_pinjam) { ?>
														<input type="text" disabled="disable" name="kelas" class="form-control" placeholder="kelas" value="<?php echo $kelas_nama ?>" required>
														<input type="hidden" name="kelas" class="form-control" placeholder="kelas" value="<?php echo $kelas_id; ?>" required>
												<?php }else{ ?>
													<select class="form-control" name="kelas" id="kelas" required >
													
														<?php
						                            foreach ($list_kelas as $kls) { ?>
						                                <option value="<?php echo $kls->kelas_id; ?>"><?php echo $kls->kelas_nama;?></option>
						                            
						                         <?php   }
						                        ?>

													
												<?php	} ?>
												</select>
		                   					
										</div>
									</div>
								</div>

								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label>Nomor Telepon:</label>
											<?php
												if (is_null($nama_peminjam)) { ?>
													<input type="number" name="no_telp" class="form-control" placeholder="Nomor telepon yang dapat dihubungi" required>
											<?php	}else if ($jam_sekarang < $jam_boleh_pinjam) { ?>
													<input type="text" disabled="disable" name="no_telp" class="form-control" value="<?php echo $no_telp; ?>" placeholder="Nomor telepon yang dapat dihubungi" required>
													<input type="hidden"  name="no_telp" class="form-control" value="<?php echo $no_telp; ?>" placeholder="Nomor telepon yang dapat dihubungi" required>
											<?php }else{ ?>
												<input type="number" name="no_telp" class="form-control" placeholder="Nomor telepon yang dapat dihubungi" required>
											<?php } ?>
											
										</div>
									</div>

									<div class="col-md-6">
										<div class="form-group">
											<label>Semester:</label>
											
											<?php 
												if (is_null($nama_peminjam)) { ?>
													<select class="form-control" name="semester" id="semester" required >
													
														<?php
						                            foreach ($list_semester as $smt) { ?>
						                                <option value="<?php echo $smt->semester_id; ?>"><?php echo $smt->semester_nama;?></option>
						                            
						                         <?php   }
						                        ?>
						                        	</select>
											<?php	}else if ($jam_sekarang < $jam_boleh_pinjam) { ?>
														<input type="text" disabled="disable" name="semester" class="form-control" placeholder="kelas" value="<?php echo $smt ?>" required>
														<input type="hidden"  name="semester" class="form-control" placeholder="kelas" value="<?php echo $smt ?>" required>
												<?php }else{ ?>
													<select class="form-control" name="semester" id="semester" required >
													
														<?php
						                            foreach ($list_semester as $smt) { ?>
						                                <option value="<?php echo $smt->semester_id; ?>"><?php echo $smt->semester_nama;?></option>
						                            
						                         <?php   }
						                        ?>
						                        	</select>
													
												<?php	} ?>
												
                       						
										</div>
									</div>
								</div>

								<?php
									$null_pj = is_null($nama_peminjam);
									//echo $null_pj;
									if ($jam_sekarang < $jam_boleh_pinjam && $null_pj != 1) { ?>
										<div class="row">
											<div class="col-md-3">
												<div class="form-group">
													<label>Mata Kuliah</label>
													<input type="text" disabled="disable" name="makul" class="form-control" placeholder="makul" value="<?php echo $makul; ?>" required>
												</div>
											</div>
											<div class="col-md-2">
												<div class="form-group">
													<label>Dosen Pengampu</label>
													<input type="text" disabled="disable" name="dosen" class="form-control" placeholder="dosen" value="<?php echo $dosen; ?>" required>
												</div>
											</div>
											<div class="col-md-1">
												<div class="form-group">
													<label>Sesi</label>
													<input type="text" disabled="disable" name="dosen" class="form-control" placeholder="dosen" value="<?php echo $sesi; ?>" required>
												</div>
											</div>
											<div class="col-md-2">
												<div class="form-group">
													<label>Jam Mulai</label>
													<input type="text" disabled="disable" name="start" class="form-control" placeholder="Jam mulai" value="<?php echo $jam_mulai; ?>" required>
												</div>
											</div>
											<div class="col-md-2">
												<div class="form-group">
													<label>Jam Selesai</label>
													<input type="text" disabled="disable" name="end" class="form-control" placeholder="Jam selesai" value="<?php echo $jam_selesai; ?>" required>
												</div>
											</div>
											<div class="col-md-2">
												<div class="form-group">
													<label>Jam Boleh Pinjam</label>
													<input type="text" disabled="disable" name="can_borrow" class="form-control" placeholder="boleh pinjam" value="<?php echo $jam_boleh_pinjam; ?>" required>
												</div>
											</div>
										</div>
								<?php } ?>
								

								<div class="row">
									<div class="col-md-3">
										<div class="form-group">
											<label> </label>
											<input type="hidden" name="id_ruang" class="form-control" placeholder="id_ruang" value="<?php echo $id; ?>" required>
											<input type="hidden" name="id_jadwal" class="form-control" placeholder="id_jadwal" value="<?php echo $id_jadwal; ?>" required>
											<input type="hidden" name="jam_sekarang" class="form-control" placeholder="sekarang" value="<?php echo $jam_sekarang; ?>" required>
											<input type="hidden" name="jam_boleh_pinjam" class="form-control" placeholder="sekarang" value="<?php echo $jam_boleh_pinjam; ?>" required>
											<input type="hidden" name="null_pj" class="form-control" placeholder="sekarang" value="<?php echo $null_pj; ?>" required>
										</div>
									</div>
								</div>

							</fieldset>
							
								
									
							
								<button type="submit" class="btn btn-primary stepy-finish"><i class="icon-check position-left"></i> Submit </button>
							
							
						</form>
		            </div>
		            <!-- /basic setup -->
	</div>
</body>