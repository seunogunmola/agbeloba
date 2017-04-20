<?php

class Produce extends Admin_controller{
    function __construct() {
        parent::__construct();
    }
    function Types($uniqueid = NULL, $delete = FALSE){
        $id = NULL;
        if ($delete != 1){
            #IF ID SUPPLIED IT MEANS WE ARE UPDATING
            if($uniqueid != NULL) {
                $this->data['produce_type'] = $this->Produce_types_model->get_by($where = array('uniqueid'=>$uniqueid),$single = TRUE);
                $id = $this->data['produce_type']->id;
                count($this->data['produce_type']) || $this->data['errors'] = 'Data not found';
            }
            else {
                $this->data['produce_type'] = $this->Produce_types_model->get_new();
            }
            #LOAD FORM VALIDATION RULES
            $rules = $this->Produce_types_model->rules;
            #PASS THE RULES TO FORM VALIDATION CLASS
            $this->form_validation->set_rules($rules) or die('I didnt set any rules');
            if ($this->form_validation->run() == TRUE) {
                    $fields = array('produce_type_name','produce_category_id');
                    $data = $this->Produce_types_model->array_from_post($fields);
                    if ($id == NULL)
                    {
                        $data['uniqueid'] = $this->Produce_types_model->generate_unique_id($len = 10,$fieldname = "uniqueid");
                    }
                    $produce_type_name_status = $this->Produce_types_model->_checkUniqueValue($value = $data['produce_type_name'],$rowname = 'produce_type_name',$tablename = 't_produce_types',$id);
                    if ($produce_type_name_status == false)
                    {
                        $this->data['message'] = getAlertMessage("Produce Type name: <mark> ".$data['produce_type_name']." </mark> already Exists, Please choose another one");
                    }
                    else {
                            $data['createdby']= $this->data['current_userid'];
                            $this->Produce_types_model->save($data,$id);
                            $this->session->set_flashdata('success','Produce Type Saved Succesfully');
                            redirect('Administrator/Produce/Types');
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
                $delete_details = $this->Produce_types_model->get_by($where = array('uniqueid'=>$uniqueid),$single = TRUE);
                if (count($delete_details)){
                    //DELETE RECURSIVELY
                    $deleted = $this->Produce_types_model->delete($delete_details->id);
                    if ($deleted) {
                        $this->session->set_flashdata('success','Produce Type Deleted Successfully');
                        redirect('Administrator/Produce/Types');
                    }
                    else {
                                    $this->session->set_flashdata('error','An Error Occured while deleting,please try again');
                                    redirect('Administrator/Produce/Types');
                    }
                }
                else {
                        $this->session->set_flashdata('error','Data not Found');
                        redirect('Administrator/Produce/Types');
                }

            }
        }
        #GET ADDITIONAL SCRIPTS AND STYLES NEEDED FOR THE VIEW
        $this->getDataTableScripts();
        //GET EXISTING PRODUCE CATEGORIES
        $this->data['produce_categories'] = $this->Produce_category_model->get();

        //GET EXISTING PRODUCE TYPES
        $this->data['produce_types'] = $this->Produce_types_model->get();
        $this->data['subview'] = 'Administrator/Produce/Produce_type_page';
        $this->load->view('Administrator/_layout_main',$this->data);
    }

    function Categories($uniqueid = NULL, $delete = FALSE){
        $id = NULL;
        if ($delete != 1){
            #IF ID SUPPLIED IT MEANS WE ARE UPDATING
            if($uniqueid != NULL) {
                $this->data['produce_category'] = $this->Produce_category_model->get_by($where = array('uniqueid'=>$uniqueid),$single = TRUE);
                $id = $this->data['produce_category']->id;
                count($this->data['produce_category']) || $this->data['errors'] = 'Data not found';
            }
            else {
                $this->data['produce_category'] = $this->Produce_category_model->get_new();
            }
            #LOAD FORM VALIDATION RULES
            $rules = $this->Produce_category_model->rules;
            #PASS THE RULES TO FORM VALIDATION CLASS
            $this->form_validation->set_rules($rules) or die('I didnt set any rules');
            if ($this->form_validation->run() == TRUE) {
                    $fields = array('produce_category_name');
                    $data = $this->Produce_category_model->array_from_post($fields);
                    if ($id == NULL)
                    {
                        $data['uniqueid'] = $this->Produce_category_model->generate_unique_id($len = 10,$fieldname = "uniqueid");
                    }
                    $produce_category_name_status = $this->Produce_category_model->_checkUniqueValue($value = $data['produce_category_name'],$rowname = 'produce_category_name',$tablename = 't_produce_category',$id);
                    if ($produce_category_name_status == false)
                    {
                        $this->data['message'] = getAlertMessage("Produce Category name: <mark> ".$data['produce_category_name']." </mark> already Exists, Please choose another one");
                    }
                    else {
                            $data['createdby']= $this->data['current_userid'];
                            $this->Produce_category_model->save($data,$id);
                            $this->session->set_flashdata('success','Produce Category Saved Succesfully');
                            redirect('Administrator/Produce/Categories');
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
                //CHECK IF CATEGORY HAS PRODUCE ATTACHED TO IT
                $_has_children = FALSE;
                if($_has_children == TRUE){
                    $this->session->set_flashdata('error','Category Already has Produce Attached to it, You cannot delete it');
                    redirect('Administrator/Produce/Categories');
                }
                else{
                    //GET DELETE DATA
                       $delete_details = $this->Produce_category_model->get_by($where = array('uniqueid'=>$uniqueid),$single = TRUE);
                       if (count($delete_details)){
                           //DELETE RECURSIVELY
                           $deleted = $this->Produce_category_model->delete($delete_details->id);
                           if ($deleted) {
                               $this->session->set_flashdata('success','Produce Category Deleted Successfully');
                               redirect('Administrator/Produce/Categories');
                           }
                           else {
                                           $this->session->set_flashdata('error','An Error Occured while deleting,please try again');
                                           redirect('Administrator/Produce/Categories');
                           }
                       }
                       else {
                               $this->session->set_flashdata('error','Data not Found');
                               redirect('Administrator/Produce/Categories');
                       }
                    }
            }
        }
        #GET ADDITIONAL SCRIPTS AND STYLES NEEDED FOR THE VIEW
        $this->getDataTableScripts();
        //GET EXISITING PRODUCE CATEGORIES
        $this->data['produce_categories'] = $this->Produce_category_model->get();
        $this->data['subview'] = 'Administrator/Produce/Produce_category_page';
        $this->load->view('Administrator/_layout_main',$this->data);
    }
}