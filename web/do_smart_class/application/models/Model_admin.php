<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Model_admin extends CI_Model
{

    public $table = 'admin';
    public $id = 'id_admin';
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
        SELECT level_admin, username_admin, id_admin, count(id_admin) as jumlah from admin where username_admin='".$username2."' and password_admin='".$password."' and admin_is_active=1
            ");
        return $query->row(); 
    }

    function login($username,$password){
        $this->db->where('username_admin', $username);
        $this->db->where('password_admin', md5($password));
        return $this->db->get('admin')->row();
    }

    function ganti_password($id,$password)
    {
       $query=  $this->db->query("
          Update karyawan set karyawan_password='".$password."' where karyawan_id='".$id."'
            ");
    }
}
