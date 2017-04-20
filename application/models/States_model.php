<?php

class States_model extends Core_Model{
    protected $_tablename = 't_states';
    protected $_primary_key = 'id';
    protected $_ordey_by = 'state_name ASC';
    public $rules = array(
        'state_name'=>array('field'=>'state_name','label'=>'State Name','rules'=>'trim|required'),
        'country_uniqueid'=>array('field'=>'country_uniqueid','label'=>'Country Name','rules'=>'trim|required'),
        );
    function get_new(){
        $std = new stdClass();
        $std->state_name = "";
        $std->country_uniqueid = "";
        return $std;
    }
}
