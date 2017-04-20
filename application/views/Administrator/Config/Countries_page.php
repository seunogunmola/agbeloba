<body class="sticky-header">
    <section>
        <div class="main-content" >
            <div class="page-heading">
                <h3>
                    <span class="fa fa-institution"></span> Manage Countries
                </h3>
            </div>
            <!-- page heading end-->
            <!--body wrapper start-->

            <div class="wrapper">
                <div class="row">
                    <div class="col-md-6">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <?php echo!empty($country->country_name) ? '<i class = "fa fa-edit"></i> Editing Country : ' . $country->country_name : '<i class = "fa fa-plus"></i> Add New Country' ?>
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
                                            <input class="form-control"  required="" name = "country_name" type = "text" placeholder="Enter Country Name" value = "<?php echo set_value('country_name', $country->country_name) ?>">
                                        </div>
                                        <div class="form-group">
                                            <label>Country Code</label>
                                            <input class="form-control"  required="" name = "country_code" type = "number" placeholder="Enter Country Code" value = "<?php echo set_value('country_code', $country->country_code) ?>">
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
                        if(count($countries)):
                    ?>
                    <div class="col-md-6">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Existing Countries
                            </div>
                            <div class="panel-body">
                                    <div class="col-lg-12">
                                        <table class="table table-bordered table-condensed table-hover table-advance" id="dynamic-table">
                                            <thead>
                                                <th>S/N</th>
                                                <th>Unique ID</th>
                                                <th>Country Name</th>
                                                <th>Country Code</th>
                                                <th>Date Added</th>
                                                <th>Action</th>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    $sn=1;
                                                    foreach($countries as $country):
                                                ?>
                                                <tr>
                                                    <td><?php echo $sn; ?></td>
                                                    <td> <?php echo $country->uniqueid; ?></td>
                                                    <td> <?php echo $country->country_name; ?></td>
                                                    <td> <?php echo $country->country_code; ?></td>
                                                    <td> <?php echo $country->datecreated; ?></td>
                                                    <td>
                                                        <?php
                                                            echo getBtn($url = site_url('Administrator/Config/Countries/'.$country->uniqueid),$type = 'edit');
                                                            echo getBtn($url = site_url('Administrator/Config/Countries/'.$country->uniqueid.'/1'),$type = 'delete');
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

