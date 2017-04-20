<?php

class Produce_types_model extends Core_Model{
    protected $_tablename = 't_produce_types';
    protected $_primary_key = 'id';
    protected $_ordey_by = 'produce_type_name ASC';
    public $rules = array(
        'produce_type_name'=>array('field'=>'produce_type_name','label'=>'Produce Type Name','rules'=>'trim|required|alpha|min_length[3]'),
        );
    function get_new(){
        $std = new stdClass();
        $std->produce_type_name = "";
        $std->produce_category_id = "";
        return $std;
    }
}
