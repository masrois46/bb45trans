<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data_order extends CI_Controller{

    function __construct(){
        parent::__construct();
        $this->auth_admin->check();
        $this->load->model('m_dataorder');
    }

    function index(){
        $flashsession = array(
			'title' => 'Data Order',
			'js' => 'dataOrderHome.js'
		);
        $this->session->set_flashdata($flashsession);
        $this->template->load('template', 'data_order/home');
    }

    function get_data_invoice(){
        $fetch_data = $this->m_dataorder->invoice_json();
        $data = array();

        foreach($fetch_data as $row)
        {
            if($row->status_paid == 0){
                $status_paid = '<label class="label label-warning">Unpaid</label>';
            }else{
                $status_paid = '<label class="label label-success">Paid</label>';
            }

            if($row->status_invoice == 0){
                $button_proses = '<li><a href="/data-order/proses/'.$row->id_invoice.'" target="_blank">Proses Tour</a></li>';
                $button_cancel = '<li><a href="#" onClick="cancel('.$row->id_invoice.');">Cancel</a></li>';
                $status_invoice = '<label class="label label-warning">Waiting Tour</label>';
            }else if($row->status_invoice == 1){
                $button_proses = '';
                $button_cancel = '';
                $status_invoice = '<label class="label label-success">Tour Completed</label>';
            }else{
                $button_proses = '<li><a href="/data-order/proses/'.$row->id_invoice.'" target="_blank">Proses Tour</a></li>';
                $button_cancel = '';
                $status_invoice = '<label class="label label-default">Canceled</label>';
            }

            $sub_array = array();
            $sub_array[] = $row->id_invoice;
            $sub_array[] = '<a target="_blank" href="/users/detail/'.urlencode($row->user_email).'">'.$row->user_email.'</a>';
            $sub_array[] = date('D, d-M-Y', $row->order_date);
            $sub_array[] = date('D, d-M-Y', $row->date_tour);
            $sub_array[] = $row->bank_name;
            $sub_array[] = $status_paid;
            $sub_array[] = $status_invoice;
            $sub_array[] = '<div class="dropdown">
            <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Options
            <span class="caret"></span></button>
            <ul class="dropdown-menu">
              '.$button_proses.'
              <li><a href="/data-order/detail/'.$row->id_invoice.'" target="_blank">Detail</a></li>
              '.$button_cancel.'
            </ul>
          </div>';
            
            $data[] = $sub_array;
        }
        
        $output = array(
            'draw' => intval($_POST['draw']),
            'recordsTotal' => $this->m_dataorder->get_all_data(),
            'recordsFiltered' => $this->m_dataorder->get_filtered_data(),
            'data' => $data
        );

        echo json_encode($output);
    }

    function proses($id=''){
        $flashsession = array(
			'title' => 'Proses Invoice '.$id,
			'js' => 'dataOrderHome.js'
        );
        $this->session->set_flashdata($flashsession);

        $invoice = $this->m_dataorder->get_detail_invoice($id);

        $totalService = 0;
        $totalTour = 0;

        foreach($invoice['service'] as $row){
            $totalService += $row->price;
        }

        foreach($invoice['tour'] as $row){
            $totalTour += $row->price;
        }
        
        $invoice['totalInvoice'] = $totalService + $totalTour;
        $result['result'] = $invoice;

        $this->template->load('template', 'data_order/proses_invoice', $result);
    }

    function process_tour(){
        $post = $this->input->post();
        if($post){
            $this->load->library('user_agent');
            $auth = $this->session->userdata('auth_admin');
            $dataArray = array(
                'id_invoice' => $post['id_invoice'],
                'status_invoice' => 1,
                'admin' => $auth['email'],
                'driver' => $post['driver']
            );
            $this->m_dataorder->save_invoice($dataArray);
            redirect($this->agent->referrer());
        }else{
            show_404();
        }
    }

    function detail($id=''){
        $flashsession = array(
			'title' => 'Detail Invoice '.$id,
			'js' => 'dataOrderHome.js'
        );
        $this->session->set_flashdata($flashsession);

        $invoice = $this->m_dataorder->get_detail_invoice($id);

        $totalService = 0;
        $totalTour = 0;

        foreach($invoice['service'] as $row){
            $totalService += $row->price;
        }

        foreach($invoice['tour'] as $row){
            $totalTour += $row->price;
        }
        
        $invoice['totalInvoice'] = $totalService + $totalTour;
        $result['result'] = $invoice;

        $this->template->load('template', 'data_order/detail', $result);
    }

    function cancel_invoice($id=''){
        $this->db->set(array('status_invoice' => $id));
        $this->db->where('id_invoice', $id);
        $this->db->update('invoice');
        redirect('/data-order');
    }

    //Konfirmasi Transfer
    function confirmation_transfer(){
        $flashsession = array(
			'title' => 'Data Confirmation Transfer',
			'js' => 'dataOrderHome.js'
		);
        $this->session->set_flashdata($flashsession);
        $this->template->load('template', 'data_order/confirmation_transfer');
    }

    function get_data_confirm(){
        $fetch_data = $this->m_dataorder->confirm_json();
        $data = array();

        foreach($fetch_data as $row)
        {
            if($row->status == 0){
                $status = '<label class="label label-warning">Pending</label>';
            }else if($row->status == 1){
                $status = '<label class="label label-success">Approved</label>';
            }else{
                $status = '<label class="label label-danger">Rejected</label>';
            }

            $sub_array = array();
            $sub_array[] = $row->id_confirm_transfer;
            $sub_array[] = '<a target="_blank" href="/users/detail/'.urlencode($row->email).'">'.$row->email.'</a>';
            $sub_array[] = '<a target="_blank" href="/data-order/detail/'.urlencode($row->id_invoice).'">'.$row->id_invoice.'</a>';
            $sub_array[] = date('D, d-M-Y', $row->date_transfer);
            $sub_array[] = $status;
            $sub_array[] = '<div class="dropdown">
            <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Options
            <span class="caret"></span></button>
            <ul class="dropdown-menu">
              <li><a href="#" data-toggle="modal" data-target="#ModalApprove" onClick="getModal('.$row->id_confirm_transfer.')">Approve</a></li>
              <li><a href="#" data-toggle="modal" data-target="#ModalApprove" onClick="getModalReject('.$row->id_confirm_transfer.')">Reject</a></li>
            </ul>
          </div>';
            
            $data[] = $sub_array;
        }
        
        $output = array(
            'draw' => intval($_POST['draw']),
            'recordsTotal' => $this->m_dataorder->get_all_data_confirm(),
            'recordsFiltered' => $this->m_dataorder->get_filtered_data_confirm(),
            'data' => $data
        );

        echo json_encode($output);
    }

    function get_data_modal(){
        $id = $this->input->get('id');
        if($id != null){
            $result['result'] = $this->db->get_where('confirm_transfer', array('id_confirm_transfer' => $id))->row_array();
            $this->load->view('data_order/modal_confirm', $result);
        }
    }


    function save_confirm(){
        $this->load->library('user_agent');
        $post = $this->input->post();
        if($post){
            if($post['type'] == 'approve'){
                $confirmSql = array(
                    'id_confirm_transfer' => $post['id_confirm_transfer'],
                    'status' => 1
                );
                $paidSql = array(
                    'id_invoice' => $post['id_invoice'],
                    'status_paid' => 1
                );
            }else{
                $confirmSql = array(
                    'id_confirm_transfer' => $post['id_confirm_transfer'],
                    'status' => 2
                );
                $paidSql = array(
                    'id_invoice' => $post['id_invoice'],
                    'status_paid' => 0
                );
            }
            $this->m_dataorder->save_confirm($confirmSql);
            $this->m_dataorder->save_invoice($paidSql);
            redirect($this->agent->referrer());
        }else{
            show_404();
        }
    }
}
?>