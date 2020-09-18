<?php
defined('BASEPATH') or exit('No direct script access allowed');
require_once APPPATH . 'third_party/Spout/Autoloader/autoload.php';

use Box\Spout\Reader\Common\Creator\ReaderEntityFactory;

class userlist extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->model('Admin_model');
    }



    public function index()
    {
        if($this->session->userdata('login')){
            $data['title'] = 'Export Import';
            $data['user'] = $this->User_model->getDataBarang();
            $data['admin'] = $this->Admin_model->get_row();
            $data['admin']->id;

           
            $this->load->view('template/meta', $data);
            $this->load->view('template/header', $data);
            $this->load->view('index', $data);
            $this->load->view('template/footer', $data);
        }else {
             redirect('login');
        }
       
    }

    public function uploaddata()
    {
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'xlsx|xls';
        $config['file_name'] = 'doc' . time();
        $this->load->library('upload', $config);
        if ($this->upload->do_upload('importexcel')) {
            $file = $this->upload->data();
            $reader = ReaderEntityFactory::createXLSXReader();
            $reader->open('uploads/' . $file['file_name']);
            foreach ($reader->getSheetIterator() as $sheet) {
                $numRow = 0;
                foreach ($sheet->getRowIterator() as $row) {
                    if ($numRow > 0) {
                        $databarang = array(
                            'fullname'  => $row->getCellAtIndex(0),
                            'team'  => $row->getCellAtIndex(1),
                            'phone'       => $row->getCellAtIndex(2),
                            'serial'       => $row->getCellAtIndex(3),
                            'laptop'       => $row->getCellAtIndex(4),
                            'serial2'       => $row->getCellAtIndex(5),
                            'orther'       => $row->getCellAtIndex(6),
                            'serial3'       => $row->getCellAtIndex(7),
                            'images'       => $row->getCellAtIndex(8),
                        );
                        $this->User_model->import_data($databarang);
                    }
                    $numRow++;
                }
                $reader->close();
                unlink('uploads/' . $file['file_fullname']);
                $this->session->set_flashdata('pesan', 'import Data Berhasil');
                redirect('userlist');
            }
        } else {
            echo "Error :" . $this->upload->display_errors();
        };
    }
    public function update()
    {
       if(isset($_POST['hidden_id']))
        {
            
            $fullname = $_POST['fullname'];
            $team = $_POST['team'];
            $laptop = $_POST['laptop'];            $phone = $_POST['phone'];
            $serial1 = $_POST['serial1'];
            $serial2 = $_POST['serial2'];
            $serial3 = $_POST['serial3'];
            $orther = $_POST['orther'];
            $serial1 = $_POST['serial1'];
            $images = $_POST['images'];
            $id = $_POST['hidden_id'];
            
            for($count = 0; $count < count($id); $count++)
            {
            $data = array(
            'fullname'   => $fullname[$count],
            'team'  => $team[$count],
            'phone'  => $phone[$count],
            'serial' => $serial1[$count],
            'laptop'   => $laptop[$count],
            'serial2' => $serial2[$count],
            'orther' => $orther[$count],
            'serial3' => $serial3[$count],
            'images'   => $images[$count],
            'id'   => $id[$count]
            );
            
            $this->User_model->import_data($data);
            }
       
        }
       
        

    }
    public function excel()

    {
        $data['title'] = "User";
        $data['user'] = $this->User_model->getDataBarang(); 

        $this->load->view('excel' , $data);
           
    }
    public function delete()
    {
            $ids = $_POST['hidden_id'];
           
            
             // If id array is not empty
            if(!empty($ids)){
                // Delete records from the database
                $delete = $this->User_model->delete($ids);
                
                // If delete is successful
                if($delete){
                    echo json_encode(array('status' => true , 'messages' => 'Xóa thành công'));
                }else{
                    echo json_encode(array('status' => false , 'messages' => 'Xóa không thành công'));
                }
            }else{
                echo json_encode(array('status' => false , 'messages' => 'Xóa không thành công'));
                
            }
    }
    public function add()
    {
        $img = "";
        $fullname = $_POST['fullname'];
        $team = $_POST['team'];
        $laptop = $_POST['laptop'];            
        $phone = $_POST['phone'];
        $serial = $_POST['serial1'];
        $serial2 = $_POST['serial2'];
        $serial3 = $_POST['serial3'];
        $orther = $_POST['orther'];
        if($phone == NULL){
            $phone = "No";
        }
        else {
            $phone = "Yes";
        }
        if($laptop == NULL){
            $laptop = "No";
        }
        else {
            $laptop = "Yes";
        }
        if($orther == NULL){
            $orther = "No";
        }
        else {
            $orther = "Yes";
        }    
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'jpg|png|jpeg';
        $config['file_name'] = 'img' . time();
        $this->load->library('upload', $config);
        if ($this->upload->do_upload('img')) {
            $file = $this->upload->data();
            $img = $file['file_name'];
        }
          $data = array(
            'fullname'   => $fullname,
            'team'  => $team,
            'phone'  => $phone,
            'serial' => $serial,
            'laptop'   => $laptop,
            'orther' => $orther,
            'serial2' => $serial2,
            'serial3' => $serial3,
            'images' => base_url().'uploads/'.$img,
            );
            $this->User_model->import_data($data);
            $this->session->set_flashdata('Thêm thành công');
            redirect('userlist');
    }
        
    public function checkout()
    {
        $data['title'] = "Checkout";
        $this->load->view('template/meta', $data);
        $this->load->view('checkout');
        $this->load->view('template/footer', $data);
    }
    
}