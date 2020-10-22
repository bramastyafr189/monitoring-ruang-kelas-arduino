<?php

	if (!defined('BASEPATH'))
	    exit('No direct script access allowed');

	/**
	* 
	*/
	class Model_manual extends CI_Model
	{
		
		function __construct()
		{
       		parent::__construct();
    	}

    	//melihat status ruangan
    	function kunci_belum_kembali()
    	{
    		$this->db->select('*');
        	$this->db->from('log_manual');
            $this->db->join('status_ruang','status_ruang.ruang_id=log_manual.id_ruang_log_manual');
            $this->db->join('mapen','mapen.id_mapen=log_manual.id_mapel_log_manual');
            $this->db->where('kunci_kembali', 0);

        	$query=$this->db->get();
        	return $query->result();
    	}

    	public function update_status_ruang($id_ruang)
        {
            $this->db->where('ruang_id', $id_ruang);
            $this->db->update('status_ruang', array('ruang_status'=>0));
        }

        public function pakai_ruang($id_ruang)
        {
            $this->db->where('ruang_id', $id_ruang);
            $this->db->update('status_ruang', array('ruang_status'=>1));
        }

        public function update_kunci_kembali_log_manual($id_log)
        {
            $this->db->where('id_log_manual', $id_log);
            $this->db->update('log_manual', array('kunci_kembali'=>1, 'waktu_selesai_manual'=>date('H:i:s')));
        }

        public function semester_aktif()
        {
            $this->db->distinct();
            $this->db->select('semester_mapen');
            $this->db->from('mapen');

            $query = $this->db->get();
            return $query->result();
        }

        public function getKelas()
        {
            $this->db->select('*');
            $this->db->from('jadwal_prodi');
            $this->db->group_by('NAMAKELAS');

            $query=$this->db->get();
            return $query->result();
        }

        public function input_penanggung_jawab($value)
        {
            $this->db->insert('log_manual', $value);
            return $this->db->insert_id();
        }

        public function getMapel($kelas, $semester)
        {
            $this->db->select('*');
            $this->db->from('mapen');
            $this->db->where('kelas_mapen', $kelas);
            $this->db->where('semester_mapen', $semester);
            $this->db->group_by('nama_mapen');

            $query = $this->db->get();
            return $query->result();
        }

        public function getRuang()
        {
            $this->db->select('*');
            $this->db->from('status_ruang');

            $query = $this->db->get();
            return $query->result();
        }

        public function data_peminjam_fix($id_log_manual, $data_peminjaman)
        {
            $this->db->where('id_log_manual', $id_log_manual);
            $this->db->update('log_manual', $data_peminjaman);
        }


	} //END Model_main

?>