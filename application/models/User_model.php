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
        // return $this->db->order_by('users' ,)->result_array();
       return $this->db->order_by('id' , 'DESC')->get('users')->result_array();
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
    public function serach($keyword)
    {
        $this->db->where("serial" ,$keyword);
        $this->db->where("serial2" , $keyword);
        $this->db->where("serial3" , $keyword);
        $result = $this->db->get('users');
        if($result->num_rows() > 0){
            return $result->row();
        }else {
            return false;
        }
    }
    public function update($data)
    {
        $this->db->update('users' , $data);
    }
    public function getuser($username)
    {
        $this->db->where("status" , 1);
        $this->db->where("user_post" , $username);
        $result = $this->db->get('users');
        
        return $result->num_rows();

    }
    public function getusers()
    {
        $this->db->where("status" , 1);
        $result = $this->db->get('users');
        
        return $result->num_rows();

    }
    public function checkMaNV($manv)
    {
        $this->db->where("manv" ,$manv);
        
        $result = $this->db->get('users');
        if($result->num_rows() > 0){
            return false;
        }else {
            return true;
        }
    }
    public function deleteAll()
    {
        $this->db->empty_table('users');
    }
    public function employeeList() {
		$this->db->select(array('id', 'manv', 'fullname', 'team', 'phone', 'model_phone' , 'serial' , 'laptop' , 'model_laptop', 'serial2' , 'orther' , 'serial3' ,'images' , 'status' , 'user_post'));
		$this->db->from('users');
		$query = $this->db->get();
		return $query->result_array();
	}
    
}