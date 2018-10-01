<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Users extends CI_Controller{

    function __construct(){
        parent::__construct();
        $this->auth_admin->check();
        $this->load->model('m_users');
    }

    function index(){
        $flashsession = array(
			'title' => 'Data Users',
			'js' => 'data_users.js'
        );
        $this->session->set_flashdata($flashsession);

        $this->template->load('template', 'data_user/home');
    }

    function user_json(){
        $fetch_data = $this->m_users->users_json();
        $data = array();

        foreach($fetch_data as $row)
        {
            if($row->confirmed == 0){
                $confirm = '<label class="label label-warning">Unconfirmed</label>';
                $button_confirm = '<li><a href="#">Verification</a></li>';
            }else{
                $confirm = '<label class="label label-success">Confirmed</label>';
                $button_confirm = '';
            }

            $sub_array = array();
            $sub_array[] = $row->email;
            $sub_array[] = $row->first_name;
            $sub_array[] = $row->phone_number;
            $sub_array[] = $row->city;
            $sub_array[] = $row->country;
            $sub_array[] = $confirm;
            $sub_array[] = date('H:i:s D, d M Y', $row->last_access);
            $sub_array[] = '<div class="dropdown">
            <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Options
            <span class="caret"></span></button>
            <ul class="dropdown-menu">
              <li><a href="/users/detail/'.urlencode($row->email).'" target="_blank">Detail</a></li>
              '.$button_confirm.'
            </ul>
          </div>';
            
            $data[] = $sub_array;
        }
        
        $output = array(
            'draw' => intval($_POST['draw']),
            'recordsTotal' => $this->m_users->get_all_data(),
            'recordsFiltered' => $this->m_users->get_filtered_data(),
            'data' => $data
        );

        echo json_encode($output);
    }

    function detail($email=''){
        $flashsession = array(
			'title' => 'Detail User '.urldecode($email),
			'js' => 'data_users.js'
        );
        $this->session->set_flashdata($flashsession);

        $server = explode('.', $_SERVER['HTTP_HOST']);
        
        $result = array(
            'result' => $this->m_users->select(urldecode($email)),
            'server' => 'http://'.$server[1]
        );

        $this->template->load('template', 'data_user/detail', $result);
    }

    function change_password(){
        $post = $this->input->post();
        if($post){
            $this->load->library('password');
            $dataArray = array(
                'email' => $post['email'],
                'password' => $this->password->hash($post['newpswd'])
            );
            $this->m_users->update($dataArray);
            echo json_encode(array('status' => 'success'));
        }else{
            show_404();
        }
    }
}
?>