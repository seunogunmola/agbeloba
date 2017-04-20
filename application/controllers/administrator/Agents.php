<?php

class Agents extends Admin_controller{

    function __construct() {
        parent::__construct();
    }

    function index($id=null,$uniqueid = null){
        #GET ADDITIONAL SCRIPTS AND STYLES NEEDED FOR THE VIEW
        $this->getDataTableScripts();
        $this->data['page_level_styles'] .= "<link rel='stylesheet' type='text/css' href='".getResource('js/ios-switch/switchery.css')."' />";
        $this->data['page_level_scripts'] .= "<script src='".getResource('js/ios-switch/switchery.js')."'></script>";
        $this->data['page_level_scripts'] .= "<script src='".getResource('js/ios-switch/ios-init.js')."'></script>";

        #IF ID SUPPLIED IT MEANS WE ARE UPDATING NEW USER
        if($id != NULL) {
            $this->data['agent'] = $this->Agents_Model->get($id);
            count($this->data['agent']) || $this->data['errors'] = 'User not found';
        }
        else {
            $this->data['agent'] = $this->Agents_Model->get_new();
        }

        #LOAD FORM VALIDATION RULES
        $rules = $this->Agents_Model->rules_admin;
        $id || $rules['password']['rules'] .= '|required';

        #PASS THE RULES TO FORM VALIDATION CLASS
        $this->form_validation->set_rules($rules) or die('I didnt set any rules');

        #CHECK IF FORM WAS VALIDATED SUCCESSFULLY
        if ($this->form_validation->run() == TRUE) {
                $fields = array('username','fullname','phone_number','email_address','status','school_id');
                $data = $this->Agents_Model->array_from_post($fields);

                $data['uniqueid'] = $this->Agents_Model->generate_unique_id($len = 10,$fieldname = "uniqueid");
                $data['privileges'] = $this->_handlePrivileges();

                #HASH THE SUPPLIED PASSWORD
                $password = $this->input->post('password');
                if (isset($password) && !empty($password))
                    $data['password'] = $this->Agents_Model->hash($password);
                #WOLLUP! BEFORE YOU INSERT OR UPDATE CHECK IF USERNAME OR EMAIL ALREADY BELONGS TO ANOTHER USER
                $userNameStatus = $this->Agents_Model->_checkUniqueValue($value = $data['username'],$rowname = "username",$tablename = "t_agents",$id = NULL);

                $emailAddressStatus = $this->Agents_Model->_checkUniqueValue($value = $data['email_address'],$rowname = "email_address",$tablename = "t_agents",$id = NULL);
                //USERNAME IS ALREADY TAKEN
                if($userNameStatus == FALSE) {
                    $this->data['message'] = getAlertMessage("Username : <mark> ".$data['username']." </mark> already Exists, Please choose another one");
                }
                elseif ($emailAddressStatus == FALSE)
                {
                    $this->data['message'] = getAlertMessage("Email Address : <mark> ".$data['email_address']." </mark> already Exists, Please choose another one");
                }
                else {
                    $this->Agents_Model->save($data,$id);
                    $this->session->set_flashdata('msg','Agent Added Succesfully');
                    redirect('Administrator/Agents');
                }
        }
        else {
           $this->data['message'] = TRIM(validation_errors()) != FALSE ? getAlertMessage(validation_errors()) : '';
        }
        $this->db->select('t_agents.*,t_schools.school_name');
        $this->db->join('t_schools','t_schools.uniqueid = t_agents.school_id','inner');
        $this->data['agents'] = $this->Agents_Model->get();
        $this->db->order_by('t_schools.school_name ASC');
        $this->data['schools'] = $this->Schools_model->get();
        $this->data['subview'] = 'Administrator/Agents/agents_page';
        $this->load->view('Administrator/_layout_main',$this->data);
    }

    function delete($id) {
        if (isset($id)) {
            $this->Agents_Model->delete($id);
            $this->session->set_flashdata('msg','Agent Deleted Successfully');
            redirect('Administrator/Agents');
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
                $privilege = $this->input->post('all');
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