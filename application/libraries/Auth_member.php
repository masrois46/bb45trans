<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth_member{

    function __construct(){
        $this->ci =& get_instance();
    }

    public function check(){
        $cek = $this->ci->session->userdata('auth_client');
        if(empty($cek)){
            redirect('/auth');
            exit();
        }
    }

    public function isLogged(){
        $cek = $this->ci->session->userdata('auth_client');
        if(!empty($cek)){
            redirect('/member');
            exit();
        }
    }
}
?>