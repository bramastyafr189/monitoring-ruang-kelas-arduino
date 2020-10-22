<?php

	if (!defined('BASEPATH'))
	    exit('No direct script access allowed');

	/**
	* 
	*/
	class Model_rfid extends CI_Model
	{
		
		function __construct()
		{
       		parent::__construct();
    	}

        public function list_data_rfid()
        {
            $this->db->select('*');
            $this->db->from('rfid');
            $this->db->join('kelas','kelas.kelas_id=rfid.rfid_kelas_id');
            $this->db->join('semester', 'semester.semester_id=rfid.rfid_semester_id');
            $this->db->where('rfid_is_active', 1);
            $this->db->group_by('rfid_id');

            $query=$this->db->get();
            return $query->result();
        }

        public function list_kelas()
        {
            $this->db->select('*');
            $this->db->from('kelas');
            $this->db->group_by('kelas_id');

            $query=$this->db->get();
            return $query->result();
        }

        public function data_tag()
        {
            $this->db->select('*');
            $this->db->from('tag');
            $this->db->order_by('no','desc');
            $this->db->limit(1);

            $query=$this->db->get();
            return $query->result();
        }

        public function list_semester()
        {
            $this->db->select('*');
            $this->db->from('semester');
            $this->db->where('semester_is_active',1);
            $this->db->group_by('semester_id');

            $query=$this->db->get();
            return $query->result();
        }

        public function get_rfid_number($data)
        {
            /*$this->db->select('*');
            $this->db->from('rfid');
            $this->db->where('rfid_number', $data);

            $query = $this->db->get();
            return $query->result();*/

            $query  = $this->db->query("SELECT * FROM rfid WHERE rfid_number='".$data."' AND rfid_is_active = 1");
            $num    = $query->num_rows();

            //echo $num;
            return $num;
           /* if ($num>1) {
                return $this->session->set_flashdata('message', 'Nomor RFID sudah digunakan');
            }else{
                return $this->session->set_flashdata('message', 'Nomor RFID berhasil ditambahkan');
            }*/
            //return $query->result();
            
        }

        public function get_data_lama($id)
        {
            $this->db->select('*');
            $this->db->from('rfid');
            $this->db->where('rfid_id', $id);

            $query = $this->db->get();
            return $query->result();
        }

        public function get_kelas_dan_semester_rfid($smt, $kls)
        {
            //$query  = $this->db->query("SELECT * FROM rfid WHERE rfid_semester_id='".$smt."' AND  rfid_kelas_id='".$kls."' AND rfid_is_active=1");
            $query = $this->db->query("SELECT * FROM rfid WHERE rfid_semester_id='".$smt."' AND  rfid_kelas_id='".$kls."' AND rfid_is_active=1 ");
            //$query = $this->db->query("SELECT * FROM rfid WHERE rfid_semester_id=2 AND  rfid_kelas_id=1311  AND rfid_is_active=1");

            $num    = $query->num_rows();
            //echo $num;
            return $num;
        }

        public function get_pj_rfid($nama)
        {
            $query  = $this->db->query("SELECT * FROM rfid WHERE rfid_penanggung_jawab='".$nama."' AND rfid_is_active=1");
            $num    = $query->num_rows();
            //echo $num;
            return $num;
        }

        public function insert_data_rfid($value)
        {
            $this->db->insert('rfid', $value);
            return $this->db->insert_id();
        }

        public function get_data_rfid($id)
        {
            $this->db->select('*');
            $this->db->from('rfid');
            $this->db->where('rfid_id', $id);
            //$this->db->group_by('id_rfid');

            $query=$this->db->get();
            return $query->result();
            //return $query->row_array();
        }

        public function update_rfid($id, $data)
        {
            $this->db->where('rfid_id', $id);
            $this->db->update('rfid', $data);
        }

        public function hapus_data_rfid($id)
        {
            $this->db->where('rfid_id', $id);
            $this->db->update('rfid', 
                array(
                    'rfid_is_active' => 0
                )
            );
        }

        public function get_data_by_kls_dan_smt($kls, $smt)
        {
            $this->db->select('*');
            $this->db->from('rfid');
            $this->db->where('rfid_kelas_id', $kls);
            $this->db->where('rfid_semester_id', $smt);
            $this->db->where('rfid_is_active', 1);

            $query = $this->db->get();
            return $query->result();
        }
    	
    }//------------------------------------ MODEL CON_RFIF -----------------------------------------------//

?>