<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class checkout  extends CI_Controller {

 function index()
 {
    $data['title'] = "checkout";
    $this->load->view('template/meta' ,$data);
    $this->load->view('template/header' ,$data);
    $this->load->view('checkout');
    $this->load->view('template/footer');   
 }

 function fetch()
 {
  $output = '';
  $query = '';
  $this->load->model('checkout_model');
  if($this->input->post('query'))
  {
   $query = $this->input->post('query');
  }
  $data = $this->checkout_model->fetch_data($query);
  $output .= '
  <div class="table-responsive">
     <table class="table table-bordered table-hover table-checkable dt-responsive nowrap">
      <tr>
       <th>fullname</th>
       <th>images</th>
       <th>team</th>
       <th>phone</th>
       <th>serial#1</th>
       <th>laptop</th>
       <th>serial#2</th>
       <th>orther</th>
       <th>serial#3</th>
      </tr>
  ';
  if($data->num_rows() > 0)
  {
   foreach($data->result() as $row)
   {
    $output .= '
      <tr>
       <td>'.$row->fullname.'</td>
       <td> <img class="img-fluid" src='.$row->images.'></td>
       <td>'.$row->team.'</td>
       <td>'.$row->phone.'</td>
       <td>'.$row->serial.'</td>
       <td>'.$row->laptop.'</td>
       <td>'.$row->serial2.'</td>
       <td>'.$row->orther.'</td>
       <td>'.$row->serial3.'</td>
      </tr>
    ';
   }
  }
  else
  {
   $output .= '<tr>
       <td colspan="5">No Data Found</td>
      </tr>';
  }
  $output .= '</table>';
  echo $output;
 }
 
}

