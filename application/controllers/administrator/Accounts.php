<?php

class Accounts extends Admin_controller{

    function __construct() {
        parent::__construct();
    }

    function index($id=null,$hashed_account_number = NULL){
        #GET ADDITIONAL SCRIPTS AND STYLES NEEDED FOR THE VIEW
        $this->getDataTableScripts();
        $this->data['page_level_styles'] .= "<link rel='stylesheet' type='text/css' href='".getResource('js/ios-switch/switchery.css')."' />";
        $this->data['page_level_scripts'] .= "<script src='".getResource('js/ios-switch/switchery.js')."'></script>";
        $this->data['page_level_scripts'] .= "<script src='".getResource('js/ios-switch/ios-init.js')."'></script>";

        #IF ID SUPPLIED IT MEANS WE ARE UPDATING NEW USER
        if($id != NULL) {
            $this->data['account'] = $this->Accounts_model->get_by(array('id'=>$id,'md5(account_number)'=>$hashed_account_number),$single = TRUE);
            count($this->data['account']) || $this->data['errors'] = 'User not found';
        }
        else {
            $this->data['account'] = $this->Accounts_model->get_new();

            }

        #LOAD FORM VALIDATION RULES
        $rules = $this->Accounts_model->rules;
        #PASS THE RULES TO FORM VALIDATION CLASS
        $this->form_validation->set_rules($rules) or die('I didnt set any rules');

        #CHECK IF FORM WAS VALIDATED SUCCESSFULLY
        if ($this->form_validation->run() == TRUE) {
                $fields = array('account_title','account_surname','account_othernames','account_gender','account_phone_number','account_email_address','account_contact_address','account_nationality','account_state','account_lga','account_bank_name','account_bank_account_name','account_bank_account_number','account_bank_sort_code','status','account_referrer_id');
                $data = $this->Accounts_model->array_from_post($fields);
                if($id == NULL){
                    $data['account_number'] = $this->Accounts_model->generate_unique_id($len = 10,$fieldname = "account_number");
                    $data['account_username'] = $this->Accounts_model->generate_unique_id($len = 10,$fieldname = "account_number");
                    $data['account_password'] = $this->Accounts_model->hash('code');
                }

                if (isset($_FILES['account_passport']) && $_FILES['account_passport']['size'] > 0) {
                    $data['account_passport'] = $this->_handlePassportUpload();
                }
                else if (!isset($_FILES['account_passport']) && $id ==  NULL){
                    $data['account_passport'] = './resources/uploads/images/accounts_passports/no_image.jpg';
                }

                if($id == NULL && !empty($data['account_referrer_id'])){
                    $referal_id = NULL;
                    //CHECK IF REFERAL ID IS VALID
                    $referral_id_status = $this->checkAccountID($data['account_referrer_id']);
                    if($referral_id_status == "valid_account_id"){

                        $referal_data['account_number'] = $data['account_number'];
                        $referal_data['parent_id'] = $data['account_referrer_id'];
                        $grand_parent_id = $this->getParentID($data['account_referrer_id']);
                        if($grand_parent_id != NULL){
                            $referal_data['grand_parent_id'] = $grand_parent_id;
                            $great_grand_parent_id = $this->getParentID($grand_parent_id);
                               if($great_grand_parent_id != NULL){
                                   $referal_data['great_grand_parent_id'] = $great_grand_parent_id;
                                        $great_great_grand_parent_id = $this->getParentID($great_grand_parent_id);
                                           if($great_great_grand_parent_id != NULL){
                                               $referal_data['great_great_grand_parent_id'] = $great_great_grand_parent_id;
                                           }
                               }
                        }
                    }
                    else{
                        $this->session->set_flashdata('Invalid Referal ID Supplied');
                    }
                }
                if(count($referal_data)){
                    $referal_information_saved = $this->Referrals_model->save($referal_data,$referal_id);
                }
                $saved = $this->Accounts_model->save($data,$id) or die("I did not save data");
                if ($saved){
                    $message = $id == NULL? 'User Added Succesfully':'User Updated Succesfully';
                    $subject = "Business Capital Funding - Registration Details";
                    $message = "<html> <body>"
                            . "<img src = '".getResource('images/login_logo.png')."'"
                            . "<h4>Your Business Capital Funding account has been created </h4><br/>"
                            . " <table border = '1'>"
                            . "<tr> <td width = '50%'> Account Name: </td> <td>".$data['account_surname']. " ".$data['account_othernames']." </td></tr>"
                            . "<tr> <td> Account Number: </td> <td>".$data['account_number']." </td></tr>"
                            . "<tr> <td> Contact Email: </td> <td>".$data['account_email_address']." </td></tr>"
                            . "<tr> <td> Contact Phone: </td> <td>".$data['account_phone_number']." </td></tr>"
                            . "Visit www.learntoliveconsult.com/investment Click LOGIN to login access your account with the account number provided."
                            . "Thank You. "
                            . "BCF Team. "
                            . "</table></body> </html>";
                    $this->sendEmail($subject,$message,$receiver = $data['account_email_address']);
                    $sms_string = "Your Business Capital Funding has been created \n"
                                . "\n Associate Name : ".$data['account_surname']. " ".$data['account_othernames']
                                . "\n Associate ID : ".$data['account_number']
                                . "\n You can now start referring others with your ID";
                    sendsms($sms_string,$data['account_phone_number']);
                    $this->session->set_flashdata('msg',$message);
                }
                else {
                    $this->session->set_flashdata('error','An Error Occured while creating account');
                }

                redirect('Administrator/Accounts/view');

        }
        else {
            //echo "I did not validate your rules";
           $this->data['message'] = TRIM(validation_errors()) != FALSE ? getAlertMessage(validation_errors()) : '';
           //redirect('Administrator/Accounts/index');
        }
        if ($id != NULL){
            $this->db->where("t_accounts.id != '$id'");
        }
        $this->db->order_by('t_accounts.account_surname ASC');
        $this->data['referer_accounts'] = $this->Accounts_model->get();
        $this->data['subview'] = 'Administrator/Accounts/create';
        $this->load->view('Administrator/_layout_main',$this->data);
    }

    function view($id=null){
        #GET ADDITIONAL SCRIPTS AND STYLES NEEDED FOR THE VIEW
        $this->getDataTableScripts();
        $this->data['page_level_styles'] .= "<link rel='stylesheet' type='text/css' href='".getResource('js/ios-switch/switchery.css')."' />";
        $this->data['page_level_scripts'] .= "<script src='".getResource('js/ios-switch/switchery.js')."'></script>";
        $this->data['page_level_scripts'] .= "<script src='".getResource('js/ios-switch/ios-init.js')."'></script>";

        $this->db->select('t_accounts.*');
        $this->db->order_by('t_accounts.datecreated DESC');
        $this->data['accounts'] = $this->db->get('t_accounts')->result();
        $this->data['subview'] = 'Administrator/Accounts/view_accounts_page';
        $this->load->view('Administrator/_layout_main',$this->data);
    }

    function view_account($id,$hashed_account_number){
        if(isset($id,$hashed_account_number)) {
            $this->data['account'] = $account_data = $this->Accounts_model->get_by(array('id'=>$id,'md5(account_number)'=>$hashed_account_number),$single = TRUE);
            if(count($account_data)){
                        $this->data['subview'] = 'Administrator/Accounts/view_single_account_page';
                        $this->load->view('Administrator/_layout_main',$this->data);
            }
            else{
                $this->session->set_flashdata('error','Account Details not found');
                redirect('Administrator/Accounts');
            }

        }

    }
    function view_sub_accounts($hashed_account_number){
        if(isset($hashed_account_number)) {

            $this->data['account_data'] = $this->Accounts_model->get_by(array('md5(account_number)'=>$hashed_account_number),TRUE);
            $this->db->select('t_referrer_relationships.*,t_accounts.*');
            $this->db->join('t_accounts','t_accounts.account_number = t_referrer_relationships.account_number','inner');
            $this->data['children_accounts_data'] = $children_accounts_data = $this->Referrals_model->get_by(array('md5(parent_id)'=>$hashed_account_number));

            $this->data['grand_children_accounts_data'] = $grand_children_accounts_data = $this->Referrals_model->get_by(array('md5(grand_parent_id)'=>$hashed_account_number));
            $this->data['great_grand_children_accounts_data'] = $great_grand_children_accounts_data = $this->Referrals_model->get_by(array('md5(great_grand_parent_id)'=>$hashed_account_number));
            $this->data['account_holders_name'] = $account_holders_name = $this->data['account_data']->account_title.' '.$this->data['account_data']->account_surname.' '.$this->data['account_data']->account_othernames;
            if(!count($children_accounts_data)){
                        $this->session->set_flashdata('error',$account_holders_name."'s Account does not have any children accounts yet");
                        redirect('Administrator/accounts/view');
            }
            else{
                $this->data['subview'] = 'Administrator/Accounts/show_sub_account_page';
                $this->load->view('Administrator/_layout_main',$this->data);
            }
        }
        else {
            redirect('Administrator/Accounts');
        }

    }

    function delete($id) {
        if (isset($id)) {
            $this->Accounts_model->delete($id);
            $this->session->set_flashdata('msg','User Deleted Successfully');
            redirect('Administrator/Accounts/view');
        }
    }

    private function _checkUserName($field,$id = NULL) {
        $this->db->where('username',$field);
        if ($id != NULL)
             $this->db->where('id !=',$id);
        $userNameData = $this->db->get('t_admin_users');
        if ($userNameData->num_rows() > 0) {

            return TRUE;
        }
        else return FALSE;
    }
    private function _checkEmailAddress($field,$id = NULL) {
        $this->db->where('email_address',$field);
        if ($id != NULL)
             $this->db->where('id !=',$id);
        $userNameData = $this->db->get('t_admin_users');
        if ($userNameData->num_rows() > 0) {

            return TRUE;
        }
        else return FALSE;
    }



}