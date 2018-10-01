<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Invoices extends CI_Controller{

    function __construct(){
        parent::__construct();
    }

    function index(){
        header("HTTP/1.1 401 Unauthorized");
    }

    function detail($id){
        $code = $this->input->get('v');
        $md5 = MD5($id);
        if($md5 == $code){
            $this->session->set_flashdata('title', 'Invoice '.$id);
            $data = array(
                'detail' => $this->detail_invoice($id),
                'tour' => $this->db->get_where('invoice_tour', array('id_invoice' => $id))->result(),
                'services' => $this->db->get_where('invoice_services', array('id_invoice' => $id))->result()
            );
            $this->load->view('invoice', $data);
        }else{
            header("HTTP/1.1 401 Unauthorized");
        }
        
    }

    private function detail_invoice($id){
        $this->db->select('invoice.*, bank_account.*, user.*');
        $this->db->join('bank_account', 'invoice.payment_method=bank_account.id_bank', 'left');
        $this->db->join('user', 'invoice.user_email=user.email');
        $this->db->where('invoice.id_invoice', $id);
        return $this->db->get('invoice')->row_array();
    }
}
?>