<?php defined('BASEPATH') OR exit('No direct script access allowed');

require __DIR__ . '/sendgrid_php/vendor/autoload.php';

class Sendmail{
	
	var $setMail;
	var $email;
	var $apiKey = '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';
	
	function __construct(){
		$this->ci =& get_instance();
		
		$this->setMail = new \SendGrid\Mail\Mail();
		$this->email = new \SendGrid($this->apiKey);
	}

	function send($data = array()){
		$this->setMail->setFrom("no-reply@bb45trans.com", "no-reply");
		$this->setMail->setSubject($data['subject']);
		$this->setMail->addTo($data['email'], $data['name']);
		$this->setMail->addContent("text/html", $data['html']);
		
		try {
			$response = $this->email->send($this->setMail);
			return $response->statusCode();
			//print_r($response->headers());
			//print $response->body() . "\n";
		} catch (Exception $e) {
			echo 'Caught exception: ',  $e->getMessage(), "\n";
		}
	}
	
	function send_confirmation($data = array()){
		//$html = $this->ci->load->view('email/register_confirm', $data['html'], TRUE);
		
		$this->setMail->setFrom("no-reply@bb45trans.com", "no-reply");
		$this->setMail->setSubject("Welcome to BB 45Trans Confirm Your Account");
		$this->setMail->addTo($data['email'], $data['name']);
		$this->setMail->addContent("text/html", $data['html']);
		
		try {
			$response = $this->email->send($this->setMail);
			print $response->statusCode() . "\n";
			//print_r($response->headers());
			print $response->body() . "\n";
		} catch (Exception $e) {
			echo 'Caught exception: ',  $e->getMessage(), "\n";
		}
	}

	function send_invoice($data = array()){
		$this->setMail->setFrom("no-reply@bb45trans.com", "no-reply");
		$this->setMail->setSubject("BB 45Trans Tour Invoice ".$data['id_invoice']);
		$this->setMail->addTo($data['email'], 'Booking Tour');
		$this->setMail->addContent("text/html", $data['html']);
		
		try {
			$response = $this->email->send($this->setMail);
			//print $response->statusCode() . "\n";
			//print_r($response->headers());
			//print $response->body() . "\n";
		} catch (Exception $e) {
			echo 'Caught exception: ',  $e->getMessage(), "\n";
		}
	}
}
?>