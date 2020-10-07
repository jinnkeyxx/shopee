<?php
defined('BASEPATH') or exit('No direct script access allowed');
require_once APPPATH . 'third_party/Spout/Autoloader/autoload.php';

use Box\Spout\Reader\Common\Creator\ReaderEntityFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
class Userlist extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->model('Admin_model');
        $this->load->helper(array('form', 'url'));
    }

    public function index()
    {
        if($this->session->userdata('login')){
            $data['title'] = 'User Management';
            $data['user'] = $this->User_model->getDataBarang();

            $data['aprove'] = $this->User_model->getuser($this->session->userdata('username'));
            $data['aproveAll'] = $this->User_model->getusers();
            $data['admin'] = $this->Admin_model->get_row($this->session->userdata('id'));
            $data['admin']->id;
           
            $this->load->view('template/meta', $data);
            $this->load->view('template/header', $data);
            $this->load->view('dashboard', $data);
            $this->load->view('template/footer', $data);
        }else {
             redirect('login');
        }
       
    }

    public function userlist()
    {
        if($this->session->userdata('login')){
            $data['title'] = 'User List';
            $data['user'] = $this->User_model->getDataBarang();
            // echo print_r($data['user']->status);
            // exit();
            $data['aprove'] = $this->User_model->getuser($this->session->userdata('username'));
            $data['aproveAll'] = $this->User_model->getusers();
            $data['admin'] = $this->Admin_model->get_row($this->session->userdata('id'));
            $data['admin']->id;
           
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
            
            $data['admin'] = $this->Admin_model->get_row($this->session->userdata('id'));
           
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
        $config['allowed_types'] = 'xls';
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
                                'manv' => $row->getCellAtIndex(1),
                                'fullname'  => $row->getCellAtIndex(2),
                                'team'      => $row->getCellAtIndex(3),
                                'phone'     => $row->getCellAtIndex(4),
                                'model_phone' => $row->getCellAtIndex(5),
                                'serial'    => $row->getCellAtIndex(6),
                                'laptop'    => $row->getCellAtIndex(7),
                                'model_laptop'    => $row->getCellAtIndex(8),
                                'serial2'   => $row->getCellAtIndex(9),
                                'orther'    => $row->getCellAtIndex(10),
                                'serial3'   => $row->getCellAtIndex(11),
                                'images'    => $row->getCellAtIndex(12),
                                'status' => 0,
                                'user_post' => $data['admin']->username, 
                                
                            );
                            $this->User_model->import_data($databarang);
                            $this->session->set_flashdata('Success', 'Thêm mới thành công!!!');
                        }
                        else 
                        {
                            $databarang = array(
                                'manv' => $row->getCellAtIndex(1),
                                'fullname'  => $row->getCellAtIndex(2),
                                'team'      => $row->getCellAtIndex(3),
                                'phone'     => $row->getCellAtIndex(4),
                                'model_phone' => $row->getCellAtIndex(5),
                                'serial'    => $row->getCellAtIndex(6),
                                'laptop'    => $row->getCellAtIndex(7),
                                'model_laptop'    => $row->getCellAtIndex(8),
                                'serial2'   => $row->getCellAtIndex(9),
                                'orther'    => $row->getCellAtIndex(10),
                                'serial3'   => $row->getCellAtIndex(11),
                                'images'    => $row->getCellAtIndex(12),
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
    public function createExcel() {
//         header('Content-Type:application/octet-stream/');
// header("Content-Disposition:attachment; filename =user.xlsx");
// header('Pragma:no-cache');
// header('Expires: 0');
echo "\xEF\xBB\xBF"; //UTF-8 BOM
		$fileName = 'user.xlsx';  
		$employeeData = $this->User_model->employeeList();
		$spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
       	$sheet->setCellValue('A1', 'stt');
        $sheet->setCellValue('B1', 'Mã nhân viên');
        $sheet->setCellValue('C1', 'Họ tên');
        $sheet->setCellValue('D1', 'team');
	    $sheet->setCellValue('E1', 'phone');
        $sheet->setCellValue('F1', 'model phone'); 
        $sheet->setCellValue('G1', 'serial');       

        $sheet->setCellValue('H1', 'laptpp');       

        $sheet->setCellValue('I1', 'model laptop');       

        $sheet->setCellValue('J1', 'serial2');   
        $sheet->setCellValue('K1', 'orther');       

        $sheet->setCellValue('L1', 'serial3');       

        $sheet->setCellValue('M1', 'images');  
        $sheet->setCellValue('N1', 'status');  
        $sheet->setCellValue('O1', 'người đăng');       




        $rows = 2;
        foreach ($employeeData as $key => $val){
            $sheet->setCellValue('A' . $rows, $key+1);
            $sheet->setCellValue('B' . $rows, $val['manv']);
            $sheet->setCellValue('C' . $rows, $val['fullname']);
            $sheet->setCellValue('D' . $rows, $val['team']);
	    $sheet->setCellValue('E' . $rows, $val['phone']);
            $sheet->setCellValue('F' . $rows, $val['model_phone']);
            $sheet->setCellValue('G' . $rows, $val['serial2']);

            $sheet->setCellValue('H' . $rows, $val['laptop']);

            $sheet->setCellValue('I' . $rows, $val['model_laptop']);
            $sheet->setCellValue('J' . $rows, $val['serial2']);
            $sheet->setCellValue('K' . $rows, $val['orther']);
            $sheet->setCellValue('L' . $rows, $val['serial3']);
            $sheet->setCellValue('M' . $rows, $val['images']);

            $sheet->setCellValue('N' . $rows, $val['status']);
            $sheet->setCellValue('O' . $rows, $val['user_post']);

            $rows++;
        } 
        $writer = new Xlsx($spreadsheet);
		$writer->save("uploads/".$fileName);
		header("Content-Type: application/vnd.ms-excel");
        redirect(base_url()."/uploads/".$fileName);              
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
   
    public function update_user()
    {
       if(isset($_POST['hidden_id']))
        {
            
            $fullname = $_POST['fullname'];
            $email = $_POST['email'];
            $username = $_POST['username'];            
            $password = $_POST['password'];
            $role = $_POST['role'];
            $status = $_POST['status'];
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
                        'status' => $status[$count],
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
                        'status' => $status[$count],
                        'id'   => $id[$count]
                    );
                    $this->Admin_model->import_data($data);
                    $this->session->set_flashdata('Success', 'Cập nhật thành công!!!');  
                }
            }
            redirect('approvelistuser'); 
        }
        else {
             $this->session->set_flashdata('Error', 'Không có danh sách được chọn!!!');
            redirect('approvelistuser'); 
            
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

    public function deleteAll()
    {
        $this->User_model->deleteAll();
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
        // $model_laptop = $_POST['model_laptop'];
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
        if(isset($_POST['model_phone'])){
            $model_phone = $_POST['model_phone'];
            
        } else {
            $model_phone = "";
        }
        if(isset($_POST['model_laptop'])){
            $model_laptop = $_POST['model_laptop'];
            
        } else {
            $model_laptop = "";
        }
        if(isset($_POST['manv'])){
            $manv = $_POST['manv'];
            
        } else {
            $manv = "";
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
        if($this->User_model->checkMaNV($manv)){
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
                redirect('userlist');

            }else {
                if($data['admin']->status == 0)
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
                    'status' => 1,
                    'images' => base_url().'uploads/'.$img,
                    'user_post' => $data['admin']->username,
                    );
                    $this->User_model->import_data($data);
                    $this->session->set_flashdata('Success','Thêm thành công');
                    redirect('userpost');
                } 
                else{
                    $this->session->set_flashdata('Error','Tài khoản bị khóa');
                    redirect('userpost');
                }
            }
        }else {
            $this->session->set_flashdata('Error','Lỗi trùng mã nhân viên');
            redirect('userlist');
        }
        redirect('approvelistuser');

    }

    public function adduser()
    {
        $img = "";
        $fullname = $_POST['fullname'];
        $email = $_POST['email'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $role = $_POST['role'];
        if($this->Admin_model->add_user($username)){

            $config['upload_path'] = './uploads/';
            $config['allowed_types'] = 'jpg|png|jpeg';
            $config['file_name'] = 'img' . time();
            $this->load->library('upload', $config);
            if ($this->upload->do_upload('img'))
            {
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
        }else {
            $this->session->set_flashdata('Error' ,'Tên tài khoản đã tồn tại');
        }
        
            redirect('approvelistuser');
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
            $laptop = $_POST['laptop'];           
            $phone = $_POST['phone'];
            $serial1 = $_POST['serial1'];
            $serial2 = $_POST['serial2'];
            $serial3 = $_POST['serial3'];
            $orther = $_POST['orther'];
            $serial1 = $_POST['serial1'];
            $images_old = $_POST['image_old'];
            $user_post = $_POST['user_post'];
            
            // $manv = $_POST['manv'];
            if(isset($_POST['model_phone'])){
                $model_phone = $_POST['model_phone'];
                
            } else {
                $model_phone = "";
            }
            if(isset($_POST['model_laptop'])){
                $model_laptop = $_POST['model_laptop'];
                
            } else {
                $model_laptop = "";
            }
            if(isset($_POST['manv'])){
                $manv = $_POST['manv'];
                
            } else {
                $manv = "";
            }
            // var_dump($user_post);
            // exit();
            $id = $_POST['hidden_id'];
            $data = [];
            $img=[];
            $data['admin'] = $this->Admin_model->get_row($this->session->userdata('id'));
            if($data['admin']->role == 0)
            { 
                $trangthai = '0';
            }
            else {
                $trangthai = '1';
            }
           
            for($count = 0; $count < count($id); $count++)
            {
                if($phone[$count] == 'No'){
                    $model_phone = "";
                    $serial1 = "";
                }
                if($laptop[$count] == 'No'){
                    $model_laptop = "";
                    $serial2 = "";
                }
                if($orther[$count] == ''){
                    
                    $serial3 = "";
                }
                $config['upload_path'] = './uploads/';
                $config['allowed_types'] = 'jpg|png|jpeg';
                $config['file_name'] = 'img' . time();
                $this->load->library('upload', $config);
                
           
                if($this->upload->do_upload("image"))
                {
                    
                    $file = $this->upload->data();
                    $data = array(
                        'fullname'   => $fullname[$count],
                        'manv' => $manv[$count],
                        'team'  => $team[$count],
                        'phone'  => $phone[$count],
                        'serial' => $serial1[$count],
                        'laptop'   => $laptop[$count],
                        'serial2' => $serial2[$count],
                        'orther' => $orther[$count],
                        'model_phone' =>$model_phone[$count],
                        'model_laptop' =>$model_laptop[$count],
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
                        'manv' => $manv[$count],
                        'team'  => $team[$count],
                        'phone'  => $phone[$count],
                        'serial' => $serial1[$count],
                        'laptop'   => $laptop[$count],
                        'serial2' => $serial2[$count],
                        'orther' => $orther[$count],
                        'model_phone' =>$model_phone[$count],
                        'model_laptop' =>$model_laptop[$count],
                        'serial3' => $serial3[$count],
                        'status' => $trangthai[$count],
                        'user_post' => $user_post[$count],
                        'status' => $trangthai[$count],
                        'images' => $images_old[$count],
                        'id'   => $id[$count]
                    );
                    
                    $this->User_model->import_data($data);
                    $this->session->set_flashdata('Success', 'Cập nhật thành công!!!');
                
                    
                }
            }
            redirect('userlist'); 
       
        }
        else {
             $this->session->set_flashdata('Error', 'Không có danh sách được chọn!!!');
            redirect('userpost'); 
            
        }
          
    }


    public function userpost()
    {
         if($this->session->userdata('login')){
            $data['title'] = 'User List';
            $data['user'] = $this->User_model->getDataBarang();
            // echo print_r($data['user']->status);
            // exit();
            $data['aprove'] = $this->User_model->getuser($this->session->userdata('username'));
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
            $data['aprove'] = $this->User_model->getuser($this->session->userdata('username'));
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