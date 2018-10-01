<?php 

class Email Extends CI_Controller{

	function __construct(){
		parent::__construct();
		$this->load->library('sendmail');
	}
	
	function index(){
		header("HTTP/1.1 401 Unauthorized");
	}

	function invoice($id){
		$cek = $this->db->get_where('invoice', array('id_invoice' => $id))->row_array();
		if($cek['email_confirm']){
			$Response = array(
				'status' => 'done'
			);
		}else{
			$this->load->model(array('m_auth','m_cart'));

			$data = array(
				'dataInvoice' => $this->m_auth->email_invoice($id),
				'dataInvoiceTour' => $this->db->get_where('invoice_tour', array('id_invoice' => $id))->result()
			);
			$html = $this->load->view('email/booking_finish', $data, TRUE);

			$dataEmail = array(
				'email' => $data['dataInvoice']['user_email'],
				'id_invoice' => $id,
				'html' => $html
			);
			$this->sendmail->send_invoice($dataEmail);

			$dataUpdate = array(
				'id_invoice' => $id,
				'email_confirm' => 1
			);
			$this->m_cart->update($dataUpdate);

			$Response = array(
				'status' => 'completed'
			);
		}
		echo json_encode($Response);
	}
}
?>