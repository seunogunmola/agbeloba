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
                                <?php echo!empty($produce_category->produce_category_name) ? '<i class = "fa fa-edit"></i> Editing Produce Category : ' . $produce_category->produce_category_name : '<i class = "fa fa-plus"></i> Add New Produce Category' ?>
                            </div>
                            <div class="panel-body">

                                    <?php echo form_open($action = ''); ?>
                                <div class="col-md-12">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>Produce Category Name</label>
                                            <input class="form-control"  required="" name = "produce_category_name" type = "text" placeholder="Enter Produce Category Name" value = "<?php echo set_value('produce_category_name', $produce_category->produce_category_name) ?>">
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
                        if(count($produce_categories)):
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
                                                <th>Produce Category Name</th>
                                                <th>Date Added</th>
                                                <th>Action</th>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    $sn=1;
                                                    foreach($produce_categories as $category):
                                                ?>
                                                <tr>
                                                    <td><?php echo $sn; ?></td>
                                                    <td> <?php echo $category->uniqueid; ?></td>
                                                    <td> <?php echo $category->produce_category_name; ?></td>
                                                    <td> <?php echo $category->datecreated; ?></td>
                                                    <td>
                                                        <?php
                                                            echo getBtn($url = site_url('Administrator/Produce/Categories/'.$category->uniqueid),$type = 'edit');
                                                            echo getBtn($url = site_url('Administrator/Produce/Categories/'.$category->uniqueid.'/1'),$type = 'delete');
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

