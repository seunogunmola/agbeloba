<body class="sticky-header">

    <section>
        <div class="main-content" >
            <div class="page-heading">
                <h3>
                    Account Management
                </h3>
                <a id = "add_users"></a>
                <ul class="breadcrumb">
                    <li>
                        <a href="#">Manage Account</a>
                    </li>
                    <li class="active"> <a href="<?php echo site_url('Administrator/Accounts/view') ?>"> View Existing Accounts </a></li>
                </ul>
            </div>
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
                                <?php echo!empty($account->surname) ? '<i class = "fa fa-edit"></i> Editing Account : ' . $account->surname : '<i class = "fa fa-plus"></i> Add New Account' ?>
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                   <?php echo form_open_multipart('') ?>
                                    <div class="col-lg-6">
                                        <h4> Basic Information </h4>
                                            <div class="col-md-12">
                                                <label>Account Passport</label>
                                                <i> Only.Jpeg format allowed : Maximum Allowed Size : 100kb</i>
                                                <div class="fileupload fileupload-new" data-provides="fileupload">
                                                    <div class="fileupload-preview thumbnail col-md-6" style="max-width:150px; border:0px;"><img width="100px" src="<?php echo!empty($account->account_passport) ? base_url($account->account_passport) : "" ?>" /></div>
                                                    <div class="col-md-6" >
                                                        <span class="btn btn-success col-lg-8">
                                                            <input type="file"  name="account_passport"  />
                                                        </span>
                                                        <a href="#" class="btn btn-danger fileupload-exists pull-right col-lg-4" data-dismiss="fileupload">Remove</a>
                                                    </div>

                                                </div>
                                            </div>

                                        
                                        <div class="form-group">
                                            <label>Title</label>
                                            <?php
                                                $title_options = array(''=>'Select Title','Mr'=>'Mr','Mrs'=>'Mrs','Dr'=>'Dr','Chief'=>'Chief','Sir'=>'Sir','Lady'=>'Lady');
                                                echo form_dropdown('account_title',$title_options,  set_value('account_title',$account->account_title),'class = "form-control" required = "required"');
                                            ?>
                                        </div>
                                        <div class="form-group">
                                            <label>Surname</label>
                                            <input class="form-control" name = "account_surname" type = "text" required ="" placeholder="Surname" value = "<?php echo set_value('account_surname', $account->account_surname) ?>">
                                        </div>
                                        <div class="form-group">
                                            <label>Othernames</label>
                                            <input class="form-control" name = "account_othernames" type = "text" required ="" placeholder="Othernames" value = "<?php echo set_value('account_othernames', $account->account_othernames) ?>">
                                        </div>
                                        <div class="form-group">
                                            <label>Gender</label>
                                            <?php
                                                $gender_options = array(''=>'Select Gender','Male'=>'Male','Female'=>'Female');
                                                echo form_dropdown('account_gender',$gender_options,  set_value('account_gender',$account->account_gender),'class = "form-control" required = "required"');
                                            ?>
                                        </div>
                                        <div class="form-group">
                                            <label>Nationality</label>
                                            <input class="form-control" name = "account_nationality" type = "text" required ="" placeholder="Nationality" value = "<?php echo set_value('account_nationality', $account->account_nationality) ?>">
                                        </div>
                                        <div class="form-group">
                                            <label>State Of Origin</label>
                                            <input class="form-control" name = "account_state" type = "text" required ="" placeholder="State of Origin" value = "<?php echo set_value('account_state', $account->account_state) ?>">
                                        </div>

                                        <h4> Contact Information </h4>
                                        <div class="form-group">
                                            <label>Phone Number</label>
                                            <input class="form-control" required="" name = "account_phone_number" type = "text"  placeholder="Phone Number" value = "<?php echo set_value('account_phone_number', $account->account_phone_number) ?>">
                                        </div>
                                        <div class="form-group">
                                            <label>Email Address</label>
                                            <input class="form-control" name = "account_email_address" type = "email"  placeholder="Email Address" value = "<?php echo set_value('account_email_address', $account->account_email_address) ?>">
                                        </div>
                                        <div class="form-group">
                                            <label>Contact Address</label>
                                            <textarea name="account_contact_address" class="form-control"><?php echo set_value('account_contact_address', $account->account_contact_address) ?></textarea>
                                        </div>

                                </div>
                                <div class="col-lg-6">
                                            <div>
                                            <h4 style="padding:1em; color:crimson"> Bank Information (Your Bank Details) </h4>
                                            <div class="form-group">
                                                <label>Bank Name</label>
                                                <input class="form-control" name = "account_bank_name" type = "text"  placeholder="Bank Name" value = "<?php echo set_value('account_bank_name', $account->account_bank_name) ?>">
                                            </div>
                                            <div class="form-group">
                                                <label>Bank Account Name</label>
                                                <input class="form-control" name = "account_bank_account_name" type = "text"  placeholder="Account Name" value = "<?php echo set_value('account_bank_account_name', $account->account_bank_account_name) ?>">
                                            </div>
                                            <div class="form-group">
                                                <label>Account Number</label>
                                                <input class="form-control" name = "account_bank_account_number" maxlength="10" type = "text"  placeholder="Bank Account Number" value = "<?php echo set_value('account_bank_account_number', $account->account_bank_account_number) ?>">
                                            </div>
                                            <div class="form-group">
                                                <label>Sort Code</label>
                                                <input class="form-control" name = "account_bank_sort_code" type = "text"  maxlength="12"  placeholder="Bank Sort Code" value = "<?php echo set_value('account_bank_sort_code', $account->account_bank_sort_code) ?>">
                                            </div>
                                            </div>
                                            <div>
                                                <h4 style="padding:1em; color:blue"> Payment Information (Details of your Registration Payment) </h4>
                                                <div class="form-group">
                                                    <label>Teller/Transaction ID</label>
                                                    <input class="form-control" disabled="" name = "account_payment_id" required="" type = "text"  placeholder="Payment Teller Number / Transaction ID" value = "<?php echo set_value('account_payment_id',$account->account_payment_id)?>">
                                                </div>
                                                <div class="form-group">
                                                    <label> Name on Teller/Transaction</label>
                                                    <input class="form-control" disabled="" name = "account_payment_name" required="" type = "text"  placeholder="Name on Payment / Transaction" value = "<?php echo set_value('account_payment_name',$account->account_payment_name); ?>">
                                                </div>
                                                <div class="form-group">
                                                    <label>Transaction Date</label>
                                                    <div class="bfh-datepicker" disabled="" data-format = "d-m-y" data-name = "account_payment_date" required = "" data-value = "<?php echo isset($account->account_bank_sort_code)?$account->account_payment_date:''?>"></div>
                                                </div>
                                            </div>
                                            <button type="submit" class="btn btn-primary" onclick = "return confirm('Please that all the information you entered is accurate before proceeding')"> Submit </button>
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

