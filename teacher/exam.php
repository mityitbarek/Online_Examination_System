<!DOCTYPE html>
<?php
if (!isset($_SESSION['teacher'])) {
    header('location:' . SITEURL . 'teacher/index.php?page=login');
}

?>
<html>

<head>
    <link rel="shortcut icon" href="<?php echo SITEURL ?>images/logo.jpg" />
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>DTU Exam | Teacher | Exams</title>

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
    <link href="<?php echo SITEURL ?>asset2/css/plugins/sweetalert/sweetalert.css" rel="stylesheet">
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
                            Exams
                        </li>

                    </ol>
                </div>
                <div class="col-sm-8">
                    <div class="title-action">
                    </div>
                </div>
            </div>
            <div class="wrapper wrapper-content animated fadeInRight">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">

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
                                                <th>Code</th>
                                                <th>Course</th>
                                                <th>Exam Type</th>
                                                <th>Total Qns</th>
                                                <th>Status</th>
                                                <th>Total Time</th>
                                                <th>Exam Date</th>
                                                <th>Study Year</th>
                                                <th>Result</th>
                                                <th>Question</th>
                                                <th>View Questions</th>
                                            </tr>
                                        </thead>

                                        <tfoot>
                                            <tr>
                                                <th>Code</th>
                                                <th>Course</th>
                                                <th>Exam Type</th>
                                                <th>Total Qns</th>
                                                <th>Status</th>
                                                <th>Total Time</th>
                                                <th>Exam Date</th>
                                                <th>Study Year</th>
                                                <th>Result</th>
                                                <th>Question</th>
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


    </div>

    <div class="modal inmodal fade" id="add_exam" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title">Edit Exam</h4>
                </div>
                <div class="modal-body">
                    <form method="POST" class="wizard-big" id="insert_form">

                        <div class="form-group"><label>Exam Type</label>
                            <select name="online_exam_type" id="online_exam_type" class="form-control" style="width: 100%">
                                <option>Select Exam type here.</option>
                                <option value="Exit Exam">Exit Exam</option>
                                <option value="Supplementary Exam">Supplementary</option>
                                <option value="Mock">Mock Exam</option>
                                <option value="Holistic Exam">Holistic Exam</option>
                            </select>
                        </div>
                        <div class="form-group"><label>Total Questions</label>
                            <input class="form-control input-sm validate[required]" name="total_questions" id="total_questions" type="number" placeholder=" Enter total questions">
                        </div>
                        <div class="form-group"><label>Exam Date and Time</label>
                            <input type="text" name="online_exam_datetime" id="online_exam_datetime" class="form-control" readonly />

                        </div>
                        <div class="form-group"><label> Time Duration</label>
                            <select name="online_exam_duration" id="online_exam_duration" class="form-control" style="width: 100%">

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
                        <input type="hidden" name="exam_id" id="exam_id" value="" />
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
    <?php include("./includes/scripts3.php") ?>
    <script src="<?php echo SITEURL ?>asset2/js/bootstrap-datetimepicker.js"></script>

    <script>
        $.fn.dataTable.Buttons.defaults.dom.button.className = 'btn btn-white btn-sm';
        $(document).ready(function() {
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
                        page: 'exam'
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
            $(document).on('click', '.add-question', function() {
                var id = $(this).attr('id');
                location.href = "<?php echo SITEURL; ?>teacher/index.php?page=add_question&exam_code=" + id;
            });
            $(document).on('click', '.view-question', function() {
                var id = $(this).attr('id');
                location.href = "<?php echo SITEURL; ?>teacher/index.php?page=question&exam_code=" + id;
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
                    if (jQuery.parseJSON(data).number_of_requests == 0) {
                        $('#number_of_requests').hide()
                    } else {
                        $('#number_of_requests').show()
                        $('#number_of_requests').html(jQuery.parseJSON(data).number_of_requests);
                    }
                    $('.dropdown-messages').html(jQuery.parseJSON(data).drop_down_component);
                },

            });

        });
        $(document).on('click', '.cancel_request', function() {
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
                    if (jQuery.parseJSON(data).number_of_requests == 0) {
                        $('#number_of_requests').hide()
                    } else {
                        $('#number_of_requests').show()
                        $('#number_of_requests').html(jQuery.parseJSON(data).number_of_requests);
                    }
                    $('.dropdown-messages').html(jQuery.parseJSON(data).drop_down_component);
                },

            });
        });

            $(document).on('click', '.edit_exam', function() {
                var exam_id = $(this).data('exam-id');
                var course_id = $(this).data('course-id');
                $.ajax({
                    url: "<?php echo SITEURL; ?>teacher/ajax_teacher.php",
                    method: "POST",
                    data: {
                        page: "exam",
                        action: "edit_fetch",
                        exam_id: exam_id
                    },
                    dataType: "json",
                    success: function(data) {
                        $('#exam_id').val(exam_id);
                        $('#online_exam_datetime').val(data.exam_date);
                        $('#online_exam_duration').val(data.time_duration);
                        $('#online_exam_duration').trigger('change');
                        $('#online_exam_type').val(data.exam_type);
                        $('#online_exam_type').trigger('change');
                        $('#total_questions').val(data.total_question);
                        $('#insert').val("Update Exam");
                        $('#action').val("update");
                        $('#add_exam').modal('show');
                    },
                    error: function(responseObj) {
                        alert("Something went wrong while processing your request.\n\nError => " +
                            responseObj.responseText);
                    }
                });
            });
            $(document).on('click', '.delete_exam', function() {
                var exam_id = $(this).data('exam-id');
                confirmDelete(exam_id);
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
                            $('#add_information').html("Operation successful");
                            $('.dataTables-example').DataTable().ajax.reload();
                        }
                    },
                    error: function(responseObj) {
                        alert("Something went wrong while processing your request.\n\nError => " +
                            responseObj.error);
                    }
                });

            });

            var date = new Date();
            date.setDate(date.getDate());
            $('#online_exam_datetime').datetimepicker({
                startDate: date,
                format: 'yyyy-mm-dd hh:ii',
                autoclose: true
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
            $(document).on('click', '#view_result', function() {
                var exam_id = $(this).data('exam-id');
                location.href = '<?php echo SITEURL ?>teacher/index.php?page=student_result&exam_id=' + exam_id;
            });

        });

        function confirmDelete(exam_id) {
            swal({
                    title: "Are you sure?",
                    text: "You will not be able to undo this.",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "green",
                    cancelButtonColor: "red",
                    confirmButtonText: "Delete!",
                    closeOnConfirm: false,
                    closeOnCancel: false
                },
                function(isConfirm) {
                    if (isConfirm) {
                        $.ajax({
                            url: "<?php echo SITEURL; ?>teacher/ajax_teacher.php",
                            method: "POST",
                            data: {
                                page: "exam",
                                action: "delete",
                                exam_id: exam_id
                            },
                            dataType: "json",
                            success: function(response) {
                                swal("Done!", response.message, response.status);
                                $('.dataTables-example').DataTable().ajax.reload();
                            },
                        });
                    } else {
                        swal("Cancelled", "Operation cancelled! :)", "error");
                    }
                })
        }
    </script>

</body>

</html>