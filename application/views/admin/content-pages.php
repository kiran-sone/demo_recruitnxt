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

            .edit-wrap{
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
                        Content Pages
                        <small></small>
                    </h1>
                </section>

                <section class="content container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <!-- general form elements -->
                            <div class="box box-primary">
                                <div class="box-header with-border">
                                    <h4 style="display: inline-block; margin-right: 30px; color: #3c8dbc;">Main Menubar</h4>

                                    <a href="<?php echo base_url(); ?>cms/page_menu" class="btn btn-info pull-right"><span class="fa fa-plus"></span> Create New Page</a>

                                </div>
                                <div class="box-body">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th style="width: 50px;">#</th>
                                                <th>Tabs</th>
                                                <th>Status</th>
                                                <th>Actions</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $no = 0;
                                            $tab = $CI->cms_model->get_main_menu();
                                            include 'menu-list.php';
                                            ?>
                                        </tbody>
                                    </table>   
                                </div><!-- /.box -->
                            </div>
                        </div>
                        <div class="clearfix"></div>


                    </div>


                    <div class="row">
                        <div class="col-md-12">
                            <!-- general form elements -->
                            <div class="box box-success">
                                <div class="box-header with-border">
                                    <h4 style="display: inline-block; margin-right: 30px; color: #00a65a;">Footer Menu</h4>

                                    <a href="<?php echo base_url(); ?>cms/page_menu" class="btn btn-info pull-right"><span class="fa fa-plus"></span> Create New Page</a>

                                </div>
                                <div class="box-body">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th style="width: 50px;">#</th>
                                                <th>Tabs</th>
                                                <th>Status</th>
                                                <th>Actions</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $no = 0;
                                            $tab = $CI->cms_model->get_footer_menu();
                                            include 'menu-list.php';
                                            ?>
                                        </tbody>
                                    </table>   
                                </div><!-- /.box -->
                            </div>
                        </div>
                        <div class="clearfix"></div>


                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <!-- general form elements -->
                            <div class="box box-warning">
                                <div class="box-header with-border">
                                    <h4 style="display: inline-block; margin-right: 30px; color: #f39c12;">Others </h4>

                                    <a href="<?php echo base_url(); ?>cms/page_menu" class="btn btn-info pull-right"><span class="fa fa-plus"></span> Create New Page</a>

                                </div>
                                <div class="box-body">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th style="width: 50px;">#</th>
                                                <th>Tabs</th>
                                                <th>Status</th>
                                                <th>Actions</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $no = 0;
                                            $tab = $CI->cms_model->get_other_menu();
                                            include 'menu-list.php';
                                            ?>
                                        </tbody>
                                    </table>   
                                </div><!-- /.box -->
                            </div>
                        </div>
                        <div class="clearfix"></div>


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
                $('.remove_page').click(function (e) {
                    e.preventDefault();
                    var pid = $(this).attr('pid');
                    var f = confirm("You will lose whole content and images of the this page. Are you sure want to delete this page ?");
                    if (f == true)
                    {
                        var dataString = "pid=" + pid + "&page=remove_page";
                        $(this).parent('td').parent('tr').hide();
                        $.ajax({
                            type: "POST",
                            url: "<?php echo base_url(); ?>cms/ajax_page",
                            data: dataString,
                            success: function (data1) {
                                alert('Page remove successfuly');
                            }, //success fun end
                        });//ajax end
                    }
                });

                $('.update-order').click(function (e) {
                    e.preventDefault();
                    var mid = $(this).attr('mid');
                    var ord = $('#m' + mid + '').val();
                    $('.page_spin').show();
                    var dataString = "mid=" + mid + "&ord=" + ord + "&page=update_menu_order";
                    $.ajax({
                        type: "POST",
                        url: "<?php echo base_url(); ?>cms/ajax_page",
                        data: dataString,
                        success: function (data1) {
                            $('.page_spin').hide();
                        }, //success fun end
                    });//ajax end
                });

                
                $('.status-btn').click(function (e) {
                    e.preventDefault();
                    var aid = $(this).attr('aid');
                    var status = $(this).attr('status');
                    if(status=='0'){
                        $(this).attr('status','1');
                        $(this).removeClass('status-on');
                        $(this).addClass('status-off');
                        
                        $(this).children("i").removeClass('fa-toggle-on');
                        $(this).children("i").addClass('fa-toggle-off');
                    } else {
                        $(this).attr('status','0');
                        $(this).removeClass('status-off');
                        $(this).addClass('status-on');
                        
                        $(this).children("i").removeClass('fa-toggle-off');
                        $(this).children("i").addClass('fa-toggle-on');
                    }
                    var dataString = "mid=" + aid + "&status=" + status + "&page=update_tab_status";
                    $('.page_spin').show();
                    $.ajax({
                        type: "POST",
                        url: "<?php echo base_url(); ?>cms/ajax_page",
                        data: dataString,
                        success: function (data) {
                            $('.page_spin').hide();
                        }, //success fun end

                    });//ajax end
                });
                
            });

        </script>
    </body>
</html>