<?php

class Lgas_model extends Core_Model{
    protected $_tablename = 't_lgas';
    protected $_primary_key = 'id';
    protected $_ordey_by = 'lga_name ASC';
    public $rules = array(
        'lga_name'=>array('field'=>'lga_name','label'=>'LGA Name','rules'=>'trim|required'),
        'state_uniqueid'=>array('field'=>'state_uniqueid','label'=>'State Name','rules'=>'trim|required'),
        );
    function get_new(){
        $std = new stdClass();
        $std->lga_name = "";
        $std->state_uniqueid = "";
        return $std;
    }
}
