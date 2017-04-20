s

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
                    <li class="active"> <a href="#existing_users"> View Existing Accounts </a></li>
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
                            Existing Accounts
                        </div>

                            <div class="panel-body">
                                <?php echo $this->session->flashdata('success') ? getAlertMessage($this->session->flashdata('msg'), 'info') : '' ?>
                                <?php echo $this->session->flashdata('error') ? getAlertMessage($this->session->flashdata('error'), 'danger') : '' ?>

                        <?php
                        if (count($accounts)) {
                            ?> 
                                <div class="table-responsive">

                                    <a href = "<?php echo site_url('Administrator/Accounts') ?>#add_users" > <button class ="btn btn-primary" style = "margin-bottom:10px"> <i class ="fa fa-plus"></i> Add New Account </button> </a>

                                    <table  class="display table table-bordered table-striped" id="dynamic-table">
                                        <thead>
                                            <tr>
                                                <th>S/N</th>
                                                <th>Account Number</th>
                                                <th>Title</th>
                                                <th>Surname</th>
                                                <th>Othernames</th>
                                                <th>Phone Number</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <?php
                                            $sn = 1;
                                            foreach ($accounts as $accountdata):
                                                ?>
                                                <tr class="">
                                                    <td> <?php echo $sn; ?> </td>
                                                    <td> <?php echo ucwords($accountdata->account_number); ?> </td>
                                                    <td> <?php echo ucwords($accountdata->account_title); ?> </td>
                                                    <td> <?php echo ucwords($accountdata->account_surname); ?> </td>
                                                    <td> <?php echo ucwords($accountdata->account_othernames); ?> </td>
                                                    <td> <?php echo ucwords($accountdata->account_phone_number); ?> </td>
                                                    <td> <?php echo $accountdata->status == 1? '<span class="label label-success"> Enabled </span>' : '<span class="label label-danger"> Disabled </span>'; ?> </td>
                                                    <td>
                                                        <div class="dropdown">
                                                          <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Action
                                                          <span class="caret"></span></button>
                                                          <ul class="dropdown-menu">
                                                                <li> <a href="<?php echo site_url('Administrator/Accounts/view_account/'.$accountdata->id.'/'.md5($accountdata->account_number)) ?>" target="_blank"> View Full Account Details</a></li>
                                                                <li> <a href="<?php echo site_url('Administrator/Accounts/index/'.$accountdata->id.'/'.md5($accountdata->account_number)) ?>" target="_blank"> Edit Account Details</a></li>
                                                                <li> <a onclick="return(confirm('Are you sure you want to delete? \n It cannot be undone o'))" href="<?php echo site_url('Administrator/Accounts/delete/'.$accountdata->id) ?>"> Delete Account</a></li>
                                                                <li> <a href="<?php echo site_url('Administrator/Accounts/view_sub_accounts/'.md5($accountdata->account_number)) ?>"> View Children Accounts</a></li>
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

                            </div>
                            <?php
                        }
                        else {
                            echo getAlertMessage('Sorry : You dont have any registered users yet');
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <!--body wrapper end-->

