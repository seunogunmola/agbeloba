<?php

class Accounts extends Accounts_controller{

    function __construct() {
        parent::__construct();
    }

    function index($id=null,$hashed_account_number = NULL){
        $this->data['account_data'] = $this->data['current_user_data'];
        if(count($this->data['account_data'])){
            $this->data['account'] = $account_data = $this->Accounts_model->get_by(array('account_number'=>$this->data['account_data']->account_number),$single = TRUE);
            $this->data['subview'] = 'Account/Accounts/view_single_account_page';
            $this->load->view('Account/_layout_main',$this->data);
        }
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

    function edit($id=null,$hashed_account_number = NULL){
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
        unset($rules['account_referrer_id']);
        unset($rules['account_payment_id']);
        unset($rules['account_payment_name']);
        unset($rules['account_payment_date']);
        #PASS THE RULES TO FORM VALIDATION CLASS
        $this->form_validation->set_rules($rules) or die('I didnt set any rules');

        #CHECK IF FORM WAS VALIDATED SUCCESSFULLY
        if ($this->form_validation->run() == TRUE) {
                $fields = array('account_title','account_surname','account_othernames','account_gender','account_phone_number','account_email_address','account_contact_address','account_nationality','account_state','account_lga','account_bank_name','account_bank_account_name','account_bank_account_number','account_bank_sort_code','account_referrer_id');
                $data = $this->Accounts_model->array_from_post($fields);
                if (isset($_FILES['account_passport']) && $_FILES['account_passport']['size'] > 0) {
                    $data['account_passport'] = $this->_handlePassportUpload();
                }
                else if (!isset($_FILES['account_passport']) && $id ==  NULL){
                    $data['account_passport'] = './resources/uploads/images/accounts_passports/no_image.jpg';
                }


                $saved = $this->Accounts_model->save($data,$id) or die("I did not save data");
                if ($saved){
                    $message = $id == NULL? 'User Added Succesfully':'Account Information Updated Succesfully';
                    $subject = "User Details Updated on Business Capital Funding";
                    $email_message = "<html> <body>"
                            . "<img src = '".getResource('images/login_logo.png')."'"
                            . "<h4>Your Business Capital Funding account has been updated </h4><br/>"
                            . " <table border = '1'>"
                            . "<tr> <td width = '50%'> Account Name: </td> <td>".$data['account_surname']. " ".$data['account_othernames']." </td></tr>"
                            . "<tr> <td> Contact Email: </td> <td>".$data['account_email_address']." </td></tr>"
                            . "<tr> <td> Contact Phone: </td> <td>".$data['account_phone_number']." </td></tr>"
                            . "Thank You. "
                            . "BCF Team. "
                            . "</table></body> </html>";
                    $this->sendEmail($subject,$email_message,$receiver = "ogunmola.net@gmail.com");
                    $sms_string = "Your Business Capital Funding has been updated \n"
                                . "\n Associate Name : ".$data['account_surname']. " ".$data['account_othernames']
                                . "\n You can now start referring others with your ID";
                    sendsms($sms_string,$data['account_phone_number']);
                    $this->session->set_flashdata('msg',$message);
                }
                else {
                    $this->session->set_flashdata('error','An Error Occured while creating account');
                }

                redirect('Account/Accounts/edit/'.$id.'/'.$hashed_account_number);

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
        $this->data['subview'] = 'Account/Accounts/create';
        $this->load->view('Account/_layout_main',$this->data);
    }

    function password(){
        $rules = array(
            'old_password'=>array('field'=>'old_password','label'=>'Current Password','rules'=>'trim|required'),
            'new_password'=>array('field'=>'new_password','label'=>'New Password','rules'=>'trim|required'),
            'confirm_new_password'=>array('field'=>'confirm_new_password','label'=>'Confirm New Password','rules'=>'trim|required|matches[new_password]'),
        );
        #PASS THE RULES TO FORM VALIDATION CLASS
        $this->form_validation->set_rules($rules) or die('I didnt set any rules');

        #CHECK IF FORM WAS VALIDATED SUCCESSFULLY
        if ($this->form_validation->run() == TRUE) {
                $fields = array('old_password','new_password','confirm_new_password');
                $data = $this->Accounts_model->array_from_post($fields);

                //CHECK IF SUCH PASSWORD EXISTS
                $where = array('account_password'=>$this->Accounts_model->hash($data['old_password']),'account_number'=>$this->data['current_user_data']->account_number);
                $confirmation_data = $this->Accounts_model->get_by($where,$single = TRUE);

                if (count($confirmation_data)){
                    $update_data = array('account_password'=>$this->Accounts_model->hash($data['new_password']));

                }
                $saved = $this->Accounts_model->save($update_data,$this->data['current_user_data']->id) or die("I did not save data");
                if ($saved){
                    $message = 'Password Changed Successfully';
                    $subject = "User Details Updated on Business Capital Funding";
                    $this->session->set_flashdata('msg',$message);
                }
                else {
                    $this->session->set_flashdata('error','An Error Occured while changing Password');
                }
                redirect('Account/Accounts/password');
        }
        else {
            //echo "I did not validate your rules";
           $this->data['message'] = TRIM(validation_errors()) != FALSE ? getAlertMessage(validation_errors()) : '';
           //redirect('Administrator/Accounts/index');
        }
        $this->data['subview'] = 'Account/Accounts/password_change_page';
        $this->load->view('Account/_layout_main',$this->data);
    }

}