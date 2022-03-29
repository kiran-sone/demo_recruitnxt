<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
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
                        Master - States
                        <small>Manage States</small>
                    </h1>
                </section>

                <section class="content container-fluid">
                    <div class="row">
                        <div class="col-lg-8 col-md-8">
                            <!-- general form elements -->
                            <div class="box box-primary">
                                <div class="box-header with-border">
                                    <h4 style="display: inline-block;">Add State</h4>

                                </div>
                                <div class="box-body">
                                    <form action="" method="POST" id="add-state" enctype="multipart/form-data">

                                        <div class="input-group">
                                            <span class="input-group-addon">State Title *</span>
                                            <input type="text" class="form-control" name="title">
                                        </div>

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

                        <div class="clearfix">
                        </div>

                        <div class="col-lg-8 col-md-8">
                            <!-- general form elements -->
                            <div class="box box-success">
                                <div class="box-header with-border">
                                    <h4 style="display: inline-block; margin-right: 30px;">States List</h4>
                                    <?php
                                    if ($msg == 1) {
                                        ?>
                                        <span class="text-success" style="font-size:20px;">New state is added</span>
                                    <?php } ?>
                                </div>
                                <div class="box-body">
                                    <div>
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Title</th>
                                                    <th>Image/Icon</th>
                                                    <?php if($ses_u_type!='operator'){ ?>
                                                        <th>Action</th>
                                                        <?php
                                                    }
                                                    ?>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $no = 0;
                                                if (!empty($sts)) {
                                                    foreach ($sts as $ct_data) {
                                                        $no++;
                                                        ?>
                                                        <tr>
                                                            <td><?php echo $no; ?></td>
                                                            <td><?php echo $ct_data->s_name; ?></td>
                                                            <td><img style="max-height: 100px;" src="<?php if(!empty($ct_data->s_img)) echo base_url().'assets/upload/state_icons/'.$ct_data->s_img; ?>"></td>
                                                            <?php if($ses_u_type!='operator'){ ?>
                                                                <td>
                                                                    <a href="<?php echo base_url(); ?>my_adminpath/edit_state/<?php echo $ct_data->s_id; ?>" class=" btn-sm btn-info"><i class="fa fa-edit"></i></a>
                                                                    <?php if($ses_u_type!='manager'){ ?>
                                                                        <a href="#" class=" btn-sm btn-danger delete_btn" sid="<?php echo $ct_data->s_id; ?>"><i class="fa fa-trash"></i></a>
                                                                        <?php
                                                                    }
                                                                    ?>
                                                                </td>
                                                                <?php
                                                            }
                                                            ?>
                                                        </tr>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </tbody>

                                        </table>
                                    </div>
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
                
                $('.delete_btn').click(function (e) {
                    e.preventDefault();
                    var sid = $(this).attr('sid');
                    var dataString = "sid=" + sid + "&page=delete_state";
                    var f = confirm('Are you sure to delete this state? Its cities will also be deleted');
                    if (f == true) {
                        $('.page_spin').show();
                        $.ajax({
                            type: "POST",
                            url: "<?php echo base_url(); ?>my_adminpath/ajax_page",
                            data: dataString,
                            success: function (data1) {
                                window.location = "<?php echo base_url(); ?>my_adminpath/states";
                            }, //success fun end

                        });//ajax end
                    }
                });


                $("#add-state").validate({
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