<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Model_karyawan extends CI_Model
{

    public $table = 'karyawan';
    public $id = 'karyawan_id';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // get all
    function login_user($username,$password){
        $password=md5($password);

        $id2=str_replace(' ','',$username);
            $dirty=array(' ',',',':','?','-','!','&','#','*','(',')');
            //cleaning service
            foreach($dirty as $dirt){
                $username2=str_replace($dirt,'',$id2);
            }

         $query=  $this->db->query("
        SELECT karyawan_nama,karyawan_id,count(karyawan_id) as jumlah from karyawan where karyawan_username='".$username2."' and karyawan_password='".$password."' and karyawan_is_active=1
            ");
        return $query->row(); 
    }

    function get_by_id($id)
    {
       $query=  $this->db->query("
        Select * from karyawan where karyawan_id=".$id." and karyawan_is_active=1
            ");
        return $query->row();
    }
        function karyawan_list()
    {
       $query=  $this->db->query("
                SELECT
                karyawan.*, kota_nama,
                jabatan_nama,
            divisi_nama,
                bagian_nama
            FROM
                karyawan
            LEFT JOIN kota ON kota_id = karyawan_kota_id
            AND kota_is_active = 1
            LEFT JOIN jabatan ON jabatan_id = karyawan_jabatan_id
            LEFT JOIN divisi ON divisi_id = karyawan_divisi_id
            left join bagian on bagian_id= karyawan_bagian_id
            WHERE
                karyawan_is_active = 1 ");
        return $query->result();
    }

    function ganti_password($id,$password)
    {
       $query=  $this->db->query("
          Update karyawan set karyawan_password='".$password."' where karyawan_id='".$id."'
            ");
    }

//============================================START AGENDA==========================================================================
       
    function agenda_insert($data)
    {
        $this->db->insert('agenda', $data);
        return $this->db->insert_id();
    }
        function agenda_detail_insert($data)
    {
        $this->db->insert('agenda_detail', $data);
        return $this->db->insert_id();
    }

    function bagian_list()
    {
       $query=  $this->db->query("
        select bagian_id,bagian_nama from bagian where bagian_is_active=1
            ");
        return $query->result();
    }
    
        function agenda_detail_list()
    {
       $query=  $this->db->query("
        SELECT * from agenda join karyawan on karyawan_id=agenda_karyawan_id where agenda_is_active=1
            ");
        return $query->result();
    }

        function agenda_list($start,$end)
    {
            return $this->db->where("agenda_tanggal_mulai >=", $start)->where("agenda_tanggal_selesai <=", $end)->get("agenda");
    }
//============================================END AGENDA============================================================================
//==========================================START SPPD DAN SURAT TUGAS==============================================================

        function anggaran_list()
    {
       $query=  $this->db->query("
        SELECT * from anggaran where anggaran_is_active=1
            ");
        return $query->result();
    }

        function sppd_insert($data)
    {
        $this->db->insert('sppd', $data);
        return $this->db->insert_id();
    }
        function surat_tugas_insert($data)
    {
        $this->db->insert('surat_tugas', $data);
        return $this->db->insert_id();
    }
        function insertpengesah($sppd,$pengesah){
    $query=$this->db->query("
        INSERT INTO sppd_pengesahan (Sppd_pengesahan_karyawan_id,Sppd_pengesahan_sppd_id) VALUES('".$pengesah."','".$sppd."')
        ");
    }

     function detail_sppd($id)
    {
        $query=  $this->db->query("
          SELECT
    Sppd_id,
    pegawai.karyawan_nama as nama,
    pengesah.karyawan_nama as ttd,
    ttdpeg.jabatan_nama as jabatan1,
    ttdpeng.jabatan_nama as jabatan2,
    Sppd_Nomor_surat,
    Sppd_Tanggal_buat,
    Sppd_Tujuan,
    Sppd_kendaraan,
    Sppd_Tanggal_berangkat,
    Sppd_Tanggal_kembali,
    Sppd_Anggaran,
    Sppd_Keterangan,
    Sppd_Maksud_dinas,
    Sppd_Pengikut,
    Sppd_Karyawan_id,
    Sppd_pengesahan_sppd_id,
    anggaran_nama
FROM
    sppd_pengesahan
LEFT JOIN karyawan AS pengesah ON pengesah.karyawan_id = Sppd_pengesahan_karyawan_id
LEFT JOIN sppd ON Sppd_pengesahan_sppd_id = Sppd_id
left join anggaran on anggaran_id = Sppd_Anggaran
LEFT JOIN karyawan AS pegawai ON pegawai.karyawan_id = Sppd_Karyawan_id
LEFT JOIN jabatan AS ttdpeg ON pegawai.karyawan_jabatan_id=ttdpeg.jabatan_id
LEFT JOIN jabatan AS ttdpeng ON pengesah.karyawan_id=ttdpeng.jabatan_id
where Sppd_pengesahan_sppd_id=".$id."
");
        return $query->row();
    }

     function sppd_list($bulan,$tahun,$nama_1,$nama_2){

        $isi_query="
        SELECT
    Sppd_id,
    pegawai.karyawan_nama,
    pengesah.karyawan_nama as ttd,
    Sppd_Nomor_surat,
    Sppd_Tanggal_buat,
    Sppd_Tujuan,
    Sppd_kendaraan,
    Sppd_Tanggal_berangkat,
    Sppd_Tanggal_kembali,
    Sppd_Anggaran,
    Sppd_Keterangan,
    Sppd_Maksud_dinas,
    Sppd_Pengikut,
    Sppd_Karyawan_id
FROM
    sppd_pengesahan
LEFT JOIN karyawan AS pengesah ON pengesah.karyawan_id = Sppd_pengesahan_karyawan_id
LEFT JOIN sppd ON Sppd_pengesahan_sppd_id = Sppd_id
LEFT JOIN karyawan AS pegawai ON pegawai.karyawan_id = Sppd_Karyawan_id
WHERE sppd_id IS NOT NULL
        ";
     
        if($bulan){
        $isi_query .= " AND MONTH(Sppd_Tanggal_buat)='".$bulan."' ";

       }

       if($tahun){
        $isi_query .= " AND YEAR(Sppd_Tanggal_buat)='".$tahun."' ";

       }

       if($nama_1){
        $isi_query .= " AND sppd_karyawan_id='".$nama_1."' ";

       }

       if($nama_2){
        $isi_query .= " AND sppd_pengesahan_karyawan_id='".$nama_2."' ";

       }

       $isi_query .= " order by Sppd_Tanggal_buat desc
            ";
       $query=  $this->db->query($isi_query);
        return $query->result();
    }


     function surat_tugas_detail($id)
   { $query=  $this->db->query("
        SELECT
     Surat_tugas_id,
    surat_tugas_nomor,
    surat_tugas_dasar,
    surat_tugas_Untuk,
    pegawai.karyawan_nama as nama,
    pengesah.karyawan_nama as ttd,
    ttdpeg.jabatan_nama as jabatan1,
    ttdpeng.jabatan_nama as jabatan2,
    Surat_tugas_Tanggal_buat,
    Surat_tugas_Tanggal_kembali,
    Surat_tugas_Tempat,
    Surat_tugas_Dasar,
    Surat_tugas_Untuk,
    Surat_tugas_Tanggal,
    Surat_tugas_Tanggal_Kembali,
    Surat_tugas_waktu,
    Surat_tugas_Karyawan_id,
    Surat_tugas_pengesahan_surat_tugas_id
        FROM
        surat_tugas
                LEFT JOIN surat_tugas_pengesahan ON Surat_tugas_pengesahan_surat_tugas_id = Surat_tugas_id
        LEFT JOIN karyawan AS pengesah ON pengesah.karyawan_id = Surat_tugas_pengesahan_karyawan_id
        LEFT JOIN karyawan AS pegawai ON pegawai.karyawan_id = Surat_tugas_Karyawan_id
        LEFT JOIN jabatan AS ttdpeg ON pegawai.karyawan_jabatan_id=ttdpeg.jabatan_id
        LEFT JOIN jabatan AS ttdpeng ON pengesah.karyawan_id=ttdpeng.jabatan_id
        where Surat_tugas_id=".$id."
");
        return $query->row();
    }

        function insert_pengesah_surat_tugas($sppd,$pengesah){
    $query=$this->db->query("
        INSERT INTO surat_tugas_pengesahan (Surat_tugas_pengesahan_karyawan_id,Surat_tugas_pengesahan_surat_tugas_id) VALUES('".$pengesah."','".$sppd."')
        ");
    }
//==========================================END SPPD DAN SURAT TUGAS===============================================================

    function show_aset(){
        $query=  $this->db->query("
            SELECT
                aset.*,karyawan_nama
            FROM
                aset
            LEFT JOIN karyawan ON karyawan_id = aset_karyawan_id
            AND karyawan_is_active = 1
            WHERE
                aset_is_active = 1
                order by aset_id desc
");
        return $query->result();
    }
}
