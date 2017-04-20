<?php

class Agent_controller extends Schoolcare_controller {

    function __construct() {
        parent::__construct();

        //$this->_is_admin();

        $this->data['error_message'] = '';
        $this->data['message'] = '';
        #LOAD NEEDED MODELS
        $this->load->model('Schools_model');
        $this->load->model('Students_model');
        $this->load->model('Incoming_Transactions_Model');
        $this->load->model('Outgoing_Transactions_Model');
        $this->load->model('Communication_model');
        $this->load->model('Reports_model');
        $this->load->model('Agents_Model');
        #CONFIRM IF USER IS LOGGEDIN ELSE REDIRECT TO LOGIN

        if(!in_array( uri_string(), array('Agent/Login')))
        {
            if (!$this->Agents_Model->loggedin()) {
                redirect('Agent/Login');
            }
        }

        @$this->data['agent_data'] = $agent_data = $this->session->userdata();
        @$this->data['agent_data']['schoolname'] = $this->_getSchoolName($agent_data['agent_schoolid']);
        $privileges = $agent_data['agent_privileges'];
        $privileges = explode('-', $privileges);
        if(isset($privileges)){
            $privilege_array = array();
            foreach ($privileges as $privilege):
                $privilege_array[] = $privilege;
            endforeach;
            $this->data['agent_privileges'] = $privilege_array;
        }
         #GET DATATABLE SCRIPT
        $this->getDataTableScripts();
    }

        public function perform_upload($upload_path,$source_file_name,$destination_file_name)
        {
            #sourcefilename = the name you gave the uploaded file in the form
            #destinationfilename = the name you want to give the uploaded file in the destination
            #upload path = the directory you wish to upload the file to
            if (!empty($_FILES[$source_file_name]['name'])) {
                $config['file_name']          = $destination_file_name;
                $config['upload_path']          = $upload_path;
                $config['allowed_types']        = 'gif|jpg|png|doc|docx|pdf|exe|zip';
                $config['max_size']             = 10240;
                $config['max_width']            = 1024;
                $config['max_height']           = 768;

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

    public function _getSchoolName($schoolid){
        $this->db->select('school_name');
        $this->db->where('uniqueid',$schoolid);
        $this->db->where('uniqueid',$schoolid);
        $data = $this->db->get('t_schools')->row();
        if(count($data))
        {
            return $data->school_name;
        }
        else{
            return false;
        }
    }



    public function _getStudents(){
        $this->db->where('t_students.school_id',$this->data['agent_data']['schoolid']);
        $this->db->order_by('t_students.surname ASC');
        $students_data = $this->Students_model->get();
        if (count($students_data)){
            return $students_data;
        }
        else {
            return false;
        }
    }
}



