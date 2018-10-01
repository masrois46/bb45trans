<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_member extends CI_Model {

    private $ses;

    function __construct(){
        $this->ses = $this->session->userdata('auth_client');
    }

    function get_invoice($limit, $start){
        
        $this->db->select('invoice.*, bank_account.bank_name');
        $this->db->join('bank_account', 'invoice.payment_method=bank_account.id_bank','left');
        $this->db->where('invoice.user_email', $this->ses['email']);
        $this->db->order_by('invoice.order_date', 'DESC');
        $this->db->limit($limit, $start);
        return $this->db->get('invoice');
    }
    
    function get_invoice_confirm($id){
        if(!empty($id)){
            return $this->invoice_confirm_get_bank($id);
        }else{
            return $this->get_all_invoice_confirm();
        }
    }

    function invoice_confirm_get_bank($id){
        $this->db->select('invoice.id_invoice, bank_account.*');
        $this->db->join('bank_account', 'invoice.payment_method=bank_account.id_bank', 'left');
        $this->db->where('invoice.id_invoice', $id);
        $results = $this->db->get('invoice')->row_array();
        $arrayJson = array(
            'id_invoice' => $results['id_invoice'],
            'v' => MD5($results['id_invoice']),
            'bank_name' => $results['bank_name'],
            'account' => $results['account'],
            'account_holder' => $results['account_holder']
        );

        return $arrayJson;
    }

    function get_all_invoice_confirm(){
        $this->db->select('invoice.id_invoice');
        $this->db->where('invoice.user_email', $this->ses['email']);
        $this->db->where('invoice.status_invoice', 0);
        $this->db->where('invoice.status_paid', 0);
        return $this->db->get('invoice')->result();
    }

    function insert_confirm_transfer($data = array()){
        $this->db->set($data);
        $this->db->insert('confirm_transfer');
    }

    function change_password($data = array()){
        $this->db->set($data);
        $this->db->where('user.email', $data['email']);
        $this->db->update('user');
    }

    function profile(){
        $this->db->where('email', $this->ses['email']);
        $result = $this->db->get('user')->row_array();
        return $result;
    }

    function save_profile($data = array()){
        $this->db->set($data);
        $this->db->where('email', $data['email']);
        $this->db->update('user');
    }
}
?>