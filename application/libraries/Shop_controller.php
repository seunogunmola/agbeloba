<?php

class Shop_controller extends Schoolcare_Controller{

    function __construct(){
        parent::__construct();
        $this->load->model('Item_category_model');
        $this->load->model('Students_model');
        $this->load->model('Items_model');
        $this->load->model('Otp_model');
        $this->load->model('Order_model');
        $this->_getCategories();
        $this->_getPartnerSchools();
        @$customer_session = $this->session->userdata['accountnumber'];
        if(isset($customer_session))
               $this->data['customer_session'] = $customer_session;
    }

    protected function _getCategories(){
        $this->db->order_by('t_item_category.category_name ASC');
        $this->data['categories'] = $this->Item_category_model->get();

    }
    protected function _getPartnerSchools(){
        $this->db->order_by('t_schools.school_name ASC');
        $this->data['partner_schools'] = $this->db->get('t_schools')->result();
    }
    protected function getlatestitems()
    {
        $this->db->order_by('t_items.datecreated DESC');
        $this->db->limit('0 10');
        $latest_items = $this->db->get('t_items')->result();
        if (count($latest_items)) {
            return $latest_items;
        } else {
            return false;
        }
    }
    public function getAllItems($filter_array = NULL)
    {
        if ($filter_array != NULL)
            $this->db->where($filter_array);
        $this->db->order_by('t_items.datecreated DESC');
        $latest_items = $this->db->get('t_items')->result();
        if (count($latest_items)) {
            return $latest_items;
        } else {
            return '';
        }
    }
    public function getitemcategories(){
        $get = $this->db->get('t_item_category')->result();
        if (count($get)) {
            return $get;
        } else {
            return false;
        }
    }
    public function getCategoryName($categoryid){
        $this->db->select('category_name');
        $this->db->where('uniqueid',$categoryid);
        $data = $this->db->get('t_item_category')->row();
        if (count($data)) {
            return $data->category_name;
        } else {
            return false;
        }
    }
}



