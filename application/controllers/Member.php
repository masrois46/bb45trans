<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Member extends CI_Controller {

    public $ses;

	function __construct(){
		parent::__construct();
        $this->load->model('m_member');
        $this->load->library('auth_member');
        $this->auth_member->check();
        $this->ses = $this->session->userdata('auth_client');
    }

    function index(){
        $this->session->set_flashdata('title', 'Dashboard');
        $data = array(
            'data_session' => $this->session->userdata('auth_client'),
            'profile' => $this->m_member->profile(),
            'csrfname' => $this->security->get_csrf_token_name(),
			'csrfhash' => $this->security->get_csrf_hash(),
        );
        $this->template->load('template', 'member/index', $data);
    }

    function page_invoice(){
        header('Content-Type: application/json');
        $this->load->library("pagination");
        $config = array();
        $config["base_url"] = "#";
        $config["total_rows"] = $this->db->get_where('invoice', array('user_email' => $this->ses['email']))->num_rows();
        $config["per_page"] = 5;
        $config["uri_segment"] = 3;
        $config["use_page_numbers"] = TRUE;
        $config["full_tag_open"] = '<ul class="pagination">';
        $config["full_tag_close"] = '</ul>';
        $config["first_tag_open"] = '<li>';
        $config["first_tag_close"] = '</li>';
        $config["last_tag_open"] = '<li>';
        $config["last_tag_close"] = '</li>';
        $config['next_link'] = '&gt;';
        $config["next_tag_open"] = '<li>';
        $config["next_tag_close"] = '</li>';
        $config["prev_link"] = "&lt;";
        $config["prev_tag_open"] = "<li>";
        $config["prev_tag_close"] = "</li>";
        $config["cur_tag_open"] = "<li class='active'><a href='#'>";
        $config["cur_tag_close"] = "</a></li>";
        $config["num_tag_open"] = "<li>";
        $config["num_tag_close"] = "</li>";
        $config["num_links"] = 1;
        $this->pagination->initialize($config);
        $page = $this->uri->segment(3);
        $start = ($page - 1) * $config["per_page"];
        $data = array('data' => $this->m_member->get_invoice($config["per_page"], $start)->result());
        $page_source = $this->load->view('member/page_invoice', $data, TRUE);
        $output = array(
            'page_number'  => $this->pagination->create_links(),
            'list_invoice'   => $page_source
        );
        echo json_encode($output);
    }

    function cancel_tour($id){
        $this->db->set(array('status_invoice' => 2));
        $this->db->where('id_invoice', $id);
        $this->db->update('invoice');
        redirect('/member#list_invoice');
    }

    function get_invoice_confirm($id=''){
        $result = $this->m_member->get_invoice_confirm($id);
        echo json_encode($result);
    }

    function save_confirm_payment(){
        $post = $this->input->post();
        if($post){
            $config['upload_path']  = './assets/buktiTransfer/';
            $config['allowed_types']    = 'gif|jpg|png';
            $config['file_ext_tolower'] = TRUE;
            $config['encrypt_name'] = TRUE;
            $config['max_size'] = 0;
            
            $this->load->library('upload', $config);
            if(!$this->upload->do_upload('userfile')){
                $response = array('status' => false, 'message' => '<strong>Danger!</strong> '.strip_tags($this->upload->display_errors()), 'csrfhash' => $this->security->get_csrf_hash());
            }else{
                $this->_delete_last_confirm($post['id_invoice']);
                $response = array('status' => true, 'message' => '<strong>Success</strong> Upload Successfully!', 'csrfhash' => $this->security->get_csrf_hash());
                $dataSql = array(
                    'email' => $this->ses['email'],
                    'id_invoice' => $post['id_invoice'],
                    'date_transfer' => strtotime($post['date_transfer']),
                    'image' => '/assets/buktiTransfer/'.$this->upload->data()['file_name'],
                    'status' => 0
                );
                $this->m_member->insert_confirm_transfer($dataSql);
            }

            echo json_encode($response);
        }else{
            show_404();
        }
    }

    function _delete_last_confirm($id_invoice){
        $cek = $this->db->get_where('confirm_transfer', array('id_invoice' => $id_invoice));
        if($cek->num_rows() > 0){
            $this->db->where('id_invoice', $id_invoice);
            $this->db->delete('confirm_transfer');
            $file = $cek->row_array();
            unlink('.'.$file['image']);
        }
    }

    function change_password(){
        $post = $this->input->post();
        if($post){
            $this->load->model('m_auth');
            $this->load->library('password');
            $result = $this->m_auth->login($this->ses['email']);
            if($this->password->verify_hash($post['old_pswd'], $result['password']) == 1){
                $dataArray = array(
                    'email' => $this->ses['email'],
                    'password' => $this->password->hash($post['new_pswd']),
                    'update_at' => time()
                );
                $this->m_member->change_password($dataArray);
                $response = array(
                    'status' => true,
                    'message' => '<strong>Success</strong> Change password Successfully!',
                    'csrfhash' => $this->security->get_csrf_hash()
                );
            }else{
                $response = array(
                    'status' => false,
                    'message' => '<strong>Danger!</strong> Change password failed!',
                    'csrfhash' => $this->security->get_csrf_hash()
                );
            }
            echo json_encode($response);
        }else{
            show_404();
        }
    }

    function save_profile(){
        $post = $this->input->post();
        if($post){
           $dataArray = array(
                'email' => $this->ses['email'],
                'first_name' => $post['first_name'],
                'last_name' => $post['last_name'],
                'phone_number' => $post['phone_number'],
                'date_of_birth' => $post['date_of_birth'],
                'street_address' => $post['street_address'],
                'city' => $post['city'],
                'zip_code' => $post['zip_code'],
                'country' => $post['country'],
                'update_at' => time()
            );
            $this->m_member->save_profile($dataArray);
            echo json_encode(array('status' => true, 'message' => '<strong>Success</strong> Update Profile Succesfully!', 'csrfhash' => $this->security->get_csrf_hash()));
        }else{
            show_404();
        }
    }

    function _delete_photo(){
        $cek = $this->db->get_where('user', array('email' => $this->ses['email']))->row_array();
        if($cek['picture'] != '' && $cek['picture'] != '/assets/profile/default-avatar.png'){
            unlink('.'.$cek['picture']);
        }
    }

    function change_photo(){
        $config['upload_path']  = './assets/profile/';
        $config['allowed_types']    = 'gif|jpg|png';
        $config['file_ext_tolower'] = TRUE;
        $config['encrypt_name'] = TRUE;
        $config['max_size'] = 0;
            
        $this->load->library('upload', $config);
        if(!$this->upload->do_upload('userfile')){
            $image = '/assets/profile/default-avatar.png';
        }else{
            $this->_delete_photo();
            $image = '/assets/profile/'.$this->upload->data()['file_name'];
        }

        $dataArray = array(
            'email' => $this->ses['email'],
            'picture' => $image,
        );
        $this->m_member->save_profile($dataArray);
        echo json_encode(array('status' => true, 'message' => '<strong>Success</strong> Upload Photo Profile Succesfully!', 'link_image' => $image, 'csrfhash' => $this->security->get_csrf_hash()));
    }
}
?>