
<body class="sticky-header">

    <section>
        <div class="main-content" >
            <div class="wrapper">
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <a id ="existing_users"></a>
                                Accounts Referred By : <?php echo $account_holders_name ?> in <?php echo $current_month . ' ' . $current_year ?>
                            </div>

                            <div class="panel-body">
                                <?php if (!count($level2_accounts_data) && !count($level1_accounts_data)) {
                                    echo getAlertMessage($message = "You dont have any accounts registered under you yet for the month");

                                }
                                else {

                                ?>
                                <div class="col-md-12 alert alert-success" style="margin-top: 10px;">
                                    <center> <h4> Main Account </h4> </center>
                                </div>
                                <div class="col-md-12">

                                    <center>

                                        <table class="table table-condensed">
                                            <tr>
                                                <td colspan="2">
                                                     <center>
                                                        <div> <img src="<?php echo base_url($account_data->account_passport) ?>" style="max-width: 100px;"/></div>
                                                     </center>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Account Name :</td>
                                                <td> <?php echo $account_data->account_title . ' ' . $account_data->account_surname . ' ' . $account_data->account_othernames; ?> </td>
                                            </tr>
                                            <tr>
                                                <td> Associate Number : </td>
                                                <td> <?php echo $account_data->account_number; ?></td>
                                            </tr>
                                        </table>

                                    </center>
                                </div>

                                <?php
                                $level1_total_payment = 0;
                                $level2_total_payment = 0;
                                if (count($level1_accounts_data)) {
                                    ?>
                                    <table class="table table-bordered">
                                        <caption> <h4> Sub Accounts Referred By : <?php echo $account_holders_name ?> in <?php echo $current_month . ' ' . $current_year ?> </h4></caption>
                                        <tr>
                                            <td>
                                                S/N
                                            </td>
                                            <td>
                                                Passport
                                            </td>
                                            <td>
                                                Account Name
                                            </td>
                                            <td>
                                                Associate Number
                                            </td>

                                            <td>
                                                Date Registered
                                            </td>

                                            <td>
                                                Total Rebate Amount
                                            </td>
                                        </tr>
                                        <?php
                                        $sn = 1;

                                        foreach ($level1_accounts_data as $sub_accounts):
                                            ?>
                                            <tr>
                                                <td>
                                                    <?php echo $sn; ?>
                                                </td>
                                                <td>
                                                    <img src="<?php echo base_url($sub_accounts->account_passport) ?>" style="max-width: 100px;"/>
                                                </td>
                                                <td>
                                                    <?php echo $sub_accounts->account_title . ' ' . $sub_accounts->account_surname . ' ' . $sub_accounts->account_othernames; ?>
                                                </td>
                                                <td>
                                                    <?php echo $sub_accounts->account_number; ?>
                                                </td>
                                                <td>
                                                    <?php echo substr($sub_accounts->datecreated, 0, 10); ?>
                                                </td>
                                                <td>
                                                    <?php echo $payment_level_1; ?>
                                                </td>
                                            </tr>
                                            <?php
                                            $level1_total_payment = $level1_total_payment + $payment_level_1;
                                            $sn++;
                                        endforeach;


                                    ?>
                                    <tfoot>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td>  <h4> Total Payments Due </h4></td>
                                            <td>  <h4> <?php echo $level1_total_payment; ?> </h4></td>
                                        </tr>
                                    </tfoot>
                                </table>
                                    <?php
                                }
                                    ?>
                                <?php
                                if (count($level2_accounts_data)) {
                                    ?>
                                    <table class="table table-bordered">
                                        <caption> <h4> Sub Accounts Referred By : <?php echo $account_holders_name ?> in <?php echo $current_month . ' ' . $current_year ?> </h4></caption>
                                        <tr>
                                            <td>
                                                S/N
                                            </td>
                                            <td>
                                                Passport
                                            </td>
                                            <td>
                                                Account Name
                                            </td>
                                            <td>
                                                Associate Number
                                            </td>

                                            <td>
                                                Date Registered
                                            </td>

                                            <td>
                                                Total Rebate Amount
                                            </td>
                                        </tr>
                                        <?php
                                        $sn = 1;
                                        $level2_total_payment = 0;
                                        foreach ($level2_accounts_data as $sub_accounts):
                                            ?>
                                            <tr>
                                                <td>
                                                    <?php echo $sn; ?>
                                                </td>
                                                <td>
                                                    <img src="<?php echo base_url($sub_accounts->account_passport) ?>" style="max-width: 100px;"/>
                                                </td>
                                                <td>
                                                    <?php echo $sub_accounts->account_title . ' ' . $sub_accounts->account_surname . ' ' . $sub_accounts->account_othernames; ?>
                                                </td>
                                                <td>
                                                    <?php echo $sub_accounts->account_number; ?>
                                                </td>
                                                <td>
                                                    <?php echo substr($sub_accounts->datecreated, 0, 10); ?>
                                                </td>
                                                <td>
                                                    <?php echo $payment_level_2; ?>
                                                </td>
                                            </tr>
                                            <?php
                                            $level2_total_payment = $level2_total_payment + $payment_level_2;
                                            $sn++;
                                        endforeach;

                                    ?>
                                    <tfoot>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td>  <h4> Total Payments Due for Level 2 </h4></td>
                                            <td>  <h4> <?php echo $level2_total_payment; ?> </h4></td>
                                        </tr>
                                    </tfoot>
                                </table>
                                    <?php
                                }
                                        $grand_total = $level1_total_payment + $level2_total_payment;
                                }
                                    ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--body wrapper end-->

