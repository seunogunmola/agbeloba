<?php
class Farmers_model extends Core_Model{
    protected $_tablename = 't_farmers';
    protected $_primary_key = 'id';
    protected $_ordey_by = 'surname ASC';
    public $rules = array(
        'surname'=>array('field'=>'surname','label'=>'Surname','rules'=>'trim|required|alpha|min_length[3]'),
        'othernames'=>array('field'=>'othernames','label'=>'Othernames','rules'=>'trim|required|alpha_numeric_spaces|min_length[3]'),
        'email_address'=>array('field'=>'email_address','label'=>'Email Address','rules'=>'trim|alpha|valid_email'),
        'phone_number'=>array('field'=>'phone_number','label'=>'Phone Number','rules'=>'trim|required|numeric|exact_length[11]'),
        'farm_address'=>array('field'=>'farm_address','label'=>'Farm Address','rules'=>'trim|required|alpha_numeric_spaces|min_length[3]'),
        'gps_location'=>array('field'=>'gps_location','label'=>'GPS Location','rules'=>'trim|alpha_numeric_spaces|min_length[3]'),
        'country_id'=>array('field'=>'country_id','label'=>'Country','rules'=>'trim|required|numeric|min_length[3]'),
        'state_id'=>array('field'=>'state_id','label'=>'State','rules'=>'trim|required|numeric|min_length[3]'),
        'lga_id'=>array('field'=>'lga_id','label'=>'LGA','rules'=>'trim|required|numeric|min_length[3]'),
        'produces'=>array('field'=>'produce_type_name','label'=>'Produce Type Name','rules'=>'trim|required'),
        'status'=>array('field'=>'status','label'=>'Status','rules'=>'trim|required|numeric'),
        );
    function get_new(){
        $std = new stdClass();
        $std->passport = "";
        $std->surname = "";
        $std->othernames = "";
        $std->email_address = "";
        $std->phone_number = "";
        $std->farm_address = "";
        $std->gps_location = "";
        $std->country_id = "";
        $std->state_id = "";
        $std->lga_id = "";
        $std->produces = "";
        $std->status = "";
        return $std;
    }
}
