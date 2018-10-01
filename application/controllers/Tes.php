<?php 

class Tes extends CI_Controller{

	function __construct(){
		parent::__construct();
		$this->load->library('sendmail');
	}
	
	function index(){
		$url = $this->input->get('url');
		header("Content-type: image/jpeg");
		echo file_get_contents($url);
	}
}
?>