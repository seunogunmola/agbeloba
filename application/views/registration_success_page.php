
<html>
    <head>
        <title><?php echo $sitename; ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="keywords" content="Corporatus a Responsive Web Template, Bootstrap Web Templates, Flat Web Templates, Android Compatible Web Template, Smartphone Compatible Web Template, Free Webdesigns for Nokia, Samsung, LG, Sony Ericsson, Motorola Web Design" />
        <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
        <link rel="stylesheet" href="<?php echo getResource('web/css/bootstrap.min.css') ?>" type="text/css" media="screen" />
        <link rel="stylesheet" href="<?php echo getResource('web/css/style.css') ?>" type="text/css" media="screen" />
        <link rel="stylesheet" href="<?php echo getResource('web/css/flexslider.css') ?>" type="text/css" media="screen" />
        <link rel="stylesheet" href="<?php echo getResource('web/css/chocolat.css') ?>" type="text/css" media="screen" />
        <link href="<?php echo base_url('resources/css/bootstrap-formhelpers.css') ?>" rel="stylesheet" type="text/css"/>
        <link href="<?php echo base_url('resources/css/bootstrap-formhelpers.min.css') ?>" rel="stylesheet" type="text/css"/>
        <link href="../../resources/css/bootstrap-fileupload.min.css" rel="stylesheet" type="text/css"/>
        <link href='//fonts.googleapis.com/css?family=Hammersmith+One' rel='stylesheet' type='text/css'>
        <link href='//fonts.googleapis.com/css?family=Open+Sans:400,300,600,700' rel='stylesheet' type='text/css'>
        <link href='//fonts.googleapis.com/css?family=Oswald:400,700,300' rel='stylesheet' type='text/css'>
        <style type="text/css">
            body{
                margin-top: 70px;
            }
        </style>
    </head>
    <body>
        <!-- Header -->
        <div class="header">
            <!-- Top-Bar -->
            <div class="top-bar">
                <div class="clearfix"></div>
            </div>
            <nav class="navbar navbar-default navbar-fixed-top">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" style="padding: 0px;" href="#"> <img src="<?php echo getResource('web/images/site_logo.png') ?>" style="max-width:200px "></a>
                    </div>
                    <div class="navbar-collapse collapse hover-effect" id="navbar">
                        <ul>
                            <li><a href="<?php echo site_url('Home'); ?>"><span data-hover="HOME">HOME</span></a></li>
                            <li><a href="<?php echo site_url('Account/Login'); ?>"><span data-hover="LOGIN">LOGIN</span></a></li>
                            <li><a href="<?php echo site_url('Home/Register'); ?>"><span data-hover="REGISTER">REGISTER</span></a></li>
                        </ul>
                    </div>
                </div>
            </nav>
            <div class="container" style="margin-top:20px">
                <?php if(isset($account_data) && count($account_data)) { ?>
                <div class="wrapper">
                    <div style="padding:1em" class="alert alert-success">
                        <h1> Your Registration was Successful </h1>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <?php echo $this->session->flashdata('msg') ? getAlertMessage($this->session->flashdata('msg'), 'info') : '' ?>
                            <?php echo $this->session->flashdata('error') ? getAlertMessage($this->session->flashdata('error'), 'danger') : '' ?>
                            <?php echo isset($message) ? $message : '' ?>
                            <div class="panel-body">
                                <div class="row" id = "printArea">
                                    <table class="table table-bordered table-condensed" width = "100%" border = "0">
                                        <tr>
                                            <td colspan="3">   <center> <img src="<?php echo getResource('images/login_logo.png') ?>" style="max-width:300px" alt=""/> </center></td>
                                        </tr>
                                        <tr>
                                            <td colspan="3">  <center> <h4> Investor Enrollment Information </center></td>
                                        </tr>
                                        <tr>
                                            <td colspan="3"> <strong> Basic Information </strong></td>
                                        </tr>
                                        <tr>
                                            <td>Referer ID</td>
                                            <td> <strong style="color:crimson"> <?php echo $account_data->account_referrer_id ?> </strong></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>Investor Number</td>
                                            <td> <strong style="color:crimson"> <?php echo $account_data->account_number ?> </strong></td>
                                            <td rowspan="4"> <img src="<?php echo !empty($account_data->account_passport)? base_url($account_data->account_passport): getResource('images/noimage.jpg')?>" width="200px" style="max-width:200px "/></td>
                                        </tr>
                                        <tr>
                                            <td>Surname</td>
                                            <td> <?php echo $account_data->account_surname ?></td>


                                        </tr>
                                        <tr>
                                            <td>Othernames</td>
                                            <td> <?php echo $account_data->account_othernames ?></td>
                                        </tr>
                                        <tr>
                                            <td>Gender</td>
                                            <td> <?php echo $account_data->account_gender ?></td>

                                        </tr>
                                        <tr>
                                            <td colspan="3"> <strong> Contact Information </strong></td>
                                        </tr>
                                        <tr>
                                            <td>Phone Number</td>
                                            <td> <?php echo $account_data->account_phone_number ?></td>
                                             <td> </td>
                                        </tr>
                                        <tr>
                                            <td>Email Address</td>
                                            <td> <?php echo $account_data->account_email_address ?></td>
                                             <td> </td>
                                        </tr>
                                        <tr>
                                            <td>Contact Address</td>
                                            <td> <?php echo $account_data->account_contact_address ?></td>
                                             <td> </td>
                                        </tr>
                                        <tr>
                                            <td colspan="3"> <strong> Bank Information </strong></td>
                                        </tr>
                                        <tr>
                                            <td>Bank Name</td>
                                            <td> <?php echo $account_data->account_bank_name ?></td>
                                             <td> </td>

                                        </tr>
                                        <tr>
                                            <td>Bank Investor Name</td>
                                            <td> <?php echo $account_data->account_bank_account_name ?></td>
                                             <td> </td>
                                        </tr>
                                        <tr>
                                            <td>Bank Investor Number</td>
                                            <td> <?php echo $account_data->account_bank_account_number ?></td>
                                             <td> </td>
                                        </tr>
                                        <tr>
                                            <td>Bank Sort Code</td>
                                            <td> <?php echo $account_data->account_bank_sort_code ?></td>
                                             <td> </td>
                                        </tr>
                                        <tr>
                                            <td colspan="3">Registration Payment Information</td>
                                        </tr>
                                        <tr>
                                            <td>Teller Number/Transaction ID</td>
                                            <td> <?php echo $account_data->account_payment_id ?></td>
                                            <td> </td>

                                        </tr>
                                        <tr>
                                            <td>Name on Teller Number/Transaction</td>
                                            <td> <?php echo $account_data->account_payment_name ?></td>
                                            <td> </td>
                                        </tr>
                                        <tr>
                                            <td>Transaction Date</td>
                                            <td> <?php echo $account_data->account_payment_date ?></td>
                                            <td> </td>
                                        </tr>
                                        <tr>
                                            <td colspan="3" style="color:crimson;font-weight: bold; text-align: center;">
                                                Please note that your account has been created but
                                                is currently disabled pending the confirmation
                                                of your payment and thorough accreditation by the Management.
                                                <br/>
                                                <span style = "color:black"> To fast track your accreditation process, contact admin on : </span><br/>
                                                Telephone : 08101869833 <br/>
                                                Email : info@learntoliveconsult.com

                                            </td>
                                        </tr>

                                    </table>
                            </div>
                                <button class="btn btn-primary" onclick="PrintDiv()"> <span class="fa fa-print"></span> Print</button>
                        </div>
                        </div>
                    </div>
                </div>
                <?php }
                else{
                    redirect('Home');
                }
                ?>
            </div>
<div class="footer">
            <div class="container">

                <div class="footer-info">
                    <div class="col-md-4 col-sm-4 footer-info-grid links">
                        <h4>QUICK LINKS</h4>
                        <ul>
                            <li><a class="scroll" href="<?php echo site_url('Home/Login'); ?>">Login</a></li>
                            <li><a class="scroll" href="<?php echo site_url('Home/Register'); ?>">Register</a></li>
                        </ul>
                    </div>
                    <div class="col-md-4 col-sm-4 footer-info-grid address">
                        <h4>ADDRESS</h4>
                        <address>
                            <ul>
                                <li>Phone : 08101869833</li>
                                <li>Email : <a class="mail" href="mailto:mail@example.com">info@learntoliveconsult.com</a></li>
                                <li>Address : Enugu Centre: Celebrities Complex, Plot 1 Hospital Road by Shoprite Polo Mall GRA Enugu </li>

                            </ul>
                        </address>
                    </div>
                    <div class="col-md-4 col-sm-4 footer-info-grid newsletter">
                        <a href="<?php echo site_url('Administrator/Login') ?>"> <button class="btn btn-primary"> <i class="fa fa-home"></i> Admin Back Office</button>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="copyright">
                    <p> <?php echo $sitename ?> &copy; 2016. All Rights Reserved </p>
                </div>

            </div>
        </div>
            <!-- //Footer -->
            <!-- Custom-JavaScript-File-Links -->
            <script type="text/javascript" src="<?php echo getResource('web/js/jquery.min.js') ?>"></script>
            <script src="../../resources/js/bootstrap-fileupload.min.js" type="text/javascript"></script>
            <script type="text/javascript" src="<?php echo getResource('web/js/bootstrap.min.js') ?>"></script>
            <script src="<?php echo base_url('resources/js/bootstrap-formhelpers.js') ?>" type="text/javascript"></script>
            <script type="text/javascript" src="<?php echo getResource('web/js/numscroller-1.0.js') ?>"></script>
            <script type="text/javascript" src="<?php echo getResource('web/js/modernizr.custom.97074.js') ?>"></script>
            <script type="text/javascript" src="<?php echo getResource('web/js/jquery.chocolat.js') ?>"></script>
            <script>

            $(function () {
            $('.gallery-grids a').Chocolat();
            });
        </script>
        <script type="text/javascript">
            $(document).ready(function () {
                var defaults = {
                    containerID: 'toTop', // fading element id
                    containerHoverID: 'toTopHover', // fading element hover id
                    scrollSpeed: 100,
                    easingType: 'linear'
                };
                $().UItoTop({easingType: 'easeOutQuart'});
            });
        </script>
        <a href="#" id="toTop" style="display: block;"> <span id="toTopHover" style="opacity: 0;"> </span></a>
        <script type="text/javascript" src="<?php echo getResource('web/js/move-top.js') ?>"></script>
        <script type="text/javascript" src="<?php echo getResource('web/js/easing.js') ?>"></script>
        <script type="text/javascript">
            jQuery(document).ready(function ($) {
                $(".scroll, .navbar li a, .footer li a").click(function (event) {
                    $('html,body').animate({scrollTop: $(this.hash).offset().top}, 1000);
                });
            });
        </script>
<script type="text/javascript">
    function PrintDiv(){
        var old_data = document.body.innerHTML;
        var print_data = document.getElementById('printArea');

        newWin= window.open("");
        newWin.document.write(print_data.outerHTML);
        newWin.print();
        newWin.close();

    }
</script>
</body>
</html>
