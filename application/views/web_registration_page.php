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
                <div class="wrapper">
                    <div style="padding:1em">
                        <h1> Associate Registration Form </h1>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <?php echo $this->session->flashdata('msg') ? getAlertMessage($this->session->flashdata('msg'), 'info') : '' ?>
                            <?php echo $this->session->flashdata('error') ? getAlertMessage($this->session->flashdata('error'), 'danger') : '' ?>
                            <?php echo isset($message) ? $message : '' ?>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <?php echo!empty($account->surname) ? '<i class = "fa fa-edit"></i> Editing Account : ' . $account->surname : '<i class = "fa fa-plus"></i> Add New Account' ?>
                                </div>
                                <div class="panel-body">
                                    <div class="row">
                                        <?php echo form_open_multipart('') ?>
                                        <div class="col-lg-6">
                                            <h4 style="padding:1em; color:green"> Basic Information </h4>
                                            <div class="col-md-12">
                                                <label>Account Passport</label>
                                                <i> Only.Jpeg format allowed : Maximum Allowed Size : 100kb</i>
                                                <div class="fileupload fileupload-new" data-provides="fileupload">
                                                    <div class="fileupload-preview thumbnail col-md-6" style="max-width:150px; border:0px;"><img width="100px" src="<?php echo!empty($account->account_passport) ? base_url($account->account_passport) : base_url('resources/images/noimage.jpg') ?>" /></div>
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
                                                $title_options = array('' => 'Select Title', 'Mr' => 'Mr', 'Mrs' => 'Mrs', 'Dr' => 'Dr', 'Chief' => 'Chief', 'Sir' => 'Sir', 'Lady' => 'Lady');
                                                echo form_dropdown('account_title', $title_options, set_value('account_title', $account->account_title), 'class = "form-control" required = "required"');
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
                                                $gender_options = array('' => 'Select Gender', 'Male' => 'Male', 'Female' => 'Female');
                                                echo form_dropdown('account_gender', $gender_options, set_value('account_gender', $account->account_gender), 'class = "form-control" required = "required"');
                                                ?>
                                            </div>
                                            <div class="form-group">
                                                <label>Nationality</label>
                                                <input class="form-control" name = "account_nationality" type = "text" required ="" placeholder="Nationality" value = "<?php echo set_value('account_nationality', $account->account_nationality) ?>">
                                            </div>
                                            <div class="form-group">
                                                <label>State Of Origin</label>
                                                <select name="account_state" class="form-control">
                                                    <option>Abuja FCT</option>
                                                    <option>Abia</option>
                                                    <option>Adamawa </option>
                                                    <option>Akwa Ibom</option>
                                                    <option>Anambra</option>
                                                    <option>Bauchi</option>
                                                    <option>Bayelsa</option>
                                                    <option>Benue</option>
                                                    <option>Borno</option>
                                                    <option>Cross River</option>
                                                    <option>Delta</option>
                                                    <option>Ebonyi</option>
                                                    <option>Edo</option>
                                                    <option>Ekiti</option>
                                                    <option>Enugu</option>
                                                    <option>Gombe</option>
                                                    <option>Imo</option>
                                                    <option>Jigawa</option>
                                                    <option>Kaduna</option>
                                                    <option>Kano</option>
                                                    <option>Katsina</option>
                                                    <option>Kebbi</option>
                                                    <option>Kogi</option>
                                                    <option>Kwara</option>
                                                    <option>Lagos</option>
                                                    <option>Nassarawa</option>
                                                    <option>Niger</option>
                                                    <option>Ogun</option>
                                                    <option>Ondo</option>
                                                    <option>Osun</option>
                                                    <option>Oyo</option>
                                                    <option>Plateau</option>
                                                    <option>Rivers</option>
                                                    <option>Sokoto</option>
                                                    <option>Taraba</option>
                                                    <option>Yobe</option>
                                                    <option>Zamfara</option>
                                                </select>
                                            </div>

                                            <h4> Contact Information </h4>
                                            <div class="form-group">
                                                <label>Phone Number</label>
                                                <input class="form-control" required="" maxlength="11" name = "account_phone_number" type = "text"  placeholder="Phone Number" value = "<?php echo set_value('account_phone_number', $account->account_phone_number) ?>">
                                            </div>
                                            <div class="form-group">
                                                <label>Email Address</label>
                                                <input class="form-control" name = "account_email_address" type = "email"  placeholder="Email Address" value = "<?php echo set_value('account_email_address', $account->account_email_address) ?>">
                                            </div>
                                            <div class="form-group">
                                                <label>Contact Address</label>
                                                <textarea style ="background:white" name="account_contact_address" class="form-control"><?php echo set_value('account_contact_address', $account->account_contact_address) ?></textarea>
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
                                                    <input class="form-control" name = "account_payment_id" required="" type = "text"  placeholder="Payment Teller Number / Transaction ID" value = "<?php echo set_value('account_payment_id')?>">
                                                </div>
                                                <div class="form-group">
                                                    <label> Name on Teller/Transaction</label>
                                                    <input class="form-control" name = "account_payment_name" required="" type = "text"  placeholder="Name on Payment / Transaction" value = "<?php echo set_value('account_payment_name'); ?>">
                                                </div>
                                                <div class="form-group">
                                                    <label>Transaction Date</label>
                                                    <div class="bfh-datepicker" data-format = "d-m-y" data-name = "account_payment_date" required = ""></div>

                                                </div>
                                            </div>
                                            <div>
                                                <h4 style="padding:1em; color:black"> Associate Information </h4>
                                                <div class="form-group">
                                                    <br/>
                                                    <label>Associate ID</label>
                                                    <input class="form-control" name = "account_referrer_id" type = "text"  placeholder="Enter Associate ID" value = "<?php echo set_value('account_bank_name', $account->account_bank_name) ?>">
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
                <!--
                <div class="connect">
                    <div class="connect-social">
                        <h4>CONNECT</h4>
                        <ul>
                            <li><a href="#" class="facebook" title="Go to Our Facebook Page"></a></li>
                            <li><a href="#" class="twitter" title="Go to Our Twitter Account"></a></li>
                            <li><a href="#" class="googleplus" title="Go to Our Google Plus Account"></a></li>
                            <li><a href="#" class="linkedin" title="Go to Our Linkedin Page"></a></li>
                            <li><a href="#" class="blogger" title="Go to Our Blogger Account"></a></li>
                            <li><a href="#" class="tumblr" title="Go to Our Tumblr Page"></a></li>
                            <li><a href="#" class="rss" title="Go to Our RSS Feed"></a></li>
                            <li><a href="#" class="youtube" title="Go to Our Youtube Channel"></a></li>
                            <li><a href="#" class="vimeo" title="Go to Our Vimeo Channel"></a></li>
                            <li><a href="#" class="deviantart" title="Go to Our Deviantart Page"></a></li>
                        </ul>
                    </div>
                </div>
                -->
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
</body>
</html>
