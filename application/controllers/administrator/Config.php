<?php

class Config extends Admin_controller{
    function __construct() {
        parent::__construct();
    }
    function Countries($uniqueid = NULL, $delete = FALSE){
        $id = NULL;
        if ($delete != 1){
            #IF ID SUPPLIED IT MEANS WE ARE UPDATING
            if($uniqueid != NULL) {
                $this->data['country'] = $this->Countries_model->get_by($where = array('uniqueid'=>$uniqueid),$single = TRUE);
                $id = $this->data['country']->id;
                count($this->data['country']) || $this->data['errors'] = 'Data not found';
            }
            else {
                $this->data['country'] = $this->Countries_model->get_new();
            }
            #LOAD FORM VALIDATION RULES
            $rules = $this->Countries_model->rules;
            #PASS THE RULES TO FORM VALIDATION CLASS
            $this->form_validation->set_rules($rules) or die('I didnt set any rules');
            if ($this->form_validation->run() == TRUE) {
                    $fields = array('country_name','country_code');
                    $data = $this->Countries_model->array_from_post($fields);
                    if ($id == NULL)
                    {
                        $data['uniqueid'] = $this->Countries_model->generate_unique_id($len = 10,$fieldname = "uniqueid");
                    }

                    $country_name_status = $this->Countries_model->_checkUniqueValue($value = $data['country_name'],$rowname = 'country_name',$tablename = 't_countries',$id);
                    if ($country_name_status == false)
                    {
                        $this->data['message'] = getAlertMessage("Country name: <mark> ".$data['country_name']." </mark> already Exists, Please choose another one");
                    }
                    else {
                            $data['createdby']= $this->data['current_userid'];
                            $this->Countries_model->save($data,$id);
                            $this->session->set_flashdata('success','Country Saved Succesfully');
                            redirect('Administrator/Config/Countries');
                    }
            }
            else {
                 $this->data['message'] = TRIM(validation_errors()) != FALSE ? getAlertMessage(validation_errors()) : '';
            }
        }
        //DELETE
        else{
            //CHECK IF ID IS SUPPLIED
            if (!empty($uniqueid)) {
             //GET DELETE DATA
                $delete_details = $this->Countries_model->get_by($where = array('uniqueid'=>$uniqueid),$single = TRUE);
                if (count($delete_details)){
                    //DELETE RECURSIVELY
                    $deleted = $this->Countries_model->delete($delete_details->id);
                    if ($deleted) {
                        $this->session->set_flashdata('success','Country Deleted Successfully');
                        redirect('Administrator/Config/Countries');
                    }
                    else {
                                    $this->session->set_flashdata('error','An Error Occured while deleting,please try again');
                                    redirect('Administrator/Config/Countries');
                    }
                }
                else {
                        $this->session->set_flashdata('error','Data not Found');
                        redirect('Administrator/Config/Countries');
                }

            }
        }
                    #GET ADDITIONAL SCRIPTS AND STYLES NEEDED FOR THE VIEW
        $this->getDataTableScripts();
        $this->data['countries'] = $this->Countries_model->get();
        $this->data['subview'] = 'Administrator/Config/Countries_page';
        $this->load->view('Administrator/_layout_main',$this->data);
    }
    function States($uniqueid = NULL, $delete = FALSE){
        $id = NULL;
        if ($delete != 1){
            #IF ID SUPPLIED IT MEANS WE ARE UPDATING
            if($uniqueid != NULL) {
                $this->data['state'] = $this->States_model->get_by($where = array('uniqueid'=>$uniqueid),$single = TRUE);
                $id = $this->data['state']->id;
                count($this->data['state']) || $this->data['errors'] = 'Data not found';
            }
            else {
                $this->data['state'] = $this->States_model->get_new();
            }
            #LOAD FORM VALIDATION RULES
            $rules = $this->States_model->rules;
            #PASS THE RULES TO FORM VALIDATION CLASS
            $this->form_validation->set_rules($rules) or die('I didnt set any rules');
            if ($this->form_validation->run() == TRUE) {
                    $fields = array('state_name','country_uniqueid');
                    $data = $this->States_model->array_from_post($fields);
                    if ($id == NULL)
                    {
                        $data['uniqueid'] = $this->States_model->generate_unique_id($len = 10,$fieldname = "uniqueid");
                    }

                    $state_name_status = $this->States_model->_checkUniqueValue($value = $data['state_name'],$rowname = 'state_name',$tablename = 't_states',$id);
                    if ($state_name_status == false)
                    {
                        $this->data['message'] = getAlertMessage("State name: <mark> ".$data['state_name']." </mark> already Exists, Please choose another one");
                    }
                    else {
                            $data['createdby']= $this->data['current_userid'];
                            $this->States_model->save($data,$id);
                            $this->session->set_flashdata('success','State Saved Succesfully');
                            redirect('Administrator/Config/States');
                    }
            }
            else {
                 $this->data['message'] = TRIM(validation_errors()) != FALSE ? getAlertMessage(validation_errors()) : '';
            }
        }
        //DELETE
        else{
            //CHECK IF ID IS SUPPLIED
            if (!empty($uniqueid)) {
             //GET DELETE DATA
                $delete_details = $this->States_model->get_by($where = array('uniqueid'=>$uniqueid),$single = TRUE);
                if (count($delete_details)){
                    //DELETE RECURSIVELY
                    $deleted = $this->States_model->delete($delete_details->id);
                    if ($deleted) {
                        $this->session->set_flashdata('success','State Deleted Successfully');
                        redirect('Administrator/Config/States');
                    }
                    else {
                                    $this->session->set_flashdata('error','An Error Occured while deleting,please try again');
                                    redirect('Administrator/Config/States');
                    }
                }
                else {
                        $this->session->set_flashdata('error','Data not Found');
                        redirect('Administrator/Config/States');
                }

            }
        }
        #GET ADDITIONAL SCRIPTS AND STYLES NEEDED FOR THE VIEW
        $this->getDataTableScripts();
        $this->data['countries'] = $this->Countries_model->get();
        $this->db->select('t_states.*');
        $this->db->select('t_countries.country_name');
        $this->db->join('t_countries','t_countries.uniqueid = t_states.country_uniqueid','inner');
        $this->data['states'] = $this->States_model->get();
        $this->data['subview'] = 'Administrator/Config/States_page';
        $this->load->view('Administrator/_layout_main',$this->data);
    }
    function Lgas($uniqueid = NULL, $delete = FALSE){
        $id = NULL;
        if ($delete != 1){
            #IF ID SUPPLIED IT MEANS WE ARE UPDATING
            if($uniqueid != NULL) {
                $this->data['lga'] = $this->Lgas_model->get_by($where = array('uniqueid'=>$uniqueid),$single = TRUE);
                $id = $this->data['lga']->id;
                count($this->data['lga']) || $this->data['errors'] = 'Data not found';
            }
            else {
                $this->data['lga'] = $this->Lgas_model->get_new();
            }
            #LOAD FORM VALIDATION RULES
            $rules = $this->Lgas_model->rules;
            #PASS THE RULES TO FORM VALIDATION CLASS
            $this->form_validation->set_rules($rules) or die('I didnt set any rules');
            if ($this->form_validation->run() == TRUE) {
                    $fields = array('lga_name','state_uniqueid');
                    $data = $this->Lgas_model->array_from_post($fields);
                    if ($id == NULL)
                    {
                        $data['uniqueid'] = $this->Lgas_model->generate_unique_id($len = 10,$fieldname = "uniqueid");
                    }
                    $lga_name_status = $this->Lgas_model->_checkUniqueValue($value = $data['lga_name'],$rowname = 'lga_name',$tablename = 't_lgas',$id);
                    if ($lga_name_status == false)
                    {
                        $this->data['message'] = getAlertMessage("LGA name: <mark> ".$data['lga_name']." </mark> already Exists, Please choose another one");
                    }
                    else {
                            $data['createdby']= $this->data['current_userid'];
                            $this->Lgas_model->save($data,$id);
                            $this->session->set_flashdata('success','LGA Saved Succesfully');
                            redirect('Administrator/Config/Lgas');
                    }
            }
            else {
                 $this->data['message'] = TRIM(validation_errors()) != FALSE ? getAlertMessage(validation_errors()) : '';
            }
        }
        //DELETE
        else{
            //CHECK IF ID IS SUPPLIED
            if (!empty($uniqueid)) {
             //GET DELETE DATA
                $delete_details = $this->Lgas_model->get_by($where = array('uniqueid'=>$uniqueid),$single = TRUE);
                if (count($delete_details)){
                    //DELETE RECURSIVELY
                    $deleted = $this->Lgas_model->delete($delete_details->id);
                    if ($deleted) {
                        $this->session->set_flashdata('success','LGA Deleted Successfully');
                        redirect('Administrator/Config/Lgas');
                    }
                    else {
                                    $this->session->set_flashdata('error','An Error Occured while deleting,please try again');
                                    redirect('Administrator/Config/Lgas');
                    }
                }
                else {
                        $this->session->set_flashdata('error','Data not Found');
                        redirect('Administrator/Config/Lgas');
                }
            }
        }

        //GET STATES FOR DROP DOWN
        $this->db->order_by('state_name ASC');
        $this->data['states'] = $this->States_model->get();
        //GET EXISTING LGAS
        $this->getDataTableScripts();
        $this->db->select('t_lgas.*');
        $this->db->select('t_states.state_name');
        $this->db->join('t_states','t_lgas.state_uniqueid = t_states.uniqueid','inner');
        $this->data['lgas'] = $this->Lgas_model->get();
        $this->data['subview'] = 'Administrator/Config/Lgas_page';
        $this->load->view('Administrator/_layout_main',$this->data);
    }


}