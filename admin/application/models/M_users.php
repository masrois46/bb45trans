<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_users extends CI_Model{

    var $table = 'user';
    var $select_column = array('email', 'first_name', 'phone_number', 'city', 'country','confirmed', 'last_access');
    var $order_column = array('email', null, null, null, null, null,'last_access',null);

    function __users_json(){
        $this->db->select($this->select_column);
        $this->db->from($this->table);
        if(isset($_POST['search']['value']))
        {
            $this->db->like('email', $_POST['search']['value']);
            $this->db->or_like('first_name', $_POST['search']['value']);
            $this->db->or_like('city', $_POST['search']['value']);
            $this->db->or_like('country', $_POST['search']['value']);
        }

        if(isset($_POST['order']))
        {
            $this->db->order_by($this->order_column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        }else{
            $this->db->order_by('create_at', 'DESC');
        }
    }

    function users_json(){
        $this->__users_json();
        if($_POST['length'] != -1)
        {
            $this->db->limit($_POST['length'], $_POST['start']);
        }
        $query = $this->db->get();
        return $query->result();
    }

    function get_filtered_data(){
        $this->__users_json();
        $query = $this->db->get();
        return $query->num_rows();
    }

    function get_all_data(){
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    function select($email){
        $this->db->where('email', $email);
        $result = $this->db->get('user');
        if($result->num_rows() >0 ){
            return $result->row_array();
        }else{
            return false;
        }
    }

    function update($data = array()){
        $this->db->set($data);
        $this->db->where('email', $data['email']);
        $this->db->update('user');
    }
}
?>