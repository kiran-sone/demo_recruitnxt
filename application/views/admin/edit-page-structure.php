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
                        Edit Page Menu
                        <small><?php echo $tab_name[0]->m_title; ?></small>
                    </h1>
                    <a href="<?php echo base_url(); ?>cms/static_page" class="btn btn-danger pull-right">Back</a>
                </section>

                <section class="content container-fluid">
                    <div class="row">
                        <div class="col-md-6">
                            <!-- general form elements -->
                            <div class="box box-primary">
                                <div class="box-header with-border">
                                    <h4 style="display: inline-block; margin-right: 30px;">Edit menu details</h4>
                                    <?php
                                    if ($msg > 0) {
                                        ?>
                                        <span class="text-success" style="font-size:20px;">Page menu details are updated</span>
                                    <?php } ?>
                                </div>
                                <div class="box-body">
                                    <form action="" method="POST" id="add-tab" enctype="multipart/form-data">

                                        <input type="hidden" value="<?php echo $tab_name[0]->m_ex_link; ?>" name="ex_page"/>
                                        <input type="hidden" value="<?php echo $tab_name[0]->m_doc_path; ?>" name="c_attach"/>

                                        <div style="border-bottom:solid 1px #ddd; padding-bottom: 10px;">
                                            <label>
                                                <input type="radio" <?php
                                                if ($tab_name[0]->m_link_type == 0) {
                                                    echo 'checked';
                                                }
                                                ?>  class="link_type" name="link_type" value="0">
                                                Static Page
                                            </label>
                                            <label style="margin-left:20px;">
                                                <input type="radio" <?php
                                                if ($tab_name[0]->m_link_type == 1) {
                                                    echo 'checked';
                                                }
                                                ?> class="link_type" name="link_type" value="1">
                                                Document
                                            </label>
                                            <label style="margin-left:20px;">
                                                <input type="radio" <?php
                                                if ($tab_name[0]->m_link_type == 2) {
                                                    echo 'checked';
                                                }
                                                ?> class="link_type" name="link_type" value="2" style="margin-left:20px;">
                                                External Link
                                            </label>

                                        </div>
                                        <div class="input-group margin15 link_wrap" style="display:<?php
                                        if ($tab_name[0]->m_link_type == 2) {
                                            echo 'block';
                                        } else {
                                            echo 'none';
                                        }
                                        ?>;">
                                            <span class="input-group-addon">External Link</span>
                                            <input type="text" class="form-control" id="ex_link" name="ex_link" value="<?php echo $tab_name[0]->m_ex_link; ?>">

                                        </div>

                                        <div style="border-bottom:solid 1px #ddd; padding-bottom: 10px; padding-top: 10px;">
                                            <label>
                                                <input type="checkbox" <?php
                                                if ($tab_name[0]->m_topmenu == '1') {
                                                    echo 'checked';
                                                }
                                                ?> aria-label="..." class="page_type"  name="page_topmenu" value="1">
                                                <span>Top Menu Bar</span>
                                            </label>

                                            <label style="margin-left:20px;">
                                                <input type="checkbox" <?php
                                                if ($tab_name[0]->m_footer == '1') {
                                                    echo 'checked';
                                                }
                                                ?> aria-label="..." class="page_type" name="page_footer" value="1" style="margin-left:20px;">
                                                <span>In Footer</span>
                                            </label>
                                            <label style="margin-left:20px;">
                                                <input type="checkbox" <?php
                                                if ($tab_name[0]->m_other == '1') {
                                                    echo 'checked';
                                                }
                                                ?> aria-label="..." class="page_type" name="page_other" value="1" style="margin-left:20px;">
                                                <span>Other</span>
                                            </label><br/>


                                        </div>

                                        <div class="input-group margin15">
                                            <span class="input-group-addon">Tab Name</span>
                                            <input type="text" class="form-control" id="m_tab" name="m_tab" value="<?php echo $tab_name[0]->m_title; ?>">

                                        </div>
                                        <div style="border-bottom:solid 1px #ddd; padding-bottom: 10px; padding-top: 10px;">
                                            <label>
                                                <input type="radio" <?php
                                                if ($tab_name[0]->m_type == 1) {
                                                    echo 'checked';
                                                }
                                                ?> aria-label="..."  class="radio_status" name="status" value="1">
                                                <span>Main Tab</span>
                                            </label>
                                            <label style="margin-left:20px;">
                                                <input type="radio" <?php
                                                if ($tab_name[0]->m_type == 0) {
                                                    echo 'checked';
                                                }
                                                ?> aria-label="..." class="radio_status" name="status" value="0" style="margin-left:20px;">
                                                <span>Sub Tab</span>
                                            </label>

                                        </div>
                                        <div class="input-group margin15">
                                            <span class="input-group-addon">Tab Under</span>


                                            <select class="form-control field" name="sub_tab" id="sub_tab" <?php
                                            if ($tab_name[0]->m_type == 1) {
                                                ?>
                                                        disabled="disabled"
                                                        <?php
                                                    }
                                                    ?> >
                                                <option value="0">-Select Main Tab-</option>
                                                <?php
                                                $tab = $CI->cms_model->get_main_menu();
                                                if (!empty($tab)) {
                                                    ?>
                                                    <optgroup label="Top Menu bar">
                                                        <?php
                                                        foreach ($tab as $tab_data) {
                                                            ?>
                                                            <option value="<?php echo $tab_data->m_id; ?>" <?php
                                                            if ($tab_data->m_id == $tab_name[0]->m_main) {
                                                                echo 'selected';
                                                            }
                                                            ?> ><?php echo $tab_data->m_title; ?></option>
                                                                    <?php
                                                                    $sub_tab = $CI->cms_model->get_sub_tab($tab_data->m_id);
                                                                    if (!empty($sub_tab)) {
                                                                        foreach ($sub_tab as $sb_data) {
                                                                            ?>
                                                                    <option value="<?php echo $sb_data->m_id; ?>" <?php
                                                                    if ($sb_data->m_id == $tab_name[0]->m_main) {
                                                                        echo 'selected';
                                                                    }
                                                                    ?> > -- <?php echo $sb_data->m_title; ?></option>
                                                                            <?php
                                                                            $third_tab = $CI->cms_model->get_sub_tab($sb_data->m_id);
                                                                            if (!empty($third_tab)) {
                                                                                foreach ($third_tab as $th_data) {
                                                                                    ?>
                                                                            <option value="<?php echo $th_data->m_id; ?>" <?php
                                                                            if ($th_data->m_id == $tab_name[0]->m_main) {
                                                                                echo 'selected';
                                                                            }
                                                                            ?> > ---- <?php echo $th_data->m_title; ?></option>
                                                                                    <?php
                                                                                }
                                                                            }
                                                                        }
                                                                    }
                                                                }
                                                                ?>
                                                    </optgroup>
                                                    <?php
                                                }
                                                
                                                $tab = $CI->cms_model->get_sidebar_menu();
                                                if (!empty($tab)) {
                                                    ?>
                                                    <optgroup label="In Sidebar">
                                                        <?php
                                                        foreach ($tab as $tab_data) {
                                                            ?>
                                                            <option value="<?php echo $tab_data->m_id; ?>" <?php
                                                            if ($tab_data->m_id == $tab_name[0]->m_main) {
                                                                echo 'selected';
                                                            }
                                                            ?> ><?php echo $tab_data->m_title; ?></option>
                                                                    <?php
                                                                    $sub_tab = $CI->cms_model->get_sub_tab($tab_data->m_id);
                                                                    if (!empty($sub_tab)) {
                                                                        foreach ($sub_tab as $sb_data) {
                                                                            ?>
                                                                    <option value="<?php echo $sb_data->m_id; ?>" <?php
                                                                    if ($sb_data->m_id == $tab_name[0]->m_main) {
                                                                        echo 'selected';
                                                                    }
                                                                    ?> > -- <?php echo $sb_data->m_title; ?></option>
                                                                            <?php
                                                                            $third_tab = $CI->cms_model->get_sub_tab($sb_data->m_id);
                                                                            if (!empty($third_tab)) {
                                                                                foreach ($third_tab as $th_data) {
                                                                                    ?>
                                                                            <option value="<?php echo $th_data->m_id; ?>" <?php
                                                                            if ($th_data->m_id == $tab_name[0]->m_main) {
                                                                                echo 'selected';
                                                                            }
                                                                            ?> > ---- <?php echo $th_data->m_title; ?></option>
                                                                                    <?php
                                                                                }
                                                                            }
                                                                        }
                                                                    }
                                                                }
                                                                ?>
                                                    </optgroup>
                                                    <?php
                                                }
                                                
                                                
                                                $tab = $CI->cms_model->get_notification_menu();
                                                if (!empty($tab)) {
                                                    ?>
                                                    <optgroup label="Notification">
                                                        <?php
                                                        foreach ($tab as $tab_data) {
                                                            ?>
                                                            <option value="<?php echo $tab_data->m_id; ?>" <?php
                                                            if ($tab_data->m_id == $tab_name[0]->m_main) {
                                                                echo 'selected';
                                                            }
                                                            ?> ><?php echo $tab_data->m_title; ?></option>
                                                                    <?php
                                                                    $sub_tab = $CI->cms_model->get_sub_tab($tab_data->m_id);
                                                                    if (!empty($sub_tab)) {
                                                                        foreach ($sub_tab as $sb_data) {
                                                                            ?>
                                                                    <option value="<?php echo $sb_data->m_id; ?>" <?php
                                                                    if ($sb_data->m_id == $tab_name[0]->m_main) {
                                                                        echo 'selected';
                                                                    }
                                                                    ?> > -- <?php echo $sb_data->m_title; ?></option>
                                                                            <?php
                                                                            $third_tab = $CI->cms_model->get_sub_tab($sb_data->m_id);
                                                                            if (!empty($third_tab)) {
                                                                                foreach ($third_tab as $th_data) {
                                                                                    ?>
                                                                            <option value="<?php echo $th_data->m_id; ?>" <?php
                                                                            if ($th_data->m_id == $tab_name[0]->m_main) {
                                                                                echo 'selected';
                                                                            }
                                                                            ?> > ---- <?php echo $th_data->m_title; ?></option>
                                                                                    <?php
                                                                                }
                                                                            }
                                                                        }
                                                                    }
                                                                }
                                                                ?>
                                                    </optgroup>
                                                    <?php
                                                }
                                                
                                                
                                                ?>
                                            </select>

                                        </div>
                                        <div class="doc_wrap" style="display:<?php
                                        if ($tab_name[0]->m_link_type == 1) {
                                            echo 'block';
                                        } else {
                                            echo 'none';
                                        }
                                        ?>;">
                                            <div class="input-group margin15">
                                                <span class="input-group-addon">Document Title</span>
                                                <input type="text" class="form-control field" value="<?php echo $tab_name[0]->m_doc_title; ?>" id="d_title" name="d_title" vtype="required">

                                            </div>
                                            <div class="title-2 margin15">Document file</div>
                                            <input type="file" class="field" id="att_doc" accept='application/pdf,.docx,application/vnd.ms-powerpoint,application/vnd.openxmlformats-officedocument.presentationml.slideshow,application/vnd.openxmlformats-officedocument.presentationml.presentation'  name="att_doc" placeholder="Docuemnt">
                                        </div>

                                        <div class="input-group margin15">
                                            <span class="input-group-addon">Page Title</span>
                                            <input type="text" class="form-control" value="<?php
                                            if (!empty($p_data)) {
                                                echo $p_data[0]->ps_title;
                                            }
                                            ?>" id="title" name="title" />

                                        </div>
                                        <div class="margin15">
                                            <div class="title-2 update_title">Meta Keywords</div>
                                            <textarea name="keyword" class="form-control"><?php
                                                if (!empty($p_data)) {
                                                    echo $p_data[0]->ps_keywords;
                                                }
                                                ?></textarea>
                                        </div>
                                        <div class="margin15">
                                            <div class="title-2 update_title">Meta Description</div>
                                            <textarea name="meta_desc" class="form-control"><?php
                                                if (!empty($p_data)) {
                                                    echo $p_data[0]->ps_description;
                                                }
                                                ?></textarea>
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
                        m_tab: "required",
                        sub_tab: {
                            min: 1
                        },
                        d_title: "required",
                        att_doc: "required",
                        ex_link: {
                            required: true,
                            // url: true
                        },
                    },
                    messages: {
                        sub_tab: "Select Main tab",
                    },
                    tooltip_options: {
                        inst: {
                            trigger: 'focus',
                        },
                    },
                });

                $('.radio_status').click(function () {
                    var status = $(this).val();
                    if (status == 1)
                    {
                        $('#sub_tab').attr('disabled', 'disabled');
                        $('#sub_tab').val(0);
                    }
                    else
                    {
                        $('#sub_tab').attr('disabled', false);
                    }
                });


                $('.link_type').change(function () {
                    var link = $(this).val();
                    if (link == '1')
                    {
                        $('.doc_wrap').show();
                    }
                    else
                    {
                        $('.doc_wrap').hide();

                    }
                    if (link == '2')
                    {
                        $('.link_wrap').show();
                    }
                    else {

                        $('.link_wrap').hide();
                    }
                });
            });
        </script>
    </body>
</html>