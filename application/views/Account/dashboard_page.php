
<body class="sticky-header">

    <section>
        <!-- main content start-->
        <div class="main-content" >
            <!-- page heading start-->
            <div class="page-heading">
                <h3>
                    Dashboard
                </h3>
                <ul class="breadcrumb">
                    <li>
                        <a href="#">Dashboard</a>
                    </li>
                    <li class="active"> My Dashboard </li>
                </ul>
            </div>
            <!-- page heading end-->

            <!--body wrapper start-->
            <div class="wrapper">
                <div class="row">

                    <div class="col-md-12">
                        <div class="alert alert-info" align = "center"> <h3>Welcome : <?php echo isset($current_user_fullname) ? $current_user_fullname :'';?> </h3> </div>
                        <!--statistics start-->
                        <div> <h3> Accounts Summary </h3> </div>
                        <div class="row state-overview">
                            <div class="col-md-4 col-xs-12 col-sm-4">
                                <div class="panel panel-primary" align = "center">
                                    <div class="panel-heading"> Your Account Info</div>
                                    <div class="panel-body" style="color:black">
                                        <table class="table table-bordered">
                                            <tr>
                                                <td>
                                                    Account Name
                                                </td>
                                                <td>
                                                    <?php
                                                    echo ($current_user_data->account_title.' '.$current_user_data->account_surname.' '.$current_user_data->account_othernames);
                                                    ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    Investor ID
                                                </td>
                                                <td>
                                                    <?php
                                                    echo ($current_user_data->account_number);
                                                    ?>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 col-xs-12 col-sm-4">
                                <div class="panel panel-primary" align = "center">
                                    <div class="panel-heading"> Total Accounts Registered Under You this month</div>
                                    <div class="panel-body">
                                        <center> <h1 style="color:black"> <?php echo isset($sub_accounts_count) ? $sub_accounts_count: '0'?> </h1> </center>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 col-xs-12 col-sm-4">
                                <div class="panel panel-success" align = "center">
                                    <div class="panel-heading"> Total Accounts Registered Under You so far</div>
                                    <div class="panel-body">
                                        <center> <h1 style="color:black"> <?php echo isset($sub_accounts_count) ? $sub_accounts_count: '0'?> </h1> </center>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div> <h3> Payments Summary </h3> </div>
                        <!--statistics start-->
                        <div class="row state-overview">
                            <div class="col-md-4 col-xs-12 col-sm-4">
                                <div class="panel panel-danger" align = "center">
                                    <div class="panel-heading"> Total Pending Payments</div>
                                    <div class="panel-body">
                                        <center> <h1 style="color:black"> <?php echo $currency_symbol; ?>  <?php echo isset($sub_accounts_count) ? number_format($total_payments,2): '0.00'?> </h1> </center>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 col-xs-12 col-sm-4">
                                <div class="panel panel-success" align = "center">
                                    <div class="panel-heading"> Total Payments Received</div>
                                    <div class="panel-body">
                                        <center> <h1 style="color:black"> <?php echo $currency_symbol; ?> <?php  echo isset($total_payments) ? number_format($total_payments,2): '0.00'?> </h1> </center>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div> <h3> Training  Summary </h3> </div>
                        <div class="row state-overview">
                            <div class="col-md-4 col-xs-12 col-sm-4">
                                            <?php
                                                $accounts_remaining = $unlock_count - $sub_accounts_count;
                                            ?>
                                <div class="panel <?php echo ($accounts_remaining > 0 )? 'panel-danger' : 'panel-success' ?>" align = "center">
                                    <div class="panel-heading"> Training Vault is <?php echo ($accounts_remaining > 0 ) ? 'locked': 'opened'  ?> </div>
                                    <div class="panel-body">
                                        <?php
                                            if($accounts_remaining > 0 ){
                                                ?>
                                                    <center> <h4 style="color:black"> Register <?php echo $accounts_remaining ?> more accounts to unlock training vault </h4> </center>
                                        <?php
                                            }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                        </div>
                    </div>

                </div>


            <script type="text/javascript">
                new Morris.Line({
                    // ID of the element in which to draw the chart.
                    element: 'incoming_transactions',
                    // Chart data records -- each entry in this array corresponds to a point on
                    // the chart.
                    data: [<?php echo $incoming_transactions_data; ?>
                    ],
                    // The name of the data record attribute that contains x-values.
                    xkey: 'date',
                    // A list of names of data record attributes that contain y-values.
                    ykeys: ['value'],
                    // Labels for the ykeys -- will be displayed when you hover over the
                    // chart.
                    labels: ['Value']
                });
            </script>
