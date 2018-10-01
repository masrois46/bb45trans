<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->model('m_dashboard');
		$this->auth_admin->check();
	}
	public function index()
	{
		$flashsession = array(
			'title' => 'Dashboard',
			'js' => 'dashboard.js'
		);
		$this->session->set_flashdata($flashsession);
		$this->template->load('template', 'dashboard');
	}

	function latest_blog(){
		$link = 'https://feed2json.org/convert?url=http%3A%2F%2Fblog.bb45trans.com%2Fatom.xml';

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $link);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$output = curl_exec($ch);

		$data = json_decode($output,true);
		$no = 0;
		foreach($data['items'] as $row){
			if($no <= 3){
				$dataArray[] = array(
					'url' => $row['url'],
					'title' => $row['title'],
					'date' => date("d", strtotime(strtok($row['date_published'], 'T'))),
					'month' => date("M", strtotime(strtok($row['date_published'], 'T'))),
					'content' => strip_tags($row['content_html'])
				);
			}
			$no++;
		}
		echo json_encode($dataArray);
	}

	function latest_tour(){
		$tourSql = $this->m_dashboard->latest_tour();
		foreach($tourSql as $row){
			if($row->status_paid == 0){
				$status = 'Unpaid';
				$label = 'label label-warning';
			}else{
				$status = 'Paid';
				$label = 'label label-success';
			}
			$dataArray[] = array(
				'id_invoice' => $row->id_invoice,
				'user_email' => $row->user_email,
				'email_encode' => urlencode($row->user_email),
				'date_order' => date('D, d M Y', $row->order_date),
				'date_tour' => date('D, d M Y', $row->date_tour),
				'payment_method' => $row->bank_name,
				'status' => $status,
				'label' => $label
			);
		}
		echo json_encode($dataArray);
	}

	function latest_confirm(){
		$confirmSql = $this->m_dashboard->latest_confirm();
		foreach($confirmSql as $row){
			if($row->status == 0){
				$status = 'Pending';
				$label = 'warning';
			}else if($row->status == 1){
				$status = 'Approved';
				$label = 'success';
			}else{
				$status = 'Rejected';
				$label = 'danger';
			}
			
			$dataArray[] = array(
				'id' => $row->id_confirm_transfer,
				'email' => $row->email,
				'id_invoice' => $row->id_invoice,
				'date_transfer' => date('D, d M Y', $row->date_transfer),
				'status' => $status,
				'label' => $label
			);
		}
	echo json_encode($dataArray);
	}
}
?>