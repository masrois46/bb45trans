<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Roiscart{
	private $cart = array();
	private $instance;
	private $session = 'CartItems';
	
	public function __get($var)
	{
		return get_instance()->$var;
	}
	
	public function instance_name()
    {
        return $this->instance;
    }
	
	public function __construct($instance = 'fed'){
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}
		
		$this->instance = 'RoisCart'.$instance;
		if(!empty($_SESSION[$this->session])){
			$this->cart[$this->instance] = $_SESSION[$this->session];
		}
		
	}
	
	private function rowid($length = 255){
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		return MD5($randomString);
	}
	
	private function validation($items = array()){
		if(!isset($items['id'], $items['qty'], $items['price'], $items['name'])){
			echo 'The cart array must contain a product ID, quantity, price, and name.';
			exit();
		}else if(!is_numeric($items["id"]) || !is_numeric($items["qty"]) || !is_numeric($items["price"]))
	 	{
	 		echo 'Id, qty and price must be numbers.';
			exit();
	 	}
	}
	
	public function insert($items = array()){
		$this->validation($items);
		if(empty($items['options'])){
			$items['options'] = array();
		}
		$dataInsertArray[$this->rowid()] = array(
			'id' => $items['id'],
			'qty' => $items['qty'],
			'price' => $items['price'],
			'name' => $items['name'],
			'options' => $items['options']
		);
		
		if($this->cart == null){
			$dataArray = $dataInsertArray;
		}else{
			$dataArray = array_merge($_SESSION[$this->session], $dataInsertArray);
		}
		$_SESSION[$this->session] = $dataArray;
	}
	
	public function remove($rowid){
		$session = $_SESSION[$this->session];
			foreach($session as $k => $v){
				if($rowid == $k){
					unset($session[$k]);
				}
			}
		$_SESSION[$this->session] = $session;
	}
	
	public function get_contents(){
		if(!empty($_SESSION[$this->session])){
			return $_SESSION[$this->session];
		}else{
			return null;
		}
	}
	
	public function ses_destroy(){
		if(!empty($_SESSION[$this->session])){
			unset($_SESSION[$this->session]);
		}
	}
	
}
?>