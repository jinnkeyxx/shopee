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
    $data['admin'] = $this->Admin_model->get_row();
    $data['admin']->id;

    $data['title'] = "Check Out User";
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
   <table class="table table-bordered table-hover table-checkable nowrap">
   <thead>
   <tr role="row">
   <th>STT</th>
   <th>Ảnh</th>
   <th>Họ và Tên</th>
   <th>Team</th>
   <th>Điện thoại</th>
   <th>Serial#1</th>
   <th>Laptop</th>
   <th>Serial#2</th>
   <th>Khác</th>
   <th>Serial#3</th>
   </tr>
   </thead>
   <tbody>
   ';
   if($data->num_rows() > 0)
   {
     foreach($data->result() as $key=>$row)
     {
      $output .= '
      <tr>
      <td>'.($key+1).'</td>
      <td> <img class="img-fluid" src='.$row->images.'></td>
      <td>'.$row->fullname.'</td>
      <td>'.$row->team.'</td>
      <td>'.$row->phone.'</td>
      <td>'.$row->serial.'</td>
      <td>'.$row->laptop.'</td>
      <td>'.$row->serial2.'</td>
      <td>'.$row->orther.'</td>
      <td>'.$row->serial3.'</td>
      </tr>
      </tbody>
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