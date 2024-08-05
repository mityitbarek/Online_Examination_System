<!DOCTYPE html>
<html>



<head>
    <link rel="shortcut icon" href="<?php echo SITEURL ?>images/logo.jpg" />

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>DTU Exam | Teacher</title>

    <?php //include('./includes/css3.php') 
    if (!isset($_SESSION['teacher'])) {
        header('location:' . SITEURL . 'teacher/index.php?page=login');
    }
    ?>
    <link href="<?php echo SITEURL ?>asset2/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo SITEURL ?>asset2/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="<?php echo SITEURL ?>asset2/css/plugins/iCheck/custom.css" rel="stylesheet">
    <link href="<?php echo SITEURL ?>asset2/css/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css" rel="stylesheet">
    <link href="<?php echo SITEURL ?>asset2/css/plugins/colorpicker/bootstrap-colorpicker.min.css" rel="stylesheet">
    <link href="<?php echo SITEURL ?>asset2/css/plugins/cropper/cropper.min.css" rel="stylesheet">
    <link href="<?php echo SITEURL ?>asset2/css/plugins/switchery/switchery.css" rel="stylesheet">
    <link href="<?php echo SITEURL ?>asset2/css/plugins/jasny/jasny-bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo SITEURL ?>asset2/css/plugins/nouslider/jquery.nouislider.css" rel="stylesheet">
    <link href="<?php echo SITEURL ?>asset2/css/plugins/dataTables/datatables.min.css" rel="stylesheet">
    <link href="<?php echo SITEURL ?>asset2/css/plugins/datapicker/datepicker3.css" rel="stylesheet">
    <link href="<?php echo SITEURL ?>asset2/css/plugins/ionRangeSlider/ion.rangeSlider.css" rel="stylesheet">
    <link href="<?php echo SITEURL ?>asset2/css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css" rel="stylesheet">
    <link href="<?php echo SITEURL ?>asset2/css/plugins/clockpicker/clockpicker.css" rel="stylesheet">
    <link href="<?php echo SITEURL ?>asset2/css/plugins/daterangepicker/daterangepicker-bs3.css" rel="stylesheet">
    <link href="<?php echo SITEURL ?>asset2/css/plugins/select2/select2.min.css" rel="stylesheet">
    <link href="<?php echo SITEURL ?>asset2/css/plugins/select2/select2-bootstrap4.min.css" rel="stylesheet">
    <link href="<?php echo SITEURL ?>asset2/css/plugins/touchspin/jquery.bootstrap-touchspin.min.css" rel="stylesheet">
    <link href="<?php echo SITEURL ?>asset2/css/plugins/dualListbox/bootstrap-duallistbox.min.css" rel="stylesheet">
    <link href="<?php echo SITEURL ?>asset2/css/animate.css" rel="stylesheet">
    <link href="<?php echo SITEURL ?>asset2/css/style.css" rel="stylesheet">
    <link href="<?php echo SITEURL ?>asset2/css/TimeCircles.css" rel="stylesheet">
    <link href="<?php echo SITEURL ?>asset2/css/bootstrap-datetimepicker.css" rel="stylesheet">



</head>

<body class="md-skin pace-done">

    <div id="wrapper">
        <?php include('sidenav.php'); ?>


        <div id="page-wrapper" class="gray-bg">
            <div class="row border-bottom">
                <?php include('./top_nav.php') ?>
            </div>
            <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-sm-4">

                    <h4><span class="label label-info"><?php echo $_SESSION['dept_name'] ?></span></h4>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="<?php echo SITEURL; ?>teacher/index.php?page=dashboard">Home</a>
                        </li>


                    </ol>
                </div>
                <div class="col-sm-8">
                    <div class="title-action">
                    </div>
                </div>
            </div>

            <div class="wrapper wrapper-content animated fadeInRight">
                <div id="courses_list" class="row">

                </div>
            </div>

            <div class="footer">
                <div class="float-right">
                    Home
                </div>
                <div>
                    <strong>Copyright</strong> DTU &copy; <?php echo date("Y") ?>
                </div>
            </div>

        </div>
    </div>

    <?php include("includes/scripts3.php") ?>
    <script src="<?php echo SITEURL ?>asset2/js/bootstrap-datetimepicker.js"></script>
    <script src="<?php echo SITEURL ?>asset2/js/TimeCircles.js"></script>


</body>

<script>
    $(document).ready(function nme() {
        $("body").tooltip({
            selector: '[data-toggle=tooltip]'
        });

        $(document).on('click', '.activate_request', function() {
            // console.log('activate button clicked')
            const request_id = $(this).data('request_id');
            const request_value = $(this).data('request_value')
            $.ajax({
                url: "<?php echo SITEURL; ?>teacher/ajax_teacher.php",
                method: "POST",
                data: {
                    page: "activate_exam_request",
                    action: "update",
                    request_value: request_value,
                    request_id: request_id
                },
                success: function(data) {
                    // alert(typeof jQuery.parseJSON(data).number_of_requests)
                    if (jQuery.parseJSON(data).number_of_requests == 0) {
                        $('#number_of_requests').hide()
                    } else {
                        $('#number_of_requests').show()
                        $('#number_of_requests').html(jQuery.parseJSON(data).number_of_requests);
                    }
                    $('.dropdown-messages').html(jQuery.parseJSON(data).drop_down_component);
                    // alert(jQuery.parseJSON(data).drop_down_component)
                },

            });

        });
        $(document).on('click', '.cancel_request', function() {
            // console.log('cancel button clicked')

            const request_id = $(this).data('request_id');
            const request_value = $(this).data('request_value')
            $.ajax({
                url: "<?php echo SITEURL; ?>teacher/ajax_teacher.php",
                method: "POST",
                data: {
                    page: "activate_exam_request",
                    action: "update",
                    request_value: request_value,
                    request_id: request_id
                },
                success: function(data) {
                    // alert(typeof jQuery.parseJSON(data).number_of_requests)
                    if (jQuery.parseJSON(data).number_of_requests == 0) {
                        $('#number_of_requests').hide()
                    } else {
                        $('#number_of_requests').show()
                        $('#number_of_requests').html(jQuery.parseJSON(data).number_of_requests);
                    }
                    $('.dropdown-messages').html(jQuery.parseJSON(data).drop_down_component);
                    // alert(jQuery.parseJSON(data).drop_down_component)
                },

            });
        });

        $.ajax({
            url: "<?php echo SITEURL; ?>teacher/ajax_teacher.php",
            method: "POST",
            data: {
                page: "dashboard",
                action: "fetch"
            },
            success: function(data) {
                $('#courses_list').html(data);
            },
            error: function(responseObj) {
                alert("Something went wrong while processing your request.\n\nError => " +
                    responseObj.responseText);
            }
        });
    });
</script>

</html>