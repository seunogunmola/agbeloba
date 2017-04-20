<?php
    if(!isset($account)){
        redirect('administrator/Investors/view');
    }
?>

<body class="sticky-header">

    <section>
        <div class="main-content" >
            <div class="page-heading">
                <h3>
                    Investor Management
                </h3>
                <a id = "add_users"></a>
            </div>
            <!-- page heading end-->
            <!--body wrapper start-->

            <div class="wrapper">
                <div class="row">
                    <div class="col-md-12">
                        <?php echo $this->session->flashdata('msg') ? getAlertMessage($this->session->flashdata('msg'), 'info') : '' ?>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Investor Information
                            </div>
                            <div class="panel-body">
                                <div class="row" id = "printArea">
                                    <table class="table table-bordered table-condensed" width = "80%" border = "1">
                                        <tr>
                                            <td colspan="3">   <center> <img src="<?php echo getResource('images/login_logo.png') ?>" style="max-width:300px" alt=""/> </center></td>
                                        </tr>
                                        <tr>
                                            <td colspan="3">  <center> <h4> Investor Enrollment Information </center></td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">Basic Information</td>
                                        </tr>
                                        <tr>
                                            <td>Referred By</td>
                                            <td> <strong style="color:crimson"> <?php echo $account->account_referrer_id ?> </strong></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>Investor Number</td>
                                            <td> <strong style="color:crimson"> <?php echo $account->account_number ?> </strong></td>
                                            <td rowspan="4"> <img src="<?php echo !empty($account->account_passport)? base_url($account->account_passport):''?>" width="200px"/></td>
                                        </tr>
                                        <tr>
                                            <td>Surname</td>
                                            <td> <?php echo $account->account_surname ?></td>

                                        </tr>
                                        <tr>
                                            <td>Othernames</td>
                                            <td> <?php echo $account->account_othernames ?></td>
                                        </tr>
                                        <tr>
                                            <td>Gender</td>
                                            <td> <?php echo $account->account_gender ?></td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">Contact Information</td>
                                        </tr>
                                        <tr>
                                            <td>Phone Number</td>
                                            <td> <?php echo $account->account_phone_number ?></td>
                                        </tr>
                                        <tr>
                                            <td>Email Address</td>
                                            <td> <?php echo $account->account_email_address ?></td>
                                        </tr>
                                        <tr>
                                            <td>Contact Address</td>
                                            <td> <?php echo $account->account_contact_address ?></td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">Bank Information</td>
                                        </tr>
                                        <tr>
                                            <td>Bank Name</td>
                                            <td> <?php echo $account->account_bank_name ?></td>

                                        </tr>
                                        <tr>
                                            <td>Bank Investor Name</td>
                                            <td> <?php echo $account->account_bank_account_name ?></td>
                                        </tr>
                                        <tr>
                                            <td>Bank Investor Number</td>
                                            <td> <?php echo $account->account_bank_account_number ?></td>
                                        </tr>
                                        <tr>
                                            <td>Bank Sort Code</td>
                                            <td> <?php echo $account->account_bank_sort_code ?></td>
                                        </tr>

                                    </table>
                            </div>
                                <button class="btn btn-primary" onclick="PrintDiv()"> <span class="fa fa-print"></span> Print</button>
                                <a href="<?php echo site_url('Account/Accounts/edit/'.$account->id.'/'.md5($account->account_number).'/') ?>"> <button class="btn btn-danger"> <span class="fa fa-edit"></span> Edit Details</button> </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--body wrapper end-->

