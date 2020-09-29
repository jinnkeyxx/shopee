<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Checkout  extends CI_Controller {

  public function __construct()
  {
    parent::__construct();
    $this->load->model('User_model');
    $this->load->model('Admin_model');
  }

  function index()
  {
    $data['admin'] = $this->Admin_model->get_row($this->session->userdata('id'));
    $data['admin']->id;

    $data['title'] = "Check Out Users";
    $this->load->view('template/meta' ,$data);
    $this->load->view('template/header' ,$data);
    $this->load->view('checkout');
    $this->load->view('template/footer');

  }

  function fetch()
  {
    $output = [];
    $query = '';
    $status = false;
    $this->load->model('Checkout_model');
    if($this->input->post('query'))
    {
     $query = $this->input->post('query');
    }
   $data = $this->Checkout_model->fetch_data($query);
 
   if($data->num_rows() > 0)
   {
     foreach($data->result() as $key=>$row)
     {
    
      array_push($output , $row);
    
    }
    $status = true;
  }
  else
  {
  //  $output .= '<tr>
  //  <td colspan="5">No Data Found</td>
  //  </tr>';
   $status = false;
  
 }
//  $output .= '</table>';
echo json_encode(array('status' => $status , 'output' => $output));

//  echo $output;
}

}