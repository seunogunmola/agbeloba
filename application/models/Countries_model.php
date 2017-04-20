<?php

class Countries_model extends Core_Model{
    protected $_tablename = 't_countries';
    protected $_primary_key = 'id';
    protected $_ordey_by = 'country_name ASC';
    public $rules = array(
        'country_name'=>array('field'=>'country_name','label'=>'Country Name','rules'=>'trim|required'),
        'country_code'=>array('field'=>'country_code','label'=>'Country Code','rules'=>'trim|required|numeric'),
        );
    function get_new(){
        $std = new stdClass();
        $std->country_name = "";
        $std->country_code = "";
        return $std;
    }
}
