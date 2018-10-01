<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_tours extends CI_Model {
	
	function random_wall_tours(){
		$this->db->select('tour.*, tour_categories.name as name_categories, tour_categories.icon_tags');
		$this->db->join('tour_categories', 'tour.id_categories=tour_categories.id_categories', 'left outer');
		$this->db->order_by('rand()');
		$this->db->limit(1);
		return $this->db->get('tour')->row_array();
	}
	
	function related_tour($self, $param){
		$this->db->select('tour.*, tour_categories.name as name_categories, tour_categories.icon_tags');
		$this->db->join('tour_categories', 'tour.id_categories=tour_categories.id_categories', 'left outer');
		$this->db->where('tour.id_tour !=', $self);
		$this->db->where('tour.id_categories', $param);
		$this->db->order_by('rand()');
		$this->db->limit(3);
		return $this->db->get('tour');
	}
	
	function count_all(){
		$result = $this->db->get('tour');
		return $result->num_rows();
	}
	
	function count_by_cat($cat){
		$this->db->where('id_categories', $cat);
		$result = $this->db->get('tour');
		return $result->num_rows();
	}
	
	function tour_home($limit, $start){
		$this->db->select('tour.*, tour_categories.name as name_categories, tour_categories.icon_tags');
		$this->db->join('tour_categories', 'tour.id_categories=tour_categories.id_categories', 'left outer');
		$this->db->order_by('tour.date_post', 'DESC');
		$this->db->limit($limit, $start);
		return $this->db->get('tour')->result();
	}
	
	function tour_by_cat($cat, $limit, $start){
		$this->db->select('tour.*, tour_categories.name as name_categories, tour_categories.icon_tags');
		$this->db->join('tour_categories', 'tour.id_categories=tour_categories.id_categories', 'left outer');
		$this->db->where('tour.id_categories', $cat);
		$this->db->order_by('tour.date_post', 'DESC');
		$this->db->limit($limit, $start);
		return $this->db->get('tour')->result();
	}
	
	function tour_features(){
		$this->db->order_by('id_features', 'ASC');
		return $this->db->get('tour_features')->result();
	}
	
	function find_tour_features($id_tour){
		$this->db->where('id_tour_features', $id_tour);
		$this->db->order_by('id_features', 'ASC');
		$this->db->limit(7);
		return $this->db->get('tour_features')->result();
	}
	
	function tour_categories(){
		return $this->db->get('tour_categories')->result();
	}
	
	function detail_tour($id_tour){
		$this->db->select('tour.*, tour_categories.name as cat_name, tour_categories.icon_tags');
		$this->db->join('tour_categories', 'tour.id_categories=tour_categories.id_categories', 'left outer');
		$this->db->where('tour.id_tour', $id_tour);
		return $this->db->get('tour')->row_array();
	}
	
	function carousel($id_tour){
		$this->db->where('id_tour', $id_tour);
		$this->db->order_by('rand()');
		return $this->db->get('tour_carousel')->result();
	}
	
	function tour_timeline($id_tour){
		$this->db->where('id_tour', $id_tour);
		$this->db->order_by('id_timeline', 'ASC');
		return $this->db->get('tour_timeline')->result();
	}
	
	function find_item($id){
		$this->db->where('id_tour', $id);
		return $this->db->get('tour')->row_array();
	}
}
?>