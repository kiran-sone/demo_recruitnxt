<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Dashboard</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <?php include 'css-files.php'; ?>
        <link	 href="<?php echo base_url(); ?>assets/ckeditor/ckeditor.css" rel="stylesheet" type="text/css">
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
                        Manage Content
                        <small>Add Page Content</small>
                    </h1>
                    <a href="<?php echo base_url(); ?>cms/static_page" class="btn btn-danger pull-right">Back</a>
                </section>

                <section class="content container-fluid">
                    <div class="row">
                        <div class="col-md-10">
                            <!-- general form elements -->
                            <div class="box box-primary">
                                <div class="box-header with-border">
                                    <h4 style="display: inline-block; margin-right: 30px;">Add Page Content | <?php echo $p_data[0]->m_title; ?></h4>
                                    <?php
                                    if ($msg > 0) {
                                        ?>
                                        <span class="text-success" style="font-size:20px;">New tab is created</span>
                                        <a href="<?php echo base_url(); ?>cms/page_structure/<?php echo $msg; ?>" class="btn btn-info pull-right">Go to Next Step</a>
                                    <?php } ?>
                                </div>
                                <div class="box-body">
                                    <form action="" method="POST" id="add-tab" enctype="multipart/form-data">
                                        <div class="col-md-8" style="padding:0px; margin: 0px;">
                                            <div class="input-group margin15">
                                                <span class="input-group-addon">Title</span>
                                                <input type="text" class="form-control field" id="title" name="title" vtype="required" aria-label="Amount (to the nearest dollar)">

                                            </div>
                                            <div class="margin15" style="border-bottom:solid 1px #ddd; padding-left: 20px; padding-bottom: 10px;">
                                                <label>
                                                    <input type="radio" checked aria-label="..." class="radio_status" img_type="no" name="img_type" value="2">
                                                    <span>No Image</span>
                                                </label>
                                                <label>
                                                    <input type="radio" aria-label="..." class="radio_status" img_type="img" name="img_type" value="1" style="margin-left:20px;">
                                                    <span>Single Image</span>
                                                </label>

                                                <label>
                                                    <input type="radio" aria-label="..." class="radio_status" img_type="alb" name="img_type" value="0" style="margin-left:20px;">
                                                    <span>Album</span>
                                                </label>
                                            </div>
                                            <div class="margin15 add_wrap add_img_wrap" style="display:none; margin-bottom: 20px;">
                                                <div class="col-md-6">
                                                    <div>Image</div>
                                                    <input type="file" class="field" id="img" accept='image/*'  name="img" aria-label="Amount (to the nearest dollar)">
                                                </div>
                                                <div class="col-md-6">
                                                    <div>Image Alignment</div>
                                                    <label>
                                                        <input type="radio" checked aria-label="..." class="radio_status"  name="img_align" value="0">
                                                        <span>Left</span>
                                                    </label>
                                                    <label>
                                                        <input type="radio" aria-label="..." class="radio_status"  name="img_align" value="1" style="margin-left:20px;">
                                                        <span>Center</span>
                                                    </label>

                                                    <label>
                                                        <input type="radio" aria-label="..." class="radio_status" name="img_align" value="2" style="margin-left:20px;">
                                                        <span>Right</span>
                                                    </label>
                                                </div>
                                                <div class="clearfix"></div>
                                                <br/>
                                            </div>
                                            <div class="margin15 add_wrap add_alb_wrap" style="display:none;">

                                                <div class="input-group margin15">
                                                    <span class="input-group-addon">Image Album</span>
                                                    <select class="form-control field" name="album" id="album">
                                                        <option value="0">-Select Album-</option>
                                                        <?php
                                                        foreach ($album as $al_data) {
                                                            ?>
                                                            <option value="<?php echo $al_data->al_id; ?>"><?php echo $al_data->al_title; ?></option>
                                                            <?php
                                                        }
                                                        ?>
                                                    </select>

                                                </div>

                                            </div>
                                            <div class="margin15">
                                                <div class="col-md-6">
                                                    <label>
                                                        <input type="checkbox" aria-label="..." class="grid" name="grid" value="1">
                                                        <span>Add Grid</span>
                                                    </label>
                                                </div>
                                                <div class="col-md-6" style="padding:0px; margin: 0px;">
                                                    <select class="form-control field" name="colmn" id="colmn" disabled="disabled">
                                                        <option value="4">4 - Columns</option>
                                                        <option value="3">3 - Columns</option>
                                                        <option value="2">2 - Columns</option>
                                                        <option value="1">1 - Column</option>
                                                    </select>
                                                </div>
                                                <div class="clearfix"></div>
                                            </div>

                                            <div class="margin15 grid_type_wrap" style="display: none; border-bottom:solid 1px #ddd; padding-left: 20px; padding-bottom: 10px;">
                                                <label>
                                                    <input type="radio" checked aria-label="..." class="grid_type"  name="grid_type" value="1">
                                                    <span>Box Type</span>
                                                </label>
                                                <label>
                                                    <input type="radio" aria-label="..." class="grid_type"  name="grid_type" value="2" style="margin-left:20px;">
                                                    <span>Accordion</span>
                                                </label>

                                                <label>
                                                    <input type="radio" aria-label="..." class="grid_type" name="grid_type" value="3" style="margin-left:20px;">
                                                    <span>Carousel</span>
                                                </label>
                                            </div>

                                            <div class="margin15">
                                                <div class="col-md-6">
                                                    <label>
                                                        <input type="checkbox" aria-label="..." class="doc_folder" name="doc_folder" value="1">
                                                        <span>Add Document Folder</span>
                                                    </label>
                                                </div>
                                                <div class="col-md-6" style="padding:0px; margin: 0px;">
                                                    <select class="form-control field" name="folder_name" id="folder_name" disabled="disabled">
                                                        <option value=""> - Select Folder - </option>
                                                        <?php
                                                        foreach ($doc as $dc_data) {
                                                            ?>
                                                            <option value="<?php echo $dc_data->dc_id; ?>"><?php echo $dc_data->dc_title; ?></option>
                                                            <?php
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                                <div class="clearfix"></div>
                                            </div>

                                            <div class="margin15">
                                                <div>Attach Document</div>
                                                <input type="file" class="form-control" id="att_doc" accept='application/pdf,.docx,application/vnd.ms-powerpoint,application/vnd.openxmlformats-officedocument.presentationml.slideshow,application/vnd.openxmlformats-officedocument.presentationml.presentation'  name="att_doc" placeholder="Docuemnt">

                                            </div>
                                        </div>
                                        <div class="clearfix"></div>
                                        <div class="margin15">
                                            <span>Description</span>
                                        </div>
                                        <div class="margin15">
                                            <textarea rows="5" name="desc" id="typingarea" class="field ckeditor" ></textarea>
                                        </div>
                                        <div class="margin15 text-right">
                                            <input type="submit"  class="btn btn-info add-tab-bt" value="Submit"/>
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
        <script src="<?php echo base_url(); ?>assets/ckeditor/ckeditor.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/validation/jquery.validate-1.14.0.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/validation/jquery-validate.bootstrap-tooltip.js"></script>
        <script type="text/javascript">
            $(document).ready(function () {

                $('.radio_status').click(function () {
                    var status = $(this).attr('img_type');
                    if (status == 'no')
                    {
                        $('.add_wrap').slideUp();
                    }
                    if (status == 'img')
                    {
                        $('.add_wrap').slideUp();
                        $('.add_img_wrap').slideDown();
                    }
                    if (status == 'alb')
                    {
                        $('.add_wrap').slideUp();
                        $('.add_alb_wrap').slideDown();
                    }
                });

                $(".grid").change(function () {
                    if ($(this).is(":checked"))
                    {
                        $('#colmn').attr('disabled', false);
                        $('.grid_type_wrap').slideDown();
                    }
                    else
                    {
                        $('#colmn').attr('disabled', 'disabled');
                        $('.grid_type_wrap').slideUp();
                    }
                });

                $(".doc_folder").change(function () {
                    if ($(this).is(":checked"))
                    {
                        $('#folder_name').attr('disabled', false);
                    }
                    else
                    {
                        $('#folder_name').attr('disabled', 'disabled');
                    }
                });

                $("#add-tab").validate({
                    rules: {
                        title: "required",
                        img: "required",
                        folder_name: "required",
                        album: {
                            min: 1
                        }
                    },
                    messages: {
                        img: "Select Image",
                        album: "Select Album",
                        folder_name: "Select Document Folder"
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