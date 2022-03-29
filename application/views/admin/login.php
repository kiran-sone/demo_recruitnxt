<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Login | Recruitnxt</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <?php include 'css-files.php'; ?>
    </head>

    <body style="background: #ecf0f5;">
        <div class="container">
            <div class="row" style="min-height: 550px;">
                <div class="col-md-4 col-md-offset-4" style="margin-top: 10%;">
                    <div class="login-panel panel panel-default">
                        <div class="panel-heading text-center">
                            <h3 class="panel-title"><img src="<?php echo base_url(); ?>assets/images/logo.png" height="50px"/> <br/>Enter your account login credentials</h3>
                        </div>
                        <div class="panel-body">
                            <form id="admin-login" action="" method="POST">
                                <fieldset>
                                    <div class="form-group">
                                        <input class="form-control" placeholder="Username(Email ID)" name="email" type="text" autofocus>
                                    </div>
                                    <div class="form-group">
                                        <input class="form-control" placeholder="Password" name="password" type="password">
                                    </div>
                                    <button type="submit" class="btn btn-success btn-block" name="login">Login</button>
                                    <?php if (!empty($msg)) { ?>
                                        <div class="alert alert-warning" style="margin-top:10px;">
                                            <a href="#" class="close" data-dismiss="alert">&times;</a>
                                            <?php echo $msg; ?>
                                        </div>
                                    <?php } ?>
                                </fieldset>
                            </form>
                        </div>

                    </div>
                </div>
            </div>

        </div>
        
        <!-- ./wrapper -->
        <?php include 'js-files.php'; ?>
        <script src="<?php echo base_url(); ?>assets/js/validation/jquery.validate-1.14.0.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/validation/jquery-validate.bootstrap-tooltip.js"></script>
        <script type="text/javascript">
                            $(document).ready(function () {
                                $("#admin-login").validate({
                                    rules: {
                                        email: "required",
                                        password: "required",
                                    },
                                    tooltip_options: {
                                        inst: {
                                            trigger: 'focus',
                                        },
                                    },
                                });
                            });

        </script>
    </body>
</html>