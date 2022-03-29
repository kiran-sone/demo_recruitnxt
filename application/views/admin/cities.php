<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Cities</title>
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
                        Master - City
                        <small>Manage Cities</small>
                    </h1>
                </section>

                <section class="content container-fluid">
                    <div class="row">
                        <div class="col-md-6">
                            <!-- general form elements -->
                            <div class="box box-primary">
                                <div class="box-header with-border">
                                    <h4 style="display: inline-block;">Add City</h4>

                                </div>
                                <div class="box-body">
                                    <form action="" method="POST" id="add_city">

                                        <div class="input-group">
                                            <span class="input-group-addon">State *</span>
                                            <select class="form-control" name="sid">
                                                <option value=""> - Select - </option>
                                                <?php
                                                if (!empty($states)) {
                                                    foreach ($states as $ct_data) {
                                                        ?>
                                                        <option value="<?php echo $ct_data->s_id; ?>"><?php echo $ct_data->s_name; ?></option>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>

                                        <div class="input-group margin15">
                                            <span class="input-group-addon">City name *</span>
                                            <input type="text" class="form-control" name="title">
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

                        <div class="col-md-6">
                            <!-- general form elements -->
                            <div class="box box-success">
                                <div class="box-header with-border">
                                    <h4 style="display: inline-block; margin-right: 30px;">City List</h4>
                                    <?php
                                    if ($msg == 1) {
                                        ?>
                                        <span class="text-success" style="font-size:20px;">New Category Added</span>
                                    <?php } ?>
                                </div>
                                <div class="box-body">
                                    <div>
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>City Name</th>
                                                    <th>State</th>
                                                    <?php if($ses_u_type!='operator'){ ?>
                                                        <th>Action</th>
                                                        <?php
                                                    }
                                                    ?>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                if (!empty($cities)) {
                                                    $no = 0;
                                                    foreach ($cities as $ct_data) {
                                                        $no++;
                                                        ?>
                                                        <tr class="bg-warning">
                                                            <td><?php echo $no; ?></td>
                                                            <td><?php echo $ct_data->c_name; ?></td>
                                                            <td><?php echo $ct_data->s_name; ?></td>
                                                            <?php if($ses_u_type!='operator'){ ?>
                                                                <td>
                                                                    <a href="<?php echo base_url(); ?>my_adminpath/edit_city/<?php echo $ct_data->c_id; ?>" class=" btn-sm btn-info"><i class="fa fa-edit"></i></a>
                                                                    <?php if($ses_u_type!='manager'){ ?>
                                                                        <a href="#" class=" btn-sm btn-danger delete_btn" cid="<?php echo $ct_data->c_id; ?>"><i class="fa fa-trash"></i></a>
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
                    var cid = $(this).attr('cid');
                    var dataString = "cid=" + cid + "&page=delete_city";
                    var f = confirm('Are you sure to delete this city?');
                    if (f == true) {
                        $('.page_spin').show();
                        $.ajax({
                            type: "POST",
                            url: "<?php echo base_url(); ?>my_adminpath/ajax_page",
                            data: dataString,
                            success: function (data1) {
                                window.location = "<?php echo base_url(); ?>my_adminpath/cities";
                            }, //success fun end

                        });//ajax end
                    }
                });


                $("#add_city").validate({
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