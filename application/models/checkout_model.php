<?php
class checkout_model extends CI_Model
{
 function fetch_data($query)
 {
  $this->db->select("*");
  $this->db->from("users");
  if($query != '')
  {
   $this->db->like('fullname', $query);
   $this->db->or_like('serial', $query);
   $this->db->or_like('serial2', $query);
   $this->db->or_like('serial3', $query);
  }
  $this->db->order_by('id', 'DESC');
  return $this->db->get();
 }
}
?>
