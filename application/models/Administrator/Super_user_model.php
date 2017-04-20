<?php

class Super_user_model extends Core_model{
    protected $_tablename = 't_admin_users';
    protected $_primary_key = 'id';
    protected $primary_filter = 'intval';
    protected $_ordey_by = 't_admin_users.id ASC';
    public $rules = array(
        'username' => array(
                'field' => 'username',
                'label' => 'username',
                'rules' => 'trim|required'
        ),
        'password' => array(
                'field' => 'password',
                'label' => 'password',
                'rules' => 'trim|required'
        )
        );
    public $rules_admin = array(
        'username' => array(
                'field' => 'username',
                'label' => 'Username',
                'rules' => 'trim|required'
        ),
        'password' => array(
                'field' => 'password',
                'label' => 'Password',
                'rules' => 'trim'
        ),
        'fullname' => array(
                'field' => 'fullname',
                'label' => 'Fullname',
                'rules' => 'trim|required'
        ),
        'email_address' => array(
                'field' => 'email_address',
                'label' => 'Email Address',
                'rules' => 'trim|required'
        ),
        'phone_number' => array(
                'field' => 'phone_number',
                'label' => 'Phone Number',
                'rules' => 'trim|required'
        ),
        );
    function __construct() {
        parent::__construct();
    }

    function Login() {
        $username = $this->input->post('username');
        $password = $this->hash($this->input->post('password'));

        $where = "((username = '$username') OR (email_address = '$username')) AND password = '$password'";
        $user = $this->get_by($where,TRUE);
        if (count($user)) {
            $data = array();

                $data['current_userid']= $user->id;
                $data['current_user_uniqueid']= $user->uniqueid;
                $data['username']= $user->username;
                $data['fullname']= $user->fullname;
                $data['loggedin']= TRUE;


            $this->session->set_userdata($data);
            return true;
        }
        else{
            return false;
        }
    }

    function loggedin() {
        return (bool)$this->session->userdata('loggedin');
    }

    function logout () {
        $this->session->sess_destroy();
    }
    //INITIALISE A NEW USER
    function get_new() {
        $user = new stdClass();
        $user->fullname = '';
        $user->username = '';
        $user->email_address = '';
        $user->phone_number = '';
        $user->password = '';
        $user->status = 1;
        $user->privileges = 'superadmin';

        return $user;
    }



}
