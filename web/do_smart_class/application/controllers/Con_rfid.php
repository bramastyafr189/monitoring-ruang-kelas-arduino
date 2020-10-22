<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Con_rfid extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Model_rfid');
        $this->load->library('form_validation');        
        $this->load->library('datatables');
        $this->load->library('template');
        $this->load->library('table');
        date_default_timezone_set('Asia/Jakarta');
        if(!$this->session->userdata('user_id')){
             redirect('login_page.html');
        }
        $this->load->helper('url');
    }

        public function rfid_list()
        {
            $data['list_data_rfid'] = $this->Model_rfid->list_data_rfid();
            $data['list_kelas']     = $this->Model_rfid->list_kelas();
            $data['list_semester']  = $this->Model_rfid->list_semester();
            $data['data_tag']  = $this->Model_rfid->data_tag();

            $this->template->display('rfid/list_data_rfid', $data);
        }

        public function input_data_rfid()
        {   

            //cek nomer RFID apakah sudah ada
            $nomer_rfid      = $this->input->post('nomer_rfid');
            //echo $nomer_rfid;
            $cek_nomer_rfid  = $this->Model_rfid->get_rfid_number($nomer_rfid);
            
            //echo $cek_nomer_rfid;
            if ($cek_nomer_rfid >0) {
                $this->session->set_flashdata('message',
                                                '<div class="alert bg-warning alert-styled-left">
                                                    <button type="button" class="close" data-dismiss="alert">
                                                        <span>×</span>
                                                        <span class="sr-only">Close</span>
                                                    </button>
                                                    <span class="text-semibold">Nomor RFID</span> sudah digunakan
                                                </div>');       
            }else{
                //cek semester dan kelas
                $semester       = $this->input->post('semester');
                $kelas          = $this->input->post('kelas');

                //cek kelas dan semester
                $cek_kelas_dan_semester = $this->Model_rfid->get_kelas_dan_semester_rfid($semester, $kelas);
                //echo $cek_kelas_dan_semester;
                if ($cek_kelas_dan_semester >0 ) {
                    $this->session->set_flashdata('message',
                                                '<div class="alert bg-warning alert-styled-left">
                                                    <button type="button" class="close" data-dismiss="alert">
                                                        <span>×</span>
                                                        <span class="sr-only">Close</span>
                                                    </button>
                                                    <span class="text-semibold">Kelas dan semester</span> sudah digunakan
                                                </div>');       
                }else{
                    $pj             = $this->input->post('penanggung_jawab');
                    //echo $pj;
                    $cek_pj_rfid    = $this->Model_rfid->get_pj_rfid($pj);
                    echo $cek_pj_rfid;
                    if ($cek_pj_rfid !=0 ) {
                        $this->session->set_flashdata('message',
                                                '<div class="alert bg-warning alert-styled-left">
                                                    <button type="button" class="close" data-dismiss="alert">
                                                        <span>×</span>
                                                        <span class="sr-only">Close</span>
                                                    </button>
                                                    <span class="text-semibold">Nama penanggung jawab</span> sudah digunakan
                                                </div>'); 
                    }else{
                        //input data doeloe
                        $data = array(
                            'rfid_number'               => $this->input->post('nomer_rfid'),
                            'rfid_kelas_id'             => $this->input->post('kelas'),
                            'rfid_semester_id'          => $this->input->post('semester'),
                            'rfid_penanggung_jawab'     => $this->input->post('penanggung_jawab'),
                            'rfid_no_handpon_pj'        => $this->input->post('no_telp')
                        );
                        $this->Model_rfid->insert_data_rfid($data);

                        //berhasil
                        $this->session->set_flashdata('message',
                                                '<div class="alert bg-success alert-styled-left">
                                                    <button type="button" class="close" data-dismiss="alert">
                                                        <span>×</span>
                                                        <span class="sr-only">Close</span>
                                                    </button>
                                                    <span class="text-semibold">Input RFID</span> berhasil
                                                </div>'); 
                    }

                }
            }


            //cek semester dan kelas
                /*$semester       = $this->input->post('semester');
                $kelas          = $this->input->post('kelas');
                $cek_kelas_dan_semester = $this->Model_rfid->get_kelas_dan_semester_rfid($semester, $kelas);*/
            //echo "Semester : ".$semester." Kelas : ".$kelas;

            /*foreach ($cek_nomer_rfid as $key) {
                echo $key->rfid_number;
            }*/
           /*if ($cek_nomer_rfid->num_rows>1) {
               echo "<script>alert('Username Sudah Digunakan');history.go(-1) </script>";
           }*/


            /*$data = array(
                'nomer_rfid'    => $this->input->post('nomer_rfid'),
                'id_kelas_rfid'      => $this->input->post('kelas'),
                'semester_rfid' => $this->input->post('semester')
            );*/

            //$this->Model_rfid->insert_data_rfid($data);
            redirect('rfid.html');
        }
        public function edit_data_rfid()
        {
            $id_rfid = $this->input->get('id');
            $data['rfid'] = $this->Model_rfid->get_data_rfid($id_rfid);
            
            /*$data['id_rfid']                = $data_rfid['rfid_id'];
            $data['rfid_number']            = $data_rfid['rfid_number'];
            $data['rfid_kelas_id']          = $data_rfid['rfid_kelas_id'];
            $data['rfid_semester_id']       = $data_rfid['rfid_semester_id'];*/
            $data['list_kelas']             = $this->Model_rfid->list_kelas();
            $data['list_semester']          = $this->Model_rfid->list_semester();
            $this->template->display('rfid/form_update_rfid', $data);
        }

        public function exe_update_rfid()
        {   
            //id RFID yang diupdate
            $id_rfid = $this->input->post('id_rfid');

            echo "ID RFID : ".$id_rfid."<br>";

            $nomer_rfid     = $this->input->post('nomer_rfid');
            $semester       = $this->input->post('semester');
            $kelas          = $this->input->post('kelas');
            $pj             = $this->input->post('penanggung_jawab');
            $no_hp          = $this->input->post('no_hp');

            echo "Nomor RFID : ".$nomer_rfid."<br>";
            echo "Semester : ".$semester."<br>";
            echo "Kelas : ".$kelas."<br>";
            echo "Penanggung_jawab : ".$pj."<br>";
            echo "No HP : ".$no_hp."<br>";

            $data_rfid_lama = $this->Model_rfid->get_data_lama($id_rfid);
            print_r($data_rfid_lama);

            echo "<br> <br>";

            foreach ($data_rfid_lama as $row) {
                $no_rfid_lama   = $row->rfid_number;
                $kelas_lama     = $row->rfid_kelas_id;
                $semester_lama  = $row->rfid_semester_id;
                $pj_lama        = $row->rfid_penanggung_jawab;
            }

            $cek_nomer_rfid  = $this->Model_rfid->get_rfid_number($nomer_rfid);
            echo "Banyaknya data yang memiliki nomor RFID ".$nomer_rfid." adalah ".$cek_nomer_rfid."<br>";

            if ($cek_nomer_rfid == 0) {
                echo "Update No RFID dengan No baru <br>";

                $cek_kelas_dan_semester = $this->Model_rfid->get_kelas_dan_semester_rfid($semester, $kelas);
                echo "Jumlah kelas ".$kelas." semester ".$semester." adalah ".$cek_kelas_dan_semester."<br>";

                if ($cek_kelas_dan_semester==0) {
                    echo "Admin kelas smt mengupdate dengan data baru <br>";

                    $cek_pj_rfid    = $this->Model_rfid->get_pj_rfid($pj);
                    echo "Banyak pj yang bernama : ".$pj." adalah ".$cek_pj_rfid."<br>";

                    if ($cek_pj_rfid == 0) {
                        $data = array(
                            'rfid_id'                   => $id_rfid,
                            'rfid_number'               => $nomer_rfid,
                            'rfid_kelas_id'             => $kelas,
                            'rfid_semester_id'          => $semester,
                            'rfid_penanggung_jawab'     => $pj,
                            'rfid_no_handpon_pj'        => $no_hp,
                            'rfid_is_active'            => '1'

                        );

                        $this->Model_rfid->update_rfid($id_rfid, $data);
                        $this->session->set_flashdata('message',
                                                '<div class="alert bg-success alert-styled-left">
                                                    <button type="button" class="close" data-dismiss="alert">
                                                        <span>×</span>
                                                        <span class="sr-only">Close</span>
                                                    </button>
                                                    <span class="text-semibold">Edit data berhasil </span>
                                                </div>');
                        redirect('rfid.html');

                        
                    
                    }else if ($cek_pj_rfid == 1 && $pj==$pj_lama) {
                        echo "Nama pj gak ganti (pj lama) <br>";
                        $data = array(
                            'rfid_id'                   => $id_rfid,
                            'rfid_number'               => $nomer_rfid,
                            'rfid_kelas_id'             => $kelas,
                            'rfid_semester_id'          => $semester,
                            'rfid_penanggung_jawab'     => $pj,
                            'rfid_no_handpon_pj'        => $no_hp,
                            'rfid_is_active'            => '1'

                        );

                        $this->Model_rfid->update_rfid($id_rfid, $data);
                        $this->session->set_flashdata('message',
                                                '<div class="alert bg-success alert-styled-left">
                                                    <button type="button" class="close" data-dismiss="alert">
                                                        <span>×</span>
                                                        <span class="sr-only">Close</span>
                                                    </button>
                                                    <span class="text-semibold">Edit data berhasil </span>
                                                </div>');
                        redirect('rfid.html');

                    }else if ($cek_pj_rfid == 1 && $pj!=$pj_lama) {
                        $this->session->set_flashdata('message',
                                                '<div class="alert bg-warning alert-styled-left">
                                                    <button type="button" class="close" data-dismiss="alert">
                                                        <span>×</span>
                                                        <span class="sr-only">Close</span>
                                                    </button>
                                                    <span class="text-semibold">Edit data gagal </span>
                                                </div>');
                        redirect('rfid.html');
                    }
                }else if ($cek_kelas_dan_semester == 1 && $kelas_lama == $kelas && $semester_lama == $semester) {
                    echo "Admin kelas smt mengupdate dengan data lama <br>";

                    $cek_pj_rfid    = $this->Model_rfid->get_pj_rfid($pj);
                    echo "Banyak pj yang bernama : ".$pj." adalah ".$cek_pj_rfid."<br>";

                    if ($cek_pj_rfid == 0) {
                        $data = array(
                            'rfid_id'                   => $id_rfid,
                            'rfid_number'               => $nomer_rfid,
                            'rfid_kelas_id'             => $kelas,
                            'rfid_semester_id'          => $semester,
                            'rfid_penanggung_jawab'     => $pj,
                            'rfid_no_handpon_pj'        => $no_hp,
                            'rfid_is_active'            => '1'

                        );

                        $this->Model_rfid->update_rfid($id_rfid, $data);
                        $this->session->set_flashdata('message',
                                                '<div class="alert bg-success alert-styled-left">
                                                    <button type="button" class="close" data-dismiss="alert">
                                                        <span>×</span>
                                                        <span class="sr-only">Close</span>
                                                    </button>
                                                    <span class="text-semibold">Edit data berhasil </span>
                                                </div>');
                        redirect('rfid.html');
                    }else if ($cek_pj_rfid == 1 && $pj==$pj_lama) {
                        $data = array(
                            'rfid_id'                   => $id_rfid,
                            'rfid_number'               => $nomer_rfid,
                            'rfid_kelas_id'             => $kelas,
                            'rfid_semester_id'          => $semester,
                            'rfid_penanggung_jawab'     => $pj,
                            'rfid_no_handpon_pj'        => $no_hp,
                            'rfid_is_active'            => '1'

                        );

                        $this->Model_rfid->update_rfid($id_rfid, $data);
                        $this->session->set_flashdata('message',
                                                '<div class="alert bg-success alert-styled-left">
                                                    <button type="button" class="close" data-dismiss="alert">
                                                        <span>×</span>
                                                        <span class="sr-only">Close</span>
                                                    </button>
                                                    <span class="text-semibold">Edit data berhasil </span>
                                                </div>');
                        redirect('rfid.html');
                    }else if ($cek_pj_rfid == 1 && $pj!=$pj_lama) {
                        $this->session->set_flashdata('message',
                                                '<div class="alert bg-warning alert-styled-left">
                                                    <button type="button" class="close" data-dismiss="alert">
                                                        <span>×</span>
                                                        <span class="sr-only">Close</span>
                                                    </button>
                                                    <span class="text-semibold">Edit data gagal </span>
                                                </div>');
                        redirect('rfid.html');
                    }
                }else if (($cek_kelas_dan_semester == 1 && $kelas_lama != $kelas && $semester_lama == $semester) || ($cek_kelas_dan_semester == 1 && $kelas_lama == $kelas && $semester_lama != $semester) || $cek_kelas_dan_semester == 1 && $kelas_lama != $kelas && $semester_lama != $semester) {
                    $this->session->set_flashdata('message',
                                                '<div class="alert bg-warning alert-styled-left">
                                                    <button type="button" class="close" data-dismiss="alert">
                                                        <span>×</span>
                                                        <span class="sr-only">Close</span>
                                                    </button>
                                                    <span class="text-semibold">Edit data gagal </span>
                                                </div>');
                        redirect('rfid.html');
                }

            }else if ($cek_nomer_rfid == 1 && $no_rfid_lama == $nomer_rfid) {
                $cek_kelas_dan_semester = $this->Model_rfid->get_kelas_dan_semester_rfid($semester, $kelas);
                echo "Jumlah kelas ".$kelas." semester ".$semester." adalah ".$cek_kelas_dan_semester."<br>";

                if ($cek_kelas_dan_semester==0) {
                    echo "Admin kelas smt mengupdate dengan data baru <br>";

                    $cek_pj_rfid    = $this->Model_rfid->get_pj_rfid($pj);
                    echo "Banyak pj yang bernama : ".$pj." adalah ".$cek_pj_rfid."<br>";

                    if ($cek_pj_rfid == 0) {
                        $data = array(
                            'rfid_id'                   => $id_rfid,
                            'rfid_number'               => $nomer_rfid,
                            'rfid_kelas_id'             => $kelas,
                            'rfid_semester_id'          => $semester,
                            'rfid_penanggung_jawab'     => $pj,
                            'rfid_no_handpon_pj'        => $no_hp,
                            'rfid_is_active'            => '1'

                        );

                        $this->Model_rfid->update_rfid($id_rfid, $data);
                        $this->session->set_flashdata('message',
                                                '<div class="alert bg-success alert-styled-left">
                                                    <button type="button" class="close" data-dismiss="alert">
                                                        <span>×</span>
                                                        <span class="sr-only">Close</span>
                                                    </button>
                                                    <span class="text-semibold">Edit data berhasil </span>
                                                </div>');
                        redirect('rfid.html');

                        
                    
                    }else if ($cek_pj_rfid == 1 && $pj==$pj_lama) {
                        echo "Nama pj gak ganti (pj lama) <br>";
                        $data = array(
                            'rfid_id'                   => $id_rfid,
                            'rfid_number'               => $nomer_rfid,
                            'rfid_kelas_id'             => $kelas,
                            'rfid_semester_id'          => $semester,
                            'rfid_penanggung_jawab'     => $pj,
                            'rfid_no_handpon_pj'        => $no_hp,
                            'rfid_is_active'            => '1'

                        );

                        $this->Model_rfid->update_rfid($id_rfid, $data);
                        $this->session->set_flashdata('message',
                                                '<div class="alert bg-success alert-styled-left">
                                                    <button type="button" class="close" data-dismiss="alert">
                                                        <span>×</span>
                                                        <span class="sr-only">Close</span>
                                                    </button>
                                                    <span class="text-semibold">Edit data berhasil </span>
                                                </div>');
                        redirect('rfid.html');

                    }else if ($cek_pj_rfid == 1 && $pj!=$pj_lama) {
                        $this->session->set_flashdata('message',
                                                '<div class="alert bg-warning alert-styled-left">
                                                    <button type="button" class="close" data-dismiss="alert">
                                                        <span>×</span>
                                                        <span class="sr-only">Close</span>
                                                    </button>
                                                    <span class="text-semibold">Edit data gagal </span>
                                                </div>');
                        redirect('rfid.html');
                    }
                }else if ($cek_kelas_dan_semester == 1 && $kelas_lama == $kelas && $semester_lama == $semester) {
                    echo "Admin kelas smt mengupdate dengan data lama <br>";

                    $cek_pj_rfid    = $this->Model_rfid->get_pj_rfid($pj);
                    echo "Banyak pj yang bernama : ".$pj." adalah ".$cek_pj_rfid."<br>";

                    if ($cek_pj_rfid == 0) {
                        $data = array(
                            'rfid_id'                   => $id_rfid,
                            'rfid_number'               => $nomer_rfid,
                            'rfid_kelas_id'             => $kelas,
                            'rfid_semester_id'          => $semester,
                            'rfid_penanggung_jawab'     => $pj,
                            'rfid_no_handpon_pj'        => $no_hp,
                            'rfid_is_active'            => '1'

                        );

                        $this->Model_rfid->update_rfid($id_rfid, $data);
                        $this->session->set_flashdata('message',
                                                '<div class="alert bg-success alert-styled-left">
                                                    <button type="button" class="close" data-dismiss="alert">
                                                        <span>×</span>
                                                        <span class="sr-only">Close</span>
                                                    </button>
                                                    <span class="text-semibold">Edit data berhasil </span>
                                                </div>');
                        redirect('rfid.html');
                    }else if ($cek_pj_rfid == 1 && $pj==$pj_lama) {
                        $data = array(
                            'rfid_id'                   => $id_rfid,
                            'rfid_number'               => $nomer_rfid,
                            'rfid_kelas_id'             => $kelas,
                            'rfid_semester_id'          => $semester,
                            'rfid_penanggung_jawab'     => $pj,
                            'rfid_no_handpon_pj'        => $no_hp,
                            'rfid_is_active'            => '1'

                        );

                        $this->Model_rfid->update_rfid($id_rfid, $data);
                        $this->session->set_flashdata('message',
                                                '<div class="alert bg-success alert-styled-left">
                                                    <button type="button" class="close" data-dismiss="alert">
                                                        <span>×</span>
                                                        <span class="sr-only">Close</span>
                                                    </button>
                                                    <span class="text-semibold">Edit data berhasil </span>
                                                </div>');
                        redirect('rfid.html');
                    }else if ($cek_pj_rfid == 1 && $pj!=$pj_lama) {
                        $this->session->set_flashdata('message',
                                                '<div class="alert bg-warning alert-styled-left">
                                                    <button type="button" class="close" data-dismiss="alert">
                                                        <span>×</span>
                                                        <span class="sr-only">Close</span>
                                                    </button>
                                                    <span class="text-semibold">Edit data gagal </span>
                                                </div>');
                        redirect('rfid.html');
                    }
                }else if (($cek_kelas_dan_semester == 1 && $kelas_lama != $kelas && $semester_lama == $semester) || ($cek_kelas_dan_semester == 1 && $kelas_lama == $kelas && $semester_lama != $semester) || $cek_kelas_dan_semester == 1 && $kelas_lama != $kelas && $semester_lama != $semester) {
                    $this->session->set_flashdata('message',
                                                '<div class="alert bg-warning alert-styled-left">
                                                    <button type="button" class="close" data-dismiss="alert">
                                                        <span>×</span>
                                                        <span class="sr-only">Close</span>
                                                    </button>
                                                    <span class="text-semibold">Edit data gagal </span>
                                                </div>');
                        redirect('rfid.html');
                }
            }else if ($cek_nomer_rfid == 1 && $no_rfid_lama != $nomer_rfid) {
               $this->session->set_flashdata('message',
                                                '<div class="alert bg-warning alert-styled-left">
                                                    <button type="button" class="close" data-dismiss="alert">
                                                        <span>×</span>
                                                        <span class="sr-only">Close</span>
                                                    </button>
                                                    <span class="text-semibold">No RFID redudan</span>
                                                </div>'); 
            }
            

            //redirect('rfid.html');
        }

        public function hapus_data_rfid()
        {
            $id_rfid = $this->input->get('id');

            $this->Model_rfid->hapus_data_rfid($id_rfid);

            redirect('rfid.html');
        }
    
    } //------------------------------------ END CON_RFIF -----------------------------------------------//




/* End of file Con_siswa.php */
/* Location: ./application/controllers/Con_siswa.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2017-09-11 10:17:16 */
/* http://harviacode.com */