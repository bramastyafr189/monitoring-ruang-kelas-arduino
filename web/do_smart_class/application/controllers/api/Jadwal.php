<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Jadwal extends CI_Controller
{
	public function index()
	{
		
		foreach ($this->getJSON() as $json) {
		 	echo '<pre>';
			print_r ($json);
			echo '</pre>';
			$this->insertJSON($json);
		}
		//$this->groupingIDRuang();
	}

	public function getJSON()
	{
		// URL JSON jadwal.uns.ac.id
		$url = 'https://jadwal.uns.ac.id/index.php?r=api/getdatapenggunaanruang&thn=2018&smt=1&prodi=132';

		// GET data JSON from URL
		$data = file_get_contents($url);

		// Convert string JSON to PHP array
		$data = json_decode($data);

		return $data;
	}

	// memasukkan data json ke database
	public function insertJSON($data = [])
	{
		$this->db->insert('jadwal_prodi', $data);
	}

	/*public function groupingIDRuang()
	{
		$this->db->select('IDRUANG');
		$this->db->from('jadwal_prodi');
		$this->db->group_by('IDRUANG');
		$idRuang = $this->db->get();
		$idRuang = $idRuang->result();

		foreach ($idRuang as $id) {
			$data = [
				'ruang_id'			=> $id->IDRUANG,
				'ruang_status'		=> 0,
				'ruang_is_active'	=> 0
			];
			$this->db->insert('status_ruang', $data);
		}
	}*/

	public function insertTabelJadwal()
	{	
		// ambil data dari tabel data_api_generate 
		$this->db->select('IDSEMESTER,SEMESTER,HARI,SESI,JAMMULAI,JAMAKHIR,IDMAPEN,IDRUANG,IDKELAS,IDDOS');
		$this->db->from('data_api_generate');

		$data_jadwal = $this->db->get();
		$data_jadwal = $data_jadwal->result();

		foreach ($data_jadwal as $jadwal) {
			$data = [
				'jadwal_tahun_semester_id' 	=> $jadwal->IDSEMESTER,
				'jadwal_semester_id' 		=> $jadwal->SEMESTER,
				'jadwal_hari' 				=> $jadwal->HARI,
				'jadwal_sesi' 				=> $jadwal->SESI,
				'jadwal_jam_mulai' 			=> $jadwal->JAMMULAI,
				'jadwal_jam_akhir' 			=> $jadwal->JAMAKHIR,
				'jadwal_makul_id' 			=> $jadwal->IDMAPEN,
				'jadwal_ruang_id' 			=> $jadwal->IDRUANG,
				'jadwal_kelas_id' 			=> $jadwal->IDKELAS,
				'jadwal_dosen_id' 			=> 0
			];

			//insert data ke database
			$this->db->insert('jadwal', $data);
		}
	}

	public function insertTabelRuang()
	{
		//ambil data dari data_api_generate
		$this->db->select('IDRUANG', 'NAMARUANG');
		$this->db->from('data_api_generate');
		$this->db->group_by('IDRUANG');

		$data_ruang = $this->db->get();
		$data_ruang = $data_ruang->result();

		foreach ($data_ruang as $ruang) {
			$data = [
				'ruang_id' 			=> $ruang->IDRUANG,
				'ruang_nama' 		=> $ruang->NAMARUANG,
				'ruang_is_active' 	=> 0
			];

			//insert data ke database
			$this->db->insert('ruang', $data);
		}
	}

	public function insertTabelMakul(){
		$this->db->select('IDMAPEN','NAMAMAKUL', 'SKS');
		$this->db->from('data_api_generate');
		$this->db->group_by('IDMAPEN');

		$data_makul = $this->db->get();
		$data_makul = $data_makul->result();

		foreach ($data_makul as $makul) {
			$data = [
				'makul_id' 		=> $makul->IDMAPEN,
				'makul_nama' 	=> 'TEST',
				'makul_sks' 	=> 0
			];

			//print_r($data);
			//insert data
			$this->db->insert('makul', $data);
		}
	}

	public function insertTabelDosen()
	{
		# code...
	}
}