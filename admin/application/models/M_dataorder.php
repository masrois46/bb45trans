<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_dataorder extends CI_Model{

    var $table = 'invoice';
    var $select_column = array('invoice.id_invoice', 'invoice.user_email', 'invoice.order_date', 'invoice.date_tour', 'bank_account.bank_name', 'invoice.status_paid', 'invoice.status_invoice');
    var $order_column = array('invoice.id_invoice', null,'invoice.order_date', 'invoice.date_tour',null,'invoice.status_paid',null,null);

    //CONFIRM TRANSFER
    var $table2 = 'confirm_transfer';
    var $select_column2 = array('id_confirm_transfer','email','id_invoice','date_transfer','status');
    var $order_column2 = array('id_confirm_transfer','email','id_invoice','date_transfer','status');

    function __invoice_json(){
        $this->db->select($this->select_column);
        $this->db->join('bank_account', 'bank_account.id_bank=invoice.payment_method');
        $this->db->from($this->table);
        if(isset($_POST['search']['value']))
        {
            $this->db->like('invoice.id_invoice', $_POST['search']['value']);
            $this->db->or_like('invoice.user_email', $_POST['search']['value']);
        }

        if(isset($_POST['order']))
        {
            $this->db->order_by($this->order_column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        }else{
            $this->db->order_by('invoice.order_date', 'DESC');
        }
    }

    function invoice_json(){
        $this->__invoice_json();
        if($_POST['length'] != -1)
        {
            $this->db->limit($_POST['length'], $_POST['start']);
        }
        $query = $this->db->get();
        return $query->result();
    }

    function get_filtered_data(){
        $this->__invoice_json();
        $query = $this->db->get();
        return $query->num_rows();
    }

    function get_all_data(){
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    //CONFIRM TRANSFER
    function __confirm_json(){
        $this->db->select($this->select_column2);
        $this->db->from($this->table2);
        if(isset($_POST['search']['value']))
        {
            $this->db->like('email', $_POST['search']['value']);
            $this->db->or_like('id_invoice', $_POST['search']['value']);
        }

        if(isset($_POST['order']))
        {
            $this->db->order_by($this->order_column2[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        }else{
            $this->db->order_by('id_confirm_transfer', 'DESC');
        }
    }

    function confirm_json(){
        $this->__confirm_json();
        if($_POST['length'] != -1)
        {
            $this->db->limit($_POST['length'], $_POST['start']);
        }
        $query = $this->db->get();
        return $query->result();
    }

    function get_filtered_data_confirm(){
        $this->__confirm_json();
        $query = $this->db->get();
        return $query->num_rows();
    }

    function get_all_data_confirm(){
        $this->db->from($this->table2);
        return $this->db->count_all_results();
    }

    function get_detail_invoice($id){
        $this->db->select('invoice.*, bank_account.bank_name, admin.name as admin_name');
        $this->db->join('bank_account', 'invoice.payment_method=bank_account.id_bank', 'left');
        $this->db->join('admin', 'invoice.admin=admin.email', 'left');
        $this->db->where('invoice.id_invoice', $id);
        $result = $this->db->get('invoice');
        if($result->num_rows() > 0){
            $dataArray = $result->row_array();
            $dataArray['service'] = $this->get_detail_invoice_service($id);
            $dataArray['tour'] = $this->get_detail_invoice_tour($id);
            $dataArray['confirm'] = $this->get_confirm_transfer($id);
            return $dataArray;
        }else{
            return false;
        }
    }

    private function get_detail_invoice_service($id){
        $this->db->where('id_invoice', $id);
        $result = $this->db->get('invoice_services')->result();
        return $result;
    }

    private function get_detail_invoice_tour($id){
        $this->db->where('id_invoice', $id);
        $result = $this->db->get('invoice_tour')->result();
        return $result;
    }

    private function get_confirm_transfer($id){
        $this->db->where('id_invoice', $id);
        return $this->db->get('confirm_transfer')->row_array();
    }

    function save_confirm($data=array()){
        $this->db->set($data);
        $this->db->where('id_confirm_transfer', $data['id_confirm_transfer']);
        $this->db->update('confirm_transfer');
    }

    function save_invoice($data=array()){
        $this->db->set($data);
        $this->db->where('id_invoice', $data['id_invoice']);
        $this->db->update('invoice');
    }
}
?>