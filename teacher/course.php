<!DOCTYPE html>
<html>



<head>
    <link rel="shortcut icon" href="<?php echo SITEURL ?>images/logo.jpg" />
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>DTU Exam | Teacher | Courses</title>

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
                        <li class="breadcrumb-item active">
                            Courses
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
                                    &nbsp;&nbsp;&nbsp;
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
                                                    <th>ID</th>
                                                    <th>Course Code</th>
                                                    <th>Course Name</th>
                                                    <th>Teacher</th>
                                                    <th>Students</th>
                                                    <th>Delivered by</th>
                                                    <th></th>
                                                </tr>
                                            </thead>

                                            <tfoot>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Course Code</th>
                                                    <th>Course Name</th>
                                                    <th>Teacher</th>
                                                    <th>Students</th>
                                                    <th>Deliverd by</th>
                                                    <th></th>
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
            <div class="modal inmodal fade" id="add_exam" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                            <h4 class="modal-title">Add Exam</h4>
                        </div>
                        <div class="modal-body">
                            <form method="POST" class="wizard-big" id="insert_form">
                                <!-- <div class="form-group"><label>Course Code</label>
                                    <input class="form-control input-sm validate[required]" name="course_code" id="course_code" type="text" placeholder=" Enter Course Code">
                                </div> -->
                                <div class="form-group"><label>Exam Type</label>
                                    <select name="online_exam_type" id="online_exam_type" class="form-control" style="width: 100%">
                                        <option>Select Exam type here.</option>
                                        <option value="Quiz">Exit Exam</option>
                                        <option value="Test">Supplementary Exam</option>
                                        <option value="Final">Mock Exam</option>

                                    </select>
                                </div>

                                <div class="form-group"><label>Total Questions</label>
                                    <input class="form-control input-sm validate[required]" name="total_questions" id="course_name" type="number" placeholder=" Enter total questions">
                                </div>
                                <div class="form-group"><label>Exam Date and Time</label>
                                    <input type="text" name="online_exam_datetime" id="online_exam_datetime" class="form-control" readonly />

                                </div>
                                <div class="form-group"><label> Time Duration</label>
                                    <select name="online_exam_duration" id="online_exam_duration" class="form-control" style="width: 100%">
                                        <option value=""></option>
                                        <option value="5">5 Minutes</option>
                                        <option value="30">30 Minutes</option>
                                        <option value="45">45 Minutes</option>
                                        <option value="60">1 Hour</option>
                                        <option value="90">1:30 Minutes</option>
                                        <option value="105">1:45 Minutes</option>
                                        <option value="120">2 Hours</option>
                                        <option value="135">2:15 Minutes</option>
                                        <option value="150">2:30 Minutes</option>
                                        <option value="165">2:45 Minutes</option>
                                        <option value="180">3 Hours</option>
                                        <option value="210">3፡30 Minutes</option>
                                        <option value="240">4 Hours</option>
                                    </select>
                                </div>
                                <div id="add_information" class="form-group"></div>
                                <input type="hidden" name="course_id" id="course_id" value="" />
                                <input type="hidden" name="page" value="exam" />
                                <input type="hidden" name="action" id="action" value="Add" />
                                <input type="submit" name="insert" value="Insert Exam" id="insert" class="btn  btn-outline  btn-primary btn-rounded" />
                            </form>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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
    <script src="<?php echo SITEURL ?>asset2/js/bootstrap-datetimepicker.js"></script>

</body>
<script>
    $.fn.dataTable.Buttons.defaults.dom.button.className = 'btn btn-white btn-sm';
    $(document).ready(function() {
        // $('[data-toggle="tooltip"]').tooltip()
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
        var dataTable = $('.dataTables-example').DataTable({
            pageLength: 10,
            responsive: true,
            serverSide: true,
            order: [],
            "ajax": {
                url: "<?php echo SITEURL; ?>teacher/ajax_teacher.php",
                type: "POST",
                data: {
                    action: 'fetch',
                    page: 'course'
                }
            },
            dom: '<"html5buttons"B>lTfgitp',
            buttons: [{
                    extend: 'copy'
                },
                {
                    extend: 'csv'
                },
                {
                    extend: 'excel',
                    title: 'ExampleFile'
                },
                {
                    extend: 'pdf',
                    title: 'ExampleFile'
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
        $(document).on('click', '.edit-data', function() {
            var course_id = $(this).attr("id");
            $('#course_id').val(course_id);
            $('#add_exam').modal('show');
        });

        $('#insert').on("click", function(event) {
            event.preventDefault();
            $.ajax({
                url: "<?php echo SITEURL; ?>teacher/ajax_teacher.php",
                data: $('#insert_form').serialize(),
                type: 'POST',
                cache: false,
                beforeSend: function() {
                    //$("#insert").val("Inserting");
                },
                complete: function(status) {
                    if (status != "error" && status != "timeout") {
                        //$("#insert").val("Inserted");
                        $('#add_information').html("Operation successful");
                        // $('.dataTables-example').DataTable().ajax.reload();
                        // $("#add_faculty").modal('toggle');

                    }
                },
                error: function(responseObj) {
                    alert("Something went wrong while processing your request.\n\nError => " +
                        responseObj.error);
                }
            });

        });
    });

    $(".select2_teacher").select2({
        theme: 'bootstrap4',
        placeholder: "Select a Teacher",
        allowClear: true,
        dropdownParent: $('#add_exam'),
        width: 'resolve',
    });
    $('#online_exam_duration').select2({
        theme: 'bootstrap4',
        placeholder: "Select a Time duration",
        allowClear: true,
        dropdownParent: $('#add_exam'),
        width: 'resolve',
    });
    $('#online_exam_type').select2({
        theme: 'bootstrap4',
        placeholder: "Select Exam Type Here.",
        allowClear: true,
        dropdownParent: $('#add_exam'),
        width: 'resolve',
    });

    var date = new Date();
    date.setDate(date.getDate());
    $('#online_exam_datetime').datetimepicker({
        startDate: date,
        format: 'yyyy-mm-dd hh:ii',
        autoclose: true
    });
</script>

</html>