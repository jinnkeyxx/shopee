<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin_Model extends CI_Model
{
    function __construct() 
    {
        $this->tblName = 'admin';
    }
    public function getDataBarang()
    {
        return $this->db->get('admin')->result_array();
    }
    public function import_data($databarang)
    {
        $jumlah = count($databarang);
        if ($jumlah > 0) {
            $this->db->replace('admin', $databarang);
        }
    }
    public function login($username , $password)
    {
        $this->db->where("username" ,$username);
        $this->db->where("password" , $password);
        $result = $this->db->get('admin');
        if($result->num_rows() > 0){
            return $result->row();
        }else {
            return false;
        }
    }
    public function get_row()
    {
        $this->db->where("id" , 0);
        $result = $this->db->get('admin');
        if($result->num_rows() > 0){
            return $result->row();
        }else {
            return false;
        }
        
    }
   
    
}