<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
  <meta name="keywords" content="<?= $sitename ?>, <?php echo config_item('keywords') ?>">
  <meta name="description" content="<?= $sitename ?>">
  <meta name="author" content="<?= $sitename ?>,<?php echo config_item('keywords') ?>">
<script src="<?php echo getResource('js/jquery-1.10.2.min.js') ?>"></script>
<script src="<?php echo getResource("js/morris-chart/morris.min.js") ?>" ></script>
<script src="<?php echo getResource("js/morris-chart/raphael.min.js") ?>" ></script>

  <title><?php echo config_item('sitename') ?> </title>

  <link rel="shortcut icon" href="#" type="image/png">
  <link href="<?php echo getResource('js/iCheck/skins/minimal/minimal.css')?>" rel="stylesheet">
  <link href="<?php echo getResource('js/iCheck/skins/square/square.css')?>" rel="stylesheet">
  <link href="<?php echo getResource('js/iCheck/skins/square/red.css')?>" rel="stylesheet">
  <link href="<?php echo getResource('js/iCheck/skins/square/blue.css')?>" rel="stylesheet">
  <link href="<?php echo getResource('css/clndr.css')?>" rel="stylesheet">
  <link href="<?php echo getResource('js/morris-chart/morris.css')?>" rel="stylesheet">
  <link href="<?php echo getResource('css/style.css')?>" rel="stylesheet">
  <link href="<?php echo getResource('css/style-responsive.css')?>" rel="stylesheet">
  <link href="<?php echo getResource('css/bootstrap-fileupload.min.css')?>" rel="stylesheet">
  <link href="<?php echo getResource('css/bootstrap-formhelpers.min.css')?>" rel="stylesheet">
  <link href="<?php echo getResource('css/bootstrap-formhelpers.css')?>" rel="stylesheet">
  <link href="<?php echo getResource('css/slideshow.css')?>" rel="stylesheet">
  <?= $page_level_styles; ?>

  <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!--[if lt IE 9]>
  <script src="js/html5shiv.js"></script>
  <script src="js/respond.min.js"></script>
  <![endif]-->
  <style>
#imagePreview {
    width: 180px;
    height: 180px;
    background-position: center center;
    background-size: cover;
    -webkit-box-shadow: 0 0 1px 1px rgba(0, 0, 0, .3);
    display: inline-block;
}
</style>
</head>



        <!-- header section start-->
        <div class="header-section">

            <!--toggle button start-->
            <a class="toggle-btn"><i class="fa fa-bars"></i></a>
            <!--toggle button end-->
            <!--notification menu start -->
            <div class="menu-right">
                <ul class="notification-menu">
                    <li>
                        <a href="#" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                            <img src="images/photos/user-avatar.png" alt="" />
                                <?php echo $this->session->userdata['fullname'];?>
                            <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-usermenu pull-right">
                            <li><a href="<?php echo site_url('Administrator/login/logout')?>"><i class="fa fa-sign-out"></i> Log Out</a></li>
                        </ul>
                    </li>

                </ul>
            </div>
            <!--notification menu end -->

        </div>
        <!-- header section end-->


        <div class="left-side sticky-left-side">

        <!--logo and iconic logo start-->
        <div class="logo" style="background-color:white">
            <a href="<?php echo site_url('Administrator/dashboard'); ?>"> <img src="<?php echo getResource('images/login_logo.png') ?>" style="max-width:200px" alt=""/> </a>
        </div>

        <div class="logo-icon text-center">
            <a href="index.html"><img src="images/logo_icon.png" alt=""></a>
        </div>
        <!--logo and iconic logo end-->

        <div class="left-side-inner">

            <!-- visible to small devices only -->
            <div class="visible-xs hidden-sm hidden-md hidden-lg">
                <div class="media logged-user">
                    <img alt="" src="images/photos/user-avatar.png" class="media-object">
                    <div class="media-body">
                        <h4><a href="#"> <?php echo $this->session->userdata['fullname'];?></a></h4>
                    </div>
                </div>

                <h5 class="left-nav-title">Account Information</h5>
                <ul class="nav nav-pills nav-stacked custom-nav">
                  <li><a href="#"><i class="fa fa-user"></i> <span>Profile</span></a></li>
                  <li><a href="#"><i class="fa fa-cog"></i> <span>Settings</span></a></li>
                  <li><a href="#"><i class="fa fa-sign-out"></i> <span>Sign Out</span></a></li>
                </ul>
            </div>
