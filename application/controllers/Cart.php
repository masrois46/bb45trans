<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cart extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('m_cart');
		$this->load->library(array('password'));
	}
	
	function index(){
		$totalCart = count($this->cart->contents());
		if($this->cart->total() >0){
			$this->session->set_flashdata('title', $totalCart.' Your Cart');
		}else{
			$this->session->set_flashdata('title', 'Empty Cart');
		}
		$data = array(
			'filter_services' => $this->session->userdata('services'),
			'services' => $this->m_cart->show_service(),
			'phone_number' => $this->loadfirst->get_where_array('footer-number'),
			'wa_number' => $this->loadfirst->get_where_array('phone-number'),
			'csrfname' => $this->security->get_csrf_token_name(),
        	'csrfhash' => $this->security->get_csrf_hash()
		);
		$this->template->load('template', 'cart/home', $data);
	}
	
	function item(){
		$data = array();
		$index = 1;
		foreach($this->cart->contents() as $row){
			$data['item'][] = array(
				'index' => $index,
				'rowid' => $row['rowid'],
				'id' => $row['id'],
				'img' => $this->m_cart->find_item($row['id'])['image_thumbnail'],
				'qty' => $row['qty'],
				'price' => $row['price'],
				'name' => $row['name'],
				'subtotal' => $row['subtotal']
			);
			$index++;
		}
		$data['total'] = $this->cart->total();
		echo json_encode($data);
	}
	
	function cart_modify(){
		if($this->input->post()){
			$data_post = $this->input->post();
			if($data_post['type'] == 'qty'){
				foreach($this->cart->contents() as $k => $v){
					$data = array(
						'rowid' => $k,
						'qty' => $data_post['qty']
					);
				$this->cart->update($data);
				}
				$this->session->set_userdata('qtyPerson', $data_post['qty']);
			}else if($data_post['type'] == 'delete_item'){
				$this->cart->remove($data_post['rowid']);
			}else{
				show_404();
			}
			$data = array(
        		'csrfhash' => $this->security->get_csrf_hash()
			);
			echo json_encode($data);
		}else{
			show_404();
		}
	}
	
	function option_services(){
		if($this->input->post()){
			$post = $this->input->post();
			if($post['type'] == 'add'){
				$dataPostArray[MD5($post['id'])] = array(
					'id' => $post['id'],
					'qty' => 1,
					'name' => $post['name'],
					'price' => $post['price']
				);
				$session = $this->session->userdata('services');
				if(empty($session)){
					$dataArray = $dataPostArray;
				}else{
					$dataArray = array_merge($session, $dataPostArray);
				}	
				$this->session->set_userdata('services', $dataArray);			
			}else if($post['type'] == 'remove'){
				$session = $this->session->userdata('services');
				foreach($session as $k => $v){
					if(MD5($post['id']) == $k){
						unset($session[$k]);
					}
				}
				$this->session->set_userdata('services', $session);
			}
			$data = array(
        		'csrfhash' => $this->security->get_csrf_hash()
			);
			echo json_encode($data);
		}else{
			show_404();
		}
	}
	
	private function calc_cost(){
		$data_tour = array();
		$session = $this->session->userdata('services');
		foreach($this->cart->contents() as $dtour){
			if($dtour['type'] == 'tour'){
				$data_tour[] = array(
					'id_tour' => $dtour['id'],
					'qty' => $dtour['qty'],
					'price' => $dtour['price'],
					'name' => $dtour['name'],
					'subtotal' => $dtour['subtotal']
				);
			}
		}
		
		$data_services = array();
		$cost_services = 0;
		if(!empty($session)){
			foreach($session as $dserv){
				$data_services[] = array(
					'name' => $dserv['name'],
					'price' => $dserv['price']
				);
				$cost_services += $dserv['price'];
			}
		}
		
		$data_cost = array(
			'tour' => $data_tour,
			'services' => $data_services,
			'cost_tour' => $this->cart->total(),
			'cost_services' => $cost_services,
			'total_cost' => $this->cart->total()+$cost_services
		);
		$this->session->set_userdata('data_cost', $data_cost);
	}
	
	function summary(){
		$this->calc_cost();
		$session = $this->session->userdata('services');
		if(!empty($session)){
			$total_cost_service = 0;
			foreach($session as $row){
				$total_cost_service += $row['price'];
			}
		}else{
			$total_cost_service = 0;
		}
		$each_tour = '';
		$qty = $this->cart->total_items();
		$ctr = $this->session->userdata('qtyPerson');
		foreach($this->cart->contents() as $row){
			if($row['type'] == 'tour'){

				$each_tour .= '
					<tr>
						<td>'.$row['name'].'</td>
						<td class="text-right">'.$row['qty'].'x $'.$row['price'].'</td>
					</tr>
				';
			}
		}
		$html = '
			<tr>
				<th>Person</th>
				<td><input type="number" id="qQty" min="1" onkeyup="qqty()" onchange="qqty()" value="'.$ctr.'" class="form-control"></td>
			</tr>
			<tr>
				<th colspan="2">Tours List</th>
			</tr>
			'.$each_tour.'
		';
		$total_cost_tour = '
			<tr>
				<th>
					Total Cost Tours
				</th>
				<th class="text-right">
					$'.number_format($this->cart->total()).'
				</th>
			</tr>
			<tr>
				<th colspan="2">Additional Services</th>
			</tr>
		';
		
		$additional_services = '';
		if(!empty($session)){
			foreach($session as $row){
				$additional_services .= '
					<tr>
						<td>'.$row['name'].'</td>
						<td class="text-right">$'.$row['price'].'</td>
					</tr>
				';
			}
		}
		
		$total_cost_services = '
			<tr>
				<th>Total Cost Services</th>
				<th class="text-right">$'.number_format($total_cost_service).'</th>
			</tr>
		';
		
		
		$cost = $this->cart->total() + $total_cost_service;
		$total_cost = '
			<tr class="total">
				<td>
					Total cost
				</td>
				<td class="text-right">
					$'.number_format($cost).'
				</td>
			</tr>
		';
		
		$html .= $total_cost_tour;
		$html .= $additional_services;
		$html .= $total_cost_services;
		$html .= $total_cost;
		echo $html;
	}
	
	function bank_account($bank){
		header("Content-Type: Application/json");
		$bank_data = $this->m_cart->select_bank(urldecode($bank));
		echo json_encode($bank_data);
	}
	
	function checkout(){
	
		if($this->cart->total() >0){
			$this->session->set_flashdata('title', 'Checkout');
		}else{
			$this->session->set_flashdata('title', 'Empty Cart');
		}
		
		$data = array(
			'phone_number' => $this->loadfirst->get_where_array('footer-number'),
			'wa_number' => $this->loadfirst->get_where_array('phone-number'),
			'csrfname' => $this->security->get_csrf_token_name(),
        	'csrfhash' => $this->security->get_csrf_hash(),
			'all_bank' => $this->m_cart->all_bank(),
			'captcha' => $this->password->captcha()
		);
		$this->template->load('template', 'cart/checkout', $data);
	}
	
	function ca_checkout(){
		if($this->input->post()){
			header("Content-Type: Application/json");
			echo $this->_finish($this->input->post());
		}else{
			redirect('/cart');
		}
	}
	
	function _finish($data){
		$cart = $this->session->userdata('data_cost');
		$date = explode(',', $data['date_tour']);
		$date_tour = strtotime($date[1]);
		$invoice = array(
			'id_invoice' => date('dmy').$this->m_cart->count_invoice(),
			'user_email' => $this->session->userdata('auth_client')['email'],
			'order_date' => time(),
			'payment_method' => $data['payment_method'],
			'date_tour' => $date_tour
		);
		$result = $this->m_cart->create_invoice($invoice);
		
		$id_invoice = $this->m_cart->get_last_invoice()['id_invoice'];
		
		foreach($cart['services'] as $row){
			$invoice_services = array(
				'id_invoice' => $id_invoice,
				'name' => $row['name'],
				'price' => $row['price']
			);
			$this->m_cart->create_invoice_services($invoice_services);
		}
		
		foreach($cart['tour'] as $row){
			$invoice_tour = array(
				'id_invoice' => $id_invoice,
				'id_tour' => $row['id_tour'],
				'qty' => $row['qty'],
				'price' => $row['price'],
				'name' => $row['name'],
				'subtotal' => $row['subtotal']
			);
			$this->m_cart->create_invoice_tour($invoice_tour);
		}
		
		if($result){
			$status = $result;
			$this->session->unset_userdata('data_cost');
			$this->session->unset_userdata('services');
			$this->session->unset_userdata('qtyPerson');
			$this->cart->destroy();
		}else{
			$status = 'false';
		}
		
		$dataResponse = array(
			'status' => $status,
			'inv' => $id_invoice,
			'hash_tour' => $this->password->hash($id_invoice),
			'csrfname' => $this->security->get_csrf_token_name(),
        	'csrfhash' => $this->security->get_csrf_hash()
		);
		return json_encode($dataResponse);
	}
	
	function finish(){
		$this->session->set_flashdata('title', 'Booking Tour Finish');
		$id_invoice = $this->input->get('inv');
		$c = $this->input->get('c');
		if($this->password->verify_hash($id_invoice, $c) == true){
			$dataArray = array(
				'detailinvoice' => $this->m_cart->detail_invoice($id_invoice),
				'detailtour' => $this->m_cart->detail_tour($id_invoice),
				'detailservices' => $this->m_cart->detail_tour($id_invoice),
				'phone_number' => $this->loadfirst->get_where_array('footer-number'),
				'wa_number' => $this->loadfirst->get_where_array('phone-number'),
			);
			$this->template->load('template', 'cart/finish', $dataArray);
		}else{
			$this->output->set_header('HTTP/1.0 403 Forbidden');
			$this->output->set_header('HTTP/1.1 403 Forbidden');
		}
	}
	
}
?>