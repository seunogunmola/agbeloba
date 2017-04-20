<?php
#CLASS HANDLES USER LOGIN ON THE ADMIN END
class Login extends Accounts_controller{

    function __construct() {
        parent::__construct();
        $this->load->model('Accounts_model');
    }

    function index() {
        #GET VALIDATION RULES FROM MODEL
        $rules = $this->Accounts_model->login_rules;
        $this->form_validation->set_rules($rules);

        #VALIDATE USER INPUT
        if($this->form_validation->run() == TRUE){
               $login_status = $this->Accounts_model->login();
               if ($login_status == "Disabled") {
                   $this->data['message'] = getAlertMessage("Your Account is currently disabled. Awaiting Authorization from the System Admin",$type = 'danger');
                                
               }
               else if($login_status == "Enabled"){
                   #USER VERIFIED, REDIRECT TO DASHBOARD
                    redirect('Account/dashboard');
               }
               else {
                   $this->data['message'] = getAlertMessage("Invalid Username/Password, Please Try Again",$type = 'danger');
               }
        }
        else {
            $this->data['message'] = (trim(validation_errors()) == FALSE ? '' : getAlertMessage(validation_errors(),$type = 'danger'));
        }

        #LOAD VIEW
        $this->load->view('Account/login_page',$this->data);
    }

    function logout () {
        $this->Accounts_model->logout();
        redirect('Account/login');

    }
}
