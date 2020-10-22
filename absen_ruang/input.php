<?php
    // error_reporting(0);
    include('koneksi.php');

    $tag = $_GET['tag'];
    $nilai = $_GET['nilai'];
    $id_ruang_manual = $_GET['ruang'];

    date_default_timezone_set('Asia/Jakarta');
    
    //$waktu = date('H:i:s');

    //$jam = date('H');
    //$bulan = date('m');

    //$tanggal = date('d-m-Y');

    $tanggal = date('Y-m-d');
    // $hariIni = 'Mon';

    $hariIni = date('D');

    if($hariIni == "Mon"){
        $hariIni = "Senin";
    }if($hariIni == "Tue"){
        $hariIni = "Selasa";
    }if($hariIni == "Wed"){
        $hariIni = "Rabu";
    }if($hariIni == "Thu"){
        $hariIni = "Kamis";
    }if($hariIni == "Fri"){
        $hariIni = "Jumat";
    }if($hariIni == "Sat"){
        $hariIni = "Sabtu";
    }if($hariIni == "Mon"){
        $hariIni = "Minggu";
    }

    	// $time_input = date('07:31:00');

        $time_input = date('G:i:s');
        // $tinput = date('G:i:s');
        // $time_input = strtotime ( '-11 hour -20 minute' , strtotime ( $tinput ) ) ;
        // $time_input = date ( 'G:i:s' , $time_input );
        // echo $new_input;

        $time_output = date('G:i:s');
        // $toutput = date('G:i:s');
        // $time_output = strtotime ( '-11 hour -20 minute' , strtotime ( $toutput ) ) ;
        // $time_output = date ( 'G:i:s' , $time_output );
        // echo $new_output;  

        $batas = date('12:00:00');

        // if ( $toutput != $batas) {
        //         //echo "belum tengah hari";
        //         $toutput = date('H:i:s');
        //         //echo "Convert = ".$time_input;
        //         $time_output = strtotime ( '-11 hour -20 minute' , strtotime ( $toutput ) ) ;
        //         $time_output = date ( 'H:i:s' , $time_output );
        //     }else{
        //         if ($toutput > $batas) {
        //             //echo "Sudah tengah hari";
        //             $toutput = date('G:i:s');
        //             //echo "Convert = ".$time_input;
        //             $time_output = strtotime ( '-11 hour -20 minute' , strtotime ( $toutput ) ) ;
        //             $time_output = date ( 'G:i:s' , $time_output );
        //         }
        //     }

        if ( $time_output != $batas) {
            //echo "belum tengah hari";
            $time_output = date('H:i:s');
            //echo "Convert = ".$time_input;
        }else{
            if ($time_output > $batas) {
                //echo "Sudah tengah hari";
                $time_output = date('G:i:s');
                //echo "Convert = ".$time_input;
            }
        }

        //echo "G : i : s = ".$time_input."<br>";
        //echo "H : i : s = ".$time_input_2;
        
        //echo "sekarang jam : ".$time_input."<br>";

            // if ( $tinput != $batas) {
            //     //echo "belum tengah hari";
            //     $tinput = date('H:i:s');
            //     //echo "Convert = ".$time_input;
            //     $time_input = strtotime ( '-11 hour -20 minute' , strtotime ( $tinput ) ) ;
            //     $time_input = date ( 'H:i:s' , $time_input );
            // }else{
            //     if ($tinput > $batas) {
            //         //echo "Sudah tengah hari";
            //         $tinput = date('G:i:s');
            //         //echo "Convert = ".$time_input;
            //         $time_input = strtotime ( '-11 hour -20 minute' , strtotime ( $tinput ) ) ;
            //         $time_input = date ( 'G:i:s' , $time_input );
            //     }
            // }

        if ( $time_input != $batas) {
            //echo "belum tengah hari";
            $time_input = date('H:i:s');
            //echo "Convert = ".$time_input;
        }else{
            if ($time_input > $batas) {
                //echo "Sudah tengah hari";
                $time_input = date('G:i:s');
                //echo "Convert = ".$time_input;
            }
        }

        //echo $time_input;
        //echo $time_input = date('H:i:s');

        //untuk coba2
        //echo $hari;
        
        //echo "Jam masuk : ".($time_input);

        /////sesi non jumat
        //sesi 1
            $start_s_1      = date('07:30:00');         
            $end_s_1        = date('08:20:00');         
        //sesi 2
            $start_s_2      = date('08:25:00');         
            $end_s_2        = date('09:15:00');
        //sesi 3
            $start_s_3      = date('09:20:00');
            $end_s_3        = date('10:10:00');
        //sesi 4
            $start_s_4      = date('10:15:00');
            $end_s_4        = date('11:05:00');
        //sesi 5
            $start_s_5      = date('11:10:00');
            $end_s_5        = date('12:00:00');
        //ishoma
            $start_ishoma   = date('12:00:01');     $s_j_ishoma = date('11:05:01');
            $end_ishoma     = date('12:59:59');     
        //sesi 6
            $start_s_6      = date('13:00:00');
            $end_s_6        = date('13:50:00');
        //sesi 7
            $start_s_7      = date('13:55:00');
            $end_s_7        = date('14:45:00');
        //ashar
            $start_ashar    = date('14:45:01');
            $end_ashar      = date('15:29:59');
        //sesi 8
            $start_s_8      = date('15:30:00');
            $end_s_8        = date('16:20:00');
        //sesi 9
            $start_s_9      = date('16:25:00');
            $end_s_9        = date('17:15:00');
        //maghrib
            $start_maghrib  = date('17:15:01');
            $end_maghrib    = date('18:09:59');
        //sesi 10
            $start_s_10     = date('18:10:00');
            $end_s_10       = date('19:00:00');
        //sesi 11
            $start_s_11     = date('19:30:10');
            $end_s_11       = date('20:20:00');
        //sesi 12
            $start_s_12     = date('20:25:00');
            $end_s_12       = date('21:15:00');
        //sesi 13
            $start_s_13     = date('21:20:00');
            $end_s_13       = date('22:10:00');


       /*if (($time_input >= $start_s_1) || ($time_input <= $end_s_1)) {
           //echo $time_input;
           $sesi = 1;
        }else if (($time_input >= $start_s_2) || ($time_input <= $end_s_2)) {
            $sesi = 2;
        }else if (($time_input>=$start_s_3) || ($time_input <= $end_s_3)) {
                $sesi = 3;
               // echo($sesi);
        }else{
            $sesi= 0;
        }*/

        if ($hariIni != 'Jumat') {
            if ($time_input > $start_s_1 && $time_input < $end_s_1) {
                $sesi = 1;
            }else{
                if ($time_input > $start_s_2 && $time_input< $end_s_2) {
                    $sesi = 2;
                }else{
                    if ($time_input > $start_s_3 && $time_input < $end_s_3) {
                        $sesi = 3;
                    }else{
                        if ($time_input > $start_s_4 && $time_input < $end_s_4) {
                            $sesi = 4;
                        }else{
                            if ($time_input > $start_s_5 && $time_input < $end_s_5) {
                                $sesi = 5;
                            }else{
                                if (($time_input>=$start_ishoma) && ($time_input <= $end_ishoma)) {
                                    $sesi = 0;
                                    //echo 'ISHOMA';
                                }else{
                                    if ($time_input > $start_s_6 && $time_input < $end_s_6) {
                                        $sesi = 6;
                                    }else{
                                        if ($time_input > $start_s_7 && $time_input < $end_s_7) {
                                            $sesi= 7;
                                        }else{
                                            if (($time_input>=$start_ashar) && ($time_input <= $end_ashar)) {
                                                $sesi = 0;
                                                echo 'Ashar';
                                            }else{
                                                if (($time_input>=$start_s_8) && ($time_input <= $end_s_8)) {
                                                    $sesi = 8;
                                                }else{
                                                    if (($time_input>=$start_s_9) && ($time_input <= $end_s_9)) {
                                                       $sesi = 9;
                                                    }else{
                                                        if (($time_input>=$start_maghrib) && ($time_input <= $end_maghrib)) {
                                                            $sesi = 0;
                                                            echo "Maghrib";
                                                        }else{
                                                            if (($time_input>=$start_s_10) && ($time_input <= $end_s_10)) {
                                                                $sesi = 10;
                                                            }else{
                                                                if (($time_input>=$start_s_11) && ($time_input <= $end_s_11)) {
                                                                    $sesi = 11;
                                                                }else{
                                                                    if (($time_input>=$start_s_12) && ($time_input <= $end_s_12)) {
                                                                        $sesi = 12;
                                                                    }else{
                                                                        if (($time_input>=$start_s_13) && ($time_input <= $end_s_13)) {
                                                                            $sesi = 13;
                                                                        } 
                                                                    } //end else 13
                                                                }//end else s 12
                                                            } //end else 11
                                                        } //end else 10
                                                    } //end else maghrib
                                                }//end else 9 
                                            }//end else 8
                                        }//end else ashar
                                    }//end else 7
                                }//end else 6
                            }//end else ishoma
                        }//end else 5
                    }//end else 4
                }//end else 3
            }//end else 2
        }else if($hariIni == 'Jumat'){
            if ($time_input>=$start_s_1 && $time_input <= $end_s_1) {
                return $sesi =1;
            }else{
                if ($time_input>=$start_s_2 && $time_input <= $end_s_2) {
                    $sesi = 2;
                }else{
                    if ($time_input >=$start_s_3 && $time_input <= $end_s_3) {
                       $sesi = 3;
                    }else{
                        if (($time_input>=$start_s_4) && ($time_input <= $end_s_4)) {
                            $sesi = 4;
                        }else{
                            if (($time_input>=$s_j_ishoma) && ($time_input <= $end_ishoma)) {
                                $sesi = 0;
                            }else{
                                if (($time_input>=$start_s_6) && ($time_input <= $end_s_6)) {
                                    $sesi = 5;
                                }else{
                                    if (($time_input>=$start_s_7) && ($time_input <= $end_s_7)) {
                                        $sesi = 6;
                                    }else{
                                        if (($time_input>=$start_ashar) && ($time_input <= $end_ashar)) {
                                            $sesi = 0;
                                        }else{
                                            if (($time_input>=$start_s_8) && ($time_input <= $end_s_8)) {
                                                $sesi = 7;
                                            }else{
                                                if (($time_input>=$start_s_9) && ($time_input <= $end_s_9)) {
                                                    $sesi = 8;
                                                }else{
                                                    if (($time_input>=$start_maghrib) && ($time_input <= $end_maghrib)) {
                                                        $sesi = 0;
                                                    }else{
                                                        if (($time_input>=$start_s_10) && ($time_input <= $end_s_10)) {
                                                            $sesi = 9;
                                                        }else{
                                                            if (($time_input>=$start_s_11) && ($time_input <= $end_s_11)) {
                                                                $sesi=10;
                                                            }else{
                                                                if (($time_input>=$start_s_12) && ($time_input <= $end_s_12)) {
                                                                    $sesi = 11;
                                                                }else{
                                                                    if (($time_input>=$start_s_13) && ($time_input <= $end_s_13)) {
                                                                        $sesi = 12;
                                                                    }
                                                                }
                                                            }
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
    //cek anggota
    // echo "nilai = ". $nilai."\n";
    // echo "ruang = ". $id_ruang_manual."\n";
    $anggota = mysqli_query($koneksi, "SELECT * FROM rfid WHERE rfid_number='$tag'");
    $cekAnggota = mysqli_num_rows($anggota);
        $dataAnggota     = mysqli_fetch_array($anggota);
        $id_rfid         = $dataAnggota['rfid_id'];
        $kelas_rfid      = $dataAnggota['rfid_kelas_id'];
        $semester_rfid   = $dataAnggota['rfid_semester_id'];
        $pj_rfid         = $dataAnggota['rfid_penanggung_jawab'];
       /* echo "kelas rfid = ".$kelas_rfid."\n";
        echo "semester_rfid = ".$semester_rfid."\n";*/

        $alat = mysqli_query($koneksi, "SELECT * FROM ruang WHERE id_alat = '$id_ruang_manual' ");
        $dataAlat      = mysqli_fetch_array($alat);
        $ruang_asli    = $dataAlat['ruang_id'];
        // $no_alat       = $dataAlat['id_alat'];
        // if ($no_alat == $id_ruang_manual){
        //     $ruang_asli = $id_ruang_manual;
        // }


    if($cekAnggota == 1 && $pj_rfid =='Admin'){
        echo "Ini kunci Admin";
    }else if ($cekAnggota == 1 && $pj_rfid !='Admin'){
       // echo "Ini kunci Siswa";

        //cek ruang apakah kosong atau isi
        $ruangan        = mysqli_query($koneksi, "SELECT * FROM ruang WHERE ruang_id = '$ruang_asli' ");
        $dataRuang      = mysqli_fetch_array($ruangan);
        $id_ruangan     = $dataRuang['ruang_id'];
        $status_ruang   = $dataRuang['ruang_is_active'];

        //ruang isi lampu nyala -> 
        if ($status_ruang == 1 && $nilai == 0) {
            //echo "Ruang Sedang Digunakan";

            $cek_log = mysqli_query($koneksi, "SELECT * FROM log WHERE log_ruang_id = $ruang_asli AND log_jam_keluar IS NULL");
            $jml_cek_log = mysqli_num_rows($cek_log);
            $v_log = mysqli_fetch_array($cek_log);
            $data_log_rfid = $v_log['log_rfid_id'];
           if ($data_log_rfid == $id_rfid) {
               echo "Kamu bisa masuk";
            }else{
                echo "Kamu tidak bisa masuk";
            }
        //ruang isi lampu padam -> jam_keluar
        }elseif ($status_ruang == 1 && $nilai == 1) {
            $cek_log = mysqli_query($koneksi, "SELECT * FROM log WHERE log_ruang_id = $ruang_asli AND log_jam_keluar IS NULL");
            $jml_cek_log = mysqli_num_rows($cek_log);
            $v_log = mysqli_fetch_array($cek_log);
            $data_log_rfid = $v_log['log_rfid_id'];
            if ($data_log_rfid == $id_rfid) {
                echo "Kamu bisa keluar";
                mysqli_query($koneksi, "
                                UPDATE log SET log_jam_keluar = '$time_output' WHERE log_ruang_id = '$ruang_asli' AND log_jam_keluar IS NULL
                            ");
                mysqli_query($koneksi, "
                                UPDATE ruang SET ruang_is_active = '0' WHERE ruang_id = '$ruang_asli'
                            ");
            }else{
                echo "Kamu tidak bisa keluar";
            }
        }
        else if($status_ruang == 0 && $nilai == 1){
            //echo "Ruang Kosong";
            //echo "Ini bukan Admin -> cek jadwal";
            //cek jadwal berdasarkan tahun ajaran aktif
            $q_tahun_ajaran         = mysqli_query($koneksi, "SELECT * FROM tahun_ajaran WHERE tahun_ajaran_is_active = 1");
            $val_tahun_ajaran       = mysqli_fetch_array($q_tahun_ajaran);
            $tahun_ajaran_id_sekarang    = $val_tahun_ajaran['tahun_ajaran_id'];
            //cek jadwal berdasarkan tahun semester aktif
            $q_tahun_semester       = mysqli_query($koneksi, "SELECT * FROM tahun_semester WHERE tahun_semester_is_active = 1");
            $val_tahun_semester     = mysqli_fetch_array($q_tahun_semester);
            $tahun_semester_id_sekarang = $val_tahun_semester['tahun_semester_id'];
            //cek jadwal saat ini

           /* echo "Sesi = ".$sesi."\n";
            echo "tahun_ajaran_id_sekarang = ".$tahun_ajaran_id_sekarang."\n";
            echo "tahun semester : ".$tahun_semester_id_sekarang."\n";
            echo "hari : ".$hariIni."\n";
            echo "ruang : ".$id_ruang_manual."\n";*/
            $data_jadwal = mysqli_query($koneksi, "SELECT * FROM jadwal WHERE jadwal_ruang_id='$ruang_asli' 
                                                                    AND jadwal_sesi = '$sesi'
                                                                    AND jadwal_tahun_berjalan = '$tahun_ajaran_id_sekarang'
                                                                    AND jadwal_tahun_semester_id = '$tahun_semester_id_sekarang'
                                                                    AND jadwal_hari = '$hariIni'
                                                                    
            ");
            $cekJadwal = mysqli_num_rows($data_jadwal);
            $dataJadwal     = mysqli_fetch_array($data_jadwal);
                $id_jadwal      = $dataJadwal['jadwal_id'];
                $tahun_ajaran   = $dataJadwal['jadwal_tahun_berjalan'];
                $tahun_semester = $dataJadwal['jadwal_tahun_semester_id'];
                $semester_jadwal= $dataJadwal['jadwal_semester_id'];
                $hari           = $dataJadwal['jadwal_hari'];
                $sesi           = $dataJadwal['jadwal_sesi'];
                $jam_mulai      = $dataJadwal['jadwal_jam_mulai'];
                $jam_selesai    = $dataJadwal['jadwal_jam_akhir'];
                $makul          = $dataJadwal['jadwal_makul_id'];
                $ruang          = $dataJadwal['jadwal_ruang_id'];
                $kelas_jadwal   = $dataJadwal['jadwal_kelas_id'];
                $dosen          = $dataJadwal['jadwal_dosen_id'];
                /*echo "kelas jadwal ".$kelas_jadwal."\n";
                echo "semester jadwal = ".$semester_jadwal."\n";*/
            //echo  "enek jadwal po ra? ".$cekJadwal;
            if($cekJadwal == 1 ){
                //echo "Ada Jadwal";
                if ($kelas_rfid == $kelas_jadwal && $semester_rfid == $semester_jadwal && $nilai == 1) {
                    echo "Kamu bisa masuk";

                    mysqli_query($koneksi, "
                                        INSERT INTO log (log_jadwal_id, log_rfid_id, log_tanggal, log_jam_masuk, log_ruang_id, log_status) VALUES ('$id_jadwal', '$id_rfid', '$tanggal', '$time_input', '$ruang_asli', 'By RFID')
                                ");
                    mysqli_query($koneksi, "
                                        UPDATE ruang SET ruang_is_active = '1' WHERE ruang_id = '$ruang_asli'
                                ");
                }else {
                    echo "Ada Jadwal Kelas Tidak Cocok";
                }
            }elseif ($cekJadwal == 0) {
                echo "Tidak Ada Jadwal";
            }
        }else if($status_ruang == 0 && $nilai == 0){
            echo "Kamu tidak bisa masuk";
        }
    } elseif ($cekAnggota == 0) {
        echo "Kartu Tidak Terdaftar";
        mysqli_query($koneksi, "INSERT INTO tag (notag) VALUES ('$tag')");
    }
    
?>