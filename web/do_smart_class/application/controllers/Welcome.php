<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	 function __construct()
    {
        parent::__construct();
        //$this->load->model('Model_karyawan');
        $this->load->model('Model_admin');
        $this->load->library('form_validation');
        $this->load->library('template');
        $this->load->library('session');
    }
    public function index(){

    }

    public function login_page(){
        if($this->session->userdata('user_id') && $this->session->level == 'admin'){
            redirect('dashboard.html');
        }else{
        $this->load->view('login/login_page');
        }
    }
    
    public function login_user(){
        $username=$this->input->post('username');
        $password=$this->input->post('password');
        //echo "1";
                //cek apakah session waktu blokir sudah habis
        if($this->session->userdata('waktu_terakhir_login')){
            if(date('Y-m-d H:i:s')>$this->session->userdata('waktu_terakhir_login')){
                $this->session->sess_destroy();
            }
        }
        //memberikan session ketika awal login
        if(!$this->session->userdata('percobaan_login')){
            $this->session->set_userdata('percobaan_login',"0");
        }
        //mengatur batas waktu blokir
        if($this->session->userdata('percobaan_login')==5){
            $waktu=date('Y-m-d H:i:s',strtotime(date('Y-m-d H:i:s') . "+5 minutes"));
            $this->session->set_userdata('waktu_terakhir_login',$waktu);
            //send email disini

        }

        if($this->session->userdata('percobaan_login')>5){
            echo "percobaan_max";
            exit;
        }


        $hasil_login= $this->Model_admin->login_user($username,$password);
        if($hasil_login->jumlah==1){
            $this->session->set_userdata('user_id',$hasil_login->id_admin);
            $this->session->set_userdata('user_nama',$hasil_login->username_admin);
            $this->session->set_userdata('level', $hasil_login->level_admin);
            //$this->session->set_userdata('level', 'admin');

            echo "ok";
        }else{
                $gagal=$this->session->userdata('percobaan_login');
                $gagal=$gagal+1;
                $this->session->set_userdata('percobaan_login',$gagal);
                echo "gagal";
            }
    } //end login_user()

    public function logout_user(){
        $this->session->sess_destroy();
        redirect('login_page.html');
    }
}