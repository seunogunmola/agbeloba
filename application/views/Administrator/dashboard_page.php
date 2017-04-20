

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
                        <h4 style="color:blue"> Accounts Summary </h4>
                        <!--statistics start-->
                        <div class="row state-overview">
                            <div class="col-md-4 col-xs-12 col-sm-12">
                                <a href="<?php echo site_url('Administrator/Accounts/view') ?>" style="color:white">
                                    <div class="panel purple">
                                        <div class="symbol">
                                            <i class="fa fa-users"></i>
                                        </div>
                                        <div class="state-value">
                                            <div class="value"> <?= isset($accounts_count) ? $accounts_count : '' ?> </div>
                                            <div class="title">Account Enrolled</div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-4 col-xs-12 col-sm-12">
                                <a href="<?php echo site_url('Administrator/Accounts/view') ?>" style="color:white">
                                    <div class="panel green">
                                        <div class="symbol">
                                            <i class="fa fa-users"></i>
                                        </div>
                                        <div class="state-value">
                                            <div class="title">Total Active Accounts</div>
                                            <div class="value"> <?= isset($active_accounts_count) ? $active_accounts_count : '' ?> </div>

                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-4 col-xs-12 col-sm-12">
                                <a href="<?php echo site_url('Administrator/Accounts/view') ?>" style="color:white">
                                    <div class="panel red">
                                        <div class="symbol">
                                            <i class="fa fa-users"></i>
                                        </div>
                                        <div class="state-value">
                                            <div class="value"> <?= isset($disabled_accounts_count) ? $disabled_accounts_count : '' ?> </div>
                                            <div class="title">Accounts currently Disabled</div>
                                        </div>
                                    </div>
                                </a>
                            </div>

                        </div>

                    </div>

                </div>
                <!---- MATERIALS-->
                <div class="row">
                    <div class="col-md-12">
                        <h4 style="color:blue"> Materials Summary </h4>
                        <!--statistics start-->
                        <div class="row state-overview">
                            <div class="col-md-4 col-xs-12 col-sm-12">
                                <a href="<?php echo site_url('Administrator/Materials/View') ?>" style="color:white">
                                    <div class="panel green">
                                        <div class="symbol">
                                            <i class="fa fa-book"></i>
                                        </div>
                                        <div class="state-value">
                                            <div class="value"> <?= isset($materials_count) ? $materials_count : '0' ?> </div>
                                            <div class="title">Materials Uploaded</div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-4 col-xs-12 col-sm-12">
                                <a href="<?php echo site_url('Administrator/Materials/Categories') ?>" style="color:white">
                                    <div class="panel blue">
                                        <div class="symbol">
                                            <i class="fa fa-list-alt"></i>
                                        </div>
                                        <div class="state-value">
                                            <div class="title">Material Categories</div>
                                            <div class="value"> <?= isset($materials_categories_count) ? $materials_categories_count : '0' ?> </div>

                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-4 col-xs-12 col-sm-12">
                                <a href="<?php echo site_url('Administrator/Materials/View/1') ?>" style="color:white">
                                    <div class="panel red">
                                        <div class="symbol">
                                            <i class="fa fa-times"></i>
                                        </div>
                                        <div class="state-value">
                                            <div class="value"> <?= isset($expired_materials_count) ? $expired_materials_count : '' ?> </div>
                                            <div class="title">Expired Materials</div>
                                        </div>
                                    </div>
                                </a>
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
