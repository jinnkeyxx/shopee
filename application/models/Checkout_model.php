<?php
class Checkout_model extends CI_Model
{
 function fetch_data($query)
 {
  $this->db->select("*");
  $this->db->from("users");
  if($query != '')
  {
   // $this->db->where('serial', $query);
   // $this->db->or_where('serial2', $query);
   // $this->db->or_where('serial3', $query);
   // $this->db->where('status', 0);
   $this->db->where( 'status',  0)->group_start()->where('serial', $query)->or_where('serial2', $query)->or_where('serial3', $query)->group_end();
  }
  $this->db->order_by('id', 'DESC');
  return $this->db->get();
 }
}
?>