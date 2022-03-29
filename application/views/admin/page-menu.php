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
                        <small>Content Page</small>
                    </h1>
                    <a href="<?php echo base_url(); ?>cms/static_page" class="btn btn-danger pull-right">Back</a>
                </section>

                <section class="content container-fluid">
                    <div class="row">
                        <div class="col-md-6">
                            <!-- general form elements -->
                            <div class="box box-primary">
                                <div class="box-header with-border">
                                    <h4 style="display: inline-block; margin-right: 30px;">Add New Tab</h4>
                                    <?php
                                    if ($msg > 0) {
                                        ?>
                                        <span class="text-success" style="font-size:20px;">New tab is created</span>
                                        <a href="<?php echo base_url(); ?>cms/page_structure/<?php echo $msg; ?>" class="btn btn-info pull-right">Go to Next Step</a>
                                    <?php } ?>
                                </div>
                                <div class="box-body">
                                    <form action="" method="POST" id="add-tab" enctype="multipart/form-data">
                                        <div style="border-bottom:solid 1px #ddd; padding-bottom: 10px;">
                                            <label>
                                                <input type="radio" checked  class="link_type" name="link_type" value="0">
                                                Static Page
                                            </label>
                                            <label style="margin-left:20px;">
                                                <input type="radio" class="link_type" name="link_type" value="1">
                                                Document
                                            </label>
                                            <label style="margin-left:20px;">
                                                <input type="radio"  class="link_type" name="link_type" value="2" style="margin-left:20px;">
                                                External Link
                                            </label>

                                        </div>
                                        <div class="input-group margin15 link_wrap" style="display:none;">
                                            <span class="input-group-addon">External Link</span>
                                            <input type="text" class="form-control field" id="ex_link" name="ex_link" vtype="required">

                                        </div>
                                        <div style="border-bottom:solid 1px #ddd; padding-bottom: 10px; padding-top: 10px;">
                                            <label>
                                                <input type="checkbox" checked aria-label="..." class="page_type" name="page_topmenu" value="1">
                                                <span>Top Menu Bar</span>
                                            </label>
<!--                                            <label style="margin-left:20px;">
                                                <input type="checkbox" aria-label="..." class="page_type" name="page_sidebar" value="1" style="margin-left:20px;">
                                                <span>In Sidebar</span>
                                            </label>-->
                                            <label style="margin-left:20px;">
                                                <input type="checkbox" aria-label="..." class="page_type" name="page_footer" value="1" style="margin-left:20px;">
                                                <span>In Footer</span>
                                            </label>
                                            <label style="margin-left:20px;">
                                                <input type="checkbox" aria-label="..." class="page_type" name="page_other" value="1" style="margin-left:20px;">
                                                <span>Other</span>
                                            </label><br/>
<!--                                            <label>
                                                <input type="checkbox" aria-label="..." class="page_type" name="page_notification" value="1">
                                                <span>Notification</span>
                                            </label>
                                            <label style="margin-left:20px;">
                                                <input type="checkbox" aria-label="..." class="page_type" name="page_announcement" value="1" style="margin-left:20px;">
                                                <span>Announcement</span>
                                            </label>

                                            <label style="margin-left:20px;">
                                                <input type="checkbox" aria-label="..." class="page_type" name="page_blog" value="1" style="margin-left:20px;">
                                                <span>Seminar</span>
                                            </label>-->

                                        </div>
                                        <div class="input-group margin15">
                                            <span class="input-group-addon">Tab Name</span>
                                            <input type="text" class="form-control field" id="m_tab" name="m_tab" vtype="required">

                                        </div>
                                        <div style="border-bottom:solid 1px #ddd; padding-bottom: 10px; padding-top: 10px;">
                                            <label>
                                                <input type="radio" checked aria-label="..." class="radio_status" name="status" value="1">
                                                <span>Main Tab</span>
                                            </label>
                                            <label style="margin-left:20px;">
                                                <input type="radio" aria-label="..." class="radio_status" name="status" value="0" style="margin-left:20px;">
                                                <span>Sub Tab</span>
                                            </label>

                                        </div>
                                        <div class="input-group margin15">
                                            <span class="input-group-addon">Tab Under</span>
                                            <select class="form-control field" name="sub_tab" id="sub_tab" disabled="disabled">
                                                <option value="0">-Select Main Tab-</option>
                                                <?php
                                                $tab = $CI->cms_model->get_main_menu();
                                                if (!empty($tab)) {
                                                    ?>
                                                    <optgroup label="Top Menu bar">
                                                        <?php
                                                        foreach ($tab as $tab_data) {
                                                            ?>
                                                            <option value="<?php echo $tab_data->m_id; ?>"><?php echo $tab_data->m_title; ?></option>
                                                            <?php
                                                            $sub_tab = $CI->cms_model->get_sub_tab($tab_data->m_id);
                                                            if (!empty($sub_tab)) {
                                                                foreach ($sub_tab as $sb_data) {
                                                                    ?>
                                                                    <option value="<?php echo $sb_data->m_id; ?>"> -- <?php echo $sb_data->m_title; ?></option>
                                                                    <?php
                                                                    $third_tab = $CI->cms_model->get_sub_tab($sb_data->m_id);
                                                                    if (!empty($third_tab)) {
                                                                        foreach ($third_tab as $th_data) {
                                                                            ?>
                                                                            <option value="<?php echo $th_data->m_id; ?>"> ---- <?php echo $th_data->m_title; ?></option>
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
                                        <div class="doc_wrap" style="display:none;">
                                            <div class="input-group margin15">
                                                <span class="input-group-addon">Document Title</span>
                                                <input type="text" class="form-control field" id="d_title" name="d_title" vtype="required">

                                            </div>
                                            <div class="title-2 margin15">Document file</div>
                                            <input type="file" class="field" id="att_doc" accept='application/pdf,.docx,application/vnd.ms-powerpoint,application/vnd.openxmlformats-officedocument.presentationml.slideshow,application/vnd.openxmlformats-officedocument.presentationml.presentation'  name="att_doc" placeholder="Docuemnt">
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
                            //url: true
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