<style type="text/css">

    @media print{
        #actions_section{
            display:none;
        }
        body{
            background-color: red;
        }
    }

</style>
<body class="sticky-header">

    <section>
        <div class="main-content" >
            <div class="page-heading">
                <h3>
                    Transaction Management
                </h3>
                <a id = "add_users"></a>
                <ul class="breadcrumb">
                    <li>
                        <a href="#">Transaction History</a>
                    </li>
                    <li class="active"> <a href="#existing_users">  </a></li>
                </ul>
            </div>
            <!-- page heading end-->
            <!--body wrapper start-->
        <div class="wrapper">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <a id ="existing_users"></a>
                            Transaction History
                        </div>
                        <?php
                        if (count($transactions)) {
                            ?>
                            <div class="panel-body">
                                <?php echo $this->session->flashdata('msg') ? getAlertMessage($this->session->flashdata('msg'), 'info') : '' ?>
                                <?php echo $this->session->flashdata('error') ? getAlertMessage($this->session->flashdata('error'), 'danger') : '' ?>
                                <div class="row">
                                    <div class="col-md-12">
                                        <h4 class="alert alert-info"> Sort By</h4>
                                        <?php echo form_open('');?>
                                        <div class="form-group col-md-3">
                                            <label class="col-md-12">Student</label>
                                            <div class="col-md-12">
                                                <?php
                                                    $students_array = array();
                                                    $students_array['All'] = 'All Students';
                                                    if(count($students)){
                                                        foreach ($students as $student):
                                                            $students_array[$student->uniqueid] = $student->surname.' '.$student->othernames;
                                                        endforeach;
                                                    }
                                                    echo form_dropdown('studentid',$options = $students_array,  set_value('studentid'),'class = "form-control" required = "required"');
                                                ?>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label class="col-md-12">Account Number</label>
                                            <div class="col-md-12">
                                                <input type="text" class="form-control" name = "account_number">
                                            </div>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label class="col-md-12">School</label>
                                            <div class="col-md-12">
                                            <?php
                                                if (count($schools)){
                                                    $school_options = array();
                                                    $school_options['All'] = 'All Schools';
                                                    foreach ($schools as $school):
                                                        $school_options[$school->uniqueid] = $school->school_name;
                                                    endforeach;
                                                    echo form_dropdown('school_id',$school_options, set_value('school_id'),'class = "form-control" required = "required"');
                                                }
                                                else{
                                            ?>
                                                    <div class="alert alert-error"> No School has been enrolled yet, Enrol a School to Proceed </div>
                                            <?php
                                                }
                                            ?>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <label class="col-md-12"></label>
                                            <button class="btn btn-primary"> <span class="fa fa-search"> </span> Proceed</button>
                                        </div>
                                    </div>
                                   <?php echo form_close(); ?>
                            </div>
                                <div class="table-responsive" id = "printArea">
                                    <table  class="display table table-bordered table-striped" border = "1">
                                        <caption>
                                            <center> <img src="<?php echo getResource('images/login_logo.png') ?>" style="max-width:200px" alt=""/> </center></td>
                                                <h4 class="alert alert-success">
                                                   <?php if(isset($single_student)){
                                                       ?>
                                                    Credit Transactions for <?php echo $transactions[0]->surname.' '. $transactions[0]->othernames; ?>
                                                    <?php
                                                   }
                                                   else if(isset($single_school)) {
                                                    ?>
                                                    Credit Transactions for <?php echo $transactions[0]->school_name ?>
                                                   <?php
                                                    }
                                                   else {?>
                                                   All Credit Transactions
                                                   <?php }
                                                   ?>
                                                </h4>
                                        </caption>
                                        <thead>
                                            <tr>
                                                <th>S/N</th>
                                                <th> Beneficiary </th>
                                                <th> School Name </th>
                                                <th> Transaction Amount </th>
                                                <th> Transaction Date </th>
                                                <th> Transaction Made By </th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <?php
                                            $sn = 1;
                                            foreach ($transactions as $value):
                                                ?>
                                                <tr class="">
                                                    <td> <?php echo $sn; ?> </td>
                                                    <td> <?php echo $value->surname.' '.$value->othernames; ?> </td>
                                                    <td> <?php echo $value->school_name; ?> </td>
                                                    <td> <?php echo $value->transaction_amount; ?> </td>
                                                    <td> <?php echo $value->transaction_date; ?> </td>
                                                    <td> <?php echo $value->transaction_made_by; ?> </td>
                                                    <td id = "actions_section">
                                                        <div class="dropdown">
                                                          <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Action
                                                          <span class="caret"></span></button>
                                                          <ul class="dropdown-menu">
                                                                <li> <a href="<?php echo site_url('Administrator/Incoming_transactions/print_receipt/'.$value->uniqueid) ?>" target="_blank"> Print Transaction Receipt </a></li>
                                                          </ul>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <?php
                                                $sn++;
                                            endforeach;
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                                <button class="btn btn-primary" onclick="PrintDiv()"> <span class="fa fa-print"></span> Print</button>

                            </div>
                            <?php
                        }
                        else {
                            echo getAlertMessage('No Record Founds');
                         ?>
                        <div align="center"> <a href="<?php echo site_url('Administrator/Reports/Credit_transactions'); ?>"> <button class = "btn btn-primary"> <i class="fa fa-refresh"></i> Refresh Results</button> </a></div>
                        <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <!--body wrapper end-->

