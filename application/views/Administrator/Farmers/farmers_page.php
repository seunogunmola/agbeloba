<body class="sticky-header">
    <section>
        <div class="main-content" >
            <div class="page-heading">
                <h3>
                    Manage Farmers
                </h3>
                <a id = "add_users"></a>
                <ul class="breadcrumb">
                    <li>
                        <a href="#">Manage Farmers</a>
                    </li>
                    <li class="active"> <a href="#existing_users"> View All Farmers </a></li>
                </ul>
            </div>
            <!-- page heading end-->
            <!--body wrapper start-->

            <div class="wrapper">
                <div class="row">
                    <div class="col-md-12">
                        <?php echo $this->session->flashdata('msg') ? getAlertMessage($this->session->flashdata('msg'), 'info') : '' ?>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <?php echo!empty($farmer->surname) ? '<i class = "fa fa-edit"></i> Editing Farmer : ' . $farmer->surname : '<i class = "fa fa-plus"></i> Add New Farmer' ?>
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    <?php echo $message ?>
                                    <?php echo form_open('') ?>
                                    <div class="col-lg-6">
                                        <h3>Bio Data</h3>

                                        <div class="col-md-12" style="padding:1em">
                                                <label>Farmer Passport</label>
                                                <i> Only.Jpeg format allowed : Maximum Allowed Size : 100kb</i>
                                                <div class="fileupload fileupload-new" data-provides="fileupload">
                                                    <div class="fileupload-preview thumbnail col-md-6" style="max-width:150px; border:0px;"><img width="100px" src="<?php echo!empty($farmer->passport) ? base_url($farmer->passport) : base_url('resources/images/noimage.jpg') ?>" /></div>
                                                    <div class="col-md-6" >
                                                        <span class="btn btn-success col-lg-8">
                                                            <input type="file"  name="passport"  />
                                                        </span>
                                                        <a href="#" class="btn btn-danger fileupload-exists pull-right col-lg-4" data-dismiss="fileupload">Remove</a>
                                                    </div>

                                                </div>
                                            </div>
                                        <div class="form-group">
                                            <label>Surname</label>
                                            <input class="form-control"  name = "surname" type = "text" placeholder="Enter Farmer's Surname" value = "<?php echo set_value('surname', $farmer->surname) ?>">
                                        </div>
                                        <div class="form-group">
                                            <label>Othernames</label>
                                            <input class="form-control"  name = "othernames" type = "text" placeholder="Enter Farmer's Othernames" value = "<?php echo set_value('othernames', $farmer->othernames) ?>">
                                        </div>
                                        <div class="form-group">
                                            <label>Phone Number</label>
                                            <input class="form-control" name = "phone_number" type = "text" placeholder="Enter Farmer's Phone Number" required="" value = "<?php echo set_value('phone_number', $farmer->phone_number) ?>">
                                        </div>
                                        <div class="form-group">
                                            <label>Email Address</label>
                                            <input class="form-control" name = "email_address" type = "text" placeholder="Enter Farmer's email Address" value = "<?php echo set_value('email_address', $farmer->email_address) ?>">
                                        </div>
                                </div>
                                <div class="col-lg-6">
                                    <h3>Location and Address</h3>
                                    <div class="form-group">
                                        <label>Country</label>
                                        <?php
                                        if(isset($countries) && !empty($countries)){
                                            $country_options = array();
                                            $country_options[''] = 'Select Farmer Country';
                                            foreach($countries as $country):
                                                $country_options[$country->uniqueid] = $country->country_name;
                                            endforeach;
                                            echo form_dropdown('country_id', $country_options, set_value('country_id', $farmer->status), 'required = "" class = "form-control"  onchange = "getStateDropDown(this.value)"');
                                        }
                                        else {
                                            echo getAlertMessage($message = "No Country Found. You need to Setup Countries before creating States \n <br/> <a href =". site_url('Administrator/Config/Countries')."> <button class = 'btn btn-primary'> Click Here to Create a Country </button> </a>", $type = "danger");
                                        }

                                        ?>
                                    </div>
                                    <div class="form-group">
                                        <label>State</label>
                                        <div id="state_dropdown">
                                            <select class="form-control">
                                                <option>Select Country to Load State</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>LGA</label>
                                        <div id="lga_dropdown">
                                            <select class="form-control">
                                                <option>Select Country and State to Load LGA</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Farm Address</label>
                                        <textarea class="form-control" required=""><?php echo set_value('farm_address'); ?></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>G.P.S. Location (Optional)</label>
                                        <textarea class="form-control"><?php echo set_value('gps_location '); ?></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Status</label>
                                        <?php
                                        $options = array('1' => 'Enabled',
                                            '2' => 'Disabled');
                                        echo form_dropdown('status', $options, set_value('status', $farmer->status), 'class = "form-control"')
                                        ?>
                                    </div>

                                    <button type="submit" class="btn btn-primary"><?php echo!empty($farmer->username) ? '<i class = "fa fa-edit"></i> Update Farmer' : '<i class = "fa fa-plus"></i> Add Farmer'; ?></button>
                                    <button type="reset" class="btn btn-danger">Reset</button>
                                </div>


<?php echo form_close(); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script type="text/javascript">
            function getStateDropDown(countryid){
                $('#state_dropdown').html("<span style = 'color:crimson'> Loading States... </span>");
                request_url= "<?php echo site_url('ajax/DynamicContent/LoadStateWithCountry?&countryid=') ?>" + countryid;
                $.ajax({url:request_url,
                success: function (result_data) {
                    $("#state_dropdown").html(result_data);
                    $("#state_dropdown").show('slow');
                }
                });
            }
         function getLgaDropDown(stateid){
                $('#lga_dropdown').html("<span style = 'color:crimson'> Loading LGAs... </span>");
                lga_request_url= "<?php echo site_url('ajax/DynamicContent/LoadLgaWithStates?&stateid=') ?>" + stateid;
                $.ajax({url:lga_request_url,
                success: function (lga_result_data) {
                    $("#lga_dropdown").html(lga_result_data);
                    $("#lga_dropdown").show('slow');
                }
                });
            }
        </script>

