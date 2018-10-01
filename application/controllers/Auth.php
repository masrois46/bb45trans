<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->model('m_auth');
		$this->load->library(array('password', 'user_agent', 'encryption','sendmail','auth_member'));
		$this->load->helper('captcha');
	}
	
	function index(){
		$this->auth_member->isLogged();
		if($this->input->get('type') == 'register'){
			$this->session->set_flashdata('title', 'Register Your Account');
			$template = 'auth/register';
		}else if($this->input->get('type') == 'login'){
			$this->session->set_flashdata('title', 'Login Your Account');
			$template = 'auth/login';
		}else{
			$this->session->set_flashdata('title', 'Login Your Account');
			$template = 'auth/login';
		}
		$data = array(
			'csrfname' => $this->security->get_csrf_token_name(),
			'csrfhash' => $this->security->get_csrf_hash(),
			'captcha' => $this->password->captcha()
		);
		
		$this->template->load('template', $template, $data);
	}

	function forgot_check_email(){
		$e = $this->input->get('e');
		$result = $this->db->get_where('user', array('email' => $e))->num_rows();
		if($result > 0){
			echo 200;
		}else{
			echo 404;
		}
	}

	function forgot(){
		if($this->input->post()){
			$post = $this->input->post();
			if($this->password->verify_captcha($post['captcha']) == true){
				$newpswd = rand(100000, 999999);

				$datatemplate = array(
					'email' => $post['email'],
					'password' => $newpswd,
				);
				$html = $this->load->view('email/forgot', $datatemplate, TRUE);

				$dataSql = array(
					'email' => $post['email'],
					'password' => $this->password->hash($datatemplate['password'])
				);
				$this->m_auth->forgot_password($dataSql);

				$dataEmail = array(
					'email' => $post['email'],
					'name' => 'Reset Password',
					'subject' => 'Reset Password BB 45Trans',
					'html' => $html
				);
				$result = $this->sendmail->send($dataEmail);
				if($result == 202){
					$status = 200;
				}else{
					$status = 401;
				}
			}else{
				$status = 'captcha';
			}
			$Response = array(
				'status' => $status,
				'csrfhash' => $this->security->get_csrf_hash()
			);
			echo json_encode($Response);
		}else{
			$this->session->set_flashdata('title', 'Forgot Password');
			$data = array(
				'csrfname' => $this->security->get_csrf_token_name(),
				'csrfhash' => $this->security->get_csrf_hash(),
				'captcha' => $this->password->captcha()
			);
			
			$this->template->load('template', 'auth/forgot', $data);
		}
	}

	function auth(){
		$hash = $this->input->get('hash');
		$dataArray = array(
			'csrfhash' => $this->security->get_csrf_hash()
		);
		$dataEmail = json_decode($this->encryption->decrypt($hash), TRUE);
		$html = $this->load->view($dataEmail['template'], $dataEmail, TRUE);
		$arrayEmail = array(
			'name' => $dataEmail['name'],
			'email' => $dataEmail['email'],
			'html' => $html
		);
		if($dataEmail['action'] == 'send_confirmation'){
			$this->sendmail->send_confirmation($arrayEmail);
		}
	}

	function register(){
		$post = $this->input->post();
		if($post){
			if($this->password->verify_captcha($post['captcha']) == true){
				$data = array(
					'email' => $post['email'],
					'password' => $this->password->hash($post['password']),
					'picture' => '',
					'first_name' => $post['first_name'],
					'last_name' => $post['last_name'],
					'phone_number' => $post['phone_number'],
					'date_of_birth' => '',
					'street_address' => '',
					'city' => '',
					'zip_code' => '',
					'country' => '',
					'confirmation_code' => $this->password->hash($post['email'].$post['password']),
					'confirmed' => 0,
					'create_at' => time(),
					'update_at' => 0,
					'last_access' => time()
				);
				
				$result = $this->m_auth->register($data);
				if($result){
					$data_session = array(
						'email' => $data['email'],
						'picture' => $data['picture'],
						'first_name' => $data['first_name'],
						'last_name' => $result['last_name'],
						'last_access' => $data['last_access']
					);
					$this->session->set_userdata('auth_client', $data_session);
					
					$dataEmail = array(
						'email' => $data['email'],
						'name' => $data['first_name'],
						'action' => 'send_confirmation',
						'template' => 'email/register_confirm',
						'html' => array(
									'link' => base_url('auth/confirm?code='.$data['confirmation_code'])
								)
					);
					$dataEncrypt = json_encode($dataEmail);
					$hash = $this->encryption->encrypt($dataEncrypt);
					$status = true;
				}else{
					$status = false;
					$hash = '';
				}
			}else{
				$status = 'captcha';
				$hash = '';
			}
			$dataResponse = array(
				'status' => $status,
				'hash' => $hash,
				'csrfname' => $this->security->get_csrf_token_name(),
				'csrfhash' => $this->security->get_csrf_hash()
			);
			echo json_encode($dataResponse);
		}else{
			redirect('/auth');
		}
	}

	function login(){
		$post = $this->input->post();
		if($post){
			$result = $this->m_auth->login($post['email']);
			if($this->password->verify_hash($post['password'], $result['password']) == 1){
				
				$data_session = array(
					'email' => $result['email'],
					'picture' => $result['picture'],
					'first_name' => $result['first_name'],
					'last_name' => $result['last_name'],
					'last_access' => time()
				);
				$this->session->set_userdata('auth_client', $data_session);
				
				$data_update = array(
					'last_access' => time()
				);
				$this->m_auth->update($result['email'], $data_update);
				
				$status = true;
			}else{
				$status = false;
			}
			$dataResponse = array(
				'status' => $status,
				'csrfname' => $this->security->get_csrf_token_name(),
				'csrfhash' => $this->security->get_csrf_hash()
			);
			echo json_encode($dataResponse);
		}else{
			redirect('/auth');
		}
	}

	function confirm(){
		$hash = $this->input->get('code');
		$dataArray = array(
			'confirmation_code' => $hash,
			'confirmed' => 1
		);
		if($this->m_auth->confirm($dataArray)){
			$this->session->set_flashdata('title', 'Confirmation Complated');
			$arrayHtml = array(
				'status' => true,
				'notif' => '<strong>Success</strong>, Confirmation email complated'
			);
		}else{
			$this->session->set_flashdata('title', 'Confirmation Failed');
			$arrayHtml = array(
				'status' => false,
				'notif' => '<strong>Failed</strong>, Please resend your confirmation email <a href="/auth/resend">Click Here</a>'
			);
		}
		$this->template->load('template', 'auth/confirm', $arrayHtml);
	}
	
	function resend(){
		$this->session->set_flashdata('title', 'Resend Confirmation Code');
		$data = array(
			'csrfname' => $this->security->get_csrf_token_name(),
			'csrfhash' => $this->security->get_csrf_hash(),
			'captcha' => $this->password->captcha()
		);
		$this->template->load('template', '/auth/resend', $data);
	}

	function resendaction(){
		$post = $this->input->post();
		if($post){
			if($this->password->verify_captcha($post['captcha']) == true){
				$dataSql = $this->m_auth->login($post['email']);
				if($dataSql){
					$dataResend = array(
						'email' => $post['email'],
						'confirmation_code' => $this->password->hash($post['email'])
					);
	
					$this->m_auth->update($post['email'], $dataResend);
	
					$dataEmail = array(
						'email' => $dataSql['email'],
						'name' => $dataSql['first_name'],
						'action' => 'send_confirmation',
						'template' => 'email/register_confirm',
						'html' => array(
									'link' => base_url('auth/confirm?code='.$dataResend['confirmation_code'])
								)
					);
					$dataEncrypt = json_encode($dataEmail);
					$hash = $this->encryption->encrypt($dataEncrypt);
					$this->password->captcha();
					$status = true;
				}else{
					$status = 'email';
					$hash = '';
				}
				
			}else{
				$status = false;
				$hash = '';
			}

			$dataArray = array(
				'status' => $status,
				'hash' => $hash,
				'csrfhash' => $this->security->get_csrf_hash()
			);

			echo json_encode($dataArray);
		}else{
			$this->resend();
		}
	}

	function logout(){
		$ref = $this->agent->referrer();
		$this->session->unset_userdata('auth_client');
		if(!empty($ref)){
			redirect($ref);
		}else{
			redirect('/auth');
		}
	}
	
}
?>