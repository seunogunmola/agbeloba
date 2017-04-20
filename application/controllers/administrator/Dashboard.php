<?php

class Dashboard extends Admin_controller {

    function __construct() {
        parent::__construct();
    }
    function index() {

        $this->data['page_level_scripts'] .= '<script src="' . getResource("js/morris-chart/morris.min.js") . '" ></script>';
        $this->data['page_level_scripts'] .= '<script src="' . getResource("js/morris-chart/raphael.min.js") . '" ></script>';
        $this->data['page_level_styles'] .= '<link rel = "stylesheet" type = "text/css" href ="' . getResource("css/morris-chart/morris.css") . '" ></script>';
        $this->data['subview'] = 'Administrator/dashboard_page';
        $this->load->view('Administrator/_layout_main',$this->data);
    }
    function quick_search(){
        #LOAD FORM VALIDATION RULES
        $rules = array(
                        'uniqueid'=>array('field'=>'uniqueid','label'=>'Account Number','rules'=>'trim'),
                        'account_number'=>array('field'=>'account_number','label'=>'Account Number','rules'=>'trim'),
            );
        #PASS THE RULES TO FORM VALIDATION CLASS
        $this->form_validation->set_rules($rules) or die('I didnt set any rules');
        #CHECK IF FORM WAS VALIDATED SUCCESSFULLY
        if ($this->form_validation->run() == TRUE) {
                $fields = array('uniqueid','account_number');
                $data = $this->Students_model->array_from_post($fields);
                //THIS HANDLES THE SEARCH FLEXIBILITY
                //IF NON OF ACCOUNT NUMBER AND STUDENTID IS SUPPLIED THEN TRIGGER ERROR
                if (empty($data['uniqueid']) && empty($data['account_number'])){
                    $this->session->set_flashdata('error',"The Student's Name or Account Number is required");
                    redirect('Administrator/Dashboard');
                }
                //IF ANY OF THEM IS SUPPLIED USE IT AS SEARCH PARAM
                elseif(isset($data['uniqueid']) && empty($data['account_number'])) {
                    $uniqueid = $data['uniqueid'];
                }
                elseif(empty($data['uniqueid']) && isset($data['account_number'])) {
                    $uniqueid = $data['account_number'];
                }
               else {
                   $uniqueid = $data['uniqueid'];
               }
                //FETCH STUDENT RECORD
                $this->db->where('uniqueid',$uniqueid);
                $this->data['student_data'] = $this->db->get('t_students')->row();
                $this->data['account_balance'] = $this->_getAccountBalance($uniqueid);
                if (!count($this->data['student_data'])){
                    $this->session->set_flashdata('error',"Student Record not Found - \n Possible Cause; Invalid Account Number Supplied \n Please try again");
                    redirect('Administrator/Dashboard');
                }

        }
        else {
             redirect('Administrator/Dashboard');
        }
        $this->data['subview'] = 'Administrator/quick_search_result_page';
        $this->load->view('Administrator/_layout_main',$this->data);
    }

    function getAccountsCount(){
        $count = 0;
        $sql = "SELECT count(*) as accounts_count FROM t_accounts";
        $data = $this->db->query($sql)->row();
        if (count($data)){
                $count = $data->accounts_count;
        }
        return $count;
    }
    function getDisabledAccountsCount(){
        $count = 0;
        $sql = "SELECT count(*) as accounts_count FROM t_accounts where status != '1'";
        $data = $this->db->query($sql)->row();
        if (count($data)){
                $count = $data->accounts_count;
        }
        return $count;
    }
    function getActiveAccountsCount(){
        $count = 0;
        $sql = "SELECT count(*) as accounts_count FROM t_accounts where status = '1'";
        $data = $this->db->query($sql)->row();
        if (count($data)){
                $count = $data->accounts_count;
        }
        return $count;
    }

    function getMaterialCount(){
            $count = 0;
            $sql = "SELECT count(*) as count FROM t_materials";
            $data = $this->db->query($sql)->row();
            if (count($data)){
                    $count = $data->count;
            }
            return $count;
        }
    function getExpiredMaterialCount(){
            $count = 0;
            $sql = "SELECT count(*) as count FROM t_materials where ".date('d-m-y')." > t_materials.material_expiry_date";
            $data = $this->db->query($sql)->row();
            if (count($data)){
                    $count = $data->count;
            }
            return $count;
        }
    function getMaterialCategoryCount(){
            $count = 0;
            $sql = "SELECT count(*) as count FROM t_material_categories";
            $data = $this->db->query($sql)->row();
            if (count($data)){
                    $count = $data->count;
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
