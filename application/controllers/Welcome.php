<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->model('m_homepage');
	}
	
	public function index()
	{
		$this->session->set_flashdata('title', 'Welcome To Our Tour');
		$data = array(
			'slider' => $this->m_homepage->slider(),
			'random_tours' => $this->m_homepage->random_tours(6),
			'other_random_tours' => $this->m_homepage->random_tours(18),
			'youtube_video' => $this->loadfirst->get_where_array('youtube_home_link')
		);
		
		$this->template->load('template', 'home_page', $data);
	}

	public function get_menu($id){
		$this->db->select('id_tour as slug, name');
		$this->db->order_by('id_tour', 'ASC');
		$result = $this->db->get_where('tour', array('id_categories' => $id))->result();
		$no = 0;
		$html = '';
		$html2 = '';
		$html3 = '';
		foreach($result as $row){
			if($no >=0 && $no <= 9){
				$html .= '<li><a href="/tour/'.$row->slug.'">'.$row->name.'</a></li>';
			}else if($no >=10 && $no <=20){
				$html2 .= '<li><a href="/tour/'.$row->slug.'">'.$row->name.'</a></li>';
			}else if($no >= 21 && $no <= 30){
				$html3 .= '<li><a href="/tour/'.$row->slug.'">'.$row->name.'</a></li>';
			}
			$no++;
		}

		$p = $this->input->get('p');
		if($p == 1){
			echo $html;
			
		}else if($p == 2){
			echo $html2;
		}else if($p == 3){
			echo $html3;
		}else{
			header("HTTP/1.1 401 Unauthorized");
		}
	}

	function latest_blog(){
		$link = 'https://feed2json.org/convert?url=http%3A%2F%2Fblog.bb45trans.com%2Fatom.xml';

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $link);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$output = curl_exec($ch);

		$data = json_decode($output,true);

		
		foreach($data['items'] as $row){
			preg_match( '@src="([^"]+)"@' , $row['content_html'], $match );

			$jsonArray[] = array(
				'title' => $row['title'],
				'url' => $row['url'],
				'img' => array_pop($match),
				'date' => date("M d,Y", strtotime(strtok($row['date_published'], 'T')))
			);
		}

		$html = '';
		foreach($jsonArray as $row){
			if($row['img'] != null){
				$img = $row['img'];
			}else{
				$img = '/assets/img/no-image.jpg';
			}
			$html .= '
			<div class="post">
				<figure>
					<a href="'.$row['url'].'" target="_blank"><img src="'.$img.'" width="62" height="62" alt="'.$row['title'].'"></a>
				</figure>
				<h4><a href="'.$row['url'].'" target="_blank">'.$row['title'].'</a></h4>
				<i class="icon-calendar-empty"></i> '.$row['date'].'
			</div>
			';
		}
		header("Content-Type: Application/json");
		echo json_encode(array('html' => $html));
	}

}
