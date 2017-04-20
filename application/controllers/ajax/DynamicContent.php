<?php
class DynamicContent extends Admin_controller{
    function __construct() {
        parent::__construct();
    }

    function LoadStateWithCountry(){
        $countryid = $this->input->get('countryid');
        if(isset($countryid)){
            //GET STATES
            $where = array('country_uniqueid'=>$countryid);
            $states =$this->States_model->get_by($where,$single = FALSE);
            if(count($states)){
                $states_options = array();
                $states_options[''] = 'Select State';
                foreach($states as $state):
                    $states_options[$state->uniqueid]= $state->state_name;
                endforeach;
                echo form_dropdown('state_id', $states_options, set_value('state_id'), 'class = "form-control" id = "stateid" required = "" onchange = "getLgaDropDown(this.value)"');
            }
            else{
                echo "<div style = 'color:crimson'> No State Found, Please Reload the Page </div>";
            }
        }
        else{
            echo "<div style = 'color:crimson'> An Error Occurred, Please Reload the Page </div>";
        }
    }
    function LoadLgaWithStates(){
        $stateid = $this->input->get('stateid');
        if(isset($stateid)){
            //GET STATES
            $where = array('state_uniqueid'=>$stateid);
            $lgas =$this->Lgas_model->get_by($where,$single = FALSE);
            if(count($lgas)){
                $lga_options = array();
                $lga_options[''] = 'Select LGA';
                foreach($lgas as $lga):
                    $lga_options[$lga->uniqueid]= $lga->lga_name;
                endforeach;
                echo form_dropdown('lga_id', $lga_options, set_value('lga_id'), 'class = "form-control" required = ""');
            }
            else{
                echo "<div style = 'color:crimson'> No LGA Found, Please Reload the Page </div>";
            }
        }
        else{
            echo "<div style = 'color:crimson'> An Error Occurred, Please Reload the Page </div>";
        }
    }
}