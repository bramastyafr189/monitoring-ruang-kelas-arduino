<?php

	if (!defined('BASEPATH'))
	    exit('No direct script access allowed');

	/**
	* 
	*/
	class Model_jadwal extends CI_Model
	{
		
		function __construct()
		{
       		parent::__construct();
    	}

    	public function list_tahun()
        {
            $this->db->select('*');
            $this->db->from('tahun_ajaran');

            $query=$this->db->get();
            return $query->result();
        }

        public function list_semester()
        {
            $this->db->select('*');
            $this->db->from('tahun_semester');

            $query=$this->db->get();
            return $query->result();
        }
    	
        public function nonaktifkan_semua_smt()
        {
            $this->db->update('tahun_semester', array('tahun_semester_is_active'=>0));
        }

        public function aktifkan_semester($id)
        {   
            $this->db->where('tahun_semester_id', $id);
            $this->db->update('tahun_semester', array('tahun_semester_is_active'=>1));
            
        }

        public function nonaktifkan_semua_tahun_ajaran()
        {
            $this->db->update('tahun_ajaran', array('tahun_ajaran_is_active'=>0));
        }

        public function aktifkan_tahun_ajaran($id)
        {   
            $this->db->where('tahun_ajaran_id', $id);
            $this->db->update('tahun_ajaran', array('tahun_ajaran_is_active'=>1));
            
        }

        public function get_tahun_aktif()
        {
            $this->db->select('*');
            $this->db->from('tahun_ajaran');
            $this->db->where('tahun_ajaran_is_active', 1);

            $query = $this->db->get();
            return $query->row();
        }

        public function get_semester_aktif()
        {
            $this->db->select('*');
            $this->db->from('tahun_semester');
            $this->db->where('tahun_semester_is_active', 1);

            $query = $this->db->get();
            return $query->row();
        }

        public function ubah_smt_ganjil_1()
        {
            $this->db->where('rfid_semester_id', 2);
            $this->db->update('rfid', array('rfid_semester_id'=>1));
        }

        public function ubah_smt_ganjil_3()
        {
            $this->db->where('rfid_semester_id', 4);
            $this->db->update('rfid', array('rfid_semester_id'=>3));
        }

        public function ubah_smt_ganjil_5()
        {
            $this->db->where('rfid_semester_id', 6);
            $this->db->update('rfid', array('rfid_semester_id'=>5));
        }

        public function ubah_smt_genap_2()
        {
            $this->db->where('rfid_semester_id', 1);
            $this->db->update('rfid', array('rfid_semester_id'=>2));
        }

        public function ubah_smt_genap_4()
        {
            $this->db->where('rfid_semester_id', 3);
            $this->db->update('rfid', array('rfid_semester_id'=>4));
        }

        public function ubah_smt_genap_6()
        {
            $this->db->where('rfid_semester_id', 5);
            $this->db->update('rfid', array('rfid_semester_id'=>6));
        }

        public function non_aktifkan_semua_smt()
        {
            $this->db->update('semester', array('semester_is_active'=>0));
        }

        public function aktifkan_semester_id_ganjil()
        {
            $this->db->where('semeter_tahun_semester_id', 1);
            $this->db->update('semester', array('semester_is_active'=>1));
        }

         public function aktifkan_semester_id_genap()
        {
            $this->db->where('semeter_tahun_semester_id', 2);
            $this->db->update('semester', array('semester_is_active'=>1));
        }
        

        

        


	} //END Model_main

?>