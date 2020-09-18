<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User_Model extends CI_Model
{
     function __construct() {
        $this->tblName = 'users';
    }
    public function import_data($databarang)
    {
        $jumlah = count($databarang);
        if ($jumlah > 0) {
            $this->db->replace('users', $databarang);
        }
    }

    public function getDataBarang()
    {
        return $this->db->get('users')->result_array();
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
}