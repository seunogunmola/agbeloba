s

<body class="sticky-header">

    <section>
        <div class="main-content" >
            <div class="page-heading">
                <h3>
                    <span class="fa fa-map-marker"></span> General System Settings
                </h3>
                <a id = "add_customers"></a>
            </div>
            <!-- page heading end-->
            <!--body wrapper start-->

            <div class="wrapper">
                <div class="row">
                    <div class="col-md-12">

                        <div class="panel panel-default">
                            <div class="panel-heading">
                                General System Settings
                            </div>
                            <div class="panel-body">
                                                        <?php echo $this->session->flashdata('msg') ? getAlertMessage($this->session->flashdata('msg'), 'info') : '' ?>
                        <?php echo $this->session->flashdata('error') ? getAlertMessage($this->session->flashdata('error'), 'danger') : '' ?>
                                <div class="row">
                                    <?php echo $message ?>
                                    <?php echo form_open_multipart('') ?>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>Default Currency</label>
                                            <input class="form-control"  required="" name = "default_currency" type = "text" placeholder="Enter Default Currency" value = "<?php echo set_value('default_currency', $settings->default_currency) ?>">
                                        </div>
                                        <div class="form-group">
                                            <label>Vat (%)</label>
                                            <input class="form-control"  required="" name = "vat" type = "text" placeholder="Enter Country Name" value = "<?php echo set_value('vat', $settings->vat) ?>">
                                        </div>
                                        <div class="form-group">
                                            <label>SMS Receivers (Seperate With Commas)</label>
                                            <input class="form-control"  required="" name = "email_receivers" type = "text" placeholder="Enter Email Receivers" value = "<?php echo set_value('email_receivers', $settings->email_receivers) ?>">
                                        </div>
                                        <div class="form-group">
                                            <label>Email Receivers (Seperate With Commas)</label>
                                            <input class="form-control"  required="" name = "sms_receivers" type = "text" placeholder="Enter SMS Receivers" value = "<?php echo set_value('sms_receivers', $settings->sms_receivers) ?>">
                                        </div>
                                        <button type="submit" class="btn btn-primary pull-right"> <span class="fa fa-plus"></span> Save</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <!--body wrapper end-->

