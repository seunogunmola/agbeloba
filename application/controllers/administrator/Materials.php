<?php

class Materials extends Admin_controller{

    function __construct() {
        parent::__construct();
        $this->load->model('Materials_category_model');
        $this->load->model('Materials_model');
        //$this->load->model('Administrator/Materials_model');
        $this->data['topnav'] = array(
            array('title'=>'Add Course','class'=>'btn-primary','uri'=>'Courses/index'),
            array('title'=>'Add Course','class'=>'btn-success','uri'=>'Courses/index'),
            array('title'=>'Add Course','class'=>'btn-danger','uri'=>'Courses/index'),
            array('title'=>'Add Course','class'=>'btn-warning','uri'=>'Courses/index'),
        );
    }

    function Upload($id=null,$uniqueid=null){
        if($id != NULL) {
            $this->data['material_data'] = $this->Materials_model->get($id);
            count($this->data['material_data']) || $this->data['errors'] = 'User not found';
        }
        else {
            $this->data['material_data'] = $this->Materials_model->get_new();
        }
        #LOAD FORM VALIDATION RULES
        $rules = $this->Materials_model->rules;
        #PASS THE RULES TO FORM VALIDATION CLASS
        $this->form_validation->set_rules($rules) or die('I didnt set any rules');

        #CHECK IF FORM WAS VALIDATED SUCCESSFULLY
        if ($this->form_validation->run() == TRUE) {
                $fields = array('material_category_id','material_name','material_description','material_type','material_status','material_expiry_date');
                $data = $this->Materials_model->array_from_post($fields);
                if($id == NULL){
                    $data['uniqueid'] = $this->Materials_model->generate_unique_id($len = 10,$fieldname = "uniqueid");
                }
                #WOLLUP! BEFORE YOU INSERT OR UPDATE CHECK IF USERNAME OR EMAIL ALREADY BELONGS TO ANOTHER USERS
                $NameStatus = $this->Materials_category_model->_checkUniqueValue($value = $data['material_name'] ,$rowname = 'material_name',$tablename = 't_materials',$id);
                    if($NameStatus == FALSE) { #NAME ALREADY EXISTS
                        $this->data['error_message'] = getAlertMessage($message = "A Course with name : ".$data['material_name']." already exists");
                    }
                else {

                if (isset($_FILES['material_file']) && $_FILES['material_file']['size'] > 0) {
                    $upload_path ='./resources/uploads/materials/';
                    if (!is_dir($upload_path))
                        mkdir ($upload_path, 0777);
                    $source_file_name = 'material_file';
                    $destination_file_name = mt_rand($min = 0000000000, $max = 999999999);
                    @$name = $_FILES[$source_file_name]["name"];
                    @$ext = end((explode(".", $name)));
                    if ($this->perform_upload($upload_path,$source_file_name,$destination_file_name))
                    {
                        $data['material_location'] = $upload_path.$destination_file_name.".".$ext;;
                    }
                    else {
                        $this->session->set_flashdata('error',$this->data['upload_error']['error']);
                        redirect('Administrator/Materials/Upload');
                    }
                }

                    $data['created_by'] = $this->data['current_userid'];
                    if($saved = $this->Materials_model->save($data,$id)){
                        $message = $uniqueid == NULL ? 'Materials Uploaded Succesfully':'Materials Updated Succesfully';
                        $this->session->set_flashdata('msg',$message);
                        redirect('Administrator/Materials/Upload');
                    }
                }
        }
        else {
           $this->data['message'] = TRIM(validation_errors()) != FALSE ? getAlertMessage(validation_errors()) : '';
        }

        $this->db->order_by('material_category_name ASC');
        $this->data['material_categories'] = $this->Materials_category_model->get();
        $this->data['subview'] = 'Administrator/Materials/Materials_page';
        $this->load->view('Administrator/_layout_main',$this->data);
    }

    function View($expired = NULL){
        #GET ADDITIONAL SCRIPTS AND STYLES NEEDED FOR THE VIEW
        $this->getDataTableScripts();
        $this->data['page_level_styles'] .= "<link rel='stylesheet' type='text/css' href='".getResource('js/ios-switch/switchery.css')."' />";
        $this->data['page_level_scripts'] .= "<script src='".getResource('js/ios-switch/switchery.js')."'></script>";
        $this->data['page_level_scripts'] .= "<script src='".getResource('js/ios-switch/ios-init.js')."'></script>";
        $this->db->order_by('t_materials.datecreated DESC');
        $this->db->select('t_materials.*,t_material_categories.material_category_name as category_name');
        $today = date('d-m-Y');

        if($expired != NULL){
            $this->data['viewing_expired'] = TRUE;
            $this->db->where("'$today' > t_materials.material_expiry_date");
        }
        $this->db->join('t_material_categories','t_material_categories.uniqueid = t_materials.material_category_id','left');
        $this->data['existing_materials'] = $this->Materials_model->get();
        $this->data['subview'] = 'Administrator/Materials/View_materials_page';
        $this->load->view('Administrator/_layout_main',$this->data);
    }

    function Categories($id = NULL,$uniqueid = NULL){
        #INITIALISE DATA
        if ($id == NULL) { #NEW
            $this->data['material_category_data'] = $this->Materials_category_model->get_new();
        }
        else {  #EXISTIGN
            $where =array('id'=>$id,'uniqueid'=>$uniqueid);
            $this->data['material_category_data'] = $this->Materials_category_model->get_by($where,$single = TRUE);
        }

        $form_validation_rules = $this->Materials_category_model->rules;
        $this->form_validation->set_rules($form_validation_rules);

        if ($this->form_validation->run() == TRUE){
            $fields = array('material_category_name','material_category_description','status');
            $data = $this->Materials_category_model->array_from_post($fields);


            if ($id == NULL){
                $data['uniqueid'] = $this->Materials_category_model->generate_unique_id($len = 10,$fieldname = "uniqueid");
                $data['created_by'] = $this->data['current_userid'];
            }
            #CHECK UNIQUE COURSE CATEGORY NAME
            $name_status = $this->Materials_category_model->_checkUniqueValue($value = $data['material_category_name'] ,$rowname = 'material_category_name',$tablename = 't_material_categories',$id);
            if($name_status == FALSE) { #NAME ALREADY EXISTS
                $this->data['error_message'] = getAlertMessage($message = "A Category with name : ".$data['material_category_name']." already exists");
            }
            else {
                #PROCEED TO SAVE
                $saved = $this->Materials_category_model->save($data,$id);
                if ($id == NULL)
                { $this->data['message'] = getAlertMessage($message = "Material Category created Successfully",$type = "success");}
                else { $this->data['message'] = getAlertMessage($message = "Material Category Updated Successfully",$type = "success");}
                $this->session->set_flashdata('message',$this->data['message']);
                redirect('Administrator/Materials/Categories');
            }
        }
        else {
            $this->data['message'] = (validation_errors()) ? getAlertMessage($message = validation_errors()) : '';
        }
        $this->db->order_by('material_category_name ASC');
        $this->data['existing_material_categories'] = $this->Materials_category_model->get();
        $this->data['subview'] = 'Administrator/Materials/Materials_category_page';
        $this->load->view('Administrator/_layout_main',$this->data);


    }

    function viewer($material_id) {
        if (!isset($material_id)) {
            redirect('Administrator/Courses');
        }
        else {
            $this->db->where('uniqueid',$material_id);
            $material_data = $this->db->get('t_material_materials')->row();
            if (count($material_data)) {
                $this->data['material_material_name'] = $material_data->material_material_name;
                $this->data['material_location'] = $material_data->material_material_location;
                $this->load->view('Administrator/courses/material_viewer',$this->data);
            }
            else {
                 redirect('Administrator/Courses/View_Material_Materials');
            }

        }
    }

    function Delete_material($id,$uniqueid) {
        if (isset($id) && isset($uniqueid)) {
            $where = array('id'=>$id,'uniqueid'=>$uniqueid);
            $material_data = $this->Materials_model->get_by($where,TRUE);

            if(count($material_data)){
                $file_location = $material_data->material_location;
                $deleted = $this->Materials_model->delete($material_data->id);
                if($deleted){
                    @unlink($file_location);
                    $this->session->set_flashdata('success','Material deleted Successfully');
                }
            }
            else {
                   $this->session->set_flashdata('error','Material not Found... It might have been deleted already');
            }

            redirect('Administrator/Materials/View');
        }
        else{
            redirect('Administrator/Materials/View');
        }
    }

    function Delete_material_category($id,$uniqueid) {
        if (isset($id) && isset($uniqueid)) {
            $where = array('id'=>$id,'uniqueid'=>$uniqueid);
            $material_category_data = $this->Materials_category_model->get_by($where,TRUE);

            if(count($material_category_data)){
                $deleted = $this->Materials_category_model->delete($material_category_data->id);
                if($deleted){
                    //UPDATE CHILDREN MATERIALS
                    $data = array('material_category_id'=>'Uncategorized');
                    $this->db->where('material_category_id',$material_category_data->uniqueid);
                    $this->db->set($data);
                    $this->db->update('t_materials',$data);
                    $this->session->set_flashdata('success','Material Category deleted Successfully');
                }
            }
            else {
                   $this->session->set_flashdata('error','Material not Found... It might have been deleted already');
            }

            redirect('Administrator/Materials/Categories');
        }
        else{
            redirect('Administrator/Materials/Categories');
        }
    }
}