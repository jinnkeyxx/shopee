<?php
class Checkout_model extends CI_Model
{
 function fetch_data($query)
 {
  $this->db->select("*");
  $this->db->from("users");
  if($query != '')
  {
//    $this->db->like('fullname', $query);
   $this->db->where('serial', $query);
   $this->db->where('serial2', $query);
   $this->db->where('serial3', $query);
  }
  $this->db->order_by('id', 'DESC');
  return $this->db->get();
 }
}
?>