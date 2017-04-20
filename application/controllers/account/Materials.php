<?php

class Materials extends Accounts_controller{

    function __construct() {
        parent::__construct();
        $this->load->model('Materials_category_model');
        $this->load->model('Materials_model');
        //$this->load->model('Account/Materials_model');
        $this->data['topnav'] = array(
            array('title'=>'Add Course','class'=>'btn-primary','uri'=>'Courses/index'),
            array('title'=>'Add Course','class'=>'btn-success','uri'=>'Courses/index'),
            array('title'=>'Add Course','class'=>'btn-danger','uri'=>'Courses/index'),
            array('title'=>'Add Course','class'=>'btn-warning','uri'=>'Courses/index'),
        );
    }
  
    function View($expired = NULL){
        #GET ADDITIONAL SCRIPTS AND STYLES NEEDED FOR THE VIEW
        $this->getDataTableScripts();
        $this->data['page_level_styles'] .= "<link rel='stylesheet' type='text/css' href='".getResource('js/ios-switch/switchery.css')."' />";
        $this->data['page_level_scripts'] .= "<script src='".getResource('js/ios-switch/switchery.js')."'></script>";
        $this->data['page_level_scripts'] .= "<script src='".getResource('js/ios-switch/ios-init.js')."'></script>";
        $today = date('d-m-Y');
        $this->db->order_by('t_materials.datecreated DESC');
        $this->db->select('t_materials.*,t_material_categories.material_category_name as category_name');
        $this->db->where("'$today' <= t_materials.material_expiry_date");
        $this->db->join('t_material_categories','t_material_categories.uniqueid = t_materials.material_category_id','left');
        $this->data['existing_materials'] = $this->Materials_model->get();
        $this->data['subview'] = 'Account/Materials/View_materials_page';
        $this->load->view('Account/_layout_main',$this->data);
    }
    function View_category($categoryid){
        #GET ADDITIONAL SCRIPTS AND STYLES NEEDED FOR THE VIEW
        $this->getDataTableScripts();
        $this->data['page_level_styles'] .= "<link rel='stylesheet' type='text/css' href='".getResource('js/ios-switch/switchery.css')."' />";
        $this->data['page_level_scripts'] .= "<script src='".getResource('js/ios-switch/switchery.js')."'></script>";
        $this->data['page_level_scripts'] .= "<script src='".getResource('js/ios-switch/ios-init.js')."'></script>";
        $today = date('d-m-Y');
        $this->db->order_by('t_materials.datecreated DESC');
        $this->db->select('t_materials.*,t_material_categories.material_category_name as category_name');
        $this->db->where('material_category_id',$categoryid);
        $this->db->where("'$today' <= t_materials.material_expiry_date");
        $this->db->join('t_material_categories','t_material_categories.uniqueid = t_materials.material_category_id','left');
        $this->data['existing_materials'] = $this->Materials_model->get();
        $this->data['subview'] = 'Account/Materials/View_materials_category_page';
        $this->load->view('Account/_layout_main',$this->data);
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
                redirect('Account/Materials/Categories');
            }
        }
        else {
            $this->data['message'] = (validation_errors()) ? getAlertMessage($message = validation_errors()) : '';
        }
        $this->db->order_by('material_category_name ASC');
        $this->data['existing_material_categories'] = $this->Materials_category_model->get();
        $this->data['subview'] = 'Account/Materials/Materials_category_page';
        $this->load->view('Account/_layout_main',$this->data);


    }
    function viewer($material_id) {
        if (!isset($material_id)) {
            redirect('Account/Courses');
        }
        else {
            $this->db->where('uniqueid',$material_id);
            $material_data = $this->db->get('t_material_materials')->row();
            if (count($material_data)) {
                $this->data['material_material_name'] = $material_data->material_material_name;
                $this->data['material_location'] = $material_data->material_material_location;
                $this->load->view('Account/courses/material_viewer',$this->data);
            }
            else {
                 redirect('Account/Courses/View_Material_Materials');
            }

        }
    }
}