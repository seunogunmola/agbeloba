<?php
class Farmers extends Admin_controller{

    function __construct() {
        parent::__construct();
    }

    function Register($id=null){
        #IF ID SUPPLIED IT MEANS WE ARE UPDATING NEW USER
        if($id != NULL) {
            $this->data['farmer'] = $this->Farmers_model->get($id);
            count($this->data['farmer']) || $this->data['errors'] = 'User not found';
        }
        else {
            $this->data['farmer'] = $this->Farmers_model->get_new();
        }
        #LOAD FORM VALIDATION RULES
        $rules = $this->Farmers_model->rules;
        #PASS THE RULES TO FORM VALIDATION CLASS
        $this->form_validation->set_rules($rules) or die('I didnt set any rules');

        #CHECK IF FORM WAS VALIDATED SUCCESSFULLY
        if ($this->form_validation->run() == TRUE) {
                $fields = array('farmername','fullname','phone_number','email_address','status');
                $data = $this->Farmers_model->array_from_post($fields);

                $data['uniqueid'] = $this->Farmers_model->generate_unique_id($len = 10,$fieldname = "uniqueid");
                $data['privileges'] = $this->_handlePrivileges();

                #HASH THE SUPPLIED PASSWORD
                $password = $this->input->post('password');
                if (isset($password) && !empty($password))
                    $data['password'] = $this->Farmers_model->hash($password);
                #WOLLUP! BEFORE YOU INSERT OR UPDATE CHECK IF USERNAME OR EMAIL ALREADY BELONGS TO ANOTHER USER
                $farmerNameStatus = $this->_checkUserName($data['farmername'],$id);

                $emailAddressStatus = $this->_checkEmailAddress($data['email_address'],$id);
                //USERNAME IS ALREADY TAKEN
                if($farmerNameStatus == TRUE) {
                    $this->data['message'] = getAlertMessage("Username : <mark> ".$data['farmername']." </mark> already Exists, Please choose another one");
                }
                elseif ($emailAddressStatus == TRUE)
                {
                    $this->data['message'] = getAlertMessage("Email Address : <mark> ".$data['email_address']." </mark> already Exists, Please choose another one");
                }
                else {
                    $this->Farmers_model->save($data,$id);
                    $this->session->set_flashdata('msg','User Added Succesfully');
                    redirect('Administrator/farmers');
                }
        }
        else {
           $this->data['message'] = TRIM(validation_errors()) != FALSE ? getAlertMessage(validation_errors()) : '';
        }
        $this->data['countries'] = $this->Countries_model->get();
        $this->data['subview'] = 'Administrator/Farmers/farmers_page';
        $this->load->view('Administrator/_layout_main',$this->data);
    }

    function delete($id) {
        if (isset($id)) {
            $this->Farmers_model->delete($id);
            $this->session->set_flashdata('msg','User Deleted Successfully');
            redirect('Administrator/farmers');
        }
    }

    private function _checkUserName($field,$id = NULL) {
        $this->db->where('farmername',$field);
        if ($id != NULL)
             $this->db->where('id !=',$id);
        $farmerNameData = $this->db->get('t_admin_farmers');
        if ($farmerNameData->num_rows() > 0) {

            return TRUE;
        }
        else return FALSE;
    }
    private function _checkEmailAddress($field,$id = NULL) {
        $this->db->where('email_address',$field);
        if ($id != NULL)
             $this->db->where('id !=',$id);
        $farmerNameData = $this->db->get('t_admin_farmers');
        if ($farmerNameData->num_rows() > 0) {

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