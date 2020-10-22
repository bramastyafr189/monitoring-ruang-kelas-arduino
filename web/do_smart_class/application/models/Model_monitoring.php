<?php

	if (!defined('BASEPATH'))
	    exit('No direct script access allowed');

	/**
	* 
	*/
	class Model_monitoring extends CI_Model
	{
		
		function __construct()
		{
       		parent::__construct();
    	}

    	//melihat status ruangan
    	function nama_ruang()
    	{
    		$this->db->select('*');
        	$this->db->from('status_ruang');
        	$this->db->join('jadwal_prodi','jadwal_prodi.IDRUANG=status_ruang.ruang_id');
        	$this->db->group_by('ruang_id');

        	$query=$this->db->get();
        	return $query->result();
    	}

        public function getLogRuang($id_ruang)
        {   
            $this->db->select('*');
            $this->db->from('log');

            $this->db->join('rfid','rfid.rfid_id = log.log_rfid_id');
            $this->db->join('jadwal','jadwal.jadwal_id = log.log_jadwal_id');
            $this->db->join('kelas', 'kelas.kelas_id = jadwal.jadwal_kelas_id');
            $this->db->join('semester', 'semester.semester_id = jadwal.jadwal_semester_id');
            $this->db->join('makul','makul.makul_id = jadwal.jadwal_makul_id');
            $this->db->order_by('log_id','DESC');

            $this->db->where('log_ruang_id', $id_ruang);
            $this->db->group_by('log_id');
            
            $query=$this->db->get();
            return $query->result();

            /*//field kan ku pilih
                $this->db->select('log_id,
                                    log_jadwal_id,
                                    jadwal_ruang_id,
                                    ruang_nama,
                                    rfid_id,
                                    rfid_number,
                                    rfid_kelas_id,
                                    kelas_nama,
                                    jadwal_makul_id,
                                    makul_nama'
                );

            //dari tabel log tentunya
                $this->db->from('log');
            
            //join --> temukan jodoh tabel mu
                #1. log join jadwal => ambil data-data dari tabel jadwal
                    $this->db->join('jadwal','jadwal.jadwal_id = log.log_jadwal_id');
                #2. jadwal join ruang => nama ruang
                    $this->db->join('ruang', 'ruang.ruang_id = jadwal.jadwal_ruang_id');
                #3. log join rfid => no rfid, semester, kelas
                    $this->db->join('rfid', 'rfid.rfid_id = log.log_rfid_id');
                #4. rfid join kelas
                    $this->db->join('kelas', 'kelas.kelas_id = rfid.rfid_kelas_id');
                #5. jadwal join makul
                    $this->db->join('makul','makul.makul_id = jadwal.jadwal_makul_id');

            //kondisi
                $this->db->where('jadwal_ruang_id', $id_ruang);

            //group by
                $this->db->group_by('log_id');

            $query=$this->db->get();
            return $query->result();*/

            /*$this->db->select('*');
            $this->db->join('jadwal_prodi','jadwal_prodi.IDRUANG=log.id_ruang_log');
            $this->db->join('data_rfid','data_rfid.id_rfid=log.id_rfid_log');
            $this->db->group_by('id_log');

            $query=$this->db->get_where('log',array('id_ruang_log'=>$id_ruang));
            return $query->result();*/
        }

        public function data_tahun($id_ruang)
        {
            $query = $this->db->query(
                    "SELECT DISTINCT YEAR(log_tanggal) AS tahun FROM log JOIN jadwal ON log_jadwal_id = jadwal_id JOIN ruang ON jadwal_ruang_id = ruang.ruang_id WHERE ruang_id =".$id_ruang." "
                );
            return $query->result();
        }

        public function data_bulan($id_ruang, $tahun)
        {
            $query = $this->db->query(
                    "SELECT DISTINCT MONTH(log_tanggal) AS bulan FROM log WHERE log_ruang_id = ".$id_ruang." AND YEAR(log_tanggal) = ".$tahun.""
                );
            return $query->result();
        }

        public function data_hari($id_ruang, $tahun, $bulan)
        {
            $query = $this->db->query(
                    "SELECT DISTINCT DAY(log_tanggal) AS hari FROM log WHERE log_ruang_id = ".$id_ruang." AND YEAR(log_tanggal) = ".$tahun." AND MONTH(log_tanggal) = ".$bulan." "
                );
            return $query->result();
        }

        public function log_monitoring_tahunan($id_ruang, $tahun)
        {   

            $this->db->select('*');
            $this->db->from('log');

            $this->db->join('rfid','rfid.rfid_id = log.log_rfid_id');
            $this->db->join('jadwal','jadwal.jadwal_id = log.log_jadwal_id');
            $this->db->join('kelas', 'kelas.kelas_id = jadwal.jadwal_kelas_id');
            $this->db->join('semester', 'semester.semester_id = jadwal.jadwal_semester_id');
            $this->db->join('makul','makul.makul_id = jadwal.jadwal_makul_id');
            $this->db->order_by('log_id','DESC');
             $this->db->where('YEAR(log_tanggal)',$tahun);
            $this->db->where('log_ruang_id', $id_ruang);
            $this->db->group_by('log_id');
            
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->result();
                } else {
                return false;
            }

           // return $query->result();
        }

        public function log_monitoring_bulanan($id_ruang, $tahun, $bulan)
        {
            $this->db->select('*');
            $this->db->from('log');

            $this->db->join('rfid','rfid.rfid_id = log.log_rfid_id');
            $this->db->join('jadwal','jadwal.jadwal_id = log.log_jadwal_id');
            $this->db->join('kelas', 'kelas.kelas_id = jadwal.jadwal_kelas_id');
            $this->db->join('semester', 'semester.semester_id = jadwal.jadwal_semester_id');
            $this->db->join('makul','makul.makul_id = jadwal.jadwal_makul_id');
            $this->db->order_by('log_id','DESC');
             $this->db->where('YEAR(log_tanggal)',$tahun);
             $this->db->where('MONTH(log_tanggal)',$bulan);
            $this->db->where('log_ruang_id', $id_ruang);
            $this->db->group_by('log_id');

           $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->result();
                } else {
                return false;
            }
        }

        public function log_monitoring_harian($id_ruang, $tahun, $bulan, $hari)
        {
            $this->db->select('*');
            $this->db->from('log');

            $this->db->join('rfid','rfid.rfid_id = log.log_rfid_id');
            $this->db->join('jadwal','jadwal.jadwal_id = log.log_jadwal_id');
            $this->db->join('kelas', 'kelas.kelas_id = jadwal.jadwal_kelas_id');
            $this->db->join('semester', 'semester.semester_id = jadwal.jadwal_semester_id');
            $this->db->join('makul','makul.makul_id = jadwal.jadwal_makul_id');
            $this->db->order_by('log_id','DESC');
            $this->db->where('YEAR(log_tanggal)',$tahun);
            $this->db->where('MONTH(log_tanggal)',$bulan);
            $this->db->where('DAY(log_tanggal)',$hari);
            $this->db->where('log_ruang_id', $id_ruang);
            $this->db->group_by('log_id');

           $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->result();
                } else {
                return false;
            }
        }

        #manual
        public function log_manual_by_ruang($id_ruang)
        {
            $this->db->select('*');
            $this->db->join('status_ruang','status_ruang.ruang_id=log_manual.id_ruang_log_manual');
            $this->db->join('mapen','mapen.id_mapen=log_manual.id_mapel_log_manual');
            $this->db->group_by('id_log_manual');

            $query=$this->db->get_where('log_manual',array('id_ruang_log_manual'=>$id_ruang));
            return $query->result();
        }

        public function data_tahun_manual($id_ruang)
        {
            $query = $this->db->query(
                    "SELECT DISTINCT YEAR(tanggal_log_manual) AS tahun FROM log_manual WHERE id_ruang_log_manual = ".$id_ruang.""
                );
            return $query->result();
        }

        public function data_bulan_manual($id_ruang, $tahun)
        {
            $query = $this->db->query(
                    "SELECT DISTINCT MONTH(tanggal_log_manual) AS bulan FROM log_manual WHERE id_ruang_log_manual = ".$id_ruang." AND YEAR(tanggal_log_manual) = ".$tahun.""
                );
            return $query->result();
        }


        function log_manual_tahunan($id_ruang, $tahun)
        {
            $this->db->select('*');
            $this->db->from('log_manual');
            $this->db->join('status_ruang','status_ruang.ruang_id=log_manual.id_ruang_log_manual');
            $this->db->join('mapen','mapen.id_mapen=log_manual.id_mapel_log_manual');
            $this->db->where('id_ruang_log_manual', $id_ruang);
            $this->db->where('YEAR(tanggal_log_manual)',$tahun);
            $this->db->group_by('id_log_manual');
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->result();
                } else {
                return false;
            }
        }

        public function log_manual_bulanan($id_ruang, $tahun, $bulan)
        {
            $this->db->select('*');
            $this->db->from('log_manual');
            $this->db->join('status_ruang','status_ruang.ruang_id=log_manual.id_ruang_log_manual');
            $this->db->join('mapen','mapen.id_mapen=log_manual.id_mapel_log_manual');
            $this->db->where('id_ruang_log_manual', $id_ruang);
            $this->db->where('YEAR(tanggal_log_manual)',$tahun);
            $this->db->where('MONTH(tanggal_log_manual)', $bulan);
            $this->db->group_by('id_log_manual');
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->result();
                } else {
                return false;
            }
        }

        public function insert_data_log($value)
        {
            $this->db->insert('log', $value);
        }

        public function get_ruang_by_id($id)
        {
            $query = $this->db->query(
                    "SELECT * FROM ruang WHERE ruang_id = ".$id.""
                );
            return $query->result();
        }

        public function ruang_is_disable($id)
        {
            $this->db->where('ruang_id', $id);
            $this->db->update('ruang', array('ruang_is_active'=>1));
        }




	} //END Model_monitoring

?>