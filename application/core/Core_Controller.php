<?php

class Core_controller extends CI_Controller {

    public $data = array();
    function __construct() {
        parent::__construct();
        #GET APP DATA
        $this->data['errors']= '';
        $this->data['sitename']= config_item('sitename');
        $this->data['sitelogo']= config_item('sitelogo');
        $this->data['siteslug']= config_item('siteslug');
        $this->data['currency_symbol']= config_item('currency_symbol');
        #PROCESS URL
        $url = current_url();
        $current_url = str_replace(uri_string() . config_item('url_suffix'), '', $url);
        $this->data['current_url'] = $cur_url = $current_url = rtrim($current_url, '/');
        $this->data['current_url'] = ((trim(config_item('index_page')) != false) ? str_replace(config_item('index_page'), '', $cur_url) : $cur_url);
        $this->data['current_url'] = $current_url = str_replace('www.', '', $this->data['current_url']);
        $this->data['current_url'] = rtrim($current_url, '/');
        #GLOBAL VARIABLES FOR PAGE LEVEL STYLES AND SCRIPTS
        $this->data['page_level_styles'] = "";
        $this->data['page_level_scripts'] = "";
        #RUN ANY NEW MIGRATIONS
        $this->load->library('migration');
        $this->migration->current();

        @$current_user_session = $this->session->userdata['current_user_uniqueid'];
        if(isset($current_user_session))
               $this->data['current_user_session'] = $current_user_session;

        $this->getPaymentLevelRewards();
    }

   //SINCE MORE THAN ONE METHOD IS MAKING USE OF THE SAME SCRIPTS IT IS GOOD PRACTICE FROM KEEP IT IN ONE PLACE
    public function getDataTableScripts() {
        #scripts for the dataTable
        $this->data['page_level_scripts'] = '<script src="' . getResource("js/advanced-datatable/js/jquery.dataTables.js") . '" ></script>';
        $this->data['page_level_scripts'] .= '<script src="' . getResource("js/data-tables/DT_bootstrap.js") . '" ></script>';
        $this->data['page_level_scripts'] .= '<script src="' . getResource("js/dynamic_table_init.js") . '" ></script>';
    }

        //THIS IS BEING USED BY MORE THAN ONE CHILD CLASS
    protected function _getAccountBalance($studentid){
        $total_credit = 0;
        $total_debit = 0;
        $account_balance = 0;

        $this->db->select('sum(transaction_amount) as total_credit');
        $this->db->where('studentid',$studentid);
        $total_credit_data = $this->db->get('t_incoming_transactions')->row();
        if(count($total_credit_data)) {
            $total_credit = $total_credit_data->total_credit;
        }

        $this->db->select('sum(transaction_amount) as total_dedit');
        $this->db->where('studentid',$studentid);
        $total_debit_data = $this->db->get('t_outgoing_transactions')->row();
        if(count($total_debit_data)) {
            $total_debit = $total_debit_data->total_dedit;
        }

        $account_balance = $total_credit - $total_debit;

        return $account_balance;
    }

    protected function _handlePassportUpload(){
        if (isset($_FILES['account_passport']) && $_FILES['account_passport']['size'] > 0) {
            $upload_location = '';
            $upload_path ='./resources/uploads/images/accounts_passports/';
            if (!is_dir($upload_path))
                mkdir ($upload_path, 0777);
                $source_file_name = 'account_passport';
                $destination_file_name = mt_rand($min = 0000000000, $max = 999999999);
                @$name = $_FILES[$source_file_name]["name"];
                @$ext = end((explode(".", $name)));
                if ($this->perform_upload($upload_path,$source_file_name,$destination_file_name))
                    {
                        $upload_location = $upload_path.$destination_file_name.".".$ext;
                    }
                else {
                    $this->session->set_flashdata('error',$this->data['upload_error']);

                    }
            }
            return $upload_location;
    }
        public function perform_upload($upload_path,$source_file_name,$destination_file_name)
        {
            #sourcefilename = the name you gave the uploaded file in the form
            #destinationfilename = the name you want to give the uploaded file in the destination
            #upload path = the directory you wish to upload the file to
            if (!empty($_FILES[$source_file_name]['name'])) {
                $config['file_name']          = $destination_file_name;
                $config['upload_path']          = $upload_path;
                $config['allowed_types']        = 'gif|jpg|png|doc|docx|pdf|exe|zip|mp4|mp3|avi|flv';
                $config['max_size']             = 102400;

                $this->load->library('upload', $config);

                if ( ! $this->upload->do_upload($source_file_name))
                {
                        $error = array('error' => $this->upload->display_errors());
                        $this->data['upload_error'] = $error['error'];
                        return false;
                }
                else
                {
                    #NOTHING WAS UPLOADED
                       return true;
                }
            }
            else {
                return null;
            }
        }

        function getPaymentLevelRewards(){
        $this->data['payment_level_1'] = config_item('payment_level_1');
        $this->data['payment_level_2'] = config_item('payment_level_2');
        $this->data['payment_level_3'] = config_item('payment_level_3');

    }


        function sendEmail($subject,$message,$receiver){
                $config = Array();
                        $smtp_host = "ssl://smtp.googlemail.com";
                        $smtp_user = "theplatformeduportal@gmail.com";
                        $smtp_password = "platformOLA123";
                        $smtp_port = "465";
                        $config['protocol'] = "SMTP";
                        $config['smtp_host'] = $smtp_host;
                        $config['smtp_port'] = $smtp_port;
                        $config['smtp_user'] = $smtp_user;
                        $config['smtp_pass'] = $smtp_password;
                        $config['mailtype'] = 'html';
                        $config['charset'] = 'iso-8859-1';
                #load and send the email
                $this->load->library('email', $config);
                $this->email->set_newline("\r\n");
                $this->email->from("BUSINESS CAPITAL FUNDING");
                $this->email->to($receiver);
                $this->email->subject($subject);
                $this->email->message($message);
                $result = @$this->email->send();
                return $result;
            }

    protected function checkAccountID($account_number){
        $status = "invalid_account_id";
        $account_data = $this->Accounts_model->get_by(array('account_number'=>$account_number),TRUE);
        if(count($account_data)){
            $status = "valid_account_id";
        }
        else {
            $status = "invalid_account_id";
        }
        return $status;
    }

    protected function getParentID($account_number){
        $parentid = NULL;
        $this->db->where('account_number',$account_number);
        $account_data = $this->db->get('t_referrer_relationships')->row();
        if(count($account_data)){
            $parentid = $account_data->parent_id;
        }
        else {
           $parentid = NULL;
        }
        return $parentid;
    }
}
