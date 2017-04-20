<body class="sticky-header">
    <section>
        <div class="main-content" >
            <div class="page-heading">
                <h3>
                    <span class="fa fa-institution"></span> Manage Produce Categories
                </h3>
            </div>
            <!-- page heading end-->
            <!--body wrapper start-->

            <div class="wrapper">
                <div class="row">
                    <div class="container">
                                        <?php echo $this->session->flashdata('success') ? getAlertMessage($this->session->flashdata('success'), 'info') : '' ?>
                                        <?php echo $this->session->flashdata('error') ? getAlertMessage($this->session->flashdata('error'), 'danger') : '' ?>
                                        <?php echo $message ?>
                    </div>
                    <div class="col-md-6">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <?php echo!empty($produce_type->produce_type_name) ? '<i class = "fa fa-edit"></i> Editing Produce Type : ' . $produce_type->produce_type_name : '<i class = "fa fa-plus"></i> Add New Produce Type' ?>
                            </div>
                            <div class="panel-body">
                                <div class="col-md-12">
                                    <div class="col-lg-12">
                                    <?php echo form_open($action = ''); ?>
                                        <div class="form-group">
                                            <label>Produce Type</label>
                                            <?php
                                                if(isset($produce_categories) && count($produce_categories)){
                                                    $category_options = array();
                                                    $category_options[''] = "Select Produce Type";
                                                    foreach ($produce_categories as $category):
                                                        $category_options[$category->uniqueid] = $category->produce_category_name;
                                                    endforeach;
                                                    echo form_dropdown($data = "produce_category_id", $category_options, set_value('produce_category_id',$produce_type->produce_category_id), $extra = "class = 'form-control' required = '' ");
                                                }
                                                else{
                                                    echo getAlertMessage($messag = "No Produce Type was Found. You need to Setup Produce Categories  \n <br/> <a href =". site_url('Administrator/Produce/Types')."> <button class = 'btn btn-primary'> Click Here to Setup Categories </button> </a>", $type = "danger");
                                                }
                                            ?>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label>Produce Type Name</label>
                                            <input class="form-control"  required="" name = "produce_type_name" type = "text" placeholder="Enter Produce Type Name" value = "<?php echo set_value('produce_type_name', $produce_type->produce_type_name) ?>">
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
                        if(count($produce_types)):
                    ?>
                    <div class="col-md-6">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Existing Produce Categories
                            </div>
                            <div class="panel-body">
                                    <div class="col-lg-12">
                                        <table class="table table-bordered table-condensed table-hover table-advance" id="dynamic-table">
                                            <thead>
                                                <th>S/N</th>
                                                <th>Unique ID</th>
                                                <th>Produce Type Name</th>
                                                <th>Date Added</th>
                                                <th>Action</th>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    $sn=1;
                                                    foreach($produce_types as $category):
                                                ?>
                                                <tr>
                                                    <td><?php echo $sn; ?></td>
                                                    <td> <?php echo $category->uniqueid; ?></td>
                                                    <td> <?php echo $category->produce_type_name; ?></td>
                                                    <td> <?php echo $category->datecreated; ?></td>
                                                    <td>
                                                        <?php
                                                            echo getBtn($url = site_url('Administrator/Produce/Types/'.$category->uniqueid),$type = 'edit');
                                                            echo getBtn($url = site_url('Administrator/Produce/Types/'.$category->uniqueid.'/1'),$type = 'delete');
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

