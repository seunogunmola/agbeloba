<?php

class Account_model extends Schoolcare_Model{
    
	public $_tablename = '';
    public $_primary_key = '';
    public $primary_filter = '';
    protected $_ordey_by = '';

    function __construct(){
        
		parent::__construct();
		
    }

	
   function get_schoolname($schoolid)
	{
		$data["uniqueid"] = $schoolid;
		$this->_tablename = "t_schools";
		$this->_primary_key = "uniqueid";
	  
		$school = $this->get_by($data,true);

		if(!count($school))
		 {
		    return false;				   
		 }
		else
		{
			return $school;
		}
		
	}


}
