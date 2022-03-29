<!DOCTYPE html>
<html>
    <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Dashboard</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <?php include 'css-files.php'; ?>
        <style>
            .update-wraper{
                display: none;
            }
            .password-wraper{
                display: none;
            }
        </style>
    </head>
    <body class="hold-transition skin-green fixed sidebar-mini">
        <div class="wrapper">

            <?php include 'header.php'; ?>
            <?php include 'sidebar-menu.php'; ?>

            <div class="content-wrapper">
                <section class="content-header">
                    <h1>
                        Dashboard
                        <small>Admin Profile</small>
                    </h1>
                    <!--                    <ol class="breadcrumb">
                                            <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
                                            <li class="active">Here</li>
                                        </ol>-->
                </section>

                <section class="content container-fluid">
                    <div class="row">
                        <div class="col-md-6">
                            <!-- general form elements -->
                            <div class="box box-primary">
                                <div class="box-header with-border">
                                    <h4 style="display: inline-block;">Admin Profile</h4>

                                    <a href="#" class="btn btn-info pull-right password-btn" style="margin-left: 10px;"><i class="fa fa-shield"></i> Change Password</a>
                                    <a href="#" class="btn btn-success pull-right update-btn"><i class="fa fa-edit"></i> Update Profile</a>
                                </div>
                                <div class="box-body">
                                    <table class="table table-striped margin10">
                                        <tbody>
                                            <tr>
                                                <td style="width:100px;">Name : </td>
                                                <td><?php echo $profile[0]->au_name; ?></td>
                                            </tr>
                                            <tr>
                                                <td style="width:100px;">Email : </td>
                                                <td><?php echo $profile[0]->au_email; ?></td>
                                            </tr>
                                            <tr>
                                                <td style="width:100px;">Contact No : </td>
                                                <td><?php echo $profile[0]->au_contact; ?></td>
                                            </tr>
                                            <tr>
                                                <td style="width:100px;">User Type : </td>
                                                <td><?php echo $profile[0]->user_role; ?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div><!-- /.box -->
                            </div>
                        </div>
                        <div class="col-md-6 update-wraper">
                            <!-- general form elements -->
                            <div class="box box-success">
                                <div class="box-header with-border">
                                    <h4 style="display: inline-block;">Update Profile</h4>

                                    <a href="#" class="pull-right close-btn" style="margin-left: 10px;"><i class="fa fa-close"></i> Close</a>
                                </div>
                                <div class="box-body">
                                    <div class="col-md-10">
                                        <form action="" method="POST" id="update-profile">

                                            <div class="input-group">
                                                <span class="input-group-addon">Name </span>
                                                <input type="text" class="form-control field" id="fname" vtype="required" name="fname" value="<?php echo $profile[0]->au_name; ?>" aria-label="Amount (to the nearest dollar)">
                                            </div>

                                            <div class="input-group margin15">
                                                <span class="input-group-addon">Contact No </span>
                                                <input type="text" class="form-control field" id="contact" vtype="num" name="contact" value="<?php echo $profile[0]->au_contact; ?>" aria-label="Amount (to the nearest dollar)">
                                            </div>
                                            <div class="text-right margin15">
                                                
                                                <button type="submit" class="btn btn-primary">Submit</button>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="clearfix"></div>

                                </div><!-- /.box -->
                            </div>
                        </div>

                        <div class="col-md-6 password-wraper">
                            <!-- general form elements -->
                            <div class="box box-info">
                                <div class="box-header with-border">
                                    <h4 style="display: inline-block;">Change Password</h4>

                                    <a href="#" class="pull-right close-btn" style="margin-left: 10px;"><i class="fa fa-close"></i> Close</a>
                                </div>
                                <div class="box-body">
                                    <div class="col-md-10">
                                        <form action="" method="POST" id="change-password">

                                            <div class="input-group">
                                                <span class="input-group-addon">Old Password </span>
                                                <input type="password" class="form-control field" id="old-pass" vtype="required" name="old_pass" value="" aria-label="Amount (to the nearest dollar)">
                                            </div>

                                            <div class="input-group margin15">
                                                <span class="input-group-addon">New Password</span>
                                                <input type="password" class="form-control field" id="new-pass" vtype="required" name="new_pass" value="" aria-label="Amount (to the nearest dollar)">
                                            </div>
                                            <div class="text-right margin15">
                                                <span class="old-pass-error" style="margin-right:30px; display: inline-block; color: #ff7701;"></span>
                                                <button type="submit" class="btn btn-primary">Submit</button>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="clearfix"></div>

                                </div><!-- /.box -->
                            </div>
                        </div>

                    </div>
                </section>
            </div>
            <?php include 'footer.php'; ?>


            <div class="control-sidebar-bg"></div>
        </div>
        <!-- ./wrapper -->
        <?php include 'js-files.php'; ?>
        <script src="<?php echo base_url(); ?>assets/js/validation/jquery.validate-1.14.0.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/validation/jquery-validate.bootstrap-tooltip.js"></script>
        <script type="text/javascript">
            $(document).ready(function () {

                $('.update-btn').click(function (e) {
                    e.preventDefault();
                    $('.update-wraper').show();
                    $('.password-wraper').hide();
                });

                $('.password-btn').click(function (e) {
                    e.preventDefault();
                    $('.update-wraper').hide();
                    $('.password-wraper').show();
                });

                $('.close-btn').click(function (e) {
                    e.preventDefault();
                    $('.update-wraper').hide();
                    $('.password-wraper').hide();
                });

                $("#update-profile").validate({
                    rules: {
                        fname: "required",
                        contact: {
                            required: true,
                            number: true
                        },
                    },
                    tooltip_options: {
                        inst: {
                            trigger: 'focus',
                        },
                    },
                });


                function chagePassword()
                {
                    $('.page_spin').show();
                    var old_pass = $("#old-pass").val();
                    var n_pass = $("#new-pass").val();
                    var dataString = "old_pass=" + old_pass + "&new_pass=" + n_pass + "&page=update_password";
                    $.ajax({
                        type: "POST",
                        url: "<?php echo base_url(); ?>my_adminpath/ajax_page",
                        data: dataString,
                        success: function (data1) {
                            $('.page_spin').hide();
                            var replay = $.trim(data1);
                            if (replay == 1)
                            {
                                window.location = "<?php echo base_url(); ?>my_adminpath/logout";
                            }
                            else
                            {
                                $('.old-pass-error').html("Old password doesn't match.");
                            }

                        }, //success fun end
                    });//ajax end
                }
                
                $("#change-password").validate({
                    rules: {
                        old_pass: "required",
                        new_pass: "required",
                    },
                    tooltip_options: {
                        inst: {
                            trigger: 'focus',
                        },
                    },
                    submitHandler: function (form) {
                        chagePassword();
                    },
                });

            });

        </script>
    </body>
</html>