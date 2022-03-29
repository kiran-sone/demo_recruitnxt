<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Edit City</title>
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
                    <h1 style="display: inline-block;">
                        Master - City
                        <small>Manage Cities</small>
                    </h1>
                    <a href="<?php echo base_url(); ?>my_adminpath/cities" class="btn btn-danger pull-right">Back</a>

                </section>

                <section class="content container-fluid">
                    <div class="row">
                        <div class="col-md-6">
                            <!-- general form elements -->
                            <div class="box box-primary">
                                <div class="box-header with-border">
                                    <h4 style="display: inline-block; margin-right: 30px;">Edit City</h4>
                                    <?php
                                    if ($msg == 1) {
                                        ?>
                                        <span class="text-success" style="font-size:20px;">City details are updated</span>
                                    <?php } ?>
                                </div>
                                <div class="box-body">
                                    <form action="" method="POST" id="add-category">
                                        <div class="input-group">
                                            <span class="input-group-addon">City Name *</span>
                                            <input type="hidden" class="form-control" name="cid" value="<?php echo $city[0]->c_id; ?>">
                                            <input type="text" class="form-control" name="title" value="<?php echo $city[0]->c_name; ?>">
                                        </div>

                                        <div class="input-group margin15">
                                            <span class="input-group-addon">State *</span>
                                            <select class="form-control" name="sid">
                                                <option value=""> - Select - </option>
                                                <?php
                                                if (!empty($states)) {
                                                    foreach ($states as $st_data) {
                                                        ?>
                                                        <option value="<?php echo $st_data->s_id; ?>" <?php if($st_data->s_id==$city[0]->s_id){ echo 'selected'; } ?>><?php echo $st_data->s_name; ?></option>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </select>
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

                $("#add-category").validate({
                    rules: {
                        sid: "required",
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