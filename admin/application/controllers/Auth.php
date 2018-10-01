<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller{

    function __construct(){
        parent::__construct();
        $this->load->library(array('password'));
        $this->load->model('m_auth');
    }

    function index(){
        if(empty($this->input->get('next'))){
            redirect('/auth?next=/');
        }
        $this->auth_admin->isLogged();
        $this->load->view('login');
    }

    function login_act(){
        if(file_get_contents('php://input')){
            $post = json_decode(file_get_contents('php://input'),true);
            $result = $this->m_auth->login($post['email']);
            if($this->password->verify_hash($post['password'], $result['password']) == true){
                $dataSession = array(
                    'email' => $post['email'],
                    'name' => $result['name']
                );
                $this->session->set_userdata('auth_admin', $dataSession);
                $status = array(
                    'status' => true
                );
            }else{
                $status = array(
                    'status' => false
                );
            }
            echo json_encode($status);
        }else{
            redirect('/');
        }
    }

    function logout(){
        $this->session->unset_userdata('auth_admin');
        redirect('/auth');
    }
}
?>