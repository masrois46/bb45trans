<?php defined('BASEPATH') OR exit('No direct script access allowed');

class M_auth extends CI_Model{

    function login($email){
        return $this->db->get_where('admin', array('email' => $email))->row_array();
    }
}
?>