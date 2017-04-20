<body class="sticky-header">
    <section>
        <div class="main-content" >
            <div class="page-heading">
                <h3>
                    <span class="fa fa-institution"></span> Manage States
                </h3>
            </div>
            <!-- page heading end-->
            <!--body wrapper start-->

            <div class="wrapper">
                <div class="row">
                    <div class="col-md-6">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <?php echo!empty($state->state_name) ? '<i class = "fa fa-edit"></i> Editing Country : ' . $state->state_name : '<i class = "fa fa-plus"></i> Add New Country' ?>
                            </div>
                            <div class="panel-body">
                                    <?php echo $this->session->flashdata('success') ? getAlertMessage($this->session->flashdata('success'), 'info') : '' ?>
                                    <?php echo $this->session->flashdata('error') ? getAlertMessage($this->session->flashdata('error'), 'danger') : '' ?>
                                    <?php echo $message ?>
                                    <?php echo form_open($action = ''); ?>
                                <div class="col-md-12">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>Country Name</label>
                                            <?php
                                                if(isset($countries) && count($countries)){
                                                    $country_options = array();
                                                    $country_options[''] = "Select Country";
                                                    foreach ($countries as $country):
                                                        $country_options[$country->uniqueid] = $country->country_name;
                                                    endforeach;
                                                    echo form_dropdown($data = "country_uniqueid", $country_options, set_value('country_uniqueid',$state->country_uniqueid), $extra = "class = 'form-control' required = '' ");
                                                }
                                                else{
                                                    echo getAlertMessage($messag = "No Country Found. You need to Setup Countries before creating States \n <br/> <a href =". site_url('Administrator/Config/Countries')."> <button class = 'btn btn-primary'> Click Here to Create a Country </button> </a>", $type = "danger");
                                                }
                                            ?>
                                        </div>
                                        <div class="form-group">
                                            <label>State Name</label>
                                            <input class="form-control"  required="" name = "state_name" type = "text" placeholder="Enter Country Name" value = "<?php echo set_value('state_name', $state->state_name) ?>">
                                        </div>
                                        <div class="form-group">
                                            <button class="btn btn-primary" type="submit"> <i class="fa fa-save"></i> Save </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php
                        if(count($states)):
                    ?>
                    <div class="col-md-6">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Existing States
                            </div>
                            <div class="panel-body">
                                    <div class="col-lg-12">
                                        <table class="table table-bordered table-condensed table-hover table-advance" id="dynamic-table">
                                            <thead>
                                                <th>S/N</th>
                                                <th>Unique ID</th>
                                                <th>Country Name</th>
                                                <th>State Name</th>
                                                <th>Date Added</th>
                                                <th>Action</th>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    $sn=1;
                                                    foreach($states as $state):
                                                ?>
                                                <tr>
                                                    <td><?php echo $sn; ?></td>
                                                    <td> <?php echo $state->uniqueid; ?></td>
                                                    <td> <?php echo $state->country_name; ?></td>
                                                    <td> <?php echo $state->state_name; ?></td>
                                                    <td> <?php echo $state->datecreated; ?></td>
                                                    <td>
                                                        <?php
                                                            echo getBtn($url = site_url('Administrator/Config/States/'.$state->uniqueid),$type = 'edit');
                                                            echo getBtn($url = site_url('Administrator/Config/States/'.$state->uniqueid.'/1'),$type = 'delete');
                                                        ?>
                                                    </td>
                                                </tr>
                                                <?php
                                                    $sn++;
                                                    endforeach;
                                                ?>
                                            </tbody>
                                        </table>
                                        <?php
                                        ?>
                                    </div>
                            </div>
                        </div>
                    </div>
                    <?php
                        endif;
                    ?>
                </div>

                <!--body wrapper end-->

