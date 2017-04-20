<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends Core_controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Accounts_model');
        $this->load->model('Referrals_model');
    }
	public function index()
	{
	   $this->load->view('homepage',$this->data);

	}

    function Register($id=null,$hashed_account_number = NULL){
        $this->data['account'] = $this->Accounts_model->get_new();
        $referal_data = array();

        #LOAD FORM VALIDATION RULES
        $rules = $this->Accounts_model->rules;
        #PASS THE RULES TO FORM VALIDATION CLASS
        $this->form_validation->set_rules($rules) or die('I didnt set any rules');
        #CHECK IF FORM WAS VALIDATED SUCCESSFULLY
        if ($this->form_validation->run() == TRUE) {
                $fields = array('account_title','account_surname','account_othernames','account_gender','account_phone_number','account_email_address','account_contact_address','account_nationality','account_state','account_lga','account_bank_name','account_bank_account_name','account_bank_account_number','account_bank_sort_code',
                    'account_referrer_id','account_payment_id','account_payment_name','account_payment_date');
                $data['status'] = NULL;
                $data = $this->Accounts_model->array_from_post($fields);

                if($id == NULL){
                    $data['account_number'] = $this->Accounts_model->generate_unique_id($len = 10,$fieldname = "account_number");
                    $data['account_username'] = $data['account_number'];
                    $data['account_password'] = $this->Accounts_model->hash('code');
                    $data['status'] = 0;
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

                if (isset($_FILES['account_passport']) && $_FILES['account_passport']['size'] > 0) {
                    $data['account_passport'] = $this->_handlePassportUpload();
                }
                else if (!isset($_FILES['account_passport']) && $id ==  NULL){
                    $data['account_passport'] = './resources/uploads/images/accounts_passports/no_image.jpg';
                }
                if(count($referal_data)){
                    $referal_information_saved = $this->Referrals_model->save($referal_data,$referal_id);
                }

                $saved = $this->Accounts_model->save($data,$id) or die("I did not save data");
                if ($saved){
                    $subject = "Business Capital Funding - Registration Details";
                    $message = "<html> <body>"
                            . "<img src = '".getResource('images/login_logo.png')."'"
                            . "<h4>You Business Capital Funding account has been created </h4><br/>"
                            . " <table border = '1'>"
                            . "<tr> <td  width = '50%'> Account Name: </td> <td>".$data['account_surname']. " ".$data['account_othernames']." </td></tr>"
                            . "<tr> <td> Account Number: </td> <td>".$data['account_number']." </td></tr>"
                            . "<tr> <td> Contact Email: </td> <td>".$data['account_email_address']." </td></tr>"
                            . "<tr> <td> Contact Phone: </td> <td>".$data['account_phone_number']." </td></tr>"
                            . "Visit www.learntoliveconsult.com/investment Click LOGIN to login access your account with the account number provided."
                            . "Thank You. "
                            . "BCF Team. "
                            . "</table></body> </html>";
                    $this->sendEmail($subject,$message,$receiver = $data['account_email_address']);
                    //SEND SMS

                    $sms_string = "Your Business Capital Funding has been created \n"
                                . "\n Associate Name : ".$data['account_surname']. " ".$data['account_othernames']
                                . "\n Associate ID : ".$data['account_number']
                                . "\n You can now start referring others with your ID";
                    sendsms($sms_string,$data['account_phone_number']);
                    redirect('Home/success/'.md5($data['account_number']));
                }
                else {
                    $this->session->set_flashdata('error','An Error Occured while creating account');
                }

        }
        else {
            //echo "I did not validate your rules";
           $this->data['message'] = TRIM(validation_errors()) != FALSE ? getAlertMessage(validation_errors()) : '';
           //redirect('Administrator/Accounts/index');
        }
         $this->load->view('web_registration_page',$this->data);

    }




    public function success($hashed_account_number){
        if(!isset($hashed_account_number)){
            redirect('Home');
        }
        else{
            $account_data = $this->Accounts_model->get_by(array('md5(account_number)'=>$hashed_account_number),TRUE);
            if(count($account_data)){
                $this->data['account_data']= $account_data;
                $this->load->view('registration_success_page',$this->data);
            }
            else{
                $this->session->set_flashdata('error','An Error Occurred during your registration, You should try Again');
                redirect('Home/Register');
            }
        }
    }

}
