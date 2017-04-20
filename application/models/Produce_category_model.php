<?php

class Produce_category_model extends Core_Model{
    protected $_tablename = 't_produce_category';
    protected $_primary_key = 'id';
    protected $_ordey_by = 'produce_category_name ASC';
    public $rules = array(
        'produce_category_name'=>array('field'=>'produce_category_name','label'=>'Produce Category Name','rules'=>'trim|required|alpha|min_length[3]'),
        );
    function get_new(){
        $std = new stdClass();
        $std->produce_category_name = "";
        return $std;
    }
}
