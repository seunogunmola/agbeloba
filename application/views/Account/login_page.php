<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="<?php echo config_item('sitename') ?>">

    <title><?php echo config_item('sitename') ?> </title>
    <link href="<?php echo getResource('css/style.css')?>" rel="stylesheet">
    <link href="<?php echo getResource('css/style-responsive.css')?>" rel="stylesheet">
    <link rel="shortcut icon" href="#" type="image/png">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->
</head>

<body class="login-body">
                <div class="container">
                    <?php
                    echo form_open('','class="form-signin" role = "form"');
                    ?>

                    <div class="form-signin-heading text-center">
                        <h1 class="sign-title">Sign In</h1>
                        <img src="<?php echo getResource('images/login_logo.png') ?>" style="max-width:300px" alt=""/>
                    </div>
                    <center> <h2>Login to your Account</h2> </center>
                    <div class="login-wrap">
                        <?php echo $message; ?>
                        <div class="form-group">
                            <label for="Username /Email address"> Associate ID</label>
                            <input type="text" name ="username" class="form-control" id="username" placeholder="Enter Associate ID" required="" data-toggle = "tooltip" title="Enter Your Username/Email Here">
                        </div>
                        <div class="form-group">
                            <label for="Password"> Password</label>
                            <input type="password" name ="password" class="form-control" id="username" placeholder="Password" required="" data-toggle = "tooltip" title="Enter Your Password Here">
                        </div>

                        <button class="btn btn-lg btn-login btn-block" type="submit" title="Click Here to Login" data-toggle = "tooltip">
                            <i class="fa fa-check"></i>
                        </button>
                        <label class="checkbox">
                            <a href="<?php echo site_url('home')?>" style="color:blue"> Return to Homepage</a>
                        </label>

                    </div>


                </form>

            </div>



            <!-- Placed js at the end of the document so the pages load faster -->

            <!-- Placed js at the end of the document so the pages load faster -->
            <script src="<?php echo getResource('js/jquery-1.10.2.min.js')?>"></script>
            <script src="<?php echo getResource('js/bootstrap.min.js')?>"></script>
            <script src="<?php echo getResource('js/modernizr.min.js')?>"></script>
            <script>
                $(document).ready(function(){
                    $('[data-toggle="tooltip"]').tooltip();
                });
            </script>
    </body>
</html>
