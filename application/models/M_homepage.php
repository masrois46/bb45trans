<?php defined('BASEPATH') OR exit('No direct script access allowed');

class M_homepage extends CI_Model{

	function slider(){
		$this->db->order_by('rand()');
		return $this->db->get('slider')->result();
	}
	
	function random_tours($limit){
		$this->db->select('tour.*, tour_categories.name as name_categories, tour_categories.icon_tags');
		$this->db->join('tour_categories', 'tour.id_categories=tour_categories.id_categories', 'left outer');
		$this->db->order_by('rand()');
		$this->db->limit($limit);
		return $this->db->get('tour')->result();
	}
	
} 
?>