<body class="sticky-header">

    <section>
        <div class="main-content" >

            <!-- page heading end-->
            <!--body wrapper start-->

            <div class="wrapper">
                <div class="row">
                    <div class="col-md-12">
                        <?php echo $this->session->flashdata('msg') ? getAlertMessage($this->session->flashdata('msg'), 'info') : '' ?>
                        <?php echo $this->session->flashdata('error') ? getAlertMessage($this->session->flashdata('error'), 'danger') : '' ?>
                        <?php echo isset($message)?$message:''?>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Change Account Password
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                   <?php echo form_open_multipart('') ?>

                                <div class="col-lg-6">
                                            <div>
                                            <div class="form-group">
                                                <label>Current Password</label>
                                                <input class="form-control" name = "old_password" type = "password"  placeholder="Current Password" value = "">
                                            </div>
                                            <div class="form-group">
                                                <label>New Password</label>
                                                <input class="form-control" name = "new_password" type = "password"  placeholder="New Password" value = "">
                                            </div>
                                            <div class="form-group">
                                                <label>Confirm New Password</label>
                                                <input class="form-control" name = "confirm_new_password" type = "password"  placeholder="Confirm New Password" value = "">
                                            </div>
                                            <button type="submit" class="btn btn-primary" onclick = "return confirm('Please that all the information you entered is accurate before proceeding')"> Change Password </button>
                                            <button type="reset" class="btn btn-danger">Reset</button>
                                        </div>


<?php echo form_close(); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--body wrapper end-->

