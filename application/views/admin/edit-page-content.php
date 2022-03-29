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
                    <button type="button" class="btn btn-sm btn-danger pull-right" onclick="history.back();">Back</button>
                </section>

                <section class="content container-fluid">
                    <div class="row">
                        <div class="col-md-10">
                            <!-- general form elements -->
                            <div class="box box-primary">
                                <div class="box-header with-border">
                                    <h4 style="display: inline-block; margin-right: 30px;">Edit Page Content | <?php echo $p_data[0]->m_title; ?></h4>
                                    <?php
                                    if ($msg > 0) {
                                        ?>
                                        <span class="text-success" style="font-size:20px;">New tab is created</span>
                                        <a href="<?php echo base_url(); ?>cms/page_structure/<?php echo $msg; ?>" class="btn btn-info pull-right">Go to Next Step</a>
                                    <?php } ?>
                                </div>
                                <div class="box-body">
                                    <form action="" method="POST" id="add-tab" enctype="multipart/form-data">
                                        <div class="col-md-7" style="padding:0px; margin: 0px;">
                                            <div class="input-group margin15">
                                                <span class="input-group-addon">Title</span>
                                                <input type="text" class="form-control field" id="title" name="title" value="<?php echo $p_data[0]->pc_title; ?>"/>

                                            </div>
                                            <div class="margin15" style="border-bottom:solid 1px #ddd; padding-left: 20px; padding-bottom: 10px;">
                                                <label>
                                                    <input type="radio" <?php
                                                    if ($p_data[0]->pc_img_type == '2') {
                                                        echo 'checked';
                                                    }
                                                    ?> aria-label="..." class="radio_status" img_type="no" name="img_type" value="2">
                                                    <span>No Image</span>
                                                </label>
                                                <label>
                                                    <input type="radio" <?php
                                                    if ($p_data[0]->pc_img_type == '1') {
                                                        echo 'checked';
                                                    }
                                                    ?> aria-label="..." class="radio_status" img_type="img" name="img_type" value="1" style="margin-left:20px;">
                                                    <span>Single Image</span>
                                                </label>

                                                <label>
                                                    <input type="radio" <?php
                                                    if ($p_data[0]->pc_img_type == '0') {
                                                        echo 'checked';
                                                    }
                                                    ?> aria-label="..." class="radio_status" img_type="alb" name="img_type" value="0" style="margin-left:20px;">
                                                    <span>Album</span>
                                                </label>
                                            </div>
                                            <div class="margin15 add_wrap add_img_wrap" style="<?php if ($p_data[0]->pc_img_type != '1') { ?>display:none;<?php } ?>  margin-bottom: 20px;">
                                                <div class="col-md-6">
                                                    <div>Change Image</div>
                                                    <input type="hidden" name="c_mg" value="<?php echo $p_data[0]->pc_img; ?>">
                                                    <input type="file" class="field" id="img" accept='image/*'  name="img" aria-label="Amount (to the nearest dollar)">
                                                </div>
                                                <div class="col-md-6">
                                                    <div>Image Alignment</div>
                                                    <label>
                                                        <input type="radio" <?php
                                                        if ($p_data[0]->pc_img_align == '0') {
                                                            echo 'checked';
                                                        }
                                                        ?> aria-label="..."  class="radio_status"  name="img_align" value="0">
                                                        <span>Left</span>
                                                    </label>
                                                    <label>
                                                        <input type="radio" <?php
                                                        if ($p_data[0]->pc_img_align == '1') {
                                                            echo 'checked';
                                                        }
                                                        ?> aria-label="..." class="radio_status"  name="img_align" value="1" style="margin-left:20px;">
                                                        <span>Center</span>
                                                    </label>

                                                    <label>
                                                        <input type="radio" <?php
                                                        if ($p_data[0]->pc_img_align == '2') {
                                                            echo 'checked';
                                                        }
                                                        ?> aria-label="..." class="radio_status" name="img_align" value="2" style="margin-left:20px;">
                                                        <span>Right</span>
                                                    </label>
                                                </div>
                                                <div class="clearfix"></div>
                                                <br/>
                                            </div>
                                            <div class="margin15 add_wrap add_alb_wrap" <?php if ($p_data[0]->pc_img_type == 1 || $p_data[0]->pc_img_type == 2) { ?>style="display: none;" <?php } ?>>

                                                <div class="input-group margin15">
                                                    <span class="input-group-addon">Image Album</span>
                                                    <select class="form-control" name="album" id="album">
                                                        <option value="0">-Select Album-</option>
                                                        <?php
                                                        foreach ($album as $al_data) {
                                                            ?>
                                                            <option value="<?php echo $al_data->al_id; ?>" <?php if($al_data->al_id==$p_data[0]->pc_al_id){ ?> selected <?php } ?>><?php echo $al_data->al_title; ?></option>
                                                            <?php
                                                        }
                                                        ?>
                                                    </select>

                                                </div>

                                            </div>
                                            <div class="margin15">
                                                <div class="col-md-6">
                                                    <label>
                                                        <input type="checkbox" <?php
                                                        if ($p_data[0]->pc_type == 1) {
                                                            echo 'checked';
                                                        }
                                                        ?> aria-label="..." class="grid" name="grid" value="1">
                                                        <span>Add Grid</span>
                                                    </label>
                                                </div>
                                                <div class="col-md-6" style="padding:0px; margin: 0px;">
                                                    <select class="form-control field" name="colmn" id="colmn" <?php if ($p_data[0]->pc_type == 0) { ?>disabled="disabled" <?php } ?>>
                                                        <option value="4" <?php
                                                        if ($p_data[0]->pc_clm == 4) {
                                                            echo 'selected';
                                                        }
                                                        ?> >4 - Columns</option>
                                                        <option value="3" <?php
                                                        if ($p_data[0]->pc_clm == 3) {
                                                            echo 'selected';
                                                        }
                                                        ?> >3 - Columns</option>
                                                        <option value="2" <?php
                                                        if ($p_data[0]->pc_clm == 2) {
                                                            echo 'selected';
                                                        }
                                                        ?> >2 - Columns</option>
                                                        <option value="1" <?php
                                                        if ($p_data[0]->pc_clm == 1) {
                                                            echo 'selected';
                                                        }
                                                        ?> >1 - Column</option>
                                                    </select>
                                                </div>
                                                <div class="clearfix"></div>
                                            </div>

                                            <div class="margin15 grid_type_wrap" style="<?php if ($p_data[0]->pc_type != 1) { ?> display: none; <?php } ?>border-bottom:solid 1px #ddd; padding-left: 20px; padding-bottom: 10px;">
                                                <label>
                                                    <input type="radio" <?php
                                                    if ($p_data[0]->pc_grid_type == 1 || $p_data[0]->pc_grid_type == '') {
                                                        echo 'checked';
                                                    }
                                                    ?> aria-label="..." class="grid_type"  name="grid_type" value="1">
                                                    <span>Box Type</span>
                                                </label>
                                                <label>
                                                    <input type="radio" <?php
                                                    if ($p_data[0]->pc_grid_type == 2) {
                                                        echo 'checked';
                                                    }
                                                    ?> aria-label="..." class="grid_type"  name="grid_type" value="2" style="margin-left:20px;">
                                                    <span>Accordion</span>
                                                </label>

                                                <label>
                                                    <input type="radio" <?php
                                                    if ($p_data[0]->pc_grid_type == 3) {
                                                        echo 'checked';
                                                    }
                                                    ?> aria-label="..." class="grid_type" name="grid_type" value="3" style="margin-left:20px;">
                                                    <span>Carousel</span>
                                                </label>
                                            </div>

                                            <div class="margin15">
                                                <div class="col-md-6">
                                                    <label>
                                                        <input type="checkbox" <?php
                                                        if ($p_data[0]->pc_doc_type == 1) {
                                                            echo 'checked';
                                                        }
                                                        ?> aria-label="..." class="doc_folder" name="doc_folder" value="1">
                                                        <span>Add Document Folder</span>
                                                    </label>
                                                </div>
                                                <div class="col-md-6" style="padding:0px; margin: 0px;">
                                                    <select class="form-control field" name="folder_name" id="folder_name" disabled="disabled">
                                                        <option value=""> - Select Folder - </option>
                                                        <?php
                                                        foreach ($doc as $dc_data) {
                                                            ?>
                                                            <option value="<?php echo $dc_data->dc_id; ?>" <?php
                                                            if ($p_data[0]->pc_doc == $dc_data->dc_id) {
                                                                echo 'selected';
                                                            }
                                                            ?> ><?php echo $dc_data->dc_title; ?></option>
                                                                    <?php
                                                                }
                                                                ?>
                                                    </select>
                                                </div>
                                                <div class="clearfix"></div>
                                            </div>

                                            <div class="margin15">
                                                <div>Change Attach Document</div>
                                                <input type="file" class="form-control" id="att_doc" accept='application/pdf,.docx,application/vnd.ms-powerpoint,application/vnd.openxmlformats-officedocument.presentationml.slideshow,application/vnd.openxmlformats-officedocument.presentationml.presentation'  name="att_doc" placeholder="Docuemnt">
                                                <input type="hidden" name="c_attach" id="remove_attach" value="<?php echo $p_data[0]->pc_attachment; ?>">
                                            </div>
                                            <?php
                                            if (!empty($p_data[0]->pc_attachment)) {
                                                ?>
                                                <div class="margin15 att-wrap">
                                                    <div style="padding:5px; height: 50px; border: solid 1px #ddd;">
                                                        <a href="#" style="position:absolute;right:15px;color: #F5152A;" rid="<?php echo $p_data[0]->pc_id; ?>" class="btn btn-default btn-sm remove_attach_bt"><span class="fa fa-trash"></span></a>
                                                        <span><?php echo $p_data[0]->pc_attachment ?></span>
                                                        <div class="clearfix"></div>
                                                    </div>
                                                </div>
                                                <?php
                                            }
                                            ?>
                                        </div>
                                        <div class="col-md-5 img-wrap">
                                            <br/> <br/>
                                            <?php
                                            if (!empty($p_data[0]->pc_img)) {
                                                ?>
                                                <a href="#" style="position:absolute;right:15px;color: #F5152A;" rid="<?php echo $p_data[0]->pc_id; ?>" class="btn btn-default btn-sm remove_img_bt"><span class="fa fa-trash"></span></a>
                                                <img src="<?php echo base_url(); ?>assets/upload/content_img/<?php echo $p_data[0]->pc_img; ?>" width="100%">

                                                <?php
                                            }
                                            ?>
                                        </div>
                                        <div class="clearfix"></div>
                                        <div class="margin15">
                                            <span>Description</span>
                                        </div>
                                        <div class="margin15">
                                            <textarea rows="5" name="desc" id="editor" class="field ckeditor" ><?php echo $p_data[0]->pc_description; ?></textarea>
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

                $('.remove_img_bt').click(function (e) {
                    e.preventDefault();
                    var rid = $(this).attr('rid');
                    var f = confirm("Are you sure want remove image ?");
                    if (f == true)
                    {
                        $('.page_spin').show();
                        var dataString = "rid=" + rid + "&page=remove_content_img";
                        $.ajax({
                            type: "POST",
                            url: "<?php echo base_url(); ?>cms/ajax_page", data: dataString,
                            success: function (data1) {
                                $('.page_spin').hide();
                                $('.img-wrap').html("<h2>Image has been removed</h2>");
                            }, //success fun end
                        });//ajax end
                        
                    }
                });
                
                $('.remove_attach_bt').click(function (e) {
                    e.preventDefault();
                    var rid = $(this).attr('rid');
                    var f = confirm("Are you sure want remove attachment ?");
                    if (f == true)
                    {
                        $('.page_spin').show();
                        var dataString = "rid=" + rid + "&page=remove_content_attachment";
                        $.ajax({
                            type: "POST",
                            url: "<?php echo base_url(); ?>cms/ajax_page", data: dataString,
                            success: function (data1) {
                                $('.page_spin').hide();
                                $('.att-wrap').html("<h3>Attachment has been removed</h3>");
                            }, //success fun end
                        });//ajax end
                        
                    }
                });

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