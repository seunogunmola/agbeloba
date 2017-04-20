<body class="sticky-header">
    <section>
        <div class="main-content" >
            <div class="page-heading">
                <h3>
                    <span class="fa fa-institution"></span> Manage LGAs
                </h3>
            </div>
            <!-- page heading end-->
            <!--body wrapper start-->

            <div class="wrapper">
                <div class="row">
                    <div class="col-md-6">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <?php echo!empty($lga->lga_name) ? '<i class = "fa fa-edit"></i> Editing Lga : ' . $lga->lga_name : '<i class = "fa fa-plus"></i> Add New Lga' ?>
                            </div>
                            <div class="panel-body">
                                <?php echo $this->session->flashdata('success') ? getAlertMessage($this->session->flashdata('success'), 'info') : '' ?>
                                <?php echo $this->session->flashdata('error') ? getAlertMessage($this->session->flashdata('error'), 'danger') : '' ?>
                                <?php echo $message ?>
                                <?php echo form_open($action = ''); ?>
                                <div class="col-md-12">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>State Name</label>
                                            <?php
                                            if (isset($states) && count($states)) {
                                                $state_options = array();
                                                $state_options[''] = "Select State";
                                                foreach ($states as $state):
                                                    $state_options[$state->uniqueid] = $state->state_name;
                                                endforeach;
                                                echo form_dropdown($data = "state_uniqueid", $state_options, set_value('state_uniqueid', $lga->state_uniqueid), $extra = "class = 'form-control' required = '' ");
                                            }
                                            else {
                                                echo getAlertMessage($messag = "No State Found. You need to Setup States before creating LGAs \n <br/> <a href =" . site_url('Administrator/Config/States') . "> <button class = 'btn btn-primary'> Click Here to Create a State </button> </a>", $type = "danger");
                                            }
                                            ?>
                                        </div>
                                        <div class="form-group">
                                            <label>LGA Name</label>
                                            <input class="form-control"  required="" name = "lga_name" type = "text" placeholder="Enter LGA Name" value = "<?php echo set_value('lga_name', $lga->lga_name) ?>">
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
                    if (isset($lgas) && count($lgas)):
                        ?>
                        <div class="col-md-6">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    Existing LGAs
                                </div>
                                <div class="panel-body">
                                    <div class="col-lg-12">
                                        <table class="table table-bordered table-condensed table-hover table-advance" id="dynamic-table">
                                            <thead>
                                            <th>S/N</th>
                                            <th>Unique ID</th>
                                            <th>Country Name</th>
                                            <th>LGA Name</th>
                                            <th>Date Added</th>
                                            <th>Action</th>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $sn = 1;
                                                foreach ($lgas as $lga):
                                                    ?>
                                                    <tr>
                                                        <td><?php echo $sn; ?></td>
                                                        <td> <?php echo $lga->uniqueid; ?></td>
                                                        <td> <?php echo $lga->state_name; ?></td>
                                                        <td> <?php echo $lga->lga_name; ?></td>
                                                        <td> <?php echo $lga->datecreated; ?></td>
                                                        <td>
                                                            <?php
                                                            echo getBtn($url = site_url('Administrator/Config/LGAs/' . $lga->uniqueid), $type = 'edit');
                                                            echo getBtn($url = site_url('Administrator/Config/LGAs/' . $lga->uniqueid . '/1'), $type = 'delete');
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

