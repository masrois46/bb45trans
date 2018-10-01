<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth_admin{

    function __construct(){
        $this->ci =& get_instance();
    }

    public function check(){
        $cek = $this->ci->session->userdata('auth_admin');
        if(empty($cek)){
            $request = $_SERVER['REQUEST_URI'];
            redirect('/auth?next='.$request);
            exit();
        }
    }

    public function isLogged(){
        $cek = $this->ci->session->userdata('auth_admin');
        if(!empty($cek)){
            $next = $this->ci->input->get('next');
            redirect($next);
            exit();
        }
    }
}
?>