<?php
defined('BASEPATH') or exit('No direct script access allowed');
require_once APPPATH . 'third_party/Spout/Autoloader/autoload.php';

use Box\Spout\Reader\Common\Creator\ReaderEntityFactory;

class Admin extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Admin_model');
        $this->load->model('User_model');
    }



    public function index()
    {
        
        $data['title'] = 'Export Import';
        $data['user'] = $this->Admin_model->getDataBarang();
        $check =  count($data['user']);
        if($check === 0){
            redirect('install');
        }
        else {
            redirect('login');
        }
      
    }
    public function login()
    {
        $data['user'] = $this->Admin_model->getDataBarang();
        
        $check =  count($data['user']);
        
        if($check > 0)
        {
            if($this->session->userdata('login')){
                redirect('userlist'); 
            }
            else {
                $data['title'] = "login";
                $this->load->view('template/meta', $data);
                $this->load->view('login');
                $this->load->view('template/footer'); 
            }
           
        } 
        else
        {
            redirect('install');
        }
        
    }
    public function install()
    {
        // $data['admin'] = $this->session->userdata('fullname');
        $data['user'] = $this->Admin_model->getDataBarang();
        
        $check =  count($data['user']);
        
        if($check <= 0){
            
            $data['title'] = "Install";
            $this->load->view('template/meta', $data);
            $this->load->view('install');
            $this->load->view('template/footer');
        }
        else {
            redirect('login');
        }
    }
    public function setup()
    {
        
        $fullname = $_POST['fullname'];
        $email = $_POST['email'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        
        $path = './uploads/';
        $this->load->library('upload');
        $datanew = [
                    
            'fullname' => $fullname,
            'username' => $username,
            'password' => $password,
            'email' => $email,
            'role' => 0,
            'image' => base_url().'assets\images\users\profile2.png',
        ];
            $save = $this->Admin_model->import_data($datanew);

                
        echo json_encode(array('status' => true , 'messages' => 'cài đặt thành công'));
            
    }
    public function api()
    {
         
        $username = $_POST['username'];
        $password = $_POST['password'];
        $reps = $this->Admin_model->login($username , $password);
        if($reps){
            $data = [
                'id' => $reps->id,
                'username' => $reps->username,
                'login' => TRUE,
                'fullname' => $reps->fullname,
                'role' => $reps->role,
            ];
            $this->session->set_userdata($data);
            echo json_encode(array('status' => true , 'messages' => 'Đăng nhập thành công'));
        }else {
            echo json_encode(array('status' => false , 'messages' => 'Đăng nhập không thành công'));
            
        }
        
    }
    public function logout() 
    {
        $this->session->unset_userdata('login');
        $this->session->sess_destroy();
        redirect('login');
    }
    public function userlogin()
    {
        
        if($this->session->userdata('login'))
        {
            if($this->session->userdata('role') == 0){
                 $data['aprove'] = $this->User_model->getuser();
                $data['title'] = "User login";
                $data['admin'] = $this->Admin_model->get_row($this->session->userdata('id'));
                // var_dump($data['admin']->fullname);
                // exit();
                $data['user'] = $this->Admin_model->getDataBarang();
                $this->load->view('template/meta' , $data);
                $this->load->view('template/header' , $data);
                
                $this->load->view('userlogin', $data);
                $this->load->view('template/footer');
            }
            else {
                redirect('userlist');
            }
            
        }
        else 
        {
            redirect('login');

        }
    }
    
}