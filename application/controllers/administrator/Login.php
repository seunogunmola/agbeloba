<?php
#CLASS HANDLES USER LOGIN ON THE ADMIN END
class Login extends Core_controller{

    function __construct() {
        parent::__construct();
        $this->load->model('Administrator/Login_model');
        $this->load->model('Administrator/Super_user_model');
    }

    function index() {
        #GET VALIDATION RULES FROM MODEL
        $rules = $this->Login_model->rules;
        $this->form_validation->set_rules($rules);
        #VALIDATE USER INPUT
        if($this->form_validation->run() == TRUE){
               $login_status = $this->Super_user_model->login();
               if ($login_status == true) {
                   #USER VERIFIED, REDIRECT TO DASHBOARD
                   redirect('Administrator/Dashboard');
               }
               else {
                   $this->data['message'] = getAlertMessage("Invalid Username/Password, Please Try Again",$type = 'danger');
               }

        }
        else {
            $this->data['message'] = (trim(validation_errors()) == FALSE ? '' : getAlertMessage(validation_errors(),$type = 'danger'));
        }

        #LOAD VIEW
        $this->load->view('Administrator/login_page',$this->data);
    }

    function logout () {
        $this->Super_user_model->logout();
        redirect('Administrator/login');

    }
}
