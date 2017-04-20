<?php

class Admin_controller extends Core_controller {

    function __construct() {
        parent::__construct();
        $this->data['error_message'] = '';
        $this->data['message'] = '';
        #LOAD NEEDED MODELS
        $this->load->model('Administrator/Super_user_model');
        $this->load->model('Countries_model');
        $this->load->model('States_model');
        $this->load->model('Lgas_model');
        $this->load->model('Produce_category_model');
        $this->load->model('Produce_types_model');
        $this->load->model('Farmers_model');
        #CONFIRM IF USER IS LOGGEDIN ELSE REDIRECT TO LOGIN

        if(!in_array( uri_string(), array('Administrator/Login')))
        {
            if (!$this->Super_user_model->loggedin()) {
                redirect('Administrator/Login');
            }
            else{
                @$this->data['current_userid'] = $this->session->userdata('current_user_uniqueid');
            }
        }

         #GET DATATABLE SCRIPT
        $this->getDataTableScripts();
    }


    public function _handleFileUpload($source_file_name,$upload_path){
        if (isset($_FILES[$source_file_name]) && $_FILES[$source_file_name]['size'] > 0) {
            $upload_location = '';
            if (!is_dir($upload_path))
                mkdir ($upload_path, 0777);
                $destination_file_name = mt_rand($min = 0000000000, $max = 999999999);
                @$name = $_FILES[$source_file_name]["name"];
                @$ext = end((explode(".", $name)));
                if ($this->perform_upload($upload_path,$source_file_name,$destination_file_name))
                    {
                        $upload_location = $upload_path.$destination_file_name.".".$ext;
                    }
                else {
                        $this->session->set_flashdata('error',$this->data['upload_error']['error']);
                        echo var_dump($this->data['upload_error']['error']);
                        exit;
                        redirect('Administrator/Students');
                    }
            }
            return $upload_location;
    }




    }



