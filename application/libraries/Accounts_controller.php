<?php

class Accounts_controller extends Core_controller {

    function __construct() {

        parent::__construct();
        $this->load->model('Accounts_model');
        $this->load->model('Payments_model');
        $this->load->model('Materials_category_model');

        if(!in_array( uri_string(), array('Account/Login')))
        {
            if (!$this->Accounts_model->loggedin()) {
                redirect('Account/Login');
            }
        }

        @$current_user_data = $this->session->userdata('current_user_details');
        if(isset($current_user_data)){
            $this->data['current_user_data'] = $current_user_data;
            $this->data['current_user_fullname'] = $current_user_data->account_surname.' '.$current_user_data->account_othernames;
        }
        $this->data['unlock_count'] = config_item('unlock_count');

        $this->data['materials_category'] = $this->getMaterialsCategory();
    }


    function getMaterialsCategory(){
        $this->db->order_by('material_category_name ASC');
        $materials_data = $this->Materials_category_model->get();
        if(count($materials_data)){
            return $materials_data;
        }

    }

}
