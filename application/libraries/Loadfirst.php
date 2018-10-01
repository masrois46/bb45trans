<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Loadfirst{
	
	function __construct(){
		$this->ci =& get_instance();
		$data = array(
			'get_social_media_footer' => $this->get_like('icon-'),
			'get_footer_copyright' => $this->get_where_array('footer-copyright'),
			'get_title' => $this->get_where_array('title-universal'),
			'get_email' => $this->get_where_array('footer-email'),
			'get_number' => $this->get_where_array('footer-number'),
			'text_link1' => $this->get_where_array('footer-text-link1'),
			'text_link2' => $this->get_where_array('footer-text-link2'),
			'text_link3' => $this->get_where_array('footer-text-link3'),
			'footer_link1' => $this->get_where_array('footer-link1'),
			'footer_link2' => $this->get_where_array('footer-link2'),
			'footer_link3' => $this->get_where_array('footer-link3'),
			'get_menus' => $this->get_menus(),
			'menu_dynamic' => $this->menu_dynamic()
		);
		$this->ci->session->unset_userdata('config');
		$this->ci->session->set_userdata('config', $data);
		
	}

	function menu_dynamic(){
		$parent = $this->ci->db->get('menu_parents');
		$final = array();

		if($parent->num_rows() >0 ){
			foreach($parent->result() as $row){
				$this->ci->db->where('parent_id', $row->parent_id);
				$children = $this->ci->db->get('menu_children');
				if($children->num_rows() > 0){
					$row->children = $children->result();
				}
				array_push($final, $row);
			}
		}
		return $final;
	}
	
	public function get_where_array($param){
		$this->ci->db->where('config', $param);
		return $this->ci->db->get('config')->row_array();
	}
	
	public function get_where_result($param){
		$this->ci->db->where('config', $param);
		return $this->ci->db->get('config')->result();
	}
	
	public function get_like($param){
		$this->ci->db->like('config', $param);
		return $this->ci->db->get('config')->result();
	}
	
	private function get_menus(){
		return $this->ci->db->get('tour_categories')->result();
	}
}
?>