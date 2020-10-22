<?php

	if (!defined('BASEPATH'))
	    exit('No direct script access allowed');

	/**
	* 
	*/
	class Model_main extends CI_Model
	{
		
		function __construct()
		{
       		parent::__construct();
    	}

    	//melihat status ruangan
    	function status_ruang()
    	{
    		$this->db->select('*');
        	$this->db->from('ruang');

        	$query=$this->db->get();
        	return $query->result();
    	}

    	public function ruang_enable($id)
    	{
    		$query=  $this->db->query("
            	update status_ruang set ruang_is_active=1 where ruang_id=".$id."
        	");
    	}

    	public function ruang_disable($id)
    	{
    		$query=  $this->db->query("
            	update status_ruang set ruang_is_active=0 where ruang_id=".$id."
        	");
    	}

        

    	public function jadwal_senin($id, $tahun_ajaran, $semester)
    	{
    		$this->db->distinct();
    		$this->db->select('*');
    		$this->db->from('jadwal');
    		$this->db->where('jadwal_ruang_id', $id);
            $this->db->join('ruang', 'ruang.ruang_id = jadwal.jadwal_ruang_id');
            $this->db->join('makul', 'makul.makul_id = jadwal.jadwal_makul_id');
            $this->db->join('kelas', 'kelas.kelas_id = jadwal.jadwal_kelas_id');
            $this->db->where('jadwal_hari', 'Senin');
            $this->db->where('jadwal_tahun_berjalan', $tahun_ajaran);
            $this->db->where('jadwal_tahun_semester_id', $semester);
            $this->db->order_by('jadwal_sesi');
    		

    		$query = $this->db->get();
    		return $query->result();
    	}

        public function jadwal_selasa($id, $tahun_ajaran, $semester)
        {
            $this->db->distinct();
            $this->db->select('*');
            $this->db->from('jadwal');
            $this->db->where('jadwal_ruang_id', $id);
            $this->db->join('ruang', 'ruang.ruang_id = jadwal.jadwal_ruang_id');
            $this->db->join('makul', 'makul.makul_id = jadwal.jadwal_makul_id');
            $this->db->join('kelas', 'kelas.kelas_id = jadwal.jadwal_kelas_id');
            $this->db->where('jadwal_hari', 'Selasa');
            $this->db->where('jadwal_tahun_berjalan', $tahun_ajaran);
            $this->db->where('jadwal_tahun_semester_id', $semester);
            $this->db->order_by('jadwal_sesi');
            

            $query = $this->db->get();
            return $query->result();
        }

        public function jadwal_rabu($id, $tahun_ajaran, $semester)
        {
            $this->db->distinct();
            $this->db->select('*');
            $this->db->from('jadwal');
            $this->db->where('jadwal_ruang_id', $id);
            $this->db->join('ruang', 'ruang.ruang_id = jadwal.jadwal_ruang_id');
            $this->db->join('makul', 'makul.makul_id = jadwal.jadwal_makul_id');
            $this->db->join('kelas', 'kelas.kelas_id = jadwal.jadwal_kelas_id');
            $this->db->where('jadwal_tahun_berjalan', $tahun_ajaran);
            $this->db->where('jadwal_tahun_semester_id', $semester);
            $this->db->where('jadwal_hari', 'Rabu');
            $this->db->order_by('jadwal_sesi');
            

            $query = $this->db->get();
            return $query->result();
        }

        public function jadwal_kamis($id, $tahun_ajaran, $semester)
        {
            $this->db->distinct();
            $this->db->select('*');
            $this->db->from('jadwal');
            $this->db->join('ruang', 'ruang.ruang_id = jadwal.jadwal_ruang_id');
            $this->db->join('makul', 'makul.makul_id = jadwal.jadwal_makul_id');
            $this->db->join('kelas', 'kelas.kelas_id = jadwal.jadwal_kelas_id');
            $this->db->where('jadwal_ruang_id', $id);
            $this->db->where('jadwal_tahun_berjalan', $tahun_ajaran);
            $this->db->where('jadwal_tahun_semester_id', $semester);
            $this->db->where('jadwal_hari', 'Kamis');
            $this->db->order_by('jadwal_sesi');
            

            $query = $this->db->get();
            return $query->result();
        }

        public function jadwal_jumat($id, $tahun_ajaran, $semester)
        {
            $this->db->distinct();
            $this->db->select('*');
            $this->db->from('jadwal');
            //$this->db->join('ruang', 'ruang.ruang_id = jadwal.jadwal_ruang_id');
            $this->db->join('makul', 'makul.makul_id = jadwal.jadwal_makul_id');
            $this->db->join('kelas', 'kelas.kelas_id = jadwal.jadwal_kelas_id');
            $this->db->where('jadwal_ruang_id', $id);
            $this->db->where('jadwal_tahun_berjalan', $tahun_ajaran);
            $this->db->where('jadwal_tahun_semester_id', $semester);
            $this->db->where('jadwal_hari', 'Jumat');
            $this->db->order_by('jadwal_sesi');
            

            $query = $this->db->get();
            return $query->result();
        }

        public function getDataRuang($id)
        {
            $this->db->select('*');
            $this->db->from('ruang');
            $this->db->where('ruang_id', $id);

            $query = $this->db->get();
            return $query->result();
        }

        public function getMakul($kls, $smt)
        {
            $this->db->select('*');
            $this->db->from('jadwal');
            $this->db->where('jadwal_kelas_id', $kls);
            $this->db->where('jadwal_semester_id', $smt);
            $this->db->join('makul', 'makul.makul_id = jadwal.jadwal_makul_id');
            $this->db->group_by('makul_nama');

            $query = $this->db->get();
            return $query->result();
        }

        public function get_pj_rfid($nama)
        {
            $query  = $this->db->query("SELECT * FROM rfid WHERE rfid_penanggung_jawab='".$nama."' AND rfid_is_active = 2");
            $num    = $query->num_rows();
            //echo $num;
            return $num;
        }

        public function get_log_by_id($id_ruang)
        {
            /*$this->db->select('log_id');
            //$this->db->from('log');
            //$this->db->where('isnull(log_jam_keluar)');
            $this->db->where('log_ruang_id', $id_ruang);

            $query =  $this->db->get('log');*/
            $query = $this->db->query("SELECT * FROM log
                        JOIN
                            rfid ON rfid_id = log_rfid_id
                        JOIN kelas ON kelas_id = rfid_kelas_id
                        JOIN semester ON semester_id = rfid_semester_id
                        JOIN jadwal ON jadwal_id = log_jadwal_id
                        JOIN makul ON jadwal_makul_id = makul_id
                        WHERE
                            ISNULL(log_jam_keluar)
                        AND log_ruang_id = ".$id_ruang."");
            return $query->result();
        }

        public function aktifkan_ruang($id)
        {   
           $this->db->where('ruang_id', $id);
            $this->db->update('ruang', 
                array(
                    'ruang_is_active' => 0
                )
            );
            
        }

        public function bebaskan_pj($id_rfid)
        {
            $this->db->where('rfid_id', $id_rfid);
            $this->db->update('rfid', 
                array(
                    'rfid_is_active' => 3
                )
            );
        }

        public function waktu_selesai_pakai_ruang($id_log)
        {
            
            $this->db->where('log_id', $id_log);
            $this->db->update('log', 
                array(
                    'log_jam_keluar' => date('H:i:s')
                )
            );
        
        }

        public function jadwal_sekarang($id, $hari, $sesi, $tahun_ajaran, $tahun_semester)
        {
            $this->db->select('*');
            $this->db->from('jadwal');

            $this->db->where('jadwal_ruang_id', $id);
            $this->db->where('jadwal_hari', $hari);
            $this->db->where('jadwal_sesi', $sesi);
            $this->db->where('jadwal_tahun_berjalan', $tahun_ajaran);
            $this->db->where('jadwal_tahun_semester_id', $tahun_semester);
            $this->db->join('makul', 'makul.makul_id = jadwal.jadwal_makul_id');
            $this->db->join('kelas', 'kelas.kelas_id = jadwal.jadwal_kelas_id');
            $this->db->join('dosen', 'dosen.dosen_id = jadwal.jadwal_dosen_id');
            $query = $this->db->get();
            return $query->result();
        }

        public function sesi_selesai($nama_makul, $hari, $id, $kls, $get_tahun, $get_smt)
        {
            $this->db->select_max('jadwal_sesi');
            $this->db->from('jadwal');
            $this->db->join('makul','makul.makul_id = jadwal.jadwal_makul_id');
            $this->db->join('ruang', 'ruang_id = jadwal_ruang_id');

            $this->db->where('makul_nama', $nama_makul);
            $this->db->where('jadwal_hari', $hari);
            $this->db->where('jadwal_ruang_id', $id);
            $this->db->where('jadwal_kelas_id', $kls);
            $this->db->where('jadwal_tahun_berjalan', $get_tahun);
            $this->db->where('jadwal_tahun_semester_id', $get_smt);

            $query = $this->db->get();
            return $query->row();
        }

        public function jadwal_selesai($id, $hari, $sesi_end, $get_tahun, $get_smt)
        {
            $this->db->select('*');
            $this->db->from('jadwal');
            $this->db->where('jadwal_ruang_id', $id);
            $this->db->where('jadwal_hari', $hari);
            $this->db->where('jadwal_sesi', 4);
            $this->db->where('jadwal_tahun_berjalan', $get_tahun);
            $this->db->where('jadwal_tahun_semester_id', $get_smt);

            $query = $this->db->get();
            return $query->result();
        }

        public function cek_jadwal($tahun_ajaran, $semester)
        {
            $query  = $this->db->query("SELECT * FROM jadwal WHERE jadwal_tahun_berjalan='".$tahun_ajaran."' AND  jadwal_tahun_semester_id='".$semester."'");
            $num    = $query->num_rows();
            //echo $num;
            return $num;
        }

        public function get_data_ruang($id)
        {
            $this->db->select('*');
            $this->db->from('ruang');
            $this->db->where('ruang_id', $id);
            //$this->db->group_by('id_rfid');

            $query=$this->db->get();
            return $query->result();
            //return $query->row_array();
        }

        public function update_ruang($id, $data)
        {
            $this->db->where('ruang_id', $id);
            $this->db->update('ruang', $data);
        }

        

        


	} //END Model_main

?>