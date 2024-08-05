<!DOCTYPE html>
<html>



<head>
    <link rel="shortcut icon" href="<?php echo SITEURL ?>images/logo.jpg" />

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>DTU Exam | Teacher | Questions</title>

    <?php //include('./includes/css3.php') 
    if (!isset($_SESSION['teacher'])) {
        header('location:' . SITEURL . 'teacher/index.php?page=login');
    }

    ?>


    <link href="<?php echo SITEURL ?>asset2/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo SITEURL ?>asset2/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="<?php echo SITEURL ?>asset2/css/plugins/iCheck/custom.css" rel="stylesheet">
    <link href="<?php echo SITEURL ?>asset2/css/plugins/sweetalert/sweetalert.css" rel="stylesheet">
    <link href="<?php echo SITEURL ?>asset2/css/animate.css" rel="stylesheet">
    <link href="<?php echo SITEURL ?>asset2/css/style.css" rel="stylesheet">

    <link href="<?php echo SITEURL ?>asset2/css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css" rel="stylesheet">

</head>

<body class="md-skin pace-done">

    <div id="wrapper">
        <?php include('sidenav.php'); ?>


        <div id="page-wrapper" class="gray-bg">
            <div class="row border-bottom">
                <nav class="navbar navbar-static-top  " role="navigation" style="margin-bottom: 0">
                    <div class="navbar-header">
                        <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
                        <form role="search" class="navbar-form-custom" action="#">
                            <div class="form-group">
                                <input type="text" placeholder="<?php echo $_SESSION['full_name'] ?>" class="form-control" name="top-search" id="top-search">
                            </div>
                        </form>
                    </div>
                    <ul class="nav navbar-top-links navbar-right">
                        <li>
                            <span class="label label-info"> <?php echo $_SESSION['full_name'] ?></span>
                        </li>
                        <li class="dropdown">
                            <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                                <i class="fa fa-envelope"></i> <span class="label label-warning">3</span>
                            </a>
                            <ul class="dropdown-menu dropdown-messages">
                                <li>
                                    <div class="dropdown-messages-box">
                                        <a class="dropdown-item float-left" href="profile.html">
                                            <img alt="image" class="rounded-circle" src="<?php echo SITEURL; ?>images/logo.jpg">
                                        </a>
                                        <div class="media-body">
                                            <small class="float-right">46h ago</small>
                                            <strong>Mike Loreipsum</strong> started following <strong>Monica Smith</strong>. <br>
                                            <small class="text-muted">3 days ago at 7:58 pm - 10.06.2014</small>
                                        </div>
                                    </div>
                                </li>
                                <li class="dropdown-divider"></li>
                                <li>
                                    <div class="dropdown-messages-box">
                                        <a class="dropdown-item float-left" href="profile.html">
                                            <img alt="image" class="rounded-circle" src="<?php echo SITEURL; ?>images/logo.jpg">
                                        </a>
                                        <div class="media-body ">
                                            <small class="float-right text-navy">5h ago</small>
                                            <strong>Chris Johnatan Overtunk</strong> started following <strong>Monica Smith</strong>. <br>
                                            <small class="text-muted">Yesterday 1:21 pm - 11.06.2014</small>
                                        </div>
                                    </div>
                                </li>
                                <li class="dropdown-divider"></li>
                                <li>
                                    <div class="dropdown-messages-box">
                                        <a class="dropdown-item float-left" href="profile.html">
                                            <img alt="image" class="rounded-circle" src="<?php echo SITEURL; ?>images/logo.jpg">
                                        </a>
                                        <div class="media-body ">
                                            <small class="float-right">23h ago</small>
                                            <strong>Monica Smith</strong> love <strong>Kim Smith</strong>. <br>
                                            <small class="text-muted">2 days ago at 2:30 am - 11.06.2014</small>
                                        </div>
                                    </div>
                                </li>
                                <li class="dropdown-divider"></li>
                                <li>
                                    <div class="text-center link-block">
                                        <a href="mailbox.html" class="dropdown-item">
                                            <i class="fa fa-envelope"></i> <strong>Read All Messages</strong>
                                        </a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                                <i class="fa fa-bell"></i> <span class="label label-danger">8</span>
                            </a>
                            <ul class="dropdown-menu dropdown-alerts">
                                <li>
                                    <a href="mailbox.html" class="dropdown-item">
                                        <div>
                                            <i class="fa fa-envelope fa-fw"></i> You have 16 messages
                                            <span class="float-right text-muted small">4 minutes ago</span>
                                        </div>
                                    </a>
                                </li>
                                <li class="dropdown-divider"></li>
                                <li>
                                    <a href="profile.html" class="dropdown-item">
                                        <div>
                                            <i class="fa fa-twitter fa-fw"></i> 3 New Followers
                                            <span class="float-right text-muted small">12 minutes ago</span>
                                        </div>
                                    </a>
                                </li>
                                <li class="dropdown-divider"></li>
                                <li>
                                    <a href="grid_options.html" class="dropdown-item">
                                        <div>
                                            <i class="fa fa-upload fa-fw"></i> Server Rebooted
                                            <span class="float-right text-muted small">4 minutes ago</span>
                                        </div>
                                    </a>
                                </li>
                                <li class="dropdown-divider"></li>
                                <li>
                                    <div class="text-center link-block">
                                        <a href="notifications.html" class="dropdown-item">
                                            <strong>See All notifications</strong>
                                            <i class="fa fa-angle-right"></i>
                                        </a>
                                    </div>
                                </li>
                            </ul>
                        </li>


                        <li>
                            <a href="<?php echo SITEURL ?>teacher/index.php?page=logout">
                                <i class="fa fa-sign-out"></i> Log out
                            </a>
                        </li>
                    </ul>

                </nav>
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
                        <button class="btn btn-outline btn-rounded btn-primary" id="ajax_button">reload</button>
                    </div>
                </div>
            </div>

            <div class="wrapper wrapper-content">
                <div class="animated fadeInRightBig">
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="card ">
                                <div class="card-header ">Question</div>
                                <div class="card-body">
                                    <div id="single_question_area">

                                    </div>
                                </div>
                            </div>
                            <br />
                        </div>
                        <div class="col-lg-4">
                            <div id="question_navigation_area"></div>
                            <div id="prev_next"></div>
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

        <!-- <?php //include("includes/scripts3.php") 
                ?> -->
        <!-- <script src="<?php echo SITEURL ?>asset2/js/jquery.min.js"></script> -->
        <script src="<?php echo SITEURL ?>asset2/js/jquery-3.1.1.min.js"></script>
        <script src="<?php echo SITEURL ?>asset2/js/popper.min.js"></script>
        <script src="<?php echo SITEURL ?>asset2/js/bootstrap.js"></script>
        <script src="<?php echo SITEURL ?>asset2/js/plugins/metisMenu/jquery.metisMenu.js"></script>
        <script src="<?php echo SITEURL ?>asset2/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

        <!-- Custom and plugin javascript -->
        <script src="<?php echo SITEURL ?>asset2/js/inspinia.js"></script>
        <script src="<?php echo SITEURL ?>asset2/js/plugins/pace/pace.min.js"></script>

        <!-- iCheck -->
        <script src="<?php echo SITEURL ?>asset2/js/plugins/iCheck/icheck.min.js"></script>
        <script src="<?php echo SITEURL ?>asset2/js/plugins/sweetalert/sweetalert.min.js"></script>


</body>

<script>
    $(document).ready(function() {

        $("body").tooltip({
            selector: '[data-toggle=tooltip]'
        });

        var exam_id = "<?php echo $_GET['exam_code']; ?>";
        question_navigation();
        load_question();


        function load_question(question_id = '') {
            $.ajax({
                url: "<?php echo SITEURL; ?>teacher/ajax_teacher.php",
                type: 'POST',
                cache: false,
                data: {
                    exam_id: exam_id,
                    question_id: question_id,
                    page: 'load_question',
                    action: 'fetch'
                },
                success: function(data) {
                    var res = JSON.parse(data);
                    var prev = question_id - 1;
                    if (res.question_id != "") {
                        $('#single_question_area').html(res.question);
                    } else {
                        $('#single_question_area').html("<font color='red'><b>No Question exists for this examination.</b></font>");
                    }
                    $('#prev_next').html(res.nav);
                    $('#question_navigation_area .btn').removeClass("active");
                    $('#question_navigation_area #' + res.question_id).addClass("active");
                    $('#single_question_area').iCheck({
                        checkboxClass: 'icheckbox_square-green',
                        radioClass: 'iradio_square-green',
                    });
                },
                error: function(response) {
                    $('#single_question_area').html(response.responseText);
                }
            })
        }

        function delete_question(question_id) {
            $.ajax({
                url: "<?php echo SITEURL; ?>teacher/ajax_teacher.php",
                type: 'POST',
                cache: false,
                data: {
                    exam_id: exam_id,
                    question_id: question_id,
                    page: 'question',
                    action: 'delete'
                },
                success: function(data) {
                    // $('#single_question_area').html(data);
                },
                error: function(response) {
                    $('#single_question_area').html("response.responseText");
                }
            })
        }

        $(document).on('click', '.next', function() {
            var question_id = $(this).attr('id');
            // $('#' + question_id).toggleClass('active');
            load_question(question_id);
        });
        $(document).on('click', '.delete_question', function() {
            // alert("are you sure ?");
            var question_id = $(this).attr('id');
            confirmDelete(question_id);
        });

        $(document).on('click', '.previous', function() {
            var question_id = $(this).attr('id');
            load_question(question_id);
        });

        $(document).on('click', '.edit_question',function () {
            var code = "<?php echo $_GET['exam_code']?>";
            var question_id = $(this).attr('id');
           location.href = "<?php echo SITEURL?>teacher/index.php?page=add_question&exam_code="+code+"&question_id="+question_id;
        });

        function question_navigation() {
            $.ajax({
                url: "<?php echo SITEURL; ?>teacher/ajax_teacher.php",
                type: "POST",
                data: {
                    exam_id: exam_id,
                    page: 'navigation',
                    action: 'fetch'
                },
                success: function(data) {
                    $('#question_navigation_area').html(data);
                }
            })
        }

        function confirmDelete(question_id) {
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
                            url: '<?php echo SITEURL ?>teacher/ajax_teacher.php',
                            type: "POST",
                            data: {
                                exam_id: exam_id,
                                question_id: question_id,
                                page: 'question',
                                action: 'delete'
                            },
                            dataType: "json",
                            success: function(response) {
                                swal("Done!", response.message, response.status);
                                load_question();
                                question_navigation();
                            }
                        });
                    } else {
                        swal("Cancelled", "Operation cancelled! :)", "error");
                    }
                })
        }
        $(document).on('click', '#ajax_button', function() {
            load_question();
            question_navigation();

        });
        $(document).on('click', '.question_navigation', function() {
            var question_id = $(this).data('question_id');
            load_question(question_id);
        });




    });
</script>

</html>