<!DOCTYPE html>
<html>



<head>

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
                        <li class="breadcrumb-item">
                            <a href="#">Student Result</a>
                        </li>


                    </ol>
                </div>
                <div class="col-sm-8">
                    <div class="title-action">
                        <!-- <a href="#" class="btn btn-outline btn-rounded btn-primary">Check Invigilation</a> -->
                    </div>
                </div>
            </div>

            <div class="wrapper wrapper-content">
                <div class="animated fadeInRightBig">
                    <div class="row">

                        <div class="col-lg-12">
                            <div class="ibox float-e-margins">
                                <div class="ibox-title">
                                    <div class="label label-primary" style="padding: 0.5rem; font-size: 1rem;">
                                        <?php
                                        $tbl_name  = "tbl_exam join tbl_course on tbl_exam.course_id = tbl_course.course_id ";
                                        $where =  "exam_id = '" . $_GET['exam_id'] . "'";
                                        $query = $obj->select_data($tbl_name, $where);
                                        $res = $obj->execute_query($conn, $query);
                                        $row = $obj->fetch_data($res);
                                        echo $row['course_name'];
                                        ?>

                                    </div>
                                    <div class="ibox-tools">
                                        <a class="collapse-link">
                                            <i class="fa fa-chevron-up"></i>
                                        </a>
                                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                            <i class="fa fa-wrench"></i>
                                        </a>

                                        <a class="close-link">
                                            <i class="fa fa-times"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="ibox-content">

                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered table-hover dataTables-example">
                                            <thead>
                                                <tr>
                                                    <th>Student ID</th>
                                                    <th>Name</th>
                                                    <th>Father's name</th>
                                                    <th>Score</th>
                                                    <th>Weight</th>

                                                </tr>
                                            </thead>

                                            <tfoot>
                                                <tr>
                                                    <th>Student ID</th>
                                                    <th>Name</th>
                                                    <th>Father's name</th>
                                                    <th>Score</th>
                                                    <th>Weight</th>
                                                </tr>
                                            </tfoot>
                                        </table>

                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>
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
    <!-- <script src="<?php echo SITEURL ?>asset2/js/bootstrap-datetimepicker.js"></script> -->
    <!-- <script src="<?php echo SITEURL ?>asset2/js/TimeCircles.js"></script> -->


</body>

<script>
    $.fn.dataTable.Buttons.defaults.dom.button.className = 'btn btn-white btn-sm';
    $(document).ready(function() {

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

        $("body").tooltip({
            selector: '[data-toggle=tooltip]'
        });

        $('.dataTables-example').DataTable({
            "processing": true,
            "serverSide": true,
            "order": [],
            responsive: true,
            "ajax": {
                url: "<?php echo SITEURL; ?>teacher/ajax_teacher.php",
                type: "POST",
                data: {
                    action: 'fetch',
                    exam_id: '<?php echo $_GET['exam_id'] ?>',
                    page: 'student_result'
                },

            },
            dom: '<"html5buttons"B>lTfgitp',
            buttons: [{
                    extend: 'copy',
                    title: 'Student_Result'

                },
                {
                    extend: 'csv',
                    title: 'Student_Result'

                },
                {
                    extend: 'excel',
                    title: 'Student_Result'
                },
                {
                    extend: 'pdf',
                    title: 'Student_Result'
                },

                {
                    extend: 'print',
                    customize: function(win) {
                        $(win.document.body).addClass('white-bg');
                        $(win.document.body).css('font-size', '10px');

                        $(win.document.body).find('table')
                            .addClass('compact')
                            .css('font-size', 'inherit');
                    }
                }
            ]

        });


    });
</script>

</html>