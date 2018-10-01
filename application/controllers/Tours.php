<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tours extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('m_tours');
	}
	
	function index(){
		$this->session->set_flashdata('title', 'Our Best Tours List');
		$data = array(
			'phone_number' => $this->loadfirst->get_where_array('footer-number'),
			'wa_number' => $this->loadfirst->get_where_array('phone-number'),
			'random_wall_tours' => $this->m_tours->random_wall_tours(),
			'tour_categories' => $this->m_tours->tour_categories()
		);
		$this->template->load('template', 'tour/tours', $data);
	}
	
	function categories(){
		$id = $this->uri->segment(3);
		$title_from_db = $this->db->get_where('tour_categories', array('id_categories' => $id))->row_array();
		$this->session->set_flashdata('title', $title_from_db['name'].' Tours');
		$data = array(
			'phone_number' => $this->loadfirst->get_where_array('footer-number'),
			'wa_number' => $this->loadfirst->get_where_array('phone-number'),
			'random_wall_tours' => $this->m_tours->random_wall_tours(),
			'tour_categories' => $this->m_tours->tour_categories()
		);
		$this->template->load('template', 'tour/tours', $data);
	}
	
	function related_tour($self, $params){
		header('Content-Type: application/json');
		$param = urldecode($params);
		$data = array(
			'data' => $this->m_tours->related_tour($self, $param)->result()
		);

		$htmlData = array(
			'status' => $this->m_tours->related_tour($self, $param)->num_rows(),
			'content' => $this->load->view('tour/related', $data, TRUE)
		);
		echo json_encode($htmlData);
	}
	
	function pagination(){
	header('Content-Type: application/json');
	  $this->load->library("pagination");
	  $config = array();
	  $config["base_url"] = "#";
	  $config["total_rows"] = $this->m_tours->count_all();
	  $config["per_page"] = 4;
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
		$data = array('data' => $this->m_tours->tour_home($config["per_page"], $start), 'features' => $this->m_tours->tour_features());
		$page_source = $this->load->view('tour/tours_pagination', $data, TRUE);
	  $output = array(
	   'pageination_tours'  => $this->pagination->create_links(),
	   'tours_post'   => $page_source
	  );
	  echo json_encode($output);
 	}
	
	function pagination_categories(){
		header('Content-Type: application/json');
		$id = $this->input->get('id');
	  $this->load->library("pagination");
	  $config = array();
	  $config["base_url"] = "#";
	  $config["total_rows"] = $this->m_tours->count_by_cat($id);
	  $config["per_page"] = 4;
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
		$data = array('data' => $this->m_tours->tour_by_cat($id, $config["per_page"], $start), 'features' => $this->m_tours->tour_features());
		$page_source = $this->load->view('tour/tours_pagination', $data, TRUE);
	  $output = array(
	   'pageination_tours'  => $this->pagination->create_links(),
	   'tours_post'   => $page_source
	  );
	  echo json_encode($output);
 	}
	
	function detail($id_tour){
		$data = array(
			'detail_tour' => $this->m_tours->detail_tour($id_tour),
			'features_tour' => $this->m_tours->find_tour_features($id_tour),
			'timeline_tour' => $this->m_tours->tour_timeline($id_tour),
			'phone_number' => $this->loadfirst->get_where_array('phone-number'),
			'csrfname' => $this->security->get_csrf_token_name(),
        	'csrfhash' => $this->security->get_csrf_hash(),
			'carousel' => $this->m_tours->carousel($id_tour)
		);
		if(!empty($data['detail_tour'])){
			$this->session->set_flashdata('title', $data['detail_tour']['name']);
			$this->session->set_flashdata('related', $data['detail_tour']['name']);
			$this->template->load('template','tour/detail', $data);
		}else{
			show_404();
		}
	}
	
	function booking_procces(){
		if($this->input->post()){
			$post = $this->input->post();
			$qty = $this->cart->total_items();
			$qtyUniversal = $this->session->userdata('qtyPerson');
			if($qtyUniversal){
				$qty = $qtyUniversal;
			}else{
				$qty = 1;
				$this->session->set_userdata('qtyPerson', 1);
			}
			$data = array(
				'id' => $post['id_tour'],
				'type' => 'tour',
				'qty' => $qty,
				'price' => $post['price'],
				'name' => $post['name']
			);
			$this->cart->insert($data);
			$data = array(
				'csrfname' => $this->security->get_csrf_token_name(),
        		'csrfhash' => $this->security->get_csrf_hash()
			);
			echo json_encode($data);
		}else{
			show_404();
		}
	}
	
	function cart_shop(){
		header('Content-Type: application/json');
		if(count($this->cart->contents()) > 0 ){
			foreach($this->cart->contents() as $row){
			$cart[] = '
				<li>
					<div class="image"><a href="/tour/'.$row['id'].'"><img src="'.$this->m_tours->find_item($row['id'])['image_thumbnail'].'" alt="'.$row['name'].'"></a></div>
					<strong>'.$row['name'].'<br>'.$row['qty'].'x $'.$row['price'].' </strong>
				</li>';
			}
			foreach($cart as $row => $val){
				$data['cart'][] = $val;
			}
			$data['total'] = $this->cart->total();
			$data['totalqty'] = count($cart);
		}else{
			$data = array(
				'total' => 0,
				'totalqty' => 0
			);
		}
		echo json_encode($data);
	}
}
?>