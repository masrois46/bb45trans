<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_auth extends CI_Model {
	
	private function check_register($email){
		$this->db->where('email', $email);
		$result = $this->db->get('user')->num_rows();
		if($result == 0){
			return true;
		}else{
			return false;
		}
	}
	
	function register($data = array()){
		if($this->check_register($data['email'])){
			$this->db->set($data);
			return $this->db->insert('user');
		}else{
			return false;
		}
	}
	
	function login($email){
		$this->db->where('email', $email);
		return $this->db->get('user')->row_array();
	}
	
	function update($email, $data = array()){
		$this->db->set($data);
		$this->db->where('email', $email);
		return $this->db->update('user');
	}

	function confirm($data = array()){
		$cek = $this->db->get_where('user', array('confirmation_code' => $data['confirmation_code']))->num_rows();
		if($cek > 0){
			$this->db->set($data);
			$this->db->where('confirmation_code', $data['confirmation_code']);
			$this->db->update('user');
			return true;
		}else{
			return false;
		}
		
	}

	function email_invoice($id){
		$this->db->select('invoice.*, bank_account.bank_name');
		$this->db->join('bank_account', 'invoice.payment_method=bank_account.id_bank');
		$this->db->where('invoice.id_invoice', $id);
		$result = $this->db->get('invoice')->row_array();
		return $result;
	}
	
	function forgot_password($data = array()){
		$this->db->set($data);
		$this->db->where('email', $data['email']);
		$this->db->update('user');
	}
}
?>