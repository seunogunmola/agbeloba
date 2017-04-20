

<body class="sticky-header">

    <section>
        <div class="main-content" >
            <div class="page-heading">
                <h3>
                    Quick Search Result
                </h3>
                <a id = "add_users"></a>
                <ul class="breadcrumb">
                    <li class="active"> <a href="<?php echo site_url('Administrator/Dashboard') ?>"> Dashboard</a></li>
                </ul>
            </div>
            <!-- page heading end-->
            <!--body wrapper start-->

            <div class="wrapper">
                <div class="row">
                    <div class="col-md-12">

                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Fund Student's Wallet
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <?php echo $this->session->flashdata('error') ? getAlertMessage($this->session->flashdata('error'), 'danger') : '' ?>
                                    </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <a href="<?php echo site_url('Administrator/Dashboard') ?>"> <div style="color:crimson" class="pull-right" title="D" data-toggle = "tooltip"> <h3> Search Another Student </h3> </div> </a>
                                            <?php if(isset($student_data)): ?>
                                                <table class="table table-bordered" width = "80%" >
                                                    <tr>
                                                        <td>Account Number</td>
                                                        <td> <strong style="color:crimson"> <?php echo $student_data->uniqueid ?> </strong></td>
                                                        <td rowspan="6"> <img src="<?php echo base_url($student_data->passport) ?>" width="100px"/></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Surname</td>
                                                        <td> <?php echo strtoupper($string = $student_data->surname) ?></td>

                                                    </tr>
                                                    <tr>
                                                        <td>Othernames</td>
                                                        <td> <?php echo strtoupper($string = $student_data->othernames) ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Gender</td>
                                                        <td> <?php echo $student_data->gender ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Parent Phone Number</td>
                                                        <td> <?php echo $student_data->parent_phone_number ?></td>
                                                    </tr>
                                                </table>
                                        <div align = "center">
                                            <h1 style="color:crimson">
                                                Account Balance : <?php echo $currency_symbol.' '.number_format($account_balance,2) ?>
                                            </h1>
                                        </div>

                                        <?php endif;?>
                                        <div align ="center">
                                            <div class="btn-group" align = "center">
                                                <a href="<?php echo site_url('Administrator/Incoming_transactions/fund_wallet/'.$student_data->uniqueid)?>"> <button type="button" class="btn btn-success"> <span class="fa fa-chevron-circle-right"></span> Fund Account</button> </a>
                                                <a href="<?php echo site_url('Administrator/Outgoing_Transactions/debit_wallet/'.$student_data->uniqueid)?>"> <button class="btn btn-danger"> <span class="fa fa-chevron-circle-left"></span> Debit Account</button> </a>
                                                <a href="<?php echo site_url('Administrator/Outgoing_Transactions/Individual_student_transaction_history/'.$student_data->uniqueid)?>"> <button type="button" class="btn btn-default"> <span class="fa fa-chevron-circle-right"></span> Debit Transactions History</button> </a>
                                                <a href="<?php echo site_url('Administrator/Incoming_transactions/Individual_student_transaction_history/'.$student_data->uniqueid)?>"> <button type="button" class="btn btn-info"> <span class="fa fa-chevron-circle-right"></span> Credit Transactions History</button> </a>
                                            </div>
                                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--body wrapper end-->

