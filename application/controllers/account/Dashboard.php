<?php

class Dashboard extends Accounts_controller {

    function __construct() {
        parent::__construct();
    }
    function index() {
        $this->data['sub_accounts_count'] = $this->getSubAccountsCount();
        //PAYMENTS
        $this->data['total_payments'] = $this->getTotalPayments();
       // $this->data['total_payments'] = $this->getTotalPayments();
        //
        $this->data['page_level_scripts'] .= '<script src="' . getResource("js/morris-chart/morris.min.js") . '" ></script>';
        $this->data['page_level_scripts'] .= '<script src="' . getResource("js/morris-chart/raphael.min.js") . '" ></script>';
        $this->data['page_level_styles'] .= '<link rel = "stylesheet" type = "text/css" href ="' . getResource("css/morris-chart/morris.css") . '" ></script>';
        $this->data['subview'] = 'Account/dashboard_page';
        $this->load->view('Account/_layout_main',$this->data);
    }
    function getSubAccountsCount(){
        $count = 0;
        $sql = "SELECT count(*) as sub_accounts_count FROM t_referrer_relationships where parent_id = '".$this->data['current_user_data']->account_number."'";
        $data = $this->db->query($sql)->row();
        if (count($data)){
                $count = $data->sub_accounts_count;
        }
        return $count;
    }
    function getTotalPayments(){
        $count = 0;
        $sql = "SELECT sum(payment_amount) as total_payments FROM t_payments where account_number = '".$this->data['current_user_data']->account_number."'";
        $data = $this->db->query($sql);
        if (count($data->num_rows)){
                $meta_data = $data->row();
                $count = $meta_data->total_payments;
        }
        return $count;
    }


    function getIncomingTransactionsDataForGraph(){
        $data_string = '';
        $this->db->select('transaction_date,sum(transaction_amount) as total_transactions');
        $this->db->group_by('transaction_date');
        $this->db->order_by('transaction_date DESC');
        $incoming_transactions_data = $this->db->get('t_incoming_transactions')->result();
        if(count($incoming_transactions_data)){
            foreach($incoming_transactions_data as $value){
              $data_string.="{ date :'".$value->transaction_date."', value : ".$value->total_transactions."},";
            }
            $data_string = rtrim($data_string,',');
        }
        return $data_string;
    }

    function getOutgoingTransactionsDataForGraph(){
        $data_string = '';
        $this->db->select('transaction_date,sum(transaction_amount) as total_transactions');
        $this->db->group_by('transaction_date');
        $this->db->order_by('transaction_date DESC');
        $incoming_transactions_data = $this->db->get('t_outgoing_transactions')->result();
        if(count($incoming_transactions_data)){
            foreach($incoming_transactions_data as $value){
              $data_string.="{ date :'".$value->transaction_date."', value : ".$value->total_transactions."},";
            }
            $data_string = rtrim($data_string,',');
        }
        return $data_string;
    }


}
