<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Con_monitoring extends CI_Controller
{
    function __construct()
    {
        parent::__construct();

        $this->load->model('Model_monitoring');
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

    public function monitoring_ruang(){
        //url_title('cek.html');
        $data['monitoring_nama_ruang']=$this->Model_monitoring->nama_ruang();
        $this->template->display('monitoring_ruang/monitoring_nama_ruang',$data); 
    }

    /*public function log_ruang_by_id_ruang()
    {
        $id_ruang           = $this->input->get('id');
        $data['log_ruang']  = $this->Model_monitoring->log_ruang($id_ruang);

        
        $this->template->display('monitoring_ruang/log_monitoring_by_id', $data);
    }*/

    public function monitoring_penggunaan_ruang()
    {
        $id_ruang           = $this->input->get('id');
        $data['ruang']      = $this->Model_monitoring->get_ruang_by_id($id_ruang);
        $data['log_ruang']  = $this->Model_monitoring->getLogRuang($id_ruang);
        $data['tahun_monitoring']   = $this->Model_monitoring->data_tahun($id_ruang);
        $this->template->display('monitoring_ruang/log_submit_ftahun', $data);
    }

    //////////////--------------------------------------------------------------------////////////////////

    public function monitoring_exe_ftahun()
    {
        $id_ruang   = $this->input->post('id_ruang');
        $tahun      = $this->input->post('tahun');

        /*echo "ID ruang : ".$id_ruang."<br>";
        echo "Tahun : ".$tahun."<br>";*/

        $data['data_ruang']        = $this->Model_monitoring->get_ruang_by_id($id_ruang);

        $data['bulan_monitoring'] = $this->Model_monitoring->data_bulan($id_ruang, $tahun);
        //$data['data_log_bulanan']   = $this->Model_monitoring->log_monitoring_bulanan($id_ruang, $tahun, $bulan);
        $data['data_log_tahunan'] = $this->Model_monitoring->log_monitoring_tahunan($id_ruang, $tahun);
        $data['tahun_monitoring'] = $tahun;
        
/*
        echo "<pre>";
            print_r($this->Model_monitoring->data_bulan($id_ruang, $tahun));
        echo "</pre>";*/
        $this->template->display('monitoring_ruang/log_submit_fbulan', $data);
    }

    public function monitoring_exe_fbulan()
    {
        $id_ruang   = $this->input->post('id_ruang');
        $tahun      = $this->input->post('tahun_monitoring');
        $bulan      = $this->input->post('bulan');

        /*echo "ID ruang : ".$id_ruang."<br>";
        echo "Tahun : ".$tahun."<br>";
        echo "Bulan : ".$bulan;*/


        $data['data_ruang']         = $this->Model_monitoring->get_ruang_by_id($id_ruang);
        $data['data_log_bulanan']   = $this->Model_monitoring->log_monitoring_bulanan($id_ruang, $tahun, $bulan);
        $data['tahun_monitoring']   = $tahun;
        $data['bulan_monitoring']   = $bulan;
        $data['pilih_tanggal']      = $this->Model_monitoring->data_hari($id_ruang, $tahun, $bulan);

        /*echo "<pre>";
            print_r($this->Model_monitoring->data_hari($id_ruang, $tahun, $bulan));
        echo "</pre>";*/

        $this->template->display('monitoring_ruang/monitoring_by_bulan', $data);

    }

    public function monitorig_by_hari()
    {
       $id_ruang    = $this->input->post('id_ruang');
        $tahun      = $this->input->post('tahun_monitoring');
        $bulan      = $this->input->post('bulan');
        $hari       = $this->input->post('hari');

        /*echo "ID ruang : ".$id_ruang."<br>";
        echo "Tahun : ".$tahun."<br>";
        echo "Bulan : ".$bulan."<br>";
        echo "Tgl : ".$hari;
*/
        $data['data_ruang']         = $this->Model_monitoring->get_ruang_by_id($id_ruang);
        $data['data_log_harian']   = $this->Model_monitoring->log_monitoring_harian($id_ruang, $tahun, $bulan, $hari);

        $this->template->display('monitoring_ruang/monitoring_by_hari', $data);
    }
    #MANUAL
    public function monitoring_manual(){
        //url_title('cek.html');
        $data['monitoring_nama_ruang']=$this->Model_monitoring->nama_ruang();
        $this->template->display('monitoring_ruang/manual_pilih_ruang',$data); 
    }

    public function log_manual_penggunaan_ruang()
     {
        $id_ruang                   = $this->input->get('id');
        $data['log_manual_ruang']   = $this->Model_monitoring->log_manual_by_ruang($id_ruang);
        $data['tahun_monitoring_manual']   = $this->Model_monitoring->data_tahun_manual($id_ruang);
        $this->template->display('monitoring_ruang/manual_log_submit_ftahun', $data);
    } 

    public function manual_exe_ftahun()
    {
        $id_ruang   = $this->input->post('id_ruang');
        $tahun      = $this->input->post('tahun');


        //mengambil data ruang
        $data['log_manual_ruang']   = $this->Model_monitoring->log_manual_by_ruang($id_ruang);

        //menampilkan bulan apa yang bisa diakses
        $data['bulan_monitoring'] = $this->Model_monitoring->data_bulan_manual($id_ruang, $tahun);

        //menampilkan data log tahunan yang diminta
        $data['data_log_tahunan'] = $this->Model_monitoring->log_manual_tahunan($id_ruang, $tahun);

        //data tahun yang dihidden untuk membantu ke function berikutnya
        $data['tahun_monitoring'] = $tahun;
        
        $this->template->display('monitoring_ruang/manual_submit_fbulan', $data);

    }

    public function manual_exe_fbulan()
    {
        $id_ruang   = $this->input->post('id_ruang');
        $tahun      = $this->input->post('tahun_monitoring');
        $bulan      = $this->input->post('bulan');

        //mengambil data ruang
        $data['log_manual_ruang']   = $this->Model_monitoring->log_manual_by_ruang($id_ruang);

        //menampilkan data bulanan
        $data['data_log_bulanan']   = $this->Model_monitoring->log_manual_bulanan($id_ruang, $tahun, $bulan);
        
        $this->template->display('monitoring_ruang/manual_by_bulan', $data);
    }

    
}




/* End of file Con_siswa.php */
/* Location: ./application/controllers/Con_siswa.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2017-09-11 10:17:16 */
/* http://harviacode.com */