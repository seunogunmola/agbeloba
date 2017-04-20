<?php
//THE BASE MODEL HOUSING ALL THE NEEDED CORE METHODS.
class Core_model extends CI_Model {

    protected $_tablename = '';
    protected $_primary_key = '';
    protected $primary_filter = 'intval';
    protected $_ordey_by = '';
    public $rules = '';
    protected $_timestamps = '';

    public $_old_data_model = NULL;
    public $_old_data_stock_field = NULL;
    public $_old_data_key = NULL;

    function __construct() {
        parent::__construct();
    }

    function get( $id = NULL,$single = FALSE) {
        #LITTLE HACK HERE
        #IF A STORE ID EXISTS,FILTER EVERY QUERY WITH THE STOREID
        //IF ID IS NOT NULL THAT MEANS WE ARE RETURNING A SINGLE ROW
        if($id != NULL){
            $filter = $this->primary_filter;
            $this->db->where($this->_primary_key,$id);
            $id = $filter!=""? $filter($id): "";
            $method = 'row';
        }
        // NO ID IS SUPPLIED BUT WE STILL WANT A SINGLE ROW RETURNED
        elseif ($single == TRUE){
            $method ='row';
        }
        //NO ID IS SUPPLIED SHOW ME ALL THE ROWS
        else {
            $method = 'result';
        }

        $this->db->order_by($this->_ordey_by);
        //IF STORES ARE INVOLVED, ALWAYS QUERY WITH STOREID

        return $this->db->get($this->_tablename)->$method();
    }

    function get_by($where,$single = FALSE) {
        $this->db->where($where);
        return $this->get(NULL,$single);
    }
    /*
	public function get_by($where, $single = FALSE){
		$this->db->where($where);
		return $this->get(NULL, $single);
	}
*/
    function save($data,$id = NULL) {
        if($this->_timestamps == TRUE) {
            $now = date('Y-m-d H:i:s');
            $id || $data['datecreated'] = $now;
            $data['datemodified'] = $now;
        }
        //INSERT
        if($id === NULL) {
            !isset($data[$this->_primary_key]) || $data[$this->_primary_key] = NULL;
            $this->db->set($data);
            $this->db->insert($this->_tablename);
            $id = $this->db->insert_id();
        }
        //UPDATE
        else {
            $filter = $this->primary_filter;
            $id = $filter($id);
            $this->db->set($data);
            $this->db->where($this->_primary_key,$id);
            $this->db->update($this->_tablename);
        }
        return $id;
    }

    function delete ($id) {
       $filter = $this->primary_filter;
       $id = $filter($id);
       if (!$id) {
           return FALSE;
       }
       else {
       $this->db->where($this->_primary_key,$id);
       $this->db->limit(1);
       if ($this->db->delete($this->_tablename))
           return TRUE;
       }
    }


    function array_from_post($fields){
        $data = array();
        foreach ($fields as $field) :
            $data[$field] = $this->input->post($field);
        endforeach;

        return $data;
    }
    public function generate_unique_id($len = 5,$fieldname) {
            $source = ""
                    . "012345678901234567890123456789"
                    . "012345678901234567890123456789"
                    . "012345678901234567890123456789";
            $range = strlen($source);
            $output = '';
            for ($i = 0; $i < $len; $i++) {
                $output .= substr($source, rand(0, $range - 1), 1);
            }

            while (count($this->get_by(array($fieldname => $output), true)) > 0) {
                $this->generate_unique_id($len);
            }
            return $output;
        }
    public function hash($stringToBeHashed) {
        return hash('sha1', $stringToBeHashed);
    }
    public function _checkUniqueValue($value,$rowname,$tablename,$id = NULL) {
        $value_status = '';
        if($id != NULL) {
            $this->db->where($this->_primary_key .'!=',$id);
        }
        $value_data = $this->db->where($rowname,$value)->get($tablename);
        $value_data_array = $value_data->result();

        if (count($value_data_array) && $value_data->num_rows() > 0) {
            $value_status = false; #VALUE ALREADY EXISTS
        }
        else {
            $value_status = true; #VALUE DOESNT EXIST
        }
        return $value_status;
    }
    public function _update_ledger($storeid = NULL,$field = NULL,$stockid = NULL,$stockqty = 0,$tablename = "STOCK_LEDGER",$selling_price = NULL) {

        if($stockqty <= 0 || $storeid == NULL || $field == NULL)
        {
            return FALSE;
        }

        $data = array();
        $data['storeid'] = $storeid;
        $data['stock_id'] = $stockid;
        $this->db->where($data);
        $stock_data = $this->db->get($tablename)->row_array();


        //CHECK IF THE STOCK ALREADY HAS AN ENTRY IN THE LEDGER
        if(count($stock_data)){
            #the ledger data already exist ... its an update.
            #check whether addition or subtraction
            $stockLedgerId = $stock_data['id'];
            $stockLedgerUniqueKey = $stock_data['ledger_id'];
            $initial_ledger_stock = $stock_data[$field];

            $update_data = array();
            switch ($this->_operation) {
                case 'add':
                    #if you are adding stock to the current stock
                    $current_stock = $initial_ledger_stock + $stockqty;
                    $update_data[$field] = $current_stock;
                    if ($selling_price != NULL)
                        $update_data['stock_current_price'] = $selling_price;
                    $this->save($update_data, $stockLedgerId);

                    break;

                case 'update':
                    #if you changed an existing stock quantity from one value to another
                    $this->db->where('storeid', $storeid);
                    $this->db->where($this->_old_data_model->_primary_key, $this->_old_data_key);
                    $varData = $this->db->get($this->_old_data_model->_tablename)->row_array();

                    if(count($varData)){
                        #first we need to know the old value you are editing from so make sure its specified
                        $current_stock = $initial_ledger_stock - $varData[$this->_old_data_stock_field];
                        $newval = $current_stock + $stockqty;
                        $update_data[$field] = $newval;
                        if ($selling_price != NULL)
                            $update_data['stock_current_price'] = $selling_price;
                        $this->db->where('ledger_id',$stockLedgerUniqueKey);
                        $this->save($update_data, $stockLedgerId);
                    }


                    //else return FALSE;


                    break;

                case 'subtract':
                    #if you are subtracting stock
                    $current_stock = $initial_ledger_stock - $stockqty;
                    $update_data[$field] = $current_stock;
                    if ($selling_price != NULL)
                        $update_data['stock_current_price'] = $selling_price;
                    $this->db->where('ledger_id',$stockLedgerUniqueKey);
                    $this->save($update_data, $stockLedgerId);
                    break;

                case 'subtracted_update':
                    #if you updated a stock value that is meant to be subtracted or that has been previously
                    #subtracted... eg you subtracted mortality and want to update it

                    $this->db->where('farmid', $farmid);
                    $this->db->where($this->_old_data_model->_primary_key, $this->_old_data_key);
                    $varData = $this->db->get($this->_old_data_model->_table_name)->row_array();

                    if(count($varData)){
                        #first we need to know the old value you are editing from so make sure its specified
                        $current_stock = $initial_ledger_stock + $varData[$this->_old_data_stock_field];
                        $current_stock -= $stockqty;
                        $update_data[$field] = $current_stock;
                        if ($selling_price != NULL)
                            $update_data['stock_current_price'] = $selling_price;
                        $this->save($update_data, $stockLedgerId);
                    }
                    else return FALSE;

                    break;
                default:
                    return FALSE;
            }

        }else{
            #this stock doesnt does not exists thus insert a new record
            $data[$field] = $stockqty;
            if ($selling_price != NULL)
                        $data['stock_current_price'] = $selling_price;
            $data['ledger_id'] = $this->Stock_Ledger_Model->generate_unique_id($len = 10, $fieldname = 'ledger_id');
            $this->Stock_Ledger_Model->Save($data);
        }

        return TRUE;
    }


}
