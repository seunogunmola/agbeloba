<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="<?php echo config_item('sitename') ?>">

        <title><?php echo config_item('sitename') ?> </title>
        <link href="<?php echo getResource('css/style.css') ?>" rel="stylesheet">
        <link href="<?php echo getResource('css/style-responsive.css') ?>" rel="stylesheet">
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
            echo form_open('', 'class="form-signin" role = "form"');
            ?>

            <div class="form-signin-heading text-center">
                <h1 class="sign-title">Sign In</h1>
                <img src="<?php echo getResource('images/login_logo.png') ?>" style="max-width:300px" alt=""/>
            </div>

            <div class="login-wrap">
                <?php echo $message; ?>
                <div class="form-group">
                    <label for="Username /Email address"> Username /Email address</label>
                    <input type="text" name ="username" class="form-control" id="username" placeholder="Username /Email address" required="" data-toggle = "tooltip" title="Enter Your Username/Email Here">
                </div>
                <div class="form-group">
                    <label for="Password"> Password</label>
                    <input type="password" name ="password" class="form-control" id="username" placeholder="Password" required="" data-toggle = "tooltip" title="Enter Your Password Here">
                </div>

                <button class="btn btn-lg btn-login btn-block" type="submit" title="Click Here to Login" data-toggle = "tooltip">
                    <i class="fa fa-check"></i>
                </button>
                <label class="checkbox">
                    <a href="<?php echo site_url('home') ?>" style="color:blue"> Return to Homepage</a>
                </label>

            </div>

            <!-- Modal -->
            <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal" class="modal fade">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title">Forgot Password ?</h4>
                        </div>
                        <div class="modal-body">
                            <p>Enter your e-mail address below to reset your password.</p>
                            <input type="text" name="email" placeholder="Email" autocomplete="off" class="form-control placeholder-no-fix">

                        </div>
                        <div class="modal-footer">
                            <button data-dismiss="modal" class="btn btn-default" type="button">Cancel</button>
                            <button class="btn btn-primary" type="button" >Submit</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- modal -->

        </form>

    </div>



    <!-- Placed js at the end of the document so the pages load faster -->

    <!-- Placed js at the end of the document so the pages load faster -->
    <script src="<?php echo getResource('js/jquery-1.10.2.min.js') ?>"></script>
    <script src="<?php echo getResource('js/bootstrap.min.js') ?>"></script>
    <script src="<?php echo getResource('js/modernizr.min.js') ?>"></script>
    <script>
        $(document).ready(function () {
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
</body>
</html>
