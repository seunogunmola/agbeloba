<?php

class Login_model extends Core_model {

    protected $_tablename = 't_users';
    protected $_primary_key = 'id';
    protected $primary_filter = 'intval';
    protected $_ordey_by = 'id ASC';
    public $rules = array(
        'username' => array(
                'field' => 'username',
                'label' => 'Username / Email',
                'rules' => 'trim|required'
        ),
        'password' => array(
                'field' => 'password',
                'label' => 'Password',
                'rules' => 'trim|required'
        )
        );

}