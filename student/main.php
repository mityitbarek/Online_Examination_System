<?php
if (isset($_GET['page'])) {
    $page = $_GET['page'];
} else {
    $page = 'welcome';
}

switch ($page) {
    case "welcome": {
            include('welcome.php');
        }
        break;

    case "result_detail": {
            include('result_detail.php');
        }
        break;

    case "exams": {
            include('exam.php');
        }
        break;

    case "login": {
        session_destroy();
            include('login.php');
        }
        break;

        // case "view_question": {
        //         include("view_question.php");
        //     }
        //     break;
    case "endSession": {
            include('endSession.php');
        }
        break;

    case "detail_result": {
            include('detail_result.php');
        }
        break;

    case "logout": {

            $tbl_name = "tbl_student";
            $username = $_SESSION['student'];
            $student_id = $obj->get_userid($tbl_name, $username, $conn);
            $res = true;
            if ($res == true) {
                //Setting Student Is_Active Mode to No
                $tbl_name3 = "tbl_student";
                $data3 = "is_active='yes'"; //needs to be changed later....just for testing purpose now.
                $where3 = "student_id='$student_id'";
                $query3 = $obj->update_data($tbl_name3, $data3, $where3);
                $res3 = $obj->execute_query($conn, $query3);
                if ($res3 === true) {
                    session_destroy();
                    header('location:' . SITEURL . 'student/index.php?page=login');
                } else {
                    echo "Error";
                }
            } else {
                echo "Error";
            }
        }
        break;
    case 'Questions':
        include('Questions.php');
        break;

    default: {
            include('welcome.php');
        }
        break;
}
