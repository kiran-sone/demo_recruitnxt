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
            label {
                display: inline-block;
                max-width: 100%;
                margin-bottom: 5px;
                font-weight: normal;
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
                        Create New Page
                        <small>Set Page Structure</small>
                    </h1>
                    <a href="<?php echo base_url(); ?>cms/static_page" class="btn btn-danger pull-right">Back</a>
                </section>

                <section class="content container-fluid">
                    <div class="row">
                        <div class="col-md-6">
                            <!-- general form elements -->
                            <div class="box box-primary">
                                <div class="box-header with-border">
                                    <h4 style="display: inline-block; margin-right: 30px;">Set Structure | <?php echo $tab[0]->m_title; ?></h4>
                                    <?php
                                    if ($msg > 0) {
                                        ?>
                                        <span class="text-success" style="font-size:20px;">New tab is created</span>
                                        <a href="<?php echo base_url(); ?>cms/page_structure/<?php echo $msg; ?>" class="btn btn-info pull-right">Go to Next Step</a>
                                    <?php } ?>
                                </div>
                                <div class="box-body">
                                    <form action="" method="POST" id="add-tab" enctype="multipart/form-data">
                                        <div class="input-group margin15">
                                            <span class="input-group-addon">Page Title</span>
                                            <input type="text" class="form-control field" id="title" name="title" vtype="required" aria-label="Amount (to the nearest dollar)">

                                        </div>
                                        <div class="margin15">
                                            <div class="title-2 update_title">Meta Keywords</div>
                                            <textarea name="keyword" class="form-control"></textarea>
                                        </div>
                                        <div class="margin15">
                                            <div class="title-2 update_title">Meta Description</div>
                                            <textarea name="meta_desc" class="form-control"></textarea>
                                        </div>
                                        <div class="text-right margin15">
                                            <input type="submit" class="btn btn-info add-tab-bt" value="Submit"/>
                                        </div>
                                    </form>
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

                $("#add-tab").validate({
                    rules: {
                        title: "required"
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