<?php defined('BASEPATH') OR exit('No direct script access allowed');

class M_dashboard extends CI_Model{

    function latest_tour(){
        $this->db->select('invoice.id_invoice, invoice.user_email, invoice.order_date, invoice.date_tour, invoice.status_paid, bank_account.bank_name');
        $this->db->join('bank_account', 'invoice.payment_method=bank_account.id_bank', 'left');
        $this->db->order_by('invoice.order_date', 'DESC');
        $this->db->limit(6);
        return $this->db->get('invoice')->result();
    }

    function latest_confirm(){
        $this->db->order_by('id_confirm_transfer', 'DESC');
        $this->db->limit(6);
        return $this->db->get('confirm_transfer')->result();
    }
}
?>