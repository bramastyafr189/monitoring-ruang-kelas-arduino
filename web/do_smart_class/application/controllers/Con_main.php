<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Con_main extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Model_main');
        $this->load->model('Model_rfid');
        $this->load->model('Model_monitoring');
        $this->load->model('Model_jadwal');
        $this->load->library('form_validation');        
        $this->load->library('datatables');
        $this->load->library('template');
        $this->load->library('table');
        date_default_timezone_set('Asia/Jakarta');

        //session
        if(!$this->session->userdata('user_id')){
             redirect('login_page.html');
        }
        $this->load->helper('url');
    }
    public function cek_data(){
        $ip=$this->Model_siswa->get_real_ip();
        print_r($ip);
    }

    public function dashboard(){
        url_title('cek.html');
        $data['status_ruang']=$this->Model_main->status_ruang();
        $this->template->display('dashboard',$data);    

    }

    /*public function aktifkan_ruang()
        {
            $id = $this->input->get('id');
            $this->Model_main->ruang_enable($id);
            redirect('dashboard.html');
        } 

    public function non_aktifkan_ruang()
        {
            $id = $this->input->get('id');
            $this->Model_main->ruang_disable($id);
            redirect('dashboard.html');
        }*/

    /*public function jadwal_penggunaan_ruang()
    {
        $id                     = $this->input->get('id');
        

        $data['jadwal_senin']   = $this->Model_main->jadwal_senin($id);
        $data['jadwal_selasa']  = $this->Model_main->jadwal_selasa($id);
        $data['jadwal_rabu']    = $this->Model_main->jadwal_rabu($id);
        $data['jadwal_kamis']   = $this->Model_main->jadwal_kamis($id);
        $data['jadwal_jumat']   = $this->Model_main->jadwal_jumat($id);
        $this->template->display('dashboard/jadwal_penggunaan_ruang', $data);
    }*/

    public function pinjam_kunci_ruang()
    {
        error_reporting(0);
        $id = $this->input->get('id');

        //$hari = 'Selasa';
        $hari = $this->casting_hari();
        //echo $hari;
        $sesi = $this->casting_sesi();
        //echo $sesi;

        $get_tahun      = $this->Model_jadwal->get_tahun_aktif();
        $tahun_ajaran   = $get_tahun->tahun_ajaran_id;

        //echo $tahun_ajaran;

        $get_smt    = $this->Model_jadwal->get_semester_aktif();
        $tahun_semester   = $get_smt->tahun_semester_id;

        $data['id_ruang']       = $id;
        $data['list_kelas']     = $this->Model_rfid->list_kelas();
        $data['list_semester']  = $this->Model_rfid->list_semester();
        $data['data_ruang']     = $this->Model_main->getDataRuang($id);
        $data['now']            = $this->Model_main->jadwal_sekarang($id, $hari, $sesi, $tahun_ajaran, $tahun_semester);
        $data['sesi']           = $sesi;

        
        //$sesi = $this->casting_sesi();
        $now = $this->Model_main->jadwal_sekarang($id, $hari, $sesi, $tahun_ajaran, $tahun_semester);
        /*echo "<pre>";
        print_r($now);
        echo "</pre>";*/

        foreach ($now as $n) {
            $kelas      = $n->kelas_id;
            $semester   = $n->jadwal_semester_id;
        }
        /*echo "Kelas : ".$kelas."<br>";
        echo "Semester : ".$semester;
*/
        //$data['pj_sekarang'] = $this->Model_rfid->get_data_by_kls_dan_smt($kelas, $semester);
        

        $data['pj_sekarang'] = $this->Model_rfid->get_data_by_kls_dan_smt($kelas, $semester);
        $pj_sekarang = $this->Model_rfid->get_data_by_kls_dan_smt($kelas, $semester);
        //print_r($pj_sekarang);

        

        //$data['jam_mulai'] = $mulai;
        

        //$data['tahun_monitoring'] = $id;
        $this->session->set_flashdata('message',
                                                '<div class="alert bg-primary alert-styled-left">
                                                    <button type="button" class="close" data-dismiss="alert">
                                                        <span>×</span>
                                                        <span class="sr-only">Close</span>
                                                    </button>
                                                    Ruang baru dapat dipinjam kelas lain jika kelas asli tidak masuk dalam 20 menit
                                                </div>'); 


        $this->template->display('dashboard/form_pinjam_kunci_ruang', $data);
    }

    public function exe_pinjam_kunci()
    {
        $id_ruang   = $this->input->post('id_ruang');
        $nama_pj    = $this->input->post('nama_peminjam');
        $no_telp    = $this->input->post('no_telp');
        $kelas      = $this->input->post('kelas');
        $semester   = $this->input->post('semester');
        $null_pj    = $this->input->post('null_pj');
        $nama_pj_2 = strtolower($nama_pj);
        $nama_pj_3 = ucwords($nama_pj_2);

        $jam_input = $this->input->post('jam_sekarang');
        $jam_boleh_pinjam = $this->input->post('jam_boleh_pinjam');

        $cek_nama_peminjam =  $this->Model_main->get_pj_rfid($nama_pj_3);

        //echo $cek_nama_peminjam;

        if ($null_pj == 1) {
            if ($cek_nama_peminjam == 1 ) {
                $this->session->set_flashdata('message',
                                                '<div class="alert bg-warning alert-styled-left">
                                                    <button type="button" class="close" data-dismiss="alert">
                                                        <span>×</span>
                                                        <span class="sr-only">Close</span>
                                                    </button>
                                                    <span class="text-semibold">Nama PJ</span> sudah digunakan
                                                </div>'); 
                redirect('dashboard.html');
            }else{
                $data['data_ruang'] = $this->Model_main->getDataRuang($id_ruang);
                $data['nama_pj']    = $nama_pj;
                $data['no_telp']    = $no_telp;
                $data['kelas']      = $kelas;
                $data['semester']   = $semester;
                $data['makul']      = $this->Model_main->getMakul($kelas, $semester);
                $this->template->display('dashboard/form_pilih_ruang', $data);
            }
        }elseif ($jam_input < $jam_boleh_pinjam) {
            if ($cek_nama_peminjam == 1 ) {
                $this->session->set_flashdata('message',
                                                '<div class="alert bg-warning alert-styled-left">
                                                    <button type="button" class="close" data-dismiss="alert">
                                                        <span>×</span>
                                                        <span class="sr-only">Close</span>
                                                    </button>
                                                    <span class="text-semibold">Nama PJ</span> sudah digunakan
                                                </div>'); 
                redirect('dashboard.html');
            }else{
                $data_rfid = array(
                    'rfid_kelas_id'             => $this->input->post('kelas'),
                    'rfid_semester_id'          => $this->input->post('semester'),
                    'rfid_penanggung_jawab'     => $this->input->post('nama_peminjam'),
                    'rfid_no_handpon_pj'        => $this->input->post('no_telp'),
                    'rfid_is_active'            => 2
                );
                $id_rfid = $this->Model_rfid->insert_data_rfid($data_rfid);

                $data_log = array(
                    'log_jadwal_id' => $this->input->post('id_jadwal'),
                    'log_rfid_id'   => $id_rfid,
                    'log_tanggal'   => date('Y-m-d'),
                    'log_jam_masuk' => date('H:i:s'),
                    'log_ruang_id'  => $this->input->post('id_ruang'),
                    'log_status'    => 'By manual'
                );
                $this->Model_monitoring->insert_data_log($data_log);
                $this->Model_monitoring->ruang_is_disable($this->input->post('id_ruang'));

                $this->session->set_flashdata('message',
                                                '<div class="alert bg-success alert-styled-left">
                                                    <button type="button" class="close" data-dismiss="alert">
                                                        <span>×</span>
                                                        <span class="sr-only">Close</span>
                                                    </button>
                                                    <span class="text-semibold">Peminjaman ruang berhasil</span> 
                                                </div>');

                redirect('dashboard.html');
            }
        }else{
            if ($cek_nama_peminjam == 1 ) {
                $this->session->set_flashdata('message',
                                                    '<div class="alert bg-warning alert-styled-left">
                                                        <button type="button" class="close" data-dismiss="alert">
                                                            <span>×</span>
                                                            <span class="sr-only">Close</span>
                                                        </button>
                                                        <span class="text-semibold">Nama PJ</span> sudah digunakan
                                                    </div>'); 
                redirect('dashboard.html');
            }else{
                /*$this->session->set_flashdata('message',
                                                    '<div class="alert bg-success alert-styled-left">
                                                        <button type="button" class="close" data-dismiss="alert">
                                                            <span>×</span>
                                                            <span class="sr-only">Close</span>
                                                        </button>
                                                        <span class="text-semibold">Peminjaman ruang</span> berhasi
                                                    </div>'); */
                //redirect('form_pinjam_2.html');
                $data['data_ruang'] = $this->Model_main->getDataRuang($id_ruang);
                $data['nama_pj']    = $nama_pj;
                $data['no_telp']    = $no_telp;
                $data['kelas']      = $kelas;
                $data['semester']   = $semester;
                $data['makul']      = $this->Model_main->getMakul($kelas, $semester);
                $this->template->display('dashboard/form_pilih_ruang', $data);
            } 
    }

        /*echo "ID ruang = ".$id_ruang."<br>";
        echo "Nama PJ = ".$nama_pj."<br>";
        echo "No handphone = ".$no_telp."<br>";
        echo "Kelas = ".$kelas."<br>";
        echo "semester = ".$semester."<br>";
        echo "Nama pj kecil = ".$nama_pj_2."<br>";

        echo "Nama pj eyd = ".$nama_pj_3."<br>";
        echo "cek nama = ".$cek_nama_peminjam;*/

        //$this->Model_main->cek_peminjam($nama_pj);

    }

    public function pinjam_fix()
    {   

        echo $this->input->post('nama_peminjam');
        echo $this->input->post('mapel');
        echo $this->input->post('no_telp');
        echo $this->input->post('kelas');
        echo $this->input->post('semester');

        $data_rfid = array(
            'rfid_kelas_id'             => $this->input->post('kelas'),
            'rfid_semester_id'          => $this->input->post('semester'),
            'rfid_penanggung_jawab'     => $this->input->post('nama_peminjam'),
            'rfid_no_handpon_pj'        => $this->input->post('no_telp'),
            'rfid_is_active'            => 2
        );
        $id_rfid = $this->Model_rfid->insert_data_rfid($data_rfid);
        
        $data_log = array(
            'log_jadwal_id' => $this->input->post('mapel'),
            'log_rfid_id'   => $id_rfid,
            'log_tanggal'   => date('Y-m-d'),
            'log_jam_masuk' => date('H:i:s'),
            'log_ruang_id'  => $this->input->post('id_ruang'),
            'log_status'    => 'By manual'
            );

        $this->Model_monitoring->insert_data_log($data_log);

        $id_ruang = $this->input->post('id_ruang');
        $this->Model_monitoring->ruang_is_disable($id_ruang);

        $this->session->set_flashdata('message',
                                                '<div class="alert bg-success alert-styled-left">
                                                    <button type="button" class="close" data-dismiss="alert">
                                                        <span>×</span>
                                                        <span class="sr-only">Close</span>
                                                    </button>
                                                    <span class="text-semibold">Peminjaman ruang</span> berhasil
                                                </div>');
        
        redirect('dashboard.html');
    }

    public function kunci_kembali()
    {
        $id = $this->input->get('id');
        //echo $this->input->get('id');
        //$query = $this->db->query('SELECT * FROM log WHERE log_ruang_id ='.$id.'')
        $data_log = $this->Model_main->get_log_by_id($id);
        
        ##cara mengakses nila $query ?
            //echo "log_id : ".$query->log_id;

        foreach ($data_log as $log) {
            $id_log     = $log->log_id."<br>";
            $jadwal_id  = $log->log_jadwal_id;
            $rfid_id    = $log->log_rfid_id;
        }

        $this->Model_main->waktu_selesai_pakai_ruang($id_log);

        $this->Model_main->aktifkan_ruang($id);

        $this->Model_main->bebaskan_pj($rfid_id);
        
        $this->session->set_flashdata('message',
                                                '<div class="alert bg-success alert-styled-left">
                                                    <button type="button" class="close" data-dismiss="alert">
                                                        <span>×</span>
                                                        <span class="sr-only">Close</span>
                                                    </button>
                                                    <span class="text-semibold">Kunci</span> sudah dikembalikan
                                                </div>');
        redirect('dashboard.html');
    }

    public function casting_hari()
    {
        //
        ////echo $id;
        //$day = 'Tue';
        $day = date('D');

        //$day = 'Fri';
        //echo date('D');

        switch ($day) {
            case 'Sun':
                $hari = 'Minggu';
                 //echo $hari;
                break;

            case 'Mon':
                $hari = 'Senin';
               // echo $hari;
                break;

            case 'Tue':
                $hari = 'Selasa';
                //echo $hari;
                break;

            case 'Wed':
                $hari = 'Rabu';
                //echo $hari;
                break;

            case 'Thu':
                $hari = 'Kamis';
                //echo($hari);
                break;

            case 'Fri':
                $hari = 'Jumat';
               // echo($hari);
                break;

            case 'Sat':
                $hari = 'Sabtu';
               // echo($hari);
                break;
            
            default:
                echo "Semua hari itu baik";
                break;
        }

        return $hari;
    }

    public function casting_sesi()
    {
        $hari = $this->casting_hari();
        //sesi

        //$time_input = date('07:31:10');
        $time_input = date('G:i:s');
        //$time_input_2 = date('H:i:s');

        //echo "G : i : s = ".$time_input."<br>";
        //echo "H : i : s = ".$time_input_2;
        $batas = date('12:00:00');
        //echo "sekarang jam : ".$time_input."<br>";
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

        if ($hari != 'Jumat') {
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
        }else if($hari == 'Jumat'){
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

        return $sesi;
    }

    public function jadwal_saat_ini()
    {   
        error_reporting(0);
        $id         = $this->input->get('id');

        $get_tahun  = $this->Model_jadwal->get_tahun_aktif();
        $tahun_ajaran      = $get_tahun->tahun_ajaran_id;

        //echo $tahun_ajaran;

        $get_smt    = $this->Model_jadwal->get_semester_aktif();
        $tahun_semester   = $get_smt->tahun_semester_id;

        //echo $tahun_semester;

        $hari = $this->casting_hari();
        $sesi =  $this->casting_sesi();

        /*echo "Hari : ".$hari;
        echo "<br>";
        echo "Sesi : ".$sesi;
        echo "<br>";*/
        //echo date('G:i:s');

        $data['jadwal_sekarang'] = $this->Model_main->jadwal_sekarang($id, $hari, $sesi, $tahun_ajaran, $tahun_semester);
        $data['data_ruang']      = $this->Model_main->getDataRuang($id);
        $this->template->display('dashboard/jadwal_saat_ini', $data);
    }

    public function status_peminjaman()
    {   
        error_reporting(0);
        $id = $this->input->get('id');
       // echo "ID ruang : ".$id."<br>";

        $hari = $this->casting_hari();
        $sesi =  $this->casting_sesi();

        /*echo "Hari : ".$hari."<br>";
        echo "Sesi : ".$sesi."<br>";*/

        $get_tahun  = $this->Model_jadwal->get_tahun_aktif();
        $tahun_ajaran      = $get_tahun->tahun_ajaran_id;

//        echo "ajaran : ".$tahun_ajaran."<br>";

        $get_smt    = $this->Model_jadwal->get_semester_aktif();
        $tahun_semester   = $get_smt->tahun_semester_id;

  //      echo "semeset : ".$tahun_semester."<br>";


        $data['jadwal_mulai'] = $this->Model_main->jadwal_sekarang($id, $hari, $sesi, $tahun_ajaran, $tahun_semester);
        $data_start = $this->Model_main->jadwal_sekarang($id, $hari, $sesi, $tahun_ajaran, $tahun_semester);
        //print_r($data_start);

        foreach ($data_start as $start) {
            $jadwal_id      = $start->jadwal_id;
            $id_makul       = $start->jadwal_makul_id;
            $nama_makul     = $start->makul_nama;
            $kelas          = $start->jadwal_kelas_id;
            $hari           = $start->jadwal_hari;
        }

        
        /*echo "Jadwal makul id : ".$id_makul."<br>";
        echo "Makul nama : ".$nama_makul."<br>";
*/
        /*echo "<br>";
        echo "<br>";
        echo "Jadwal makul id : ".$id_makul."<br>";
        echo "Makul nama : ".$nama_makul."<br>";
        echo "Kelas id : ".$kelas."<br>";
        echo "Hari : ".$hari."<br>";*/

        $sesi_end = $this->Model_main->sesi_selesai($nama_makul, $hari, $id, $kelas, $tahun_ajaran, $tahun_semester);

        $sesi_end_data = $sesi_end->jadwal_sesi;

        //echo "sesi_end : ".$sesi_end_data."<br>";

        $jadwal_selesai = $this->Model_main->jadwal_selesai($id, $hari, $sesi_end_data,$tahun_ajaran, $tahun_semester);
        //print_r($jadwal_selesai);

        //echo "<br> <br>";

        $log_peminjaman = $this->Model_main->get_log_by_id($id);
        //print_r($log_peminjaman);

        $data['jadwal_sekarang'] = $this->Model_main->jadwal_sekarang($id, $hari, $sesi, $tahun_ajaran, $tahun_semester);
        $data['log_peminjaman'] = $this->Model_main->get_log_by_id($id);
        $data['jadwal_selesai'] = $this->Model_main->jadwal_selesai($id, $hari, $sesi_end_data, $tahun_ajaran, $tahun_semester);
        $data['data_ruang']     = $this->Model_main->getDataRuang($id);

        $this->template->display('dashboard/cek_peminjam', $data);
        

    }

    public function cari_jadwal()
        {
            $id_ruang = $this->input->get('id');
            $get_tahun  = $this->Model_jadwal->get_tahun_aktif();
            $tahun_ajaran      = $get_tahun->tahun_ajaran_id;

            //echo "Tahun ajaran : ".$tahun_ajaran."<br>";

            $get_smt    = $this->Model_jadwal->get_semester_aktif();
            $tahun_semester   = $get_smt->tahun_semester_id;

            //echo "semester : ".$tahun_semester."<br>";

            $data['tahun_ajaran_aktif']   = $tahun_ajaran;
            $data['tahun_semester_aktif'] = $tahun_semester;
            $data['data_ruang']     = $this->Model_main->getDataRuang($id_ruang);
            $data['list_tahun']     = $this->Model_jadwal->list_tahun();
            $data['list_semester']  = $this->Model_jadwal->list_semester();
            $data['id_ruang']       = $id_ruang;
            $this->template->display('dashboard/cari_jadwal', $data);

            /*$thn = $this->Model_jadwal->list_tahun();
            print_r($thn);
            echo "<br> <br>";
            $smt = $this->Model_jadwal->list_semester();
            print_r($smt);

            echo "ID ruang : ".$id_ruang;*/
            
        }

    public function get_jadwal()
    {   //error_reporting(0);
        $id_ruang = $this->input->post('id_ruang');
        //echo $id_ruang;
        $tahun_ajaran = $this->input->post('tahun');
        $semester = $this->input->post('smt');
        $cek_jadwal = $this->Model_main->cek_jadwal($tahun_ajaran, $semester);
        /*echo $cek_jadwal;
        echo  $tahun_ajaran;
        echo $semester;
        echo $id_ruang;*/

        /*echo "id ruang : ".$id_ruang."<br>";
        echo "tahun ajaran : ".$tahun_ajaran."<br>";
        echo "semester : ".$semester."<br>";
        echo "jml makoel : ".$cek_jadwal;*/

        if ($cek_jadwal == 0) {
            foreach ($this->getJSON($tahun_ajaran, $semester) as $json) {
                /*echo '<pre>';
                print_r ($json);
                echo '</pre>';*/
                $this->insertJSON($json);
            }
        
            $this->getRuang($tahun_ajaran, $semester);
            $this->getMakul($tahun_ajaran, $semester);
            $this->getDosen($tahun_ajaran, $semester);
            $this->getKelas($tahun_ajaran, $semester);
            $this->getJadwal($tahun_ajaran, $semester);

            $data['ruang_nama']     = $this->Model_main->getDataRuang($id_ruang);
            $data['jadwal_senin']   = $this->Model_main->jadwal_senin($id_ruang, $tahun_ajaran, $semester);
            $data['jadwal_selasa']  = $this->Model_main->jadwal_selasa($id_ruang, $tahun_ajaran, $semester);
            $data['jadwal_rabu']    = $this->Model_main->jadwal_rabu($id_ruang, $tahun_ajaran, $semester);
            $data['jadwal_kamis']   = $this->Model_main->jadwal_kamis($id_ruang, $tahun_ajaran, $semester);
            $data['jadwal_jumat']   = $this->Model_main->jadwal_jumat($id_ruang, $tahun_ajaran, $semester);
            $this->template->display('dashboard/jadwal_penggunaan_ruang', $data);
        }else if ($cek_jadwal >0){
            //echo "langsung cuus";
            $data['ruang_nama']     = $this->Model_main->getDataRuang($id_ruang);
            $data['jadwal_senin']   = $this->Model_main->jadwal_senin($id_ruang, $tahun_ajaran, $semester);
            $data['jadwal_selasa']  = $this->Model_main->jadwal_selasa($id_ruang, $tahun_ajaran, $semester);
            $data['jadwal_rabu']    = $this->Model_main->jadwal_rabu($id_ruang, $tahun_ajaran, $semester);
            $data['jadwal_kamis']   = $this->Model_main->jadwal_kamis($id_ruang, $tahun_ajaran, $semester);
            $data['jadwal_jumat']   = $this->Model_main->jadwal_jumat($id_ruang, $tahun_ajaran, $semester);
            $this->template->display('dashboard/jadwal_penggunaan_ruang', $data);
        }
    }

        public function getJSON($tahun, $semester)
    {
        // URL JSON jadwal.uns.ac.id
            //$url = 'https://jadwal.uns.ac.id/index.php?r=api/getdatapenggunaanruang&thn=2018&smt=2&prodi=132';

        $url = 'https://jadwal.uns.ac.id/index.php?r=api/getdatapenggunaanruang&thn='.$tahun.'&smt='.$semester.'&prodi=132';

        // GET data JSON from URL
        $data = file_get_contents($url);

        // Convert string JSON to PHP array
        $data = json_decode($data);

        return $data;
    }

    // memasukkan data json ke database
    public function insertJSON($data = [])
    {
        $this->db->insert('data_api_generate', $data);
    }

    public function getRuang($tahun, $semester)
    {
        $this->db->select('IDRUANG, NAMARUANG');
        $this->db->from('data_api_generate');
        $this->db->group_by('IDRUANG');
        $this->db->where('TAHUNAJAR', $tahun);
        $this->db->where('IDSEMESTER', $semester);
        $dataRuang = $this->db->get();
        $dataRuang = $dataRuang->result();

        foreach ($dataRuang as $ruang) {
            $data_ruang = [
                'ruang_id'          => $ruang->IDRUANG,
                'ruang_nama'        => $ruang->NAMARUANG,
                'ruang_is_active'   => 0
            ];
            
            $insert_ruang_1 = $this->db->insert_string('ruang', $data_ruang);
            $insert_ruang_2 = str_replace('INSERT INTO','INSERT IGNORE INTO',$insert_ruang_1);
            $this->db->query($insert_ruang_2);
            
            //print_r($data_ruang);
        }
    }

    public function getJadwal($tahun, $semester)
    {
        $this->db->select('TAHUNAJAR,
                            IDSEMESTER,
                            SEMESTER,
                            HARI,
                            SESI,
                            JAMMULAI,
                            JAMAKHIR,
                            IDMAPEN,
                            IDRUANG,
                            IDKELAS,
                            IDDOS
                        ');
        $this->db->from('data_api_generate');
        $this->db->where('TAHUNAJAR', $tahun);
        $this->db->where('IDSEMESTER', $semester);
        $dataJadwal = $this->db->get();
        $dataJadwal = $dataJadwal->result();

        

        foreach ($dataJadwal as $jadwal) {
            $data_jadwal = [
                'jadwal_tahun_berjalan'     => $jadwal->TAHUNAJAR,
                'jadwal_semester_id'        => $jadwal->SEMESTER,
                'jadwal_tahun_semester_id'  => $jadwal->IDSEMESTER,
                'jadwal_hari'               => $jadwal->HARI,
                'jadwal_sesi'               => $jadwal->SESI,
                'jadwal_jam_mulai'          => $jadwal->JAMMULAI,
                'jadwal_jam_akhir'          => $jadwal->JAMAKHIR,
                'jadwal_makul_id'           => $jadwal->IDMAPEN,
                'jadwal_ruang_id'           => $jadwal->IDRUANG,
                'jadwal_kelas_id'           => $jadwal->IDKELAS,
                'jadwal_dosen_id'           => $jadwal->IDDOS

            ];

            $this->db->insert('jadwal', $data_jadwal);

            //print_r($data_jadwal);
        }   

    }

    public function getMakul($tahun, $semester)
    {
        $this->db->select('IDMAPEN,
            NAMAMAKUL,
            SKSJADWAL
        ');
        $this->db->from('data_api_generate');
        $this->db->where('TAHUNAJAR', $tahun);
        $this->db->where('IDSEMESTER', $semester);
        $this->db->group_by('IDMAPEN');
        $dataMakul = $this->db->get();
        $dataMakul = $dataMakul->result();

        foreach ($dataMakul as $makul) {
            $data_makul = [
                'makul_id'      => $makul->IDMAPEN,
                'makul_nama'    => $makul->NAMAMAKUL,
                'makul_sks'     => $makul->SKSJADWAL
            ];

            $insert_makul_1 = $this->db->insert_string('makul', $data_makul);
            $insert_makul_2 = str_replace('INSERT INTO','INSERT IGNORE INTO',$insert_makul_1);
            $this->db->query($insert_makul_2);
            //$this->db->insert('makul', $data_makul);

            //print_r($data_makul);
        }
    }

    public function getDosen($tahun, $semester)
    {
        $this->db->select('IDDOS,
                            NAMADOSEN,
                            GELARAKADDPN,
                            GELARAKADBLKG,
                            NIDN,
                            NIPBARU
        ');
        $this->db->from('data_api_generate');
        $this->db->where('TAHUNAJAR', $tahun);
        $this->db->where('IDSEMESTER', $semester);
        $this->db->group_by('IDDOS');
        $dataDosen = $this->db->get();
        $dataDosen = $dataDosen->result();

        foreach ($dataDosen as $dosen) {
            $data_dosen = [
                'dosen_id'              => $dosen->IDDOS,
                'dosen_nama'            => $dosen->NAMADOSEN,
                'dosen_gelarakaddpn'    => $dosen->GELARAKADDPN,
                'dosen_gelarakadblkng'  => $dosen->GELARAKADBLKG,
                'dosen_nidn'            => $dosen->NIDN,
                'dosen_nipbaru'         => $dosen->NIPBARU
            ];

            $insert_dosen_1 = $this->db->insert_string('dosen', $data_dosen);
            $insert_dosen_2 = str_replace('INSERT INTO','INSERT IGNORE INTO',$insert_dosen_1);
            $this->db->query($insert_dosen_2);
            //$this->db->insert('makul', $data_makul);

            //print_r($data_dosen);
        }
    }

    public function getKelas($tahun, $semester)
    {
        $this->db->select('IDKELAS,
                            NAMAKELAS');
        $this->db->from('data_api_generate');
        $this->db->where('TAHUNAJAR', $tahun);
        $this->db->where('IDSEMESTER', $semester);
        $this->db->group_by('IDKELAS');
        $dataKelas = $this->db->get();
        $dataKelas = $dataKelas->result();

        foreach ($dataKelas as $kelas) {
            $data_kelas = [
                'kelas_id'      => $kelas->IDKELAS,
                'kelas_nama'    => $kelas->NAMAKELAS
            ];

            $insert_kelas_1 = $this->db->insert_string('kelas', $data_kelas);
            $insert_kelas_2 = str_replace('INSERT INTO','INSERT IGNORE INTO',$insert_kelas_1);
            $this->db->query($insert_kelas_2);

            //print_r($data_kelas);
        }
    }
    public function edit_data_ruang()
    {
        $id_ruang = $this->input->get('id');
        $data['ruang'] = $this->Model_main->get_data_ruang($id_ruang);
        
        /*$data['id_rfid']                = $data_rfid['rfid_id'];
         $data['rfid_number']            = $data_rfid['rfid_number'];
        $data['rfid_kelas_id']          = $data_rfid['rfid_kelas_id'];
        $data['rfid_semester_id']       = $data_rfid['rfid_semester_id'];*/
        // $data['list_kelas']             = $this->Model_rfid->list_kelas();
        // $data['list_semester']          = $this->Model_rfid->list_semester();
        $this->template->display('form_update_ruang', $data);
    }
    public function exe_update_ruang()
        {   
            //id RFID yang diupdate
            $id_ruang = $this->input->post('id_ruang');
            $alat_id     = $this->input->post('alat_id');
                    
                        $data = array(
                            'ruang_id'                   => $id_ruang,
                            'id_alat'                    => $alat_id,
                        );

                        $this->Model_main->update_ruang($id_ruang, $data);
                        $this->session->set_flashdata('message',
                                                '<div class="alert bg-success alert-styled-left">
                                                    <button type="button" class="close" data-dismiss="alert">
                                                        <span>×</span>
                                                        <span class="sr-only">Close</span>
                                                    </button>
                                                    <span class="text-semibold">Edit data berhasil </span>
                                                </div>');
                        redirect('ruang.html');
        }
    
}




/* End of file Con_siswa.php */
/* Location: ./application/controllers/Con_siswa.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2017-09-11 10:17:16 */
/* http://harviacode.com */
