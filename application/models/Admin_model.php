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
        return $this->db->get($this->tblName)->result_array();
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
    public function get_row($id)
    {
        $this->db->where("id" , $id);
        $result = $this->db->get('admin');
        if($result->num_rows() > 0){
            return $result->row();
        }else {
            return false;
        }
        
    }
     public function delete($id){
        if(is_array($id)){
            $this->db->where_in('id', $id);
        }else{
            $this->db->where('id', $id);
        }
        $delete = $this->db->delete($this->tblName);
        return $delete?true:false;
    }
    public function add_user($username)
    {
        $this->db->where("username" ,$username);
        
        $result = $this->db->get('admin');
        if($result->num_rows() > 0){
            return false;
        }else {
            return true;
        }
    }
   
    
}