<?php

class Payments extends Accounts_controller{

    function __construct() {
        parent::__construct();
    }

    function index_($id=null,$hashed_account_number = NULL){
         //GET PENDING ACCOUNTS
        $this->data['month'] = $current_month = round(date('m'));
        $this->data['year'] = $current_year = date('Y');
        $this->data['current_month'] = date('M');
        $this->data['current_year'] = date('Y');

        // GET
        $this->db->select('t_accounts.*,count(t_referrer_relationships.account_number) as sub_account_count');
        $this->db->from('t_accounts');
        $this->db->where('month(t_referrer_relationships.datecreated) =',$current_month);
        $this->db->where('year(t_referrer_relationships.datecreated) = ',$current_year);
        $this->db->join('t_referrer_relationships','t_accounts.account_number = t_referrer_relationships.parent_id','inner');
        $this->db->having('count(t_referrer_relationships.account_number) > 0');
        $this->data['level1_pending_payments_data'] = $this->db->get()->result();

        $this->db->select('t_accounts.*,count(t_referrer_relationships.account_number) as sub_account_count');
        $this->db->from('t_accounts');
        $this->db->where('month(t_referrer_relationships.datecreated) =',$current_month);
        $this->db->where('year(t_referrer_relationships.datecreated) = ',$current_year);
        $this->db->join('t_referrer_relationships','t_accounts.account_number = t_referrer_relationships.grand_parent_id','inner');
        $this->db->having('count(t_referrer_relationships.account_number) > 0');
        $this->data['level2_pending_payments_data'] = $this->db->get()->result();



    #GET ADDITIONAL SCRIPTS AND STYLES NEEDED FOR THE VIEW
        $this->getDataTableScripts();
        $this->data['page_level_styles'] .= "<link rel='stylesheet' type='text/css' href='".getResource('js/ios-switch/switchery.css')."' />";
        $this->data['page_level_scripts'] .= "<script src='".getResource('js/ios-switch/switchery.js')."'></script>";
        $this->data['page_level_scripts'] .= "<script src='".getResource('js/ios-switch/ios-init.js')."'></script>";


        $this->data['subview'] = 'Account/Payments/pending_payments_page';
        $this->load->view('Account/_layout_main',$this->data);
    }

    function view($id=null){
        #GET ADDITIONAL SCRIPTS AND STYLES NEEDED FOR THE VIEW
        $this->getDataTableScripts();
        $this->data['page_level_styles'] .= "<link rel='stylesheet' type='text/css' href='".getResource('js/ios-switch/switchery.css')."' />";
        $this->data['page_level_scripts'] .= "<script src='".getResource('js/ios-switch/switchery.js')."'></script>";
        $this->data['page_level_scripts'] .= "<script src='".getResource('js/ios-switch/ios-init.js')."'></script>";

        $this->db->select('t_accounts.*');
        $this->db->order_by('t_accounts.account_surname ASC');
        $this->data['accounts'] = $this->db->get('t_accounts')->result();
        $this->data['subview'] = 'Account/Accounts/view_accounts_page';
        $this->load->view('Account/_layout_main',$this->data);
    }
    function index(){
        $hashed_account_number = md5($this->data['current_user_data']->account_number);
        $hashed_month = md5(round(date('m')));
        $hashed_year = md5(date('Y'));
        if(isset($hashed_account_number) && isset($hashed_month) && isset($hashed_year)) {
            $this->data['account_data'] = $this->Accounts_model->get_by(array('md5(account_number)'=>$hashed_account_number),TRUE);
            $this->data['current_month'] = date('M');
            $this->data['current_year'] = date('Y');
            $this->data['hashed_month'] = $hashed_month;
            $this->data['hashed_year'] = $hashed_year;
                // GET
                $this->db->select('t_accounts.*');
                $this->db->from('t_referrer_relationships');
                $this->db->where('md5(month(t_referrer_relationships.datecreated)) =',$hashed_month);
                $this->db->where('md5(year(t_referrer_relationships.datecreated)) = ',$hashed_year);
                $this->db->where('md5(t_referrer_relationships.parent_id) = ',$hashed_account_number);
                $this->db->join('t_accounts','t_referrer_relationships.account_number = t_accounts.account_number','inner');
                $this->data['level1_accounts_data'] = $this->db->get()->result();


                
                $this->db->select('t_accounts.*');
                $this->db->from('t_referrer_relationships');
                $this->db->where('md5(month(t_referrer_relationships.datecreated)) =',$hashed_month);
                $this->db->where('md5(year(t_referrer_relationships.datecreated)) = ',$hashed_year);
                $this->db->where('md5(t_referrer_relationships.grand_parent_id) = ',$hashed_account_number);
                $this->db->join('t_accounts','t_referrer_relationships.account_number = t_accounts.account_number','inner');
                $this->data['level2_accounts_data'] = $this->db->get()->result();


            $this->data['account_holders_name'] = $account_holders_name = $this->data['account_data']->account_title.' '.$this->data['account_data']->account_surname.' '.$this->data['account_data']->account_othernames;
            if(!count($this->data['level1_accounts_data']) && $this->data['level2_accounts_data']){
                        $this->session->set_flashdata('error',$account_holders_name."'s Account does not have any sub-account registered this month");
                        redirect('administrator/payments');
            }
            else{
                $this->data['subview'] = 'Account/Payments/show_payment_details_page';
                $this->load->view('Account/_layout_main',$this->data);
            }

        }

    }
    function make_payment($hashed_account_number,$hashed_month,$hashed_year){
        if(isset($hashed_account_number) && isset($hashed_month) && isset($hashed_year)) {
            $this->data['account_data'] = $this->Accounts_model->get_by(array('md5(account_number)'=>$hashed_account_number),TRUE);
            $this->db->where('md5(month(datecreated)) =',$hashed_month);
            $this->db->where('md5(year(datecreated)) = ',$hashed_year);
            $this->db->where("md5(account_referrer_id)",$hashed_account_number);
            $this->db->select('month(datecreated) as month_created,year(datecreated) as year_created,t_accounts.*');
            $this->data['sub_accounts_data'] = $sub_accounts_data = $this->Accounts_model->get();
            if(count($sub_accounts_data)){
                 $sub_account_count =  count($sub_accounts_data);
                 $data = array();

                 $data['payment_id'] = $this->Payments_model->generate_unique_id($len = 12,$fieldname = "payment_id");
                 $data['payment_amount'] = $sub_account_count * $this->data['payment_rate'];
                 $data['account_number'] = $this->data['account_data']->account_number;
                 $data['payment_month'] = round($sub_accounts_data[0]->month_created);
                 $data['payment_year'] = round($sub_accounts_data[0]->year_created);
                 $data['payment_date'] = date('Y-m-d H:i:s');
                 $data['status'] = 0;
                 $referred_account_numbers = '';
                 foreach($sub_accounts_data as $sub_accounts){
                      $referred_account_numbers .= $sub_accounts->account_number.',';
                 }
                 $data['referred_accounts'] = $referred_account_numbers;
                 $payment_saved = $this->Payments_model->save($data,$id = NULL);
                 if($payment_saved){
                     $this->session->set_flashdata('success','Payment Made Successfully');
                     redirect('administrator/payments');
                 }
                 else{
                     $this->session->set_flashdata('error','An Error occurred while making payment');
                     redirect('administrator/payments');
                 }

            }
            else{
                $this->session->set_flashdata('error','Invalid Payment Information Supplied');
                redirect('administrator/payments');
            }

        }

    }
    function view_sub_accounts($hashed_account_number){
        if(isset($hashed_account_number)) {

            $this->data['account_data'] = $this->Accounts_model->get_by(array('md5(account_number)'=>$hashed_account_number),TRUE);
            $this->data['sub_accounts_data'] = $sub_accounts_data = $this->Accounts_model->get_by(array('md5(account_referrer_id)'=>$hashed_account_number));
            $this->data['account_holders_name'] = $account_holders_name = $this->data['account_data']->account_title.' '.$this->data['account_data']->account_surname.' '.$this->data['account_data']->account_othernames;
            if(!count($sub_accounts_data)){
                        $this->session->set_flashdata('error',$account_holders_name."'s Account does not have any children accounts yet");
                        redirect('administrator/accounts/view');
            }
            else{
                $this->data['subview'] = 'Account/Accounts/show_sub_account_page';
                $this->load->view('Account/_layout_main',$this->data);
            }
        }
        else {
            redirect('administrator/Accounts');
        }

    }
    function view_payment_receipt($hashed_payment_id){
        if(isset($hashed_payment_id)) {
            $this->db->select('t_payments.*');
            $this->db->where('md5(payment_id)',$hashed_payment_id);
            $this->data['payment_data'] = $payment_data = $this->Payments_model->get($id = NULL,$single = TRUE);
                if(count($payment_data)){
                    $this->data['account_data'] = $account_data = $this->Accounts_model->get_by(array('account_number'=>$payment_data->account_number),TRUE);
                    $this->data['subview'] = 'Account/Payments/payment_receipt_page';
                    $this->load->view('Account/_layout_main',$this->data);
                }
                else{
                            $this->session->set_flashdata('error',"Payment Record not Found, Please try again");
                            redirect('administrator/payments/paid');
                }
            }
            else{
                redirect('administrator/payments/paid');
            }

        }



    function delete($id) {
        if (isset($id)) {
            $this->Accounts_model->delete($id);
            $this->session->set_flashdata('msg','User Deleted Successfully');
            redirect('Account/Accounts/view');
        }
    }

}