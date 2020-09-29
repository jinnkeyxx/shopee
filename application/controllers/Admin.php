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
        $data['title'] = 'Login to Checkin';
        $data['user'] = $this->Admin_model->getDataBarang();
        $check =  count($data['user']);
        if ($check === 0) {
            redirect('install');
        } else {
            redirect('login');
        }
    }


    public function login()
    {
        $data['user'] = $this->Admin_model->getDataBarang();

        $check =  count($data['user']);

        if ($check > 0) {
            if ($this->session->userdata('login')) {
                redirect('dashboard');
            } else {
                $data['title'] = "Login to Checkin";
                $this->load->view('template/meta', $data);
                $this->load->view('login');
                $this->load->view('template/footer');
            }
        } else {
            redirect('install');
        }
    }


    public function install()
    {
        $data['user'] = $this->Admin_model->getDataBarang();

        $check =  count($data['user']);

        if ($check <= 0) {

            $data['title'] = "Install";
            $this->load->view('template/meta', $data);
            $this->load->view('install');
            $this->load->view('template/footer');
        } else {
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
            'image' => base_url() . 'assets\images\users\profile2.png',
        ];
        $save = $this->Admin_model->import_data($datanew);

        echo json_encode(array('status' => true, 'messages' => 'Cài đặt thành công !!!'));
    }


    public function api()
    {

        $username = $_POST['username'];
        $password = $_POST['password'];
        $reps = $this->Admin_model->login($username, $password);
        if ($reps) {
            $data = [
                'id' => $reps->id,
                'username' => $reps->username,
                'login' => TRUE,
                'fullname' => $reps->fullname,
                'role' => $reps->role,
                'status' => $reps->status,
            ];
            if ($reps->status == 0) {
                $this->session->set_userdata($data);
                echo json_encode(array('status' => true, 'messages' => 'Đăng nhập thành công'));
            } else {
                echo json_encode(array('status' => false, 'messages' => 'Tài khoản của bạn đã bị khóa'));
            }
        } else {
            echo json_encode(array('status' => false, 'messages' => 'Đăng nhập không thành công'));
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

        if ($this->session->userdata('login')) {
            if ($this->session->userdata('role') == 0) {
                $data['aprove'] = $this->User_model->getuser($this->session->userdata('id'));
                $data['aproveAll'] = $this->User_model->getusers();
                $data['title'] = "Login User";
                $data['admin'] = $this->Admin_model->get_row($this->session->userdata('id'));

                $data['user'] = $this->Admin_model->getDataBarang();
                $this->load->view('template/meta', $data);
                $this->load->view('template/header', $data);

                $this->load->view('userlogin', $data);
                $this->load->view('template/footer');
            } else {
                redirect('dashboard');
            }
        } else {
            redirect('login');
        }
    }
    public function dashboard()
    {
        if ($this->session->userdata('login')) {
            $data['title'] = 'User List';
            $data['user'] = $this->User_model->getDataBarang();

            $data['aprove'] = $this->User_model->getuser($this->session->userdata('username'));
            $data['aproveAll'] = $this->User_model->getusers();
            $data['admin'] = $this->Admin_model->get_row($this->session->userdata('id'));
            $data['admin']->id;

            $this->load->view('template/meta', $data);
            $this->load->view('template/header', $data);
            $this->load->view('dashboard', $data);
            $this->load->view('template/footer', $data);
        } else {
            redirect('login');
        }
    }
}