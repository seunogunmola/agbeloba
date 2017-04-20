<?php

class Users extends Admin_controller{

    function __construct() {
        parent::__construct();
    }

    function index($id=null){
        #GET ADDITIONAL SCRIPTS AND STYLES NEEDED FOR THE VIEW
        $this->getDataTableScripts();
        $this->data['page_level_styles'] .= "<link rel='stylesheet' type='text/css' href='".getResource('js/ios-switch/switchery.css')."' />";
        $this->data['page_level_scripts'] .= "<script src='".getResource('js/ios-switch/switchery.js')."'></script>";
        $this->data['page_level_scripts'] .= "<script src='".getResource('js/ios-switch/ios-init.js')."'></script>";

        #IF ID SUPPLIED IT MEANS WE ARE UPDATING NEW USER
        if($id != NULL) {
            $this->data['user'] = $this->Super_user_model->get($id);
            count($this->data['user']) || $this->data['errors'] = 'User not found';
        }
        else {
            $this->data['user'] = $this->Super_user_model->get_new();
        }

        #LOAD FORM VALIDATION RULES
        $rules = $this->Super_user_model->rules_admin;
        $id || $rules['password']['rules'] .= '|required';

        #PASS THE RULES TO FORM VALIDATION CLASS
        $this->form_validation->set_rules($rules) or die('I didnt set any rules');

        #CHECK IF FORM WAS VALIDATED SUCCESSFULLY
        if ($this->form_validation->run() == TRUE) {
                $fields = array('username','fullname','phone_number','email_address','status');
                $data = $this->Super_user_model->array_from_post($fields);

                $data['uniqueid'] = $this->Super_user_model->generate_unique_id($len = 10,$fieldname = "uniqueid");
                $data['privileges'] = $this->_handlePrivileges();

                #HASH THE SUPPLIED PASSWORD
                $password = $this->input->post('password');
                if (isset($password) && !empty($password))
                    $data['password'] = $this->Super_user_model->hash($password);
                #WOLLUP! BEFORE YOU INSERT OR UPDATE CHECK IF USERNAME OR EMAIL ALREADY BELONGS TO ANOTHER USER
                $userNameStatus = $this->_checkUserName($data['username'],$id);

                $emailAddressStatus = $this->_checkEmailAddress($data['email_address'],$id);
                //USERNAME IS ALREADY TAKEN
                if($userNameStatus == TRUE) {
                    $this->data['message'] = getAlertMessage("Username : <mark> ".$data['username']." </mark> already Exists, Please choose another one");
                }
                elseif ($emailAddressStatus == TRUE)
                {
                    $this->data['message'] = getAlertMessage("Email Address : <mark> ".$data['email_address']." </mark> already Exists, Please choose another one");
                }
                else {
                    $this->Super_user_model->save($data,$id);
                    $this->session->set_flashdata('msg','User Added Succesfully');
                    redirect('Administrator/users');
                }
        }
        else {
           $this->data['message'] = TRIM(validation_errors()) != FALSE ? getAlertMessage(validation_errors()) : '';
        }
        $this->data['users'] = $this->Super_user_model->get();
        $this->data['subview'] = 'Administrator/users_page';
        $this->load->view('Administrator/_layout_main',$this->data);
    }

    function delete($id) {
        if (isset($id)) {
            $this->Super_user_model->delete($id);
            $this->session->set_flashdata('msg','User Deleted Successfully');
            redirect('Administrator/users');
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

    private function _handlePrivileges(){
                $privilege = $this->input->post('superadmin');
                if (strtoupper($privilege) == 'ON') {
                    $privilege = 'superadmin';
                }
                else {
                    $other_privileges = "";
                    foreach ( $this->input->post('privileges') as $value):
                        $other_privileges.=$value.'-';
                    endforeach;
                    $privilege = $other_privileges;
                }

                return rtrim($privilege,'-');
    }

}