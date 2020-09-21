<?php
defined('BASEPATH') or exit('No direct script access allowed');
require_once APPPATH . 'third_party/Spout/Autoloader/autoload.php';

use Box\Spout\Reader\Common\Creator\ReaderEntityFactory;

class Userlist extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->model('Admin_model');
        // $this->load->helper('url');
        $this->load->helper(array('form', 'url'));
    }



    public function index()
    {
        if($this->session->userdata('login')){
            $data['title'] = 'User List';
            $data['user'] = $this->User_model->getDataBarang();
            // echo print_r($data['user']->status);
            // exit();
            $data['aprove'] = $this->User_model->getuser();
            
            $data['admin'] = $this->Admin_model->get_row($this->session->userdata('id'));
            // $data['admin']->id;

           
            $this->load->view('template/meta', $data);
            $this->load->view('template/header', $data);
            $this->load->view('index', $data);
            $this->load->view('template/footer', $data);
        }else {
             redirect('login');
        }
       
    }
    public function userlistaprove()
    {
        if($this->session->userdata('login')){
            if($this->session->userdata('role') == 0)
            {
            $data['title'] = 'User List';
            $data['user'] = $this->User_model->getDataBarang();
            // echo print_r($data['user']->status);
            // exit();
            
            $data['admin'] = $this->Admin_model->get_row($this->session->userdata('id'));
            // $data['admin']->id;

           
            $this->load->view('template/meta', $data);
            $this->load->view('template/header', $data);
            $this->load->view('userlistaprove', $data);
            $this->load->view('template/footer', $data);
            } else {
             redirect('userlist');

            }
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
                        $data['admin'] = $this->Admin_model->get_row($this->session->userdata('id'));
                        if($data['admin']->role == 0)
                        {
                            $databarang = array(
                                'manv' => $row->getCellAtIndex(0),
                                'fullname'  => $row->getCellAtIndex(1),
                                'team'      => $row->getCellAtIndex(2),
                                'phone'     => $row->getCellAtIndex(3),
                                'model_phone' => $row->getCellAtIndex(4),
                                'serial'    => $row->getCellAtIndex(5),
                                'laptop'    => $row->getCellAtIndex(6),
                                'model_laptop'    => $row->getCellAtIndex(7),
                                'serial2'   => $row->getCellAtIndex(8),
                                'orther'    => $row->getCellAtIndex(9),
                                'serial3'   => $row->getCellAtIndex(10),
                                'images'    => $row->getCellAtIndex(11),
                                'status' => 0,
                                'user_post' => $data['admin']->username, 
                                
                            );
                            $this->User_model->import_data($databarang);
                            $this->session->set_flashdata('Success', 'Thêm mới thành công!!!');
                        }
                        else 
                        {
                            $databarang = array(
                                'manv' => $row->getCellAtIndex(0),
                                'fullname'  => $row->getCellAtIndex(1),
                                'team'      => $row->getCellAtIndex(2),
                                'phone'     => $row->getCellAtIndex(3),
                                'model_phone' => $row->getCellAtIndex(4),
                                'serial'    => $row->getCellAtIndex(5),
                                'laptop'    => $row->getCellAtIndex(6),
                                'model_laptop'    => $row->getCellAtIndex(7),
                                'serial2'   => $row->getCellAtIndex(8),
                                'orther'    => $row->getCellAtIndex(9),
                                'serial3'   => $row->getCellAtIndex(10),
                                'images'    => $row->getCellAtIndex(11),
                                'status' => 1,
                                'user_post' => $data['admin']->username, 
                            );
                            $this->User_model->import_data($databarang);
                            $this->session->set_flashdata('Success', 'Cập nhật thành công!!!');
                        }
                    }
                    $numRow++;
                }
                $reader->close();
                unlink('uploads/' . $file['file_fullname']);
                $this->session->set_flashdata('Success', 'Thêm Data thành công !!!');
                redirect('userlist');
            }
        } else {
            echo "Error :" . $this->upload->display_errors();
        };
    }
    public function uploaduser()
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
                            'email'      => $row->getCellAtIndex(1),
                            'username'     => $row->getCellAtIndex(2),
                            'password'    => $row->getCellAtIndex(3),
                            'role'    => $row->getCellAtIndex(4),
                            
                            'image'    => $row->getCellAtIndex(5),
                        );
                        $this->Admin_model->import_data($databarang);
                        
                    }
                    $numRow++;
                }
                $reader->close();
                unlink('uploads/' . $file['file_fullname']);
                $this->session->set_flashdata('Success', 'Thêm Data thành công !!!');
                redirect('userlist');
            }
        } else {
            echo "Error :" . $this->upload->display_errors();
        };
    }
    public function update()
    {
      
            
            $fullname = $_POST['fullname'];
            
            $team = $_POST['team'];
            $laptop = $_POST['laptop'];   
            $model_laptop = $_POST['model_laptop'];
            $phone = $_POST['phone'];
            $model_phone = $_POST['model_phone'];
            $serial1 = $_POST['serial1'];
            $serial2 = $_POST['serial2'];
            $serial3 = $_POST['serial3'];
            $orther = $_POST['orther'];
            $serial1 = $_POST['serial1'];
            $manv = $_POST['manv'];
            
            $images_old = $_POST['image_old'];
            $user_post = $_POST['user_post'];
            $id = $_POST['hidden_id'];
            $data = [];
            $img=[];
            
            for($count = 0; $count < count($id); $count++)
            
            {
                
                
                $path = './uploads/';
                $this->load->library('upload');
           
            
                $this->upload->initialize(array(
                    "upload_path"       =>  $path,
                    "allowed_types"     =>  "gif|jpg|png",
                    
                ));
           
                if($this->upload->do_upload("image"))
                {
                
                    $file = $this->upload->data();
                    $data = array(
                        'fullname'   => $fullname[$count],
                        'team'  => $team[$count],
                        'phone'  => $phone[$count],
                        'model_phone' => $model_phone[$count],
                        'serial' => $serial1[$count],
                        'laptop'   => $laptop[$count],
                        'model_laptop' => $model_laptop[$count],
                        'serial2' => $serial2[$count],
                        'orther' => $orther[$count],
                        'serial3' => $serial3[$count],
                        'images' => base_url().'uploads/'. $file['file_name'],
                        'user_post'=>$user_post[$count],
                        'manv' => $manv[$count],
                        'id'   => $id[$count],

                    );
                    $this->User_model->import_data($data);
                    $this->session->set_flashdata('Success', 'Cập nhật thành công!!!');

                   
                
                
                }
                else 
                {
                    $data = array(
                        'fullname'   => $fullname[$count],
                        'team'  => $team[$count],
                         'phone'  => $phone[$count],
                        'model_phone' => $model_phone[$count],
                        'serial' => $serial1[$count],
                        'laptop'   => $laptop[$count],
                        'model_laptop' => $model_laptop[$count],
                        'serial2' => $serial2[$count],
                        'orther' => $orther[$count],
                        'serial3' => $serial3[$count],
                        'images' => $images_old[$count],
                        'user_post'=>$user_post[$count],
                        'manv' => $manv[$count],
                        'id'   => $id[$count]
                    );
                    
                    $this->User_model->import_data($data);
                    $this->session->set_flashdata('Success', 'Cập nhật thành công!!!');

                    
                }
               
            }
             redirect('userlist'); 
        
       
          

    }
    public function update_user()
    {
       if(isset($_POST['hidden_id']))
        {
            
            $fullname = $_POST['fullname'];
            $email = $_POST['email'];
            $username = $_POST['username'];            
            $password = $_POST['password'];
            $role = $_POST['role'];
            
            // $role = (int)$role;
            $images_old = $_POST['image_old'];
            
            $id = $_POST['hidden_id'];
            $data = [];
            $img=[];
           
            for($count = 0; $count < count($id); $count++)
            {
                $path = './uploads/';
                $this->load->library('upload');
           
            
                $this->upload->initialize(array(
                    "upload_path"       =>  $path,
                    "allowed_types"     =>  "gif|jpg|png",
                    
                ));
           
                if($this->upload->do_upload("image"))
                {
                
                    $file = $this->upload->data();
                    $data = array(
                        'fullname'   => $fullname[$count],
                        'email'  => $email[$count],
                        'username'  => $username[$count],
                        'password' => $password[$count],
                        'role'   => $role[$count],
                        'image' => base_url().'uploads/'. $file['file_name'],
                        'id'   => $id[$count]
                    );
                    $this->Admin_model->import_data($data);
                    $this->session->set_flashdata('Success', 'Cập nhật thành công!!!');
                    
                
                }
                else 
                {
                    $data = array(
                        'fullname'   => $fullname[$count],
                        'email'  => $email[$count],
                        'username'  => $username[$count],
                        'password' => $password[$count],
                        'role'   => $role[$count],
                        'image' => $images_old[$count],
                        'id'   => $id[$count]
                    );
                    $this->Admin_model->import_data($data);
                    $this->session->set_flashdata('Success', 'Cập nhật thành công!!!');

                    
                }
            }
            redirect('userlogin'); 
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
           
            // echo $ids;
            // exit();
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
     public function delete_user()
    {
            $ids = $_POST['hidden_id'];
           
            
             // If id array is not empty
            if(!empty($ids)){
                // Delete records from the database
                $delete = $this->Admin_model->delete($ids);
                
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
        $serial = $_POST['serial1'];
        $serial2 = $_POST['serial2'];
        if(isset($_POST['model_phone'])){
            $model_phone = $_POST['model_phone'];

        }
        else {
            $model_phone = "";

        }
        if(isset($_POST['model_laptop'])){
            $model_laptop = $_POST['model_laptop'];

        }
        else {
            $model_laptop = "";

        }
        if(isset($_POST['manv'])){
            $manv = $_POST['manv'];

        }
        else {
            $manv = "";

        }
        // $manv = $_POST['manv'];
        if(isset($_POST['serial3'])){
            $serial3 = $_POST['serial3'];
        }
        else {
            $serial3 = "";
        }
        $orther = $_POST['orther'];
        if(isset($_POST['phone'])){
            $phone = $_POST['phone'];
            if($phone == NULL){
                $phone = "No";
            }
            else {
                $phone = "Yes";
            }
        } else {
            $phone = "No";
        }
        
        if(isset($_POST['laptop'])){
            $laptop = $_POST['laptop'];
            if($laptop == NULL){
                $laptop = "No";
            }
            else {
                $laptop = "Yes";
            }
        }else {
            $laptop = "No";
        }
        
          
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'jpg|png|jpeg';
        $config['file_name'] = 'img' . time();
        $this->load->library('upload', $config);
        if ($this->upload->do_upload('img')) {
            $file = $this->upload->data();
            $img = $file['file_name'];
        }
        $data['admin'] = $this->Admin_model->get_row($this->session->userdata('id'));
        if($data['admin']->role == 0)
        {
            $data = array(
            'fullname'   => $fullname,
            'team'  => $team,
            'phone'  => $phone,
            'serial' => $serial,
            'laptop'   => $laptop,
            'model_phone' =>$model_phone,
            'model_laptop' =>$model_laptop,
            'orther' => $orther,
            'manv' => $manv,
            'serial2' => $serial2,
            'serial3' => $serial3,
            'images' => base_url().'uploads/'.$img,
            'user_post' => $data['admin']->username,
            );
            $this->User_model->import_data($data);
            $this->session->set_flashdata('Success','Thêm thành công');
        }else {
            $data = array(
            'fullname'   => $fullname,
            'team'  => $team,
            'phone'  => $phone,
            'serial' => $serial,
            'laptop'   => $laptop,
            'model_phone' =>$model_phone,
            'model_laptop' =>$model_laptop,
            'orther' => $orther,
            'manv' => $manv,
            'serial2' => $serial2,
            'serial3' => $serial3,
            'status' => 1,
            'images' => base_url().'uploads/'.$img,
            'user_post' => $data['admin']->username,
            );
            $this->User_model->import_data($data);
            $this->session->set_flashdata('Success','Thêm thành công');

            // redirect('userlist');
        }
            redirect('userpost');

          
            
    }

    public function adduser()
    {
        $img = "";
        $fullname = $_POST['fullname'];
        $email = $_POST['email'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $role = $_POST['role'];
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'jpg|png|jpeg';
        $config['file_name'] = 'img' . time();
        $this->load->library('upload', $config);
        if ($this->upload->do_upload('img')) {
            $file = $this->upload->data();
            $img = $file['file_name'];
            $data = array(
                'fullname'   => $fullname,
                'email'  => $email,
                'username'  => $username,
                'password' => $password,
                'role'   => $role,
                'image' => base_url().'uploads/'.$img,
            );
            $this->Admin_model->import_data($data);
            $this->session->set_flashdata('Success', 'Thêm mới thành công!!!');

        }else {
            $data = array(
                'fullname'   => $fullname,
                'email'  => $email,
                'username'  => $username,
                'password' => $password,
                'role'   => $role,
                
                'image' => base_url().'assets\images\users\profile2.png',

            );
            $this->Admin_model->import_data($data);
            $this->session->set_flashdata('Success', 'Thêm mới thành công!!!');

        }
        
            $this->session->set_flashdata('Thêm thành công');
            redirect('userlogin');
    }
        
    public function checkout()
    {
        $data['title'] = "Checkout";
        $this->load->view('template/meta', $data);
        $this->load->view('checkout');
        $this->load->view('template/footer', $data);
    }
    public function profile()
    {   $data['title'] = "Profle";
        $data['admin'] = $this->Admin_model->get_row($this->session->userdata('id'));
        // die($data['admin']->fullname);
        $this->load->view('template/meta' , $data);
        $this->load->view('template/header' , $data);
        $this->load->view('profile' , $data);
        $this->load->view('template/footer' , $data );
    }
    public function aprove()
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
            $images_old = $_POST['image_old'];
            $user_post = $_POST['user_post'];
            // var_dump($user_post);
            // exit();
            $id = $_POST['hidden_id'];
            $data = [];
            $img=[];
            $trangthai = '0';
            for($count = 0; $count < count($id); $count++)
            {
                $path = './uploads/';
                $this->load->library('upload');
           
            
                $this->upload->initialize(array(
                    "upload_path"       =>  $path,
                    "allowed_types"     =>  "gif|jpg|png",
                    
                ));
           
                if($this->upload->do_upload("image"))
                {
                
                    $file = $this->upload->data();
                    $data = array(
                        'fullname'   => $fullname[$count],
                        'team'  => $team[$count],
                        'phone'  => $phone[$count],
                        'serial' => $serial1[$count],
                        'laptop'   => $laptop[$count],
                        'serial2' => $serial2[$count],
                        'orther' => $orther[$count],
                        'serial3' => $serial3[$count],
                        'images' => base_url().'uploads/'. $file['file_name'],
                        'status' => $trangthai[$count],
                        'user_post' => $user_post[$count],
                        'id'   => $id[$count]
                    );
                    $this->User_model->import_data($data);
                    $this->session->set_flashdata('Success', 'Cập nhật thành công!!!');

                    
                
                
                }
                else 
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
                        'images' => $images_old[$count],
                        'status' => $trangthai[$count],
                        'user_post' => $user_post[$count],
                        'id'   => $id[$count]
                    );
                    $this->User_model->import_data($data);
                    $this->session->set_flashdata('Success', 'Cập nhật thành công!!!');

                    
                }
            }
            redirect('userlist'); 
       
        }
       
          

    }
    public function userpost()
    {
         if($this->session->userdata('login')){
            $data['title'] = 'User List';
            $data['user'] = $this->User_model->getDataBarang();
            // echo print_r($data['user']->status);
            // exit();
            
            $data['admin'] = $this->Admin_model->get_row($this->session->userdata('id'));
            $data['admin']->id;

           
            $this->load->view('template/meta', $data);
            $this->load->view('template/header', $data);
            $this->load->view('userpost', $data);
            $this->load->view('template/footer', $data);
        }else {
             redirect('login');
        }
    }
    public function userpostaprove()
    {
         if($this->session->userdata('login')){
            $data['title'] = 'User List';
            $data['user'] = $this->User_model->getDataBarang();
            // echo print_r($data['user']->status);
            // exit();
            
            $data['admin'] = $this->Admin_model->get_row($this->session->userdata('id'));
            $data['admin']->id;

           
            $this->load->view('template/meta', $data);
            $this->load->view('template/header', $data);
            $this->load->view('userpostaprove', $data);
            $this->load->view('template/footer', $data);
        }else {
             redirect('login');
        }
    }
    

    
    
}