<?php

class Enquiries extends Admin_controller{

    function __construct() {
        parent::__construct();
        $this->load->model('Enquiries_model');
    }

    function index(){
        $this->db->order_by('date_sent ASC, status ASC');
        $this->data['enquiries'] = $this->Enquiries_model->get();
        #LOAD VIEW
        $this->data['subview'] = 'Administrator/Enquiries/enquiries_page';
        $this->load->view('Administrator/_layout_main',$this->data);
    }
    function read($id){
        if (isset($id)){
            $this->data['enquiry'] = $this->Enquiries_model->get($id);
            if (!count($this->data['enquiry'])){
                redirect('Administrator/Enquiries');
            }
            else {
                #LOAD VIEW
                $this->data['subview'] = 'Administrator/Enquiries/read_enquiries_page';
                $this->load->view('Administrator/_layout_main',$this->data);
            }
        }
        else {
            redirect('Administrator/Enquiries');
        }
    }
    function MarkReadMessage($id){
        if (isset($id)){
            $this->data['enquiry'] = $this->Enquiries_model->get($id);
            if (!count($this->data['enquiry'])){
                redirect('Administrator/Enquiries');
            }
            else {
                 $data = array('status'=>1);
                 $this->db->where('id',$id);
                 $this->db->set($data);
                 $marked = $this->db->update('t_enquiries');
                 if ($marked){
                     redirect('Administrator/Enquiries');
                 }

            }
        }
        else {
            redirect('Administrator/Enquiries');
        }
    }


    function delete($id) {
        if (isset($id)) {
            $this->Enquiries_model->delete($id);
            $this->session->set_flashdata('msg','Enquiry Deleted Successfully');
            redirect('administrator/enquiries');
        }
    }


}