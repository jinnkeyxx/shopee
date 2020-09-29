<?php
class Checkout_model extends CI_Model
{
 function fetch_data($query)
 {
  $this->db->select("*");
  $this->db->from("users");
  if($query != '')
  {

   $this->db->like('serial', $query);
   $this->db->like('status' , 0);
   $this->db->or_like('serial2', $query);
   $this->db->like('status' , 0);
   $this->db->or_like('serial3', $query);
   $this->db->like('status' , 0);
  


  }

  $this->db->order_by('id', 'DESC');

  return $this->db->get();
 }
}
?>