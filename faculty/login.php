<!DOCTYPE html>
<html>



<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>DTU Exam | Department Login </title>

    <link href="<?php echo SITEURL ?>asset2/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo SITEURL ?>asset2/font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="<?php echo SITEURL ?>asset2/css/animate.css" rel="stylesheet">
    <link href="<?php echo SITEURL ?>asset2/css/style.css" rel="stylesheet">

</head>

<body class="gray-bg top-navigation">
    <nav class="navbar navbar-expand-lg navbar-static-top" role="navigation">

        <a href="#" class="navbar-brand">DTU Exam</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fa fa-reorder"></i>
        </button>

        <div class="navbar-collapse collapse" id="navbar">
            <ul class="nav navbar-nav mr-auto">

                <li class="dropdown">
                    <a aria-expanded="false" role="button" href="#" class="dropdown-toggle text-white bg-primary" data-toggle="dropdown"> Login</a>
                    <ul role="menu" class="dropdown-menu">
                        <li><a href="<?php echo SITEURL; ?>admin/index.php?page=login">Admin</a></li>
                        <li><a href="<?php echo SITEURL; ?>faculty/index.php?page=login">Faculty</a></li>
                        <li><a href="<?php echo SITEURL; ?>department/index.php?page=login">Department</a></li>
                        <li><a href="<?php echo SITEURL; ?>teacher/index.php?page=login">Teacher</a></li>
                        <li><a href="<?php echo SITEURL; ?>student/index.php?page=login">Student</a></li>
                    </ul>
                </li>

            </ul>
            <ul class="nav navbar-top-links navbar-right">
                <li>
                    <a class="text-white bg-primary" href="http://www.dtu.edu.et" target="blank">
                        <i class="fa fa-sign-out active"></i> Univeristy website
                    </a>
                </li>
            </ul>
        </div>
    </nav>
    <div class="loginColumns animated fadeInDown">
        <div class="row">

            <div class="col-md-6">
                <h2 class="font-bold">Faculty Dean</h2>

                <p>
                    Perfectly designed and precisely prepared admin theme with over 50 pages with extra new web app views.
                </p>

                <p>
                    Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.
                </p>

                <p>
                    When an unknown printer took a galley of type and scrambled it to make a type specimen book.
                </p>

                <p>
                    <small>It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</small>
                </p>

            </div>
            <div class="col-md-6">
                <center><img src="<?php echo SITEURL; ?>images/logo.jpg" class="img-circle" height="100" width="100"></center>
                <div class="ibox-content">
                    <form class="m-t" role="form" action="" method="POST">
                        <div class="form-group">
                            <input type="text" class="form-control" name="username" placeholder="Username" required="">
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" name="password" placeholder="Password" required="">
                        </div>
                        <center><input type="submit" name="submit" value="Log In" class="btn btn-lg btn-primary btn-rounded btn-outline " /></center>
                        <br>
                        <a href="#">
                            <small>Forgot password?</small>
                        </a>
                        <!-- 
                        <p class="text-muted text-center">
                            <small>Do not have an account?</small>
                        </p>
                        <a class="btn btn-sm btn-white btn-block" href="register.html">Create an account</a> -->
                    </form>
                    <!-- <p class="m-t">
                        <small>Inspinia we app framework base on Bootstrap 3 &copy; 2014</small>
                    </p> -->
                    <?php
                    if (isset($_POST['submit'])) {
                        //echo "Clicked";
                        $username = $obj->sanitize($conn, $_POST['username']);
                        $password_db = md5($obj->sanitize($conn, $_POST['password']));
                        // $password_db = $obj->sanitize($conn, $_POST['password']);

                        if (($username == "") or ($password = "")) {
                            $_SESSION['validation'] = "<div class='alert alert-danger'>Username or Password is Empty</div>";
                            header('location:' . SITEURL . 'department/index.php?page=login');
                        }
                        $tbl_name = "tbl_faculty_dean";
                        $where = "username='$username' AND password='$password_db'";
                        $query = $obj->select_data($tbl_name, $where);
                        $res = $obj->execute_query($conn, $query);
                        $row = $obj->fetch_data($res);
                        $count_rows = $obj->num_rows($res);
                        if ($count_rows == 1) {
                            $_SESSION['dean'] = $username;
                            $_SESSION['dean_id'] = $row['dean_id'];
                            $_SESSION['faculty_id'] = $row['faculty_id'];
                            $_SESSION['success'] = "<div class='alert alert-success'>Login Successful. Welcome " . $username . " to dashboard.</div>";
                            header('location:' . SITEURL . 'faculty/index.php?page=dashboard');
                        } else {
                            $_SESSION['fail'] = "<div class='alert alert-danger'>Username or Password is invalid. Please try again.</div>";
                            header('location:' . SITEURL . 'faculty/index.php?page=login');
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
        <hr />
        <div class="row">
            <div class="col-md-6">
                Copyright Debre Tabor Univeristy
            </div>
            <div class="col-md-6 text-right">
                <small>© <?php echo date('Y') ?></small>
            </div>
        </div>
    </div>

</body>
<script src="<?php echo SITEURL ?>asset2/js/jquery-3.1.1.min.js"></script>
<script src="<?php echo SITEURL ?>asset2/js/popper.min.js"></script>
<script src="<?php echo SITEURL ?>asset2/js/bootstrap.js"></script>
<script src="<?php echo SITEURL ?>asset2/js/plugins/metisMenu/jquery.metisMenu.js"></script>
<script src="<?php echo SITEURL ?>asset2/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

<!-- Custom and plugin javascript -->
<script src="<?php echo SITEURL ?>asset2/js/inspinia.js"></script>
<script src="<?php echo SITEURL ?>asset2/js/plugins/pace/pace.min.js"></script>



<script>
    $(document).ready({});
</script>

</html>