<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_cart extends CI_Model{

	function find_item($id){
		$this->db->where('id_tour', $id);
		return $this->db->get('tour')->row_array();
	}
	
	function show_service(){
		$this->db->order_by('id_services', 'ASC');
		return $this->db->get('tour_services')->result();
	}
	
	function count_invoice(){
		return $this->db->get('invoice')->num_rows();
	}
	
	function all_bank(){
		$this->db->order_by('id_bank', 'ASC');
		return $this->db->get('bank_account')->result();
	}
	
	function select_bank($bank){
		$this->db->where('id_bank', $bank);
		return $this->db->get('bank_account')->row_array();
	}
	
	function create_invoice($data = array()){
		$this->db->set($data);
		return $this->db->insert('invoice');
	}
	
	function create_invoice_services($data = array()){
		$this->db->set($data);
		$this->db->insert('invoice_services');
	}
	
	function create_invoice_tour($data = array()){
		$this->db->set($data);
		$this->db->insert('invoice_tour');
	}
	
	function get_last_invoice(){
		$this->db->order_by('id_invoice', 'DESC');
		$this->db->limit(1);
		return $this->db->get('invoice')->row_array();
	}

	//Booking Finish
	function detail_invoice($id){
		$this->db->select('invoice.*, bank_account.bank_name');
		$this->db->join('bank_account', 'invoice.payment_method=bank_account.id_bank', 'left');
		$this->db->where('invoice.id_invoice', $id);
		return $this->db->get('invoice')->row_array();
	}

	function detail_tour($id){
		$this->db->where('id_invoice', $id);
		return $this->db->get('invoice_tour')->result();
	}

	function detail_services($id){
		$this->db->where('id_invoice', $id);
		return $this->db->get('invoice_services')->result();
	}

	function update($data = array()){
		$this->db->set($data);
		$this->db->where('id_invoice', $data['id_invoice']);
		$this->db->update('invoice');
	}
}
?>