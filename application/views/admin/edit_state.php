<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Edit State</title>
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
                    <h1 style="display:inline-block;">
                        Edit State
                        <small>Manage States</small>
                    </h1>
                    <a href="<?php echo base_url(); ?>my_adminpath/states" class="btn btn-danger pull-right">Back</a>
                </section>

                <section class="content container-fluid">
                    <div class="row">
                        <div class="col-md-6">
                            <!-- general form elements -->
                            <div class="box box-primary">
                                <div class="box-header with-border">
                                    <h4 style="display: inline-block;">Edit State</h4>
                                    <?php
                                    if ($msg == 1) {
                                        ?>
                                        <span class="text-success" style="font-size:20px;">State details are updated</span>
                                    <?php } ?>
                                </div>
                                <div class="box-body">
                                    <form action="" method="POST" id="edit_state" enctype="multipart/form-data">

                                        <div class="input-group">
                                            <span class="input-group-addon">State Title *</span>
                                            <input type="hidden" class="form-control" name="s_id" value="<?php echo $st[0]->s_id; ?>">
                                            <input type="text" class="form-control" name="title" value="<?php echo $st[0]->s_name; ?>">
                                        </div>

                                        <?php if(!empty($st[0]->s_img)){ ?>
                                            <div class="input-group margin15">
                                                <div>Current Icon/Image</div>
                                                <img style="max-height: 100px;" src="<?php if(!empty($st[0]->s_img)) echo base_url().'assets/upload/state_icons/'.$st[0]->s_img; ?>">
                                            </div>
                                        <?php } ?>

                                        <div class="input-group margin15">
                                            <span class="input-group-addon">Image/Logo </span>
                                            <input type="file" class="form-control" accept='image/*' name="att_img"/>
                                        </div>

                                        <div class="text-right margin15">
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </div>
                                    </form>
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



                $("#edit_state").validate({
                    rules: {
                        title: "required",
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