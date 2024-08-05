<?php
include('config/apply.php');
function Get_exam_question_limit($exam_id, $conn, $obj)
{
    $tbl_name = "tbl_exam";
    $where = "exam_id = '$exam_id'";
    $query = $obj->select_data($tbl_name, $where);

    $result = $obj->execute_query($conn, $query);

    foreach ($result as $row) {
        return $row['qns_per_set'];
    }
}
function Get_exam_total_question($exam_id, $conn, $obj)
{

    $tbl_name = "tbl_question";
    $where = "exam_id = '$exam_id'";
    $query = $obj->select_data($tbl_name, $where);
    $res = $obj->execute_query($conn, $query);
    return $obj->num_rows($res);
}
function change_exam_status($student_id, $conn, $obj)
{
    $current_datetime = date('Y-m-d H:i:s');
    $tbl_name = "tbl_student_exam_enrol inner join tbl_exam on tbl_student_exam_enrol.exam_id = tbl_exam.exam_id";
    $where = "tbl_student_exam_enrol.student_id = '$student_id'"; //thinnk of the where clause the next time.
    $query = $obj->select_data($tbl_name, $where);
    $res = $obj->execute_query($conn, $query);
    $tbl_name = "tbl_exam";
    while ($row = $obj->fetch_data($res)) {
        $where = "exam_id = '" . $row['exam_id'] . "'";
        $exam_start_time  = $row['exam_date'];
        $duration = $row['time_duration'] . ' minute';
        $exam_end_time = strtotime($exam_start_time . '+' . $duration);
        $exam_end_time = date('Y-m-d H:i:s', $exam_end_time);
        if ($current_datetime >= $exam_start_time && $current_datetime <= $exam_end_time) {
            $data = "status = 'started'";
            $query = $obj->update_data($tbl_name, $data, $where);
            $ress = $obj->execute_query($conn, $query);
        } elseif ($current_datetime > $exam_end_time) {
            $data = "status='completed'";
            $query = $obj->update_data($tbl_name, $data, $where);
            $ress = $obj->execute_query($conn, $query);
        } elseif ($current_datetime < $exam_start_time) {
            $data = "status='created'";
            $query = $obj->update_data($tbl_name, $data, $where);
            $ress = $obj->execute_query($conn, $query);
        }
    }
}
function Is_allowed_add_question($exam_id, $conn, $obj)
{
    $exam_question_limit = Get_exam_question_limit($exam_id, $conn, $obj);

    $exam_total_question = Get_exam_total_question($exam_id, $conn, $obj);

    if ($exam_total_question >= $exam_question_limit) {
        return false;
    }
    return true;
}
function If_user_already_enroll_exam($conn, $obj, $exam_id, $student_id)
{
    $tbl_name = 'tbl_student_exam_enrol';
    $where = 'exam_id = "' . $exam_id . '" and student_id="' . $student_id . '"';
    $query = $obj->select_data($tbl_name, $where);
    $res = $obj->execute_query($conn, $query);
    if ($obj->num_rows($res) > 0) {
        return true;
    }
    return false;
}
function if_question_is_answered($conn, $obj, $student_id, $exam_id, $question_id)
{
    $tbl_name = "tbl_result";
    $where = "
    student_id = '" . $student_id . "'
    AND exam_id = '" . $exam_id . "'
    AND question_id = '" . $question_id . "'
    ";
    $query = $obj->select_data($tbl_name, $where);
    $res = $obj->execute_query($conn, $query);
    if ($obj->num_rows($res)) {
        return true;
    }
    return false;
}
function get_user_answer($conn, $obj, $student_id, $exam_id, $question_id)
{
    $tbl_name = "tbl_result";
    $where = "
    student_id = '" . $student_id . "'
    AND exam_id = '" . $exam_id . "'
    AND question_id = '" . $question_id . "'
    ";
    $query = $obj->select_data($tbl_name, $where);
    $res = $obj->execute_query($conn, $query);
    if ($res)
        $row = $obj->fetch_data($res);
    return $row['user_answer'];
}
function request_already_sent($conn, $obj, $student_id, $exam_id)
{
    $tbl_name = 'tbl_exam_activation_request';
    $where = 'exam_id = "' . $exam_id . '" and student_id="' . $student_id . '"  and request_status="Pending"';
    $query = $obj->select_data($tbl_name, $where);
    $res = $obj->execute_query($conn, $query);
    if ($obj->num_rows($res) > 0) {
        return true;
    }
    return false;
}
// login
if ($_POST['action'] == 'login') {
    if ($_POST['page'] == 'student') {
        # code...
        $username = $_POST['username'];
        $password = $_POST['password'];
        $tbl_name = "tbl_student";
        $where = "username='$username' and password ='$password'";
        $query = $obj->select_data($tbl_name, $where);
        $res = $obj->execute_query($conn, $query);
        $row = $obj->fetch_data($res);
        $count_rows = $obj->num_rows($res);
        if ($count_rows == 1) {
            $_SESSION['student'] = $username;
            $_SESSION['student_id'] = $row['student_id'];
            change_exam_status($_SESSION['student_id'], $conn, $obj);
            $_SESSION['dept_id'] = $row['department_id'];
            $_SESSION['full_name'] = $row['first_name'] . " " . $row['last_name'];
            $_SESSION['study_year'] = $row['study_year'];
            $output = array(
                'success'    =>    true
            );
            $tbl_name = "tbl_department";
            $where = "dept_id= '" . $_SESSION['dept_id'] . "'";
            $query = $obj->select_data($tbl_name, $where);
            $res = $obj->execute_query($conn, $query);
            $row = $obj->fetch_data($res);
            $_SESSION['dept_name'] = $row['department_name'];
        } else {
            $output = array(
                "error" => "Username or Password is invalid. Please try again."
            );
        }
        echo json_encode($output);
    }
}
if ($_POST['action'] == "fetch") {
    change_exam_status($_SESSION['student_id'], $conn, $obj);
    if ($_POST['page'] == "load_question") {
        $tbl_name = "tbl_question";
        $other = "";
        if ($_POST['question_id'] == '') {
            $where = "exam_id = '" . $_POST['exam_id'] . "'";
            $other .= "ORDER BY question_id ASC LIMIT 1";
            // display the first question
        } else {
            $where = "question_id = '" . $_POST["question_id"] . "'";
        }
        $query  = $obj->select_data($tbl_name, $where, $other);
        $res = $obj->execute_query($conn, $query);
        $output = '';
        $prev_next = '';
        $var = '';
        $class = '';
        $user_answered = '';
        $check_1 = '';
        $check_2 = '';
        $check_3 = '';
        $check_4 = '';
        $check_5 = '';
        if (if_question_is_answered($conn, $obj, $_SESSION['student_id'], $_POST['exam_id'], $_POST['question_id'])) {
            $user_answered = get_user_answer($conn, $obj, $_SESSION['student_id'], $_POST['exam_id'], $_POST['question_id']);
            switch ($user_answered) {
                case 1:
                    $check_1 = 'checked';
                    break;
                case 2:
                    $check_2 = 'checked';
                    break;
                case 3:
                    $check_3 = 'checked';
                    break;
                case 4:
                    $check_4 = 'checked';
                    break;
                case 5:
                    $check_5 = 'checked';
                default:
            }
        }
        while ($row = $obj->fetch_data($res)) {
            $output .= ' <h4>' . $row["question"] . '(<font color = "green">' . $row['marks'] . ' marks</font>)</h4>
				<div class = "hr-line-solid"></div>
				<br />';
            if ($row['image_name'] != "") {
                $output .= '<img src="' . SITEURL . 'images/questions/' . $row['image_name'] . '" class="rounded" alt="Supplementary Image" height="100%" width = "100%"/><hr>';
            }
            $output .= '<div class="row">';

            $output .= '<div class="col-md-6" >
                                <label>
                                <h4><input type="radio" name="option_1"  value ="1" class="answer_option" data-question_id="' . $row["question_id"] . '" required = "true" ' . $check_1 . '/>
                                &nbsp;<span>A</span>'.$row["first_answer"] . '</h4>
                                </label>
                        </div>';
            $output .= '<div class="col-md-6">
                                <label>
                                <h4><input type="radio" name="option_1"  value ="2" class="answer_option" data-question_id="' . $row["question_id"] . '" required ="true" ' . $check_2 . '/>
                                &nbsp;<span>B</span>'.$row["second_answer"] . '</h4></label>
                        </div>';
            $output .= '<div class="col-md-6">
                                <label>
                                <h4><input type="radio" name="option_1"  value ="3" class="answer_option" data-question_id="' . $row["question_id"] . '"required ="true" ' . $check_3 . '/>
                                &nbsp;<span>C</span>'.$row["third_answer"] . '</h4></label>
                        </div>';
            $output .= '<div class="col-md-6">
                                <label>
                                <h4><input type="radio" name="option_1"  value ="4" class="answer_option" data-question_id="' . $row["question_id"] . '"required ="true"' . $check_4 . '/>
                                &nbsp;<span>D</span>'.$row["fourth_answer"] . '</h4></label>
                        </div>';
            $output .= '<div class="col-md-6">
                                <label >
                                <h4><input type="radio" name="option_1" value ="5" class="answer_option" data-question_id="' . $row["question_id"] . '" required ="true"' . $check_5 . '/>
                                &nbsp; <span>E</span>'. $row["fifth_answer"] . '</h4></label>
                        </div>';
            $output .= '<input type="hidden" name="right_answer" id = "right_answer" value="' . $row['answer'] . '" />';
            $output .= '<input type="hidden" name="marks" id = "marks" value="' . $row['marks'] . '" />';
            $output .= '</div>';
            $tbl_name = "tbl_question";
            $where = "
				question_id < '" . $row['question_id'] . "' 
				AND exam_id = '" . $_POST["exam_id"] . "'  
				order by question_id DESC LIMIT 1";
            $query = $obj->select_data($tbl_name, $where);
            $res = $obj->execute_query($conn, $query);
            $previous_row = $obj->fetch_data($res);

            $previous_id = '';
            $next_id = '';
            $previous_id = isset($previous_row['question_id']) ? $previous_row['question_id'] : 0;

            $where = "
				question_id > '" . $row['question_id'] . "' 
				AND exam_id = '" . $_POST["exam_id"] . "' 
				ORDER BY   question_id ASC LIMIT 1";
            $query = $obj->select_data($tbl_name, $where);
            $ress = $obj->execute_query($conn, $query);
            $next_row = $obj->fetch_data($ress);

            $next_id = isset($next_row['question_id']) ? $next_row['question_id'] : 0;

            $if_previous_disable = '';
            $if_next_disable = '';

            if ($previous_id == "") {
                $if_previous_disable = 'disabled';
            }

            if ($next_id == "") {
                $if_next_disable = 'disabled';
            }

            // $prev_next = '
            // 		<br />
            // 	  	<div align="center">
            // 	   		<button type="button" name="previous" class="btn  btn-primary btn-outline btn-rounded btn-lg previous" id="' . $previous_id . '" ' . $if_previous_disable . '>Previous</button>
            // 	   		<button type="button" name="next" class="btn btn-primary  btn-lg btn-outline btn-rounded next" id="' . $next_id . '" ' . $if_next_disable . '>Next</button>
            // 	  	</div>
            // 	  	<br />';
            // $output .= $prev_next;
            $var = $row['question_id'];
            if (if_question_is_answered($conn, $obj, $_SESSION['student_id'], $_POST['exam_id'], $row['question_id'])) {
                $class = 'btn-primary';
            } else
                $class = 'btn-danger';
        }
        $data = array(
            "question" => $output,
            "nav" => $prev_next,
            "question_id" => $var,
            "class" => $class
        );


        echo json_encode($data);
    }
    if ($_POST['page'] == "navigation") {
        # code...
        $tbl_name = "tbl_question";
        $where = "
				exam_id = '" . $_POST["exam_id"] . "' 
				ORDER BY RAND() 
				";
        $query = $obj->select_data($tbl_name, $where);
        $res = $obj->execute_query($conn, $query);
        // $result = $obj->fetch_data($res);
        $output = '
			<div class="card">
				<div class="card-header b-r-md"><b>Question Navigation</b></div>
				<div class="card-body">
					<div class="row">
			';
        $count = 1;
        while ($row = $obj->fetch_data($res)) {
            if ($row['question_id']) {
                if (if_question_is_answered($conn, $obj, $_SESSION['student_id'], $_POST['exam_id'], $row['question_id'])) {
                    $class = 'btn-primary';
                } else
                    $class = 'btn-danger';
                $output .= '
                    <div class="col-sm-2" style="margin-bottom:10px;">
                        <button type="button" class="btn ' . $class . ' btn-sm btn-circle question_navigation" data-question_id="' . $row["question_id"] . '" id="' . $row["question_id"] . '">' . $count . '</button>
                    </div>
                    ';
                $count++;
            } else {
                break;
            }
        }
        if ($count == 1)
            $output = '';
        else {
            $output .= '
            </div>
			</div>
            <div class="card-footer">
            <label><button class ="btn btn-sm btn-circle btn-primary "></button> Answered</label>
            <label><button class ="btn btn-circle btn-danger "></button> Not Answered</label>
			</div>
            </div>
			';
        }
        echo $output;
    }
    if ($_POST['page'] == 'exam') {
        change_exam_status($_SESSION['student_id'], $conn, $obj);
        $tbl_name = "(tbl_exam join tbl_course on tbl_exam.course_id=tbl_course.course_id)
                      join tbl_year_study on tbl_course.study_year=tbl_year_study.study_year_id
                      join tbl_teacher on tbl_course.teacher_id = tbl_teacher.id
                      join tbl_student_exam_enrol on tbl_exam.exam_id = tbl_student_exam_enrol.exam_id";
        //   left join tbl_invigilator on tbl_exam.examiner_id=tbl_invigilator.examiner_id";
        $where = "tbl_course.department_id = '" . $_SESSION['dept_id'] . "' and tbl_student_exam_enrol.student_id='" . $_SESSION['student_id'] . "' AND ";
        if (isset($_POST['search']['value'])) {
            $where .= "(";
            // $where .= 'exam_id LIKE "%' . $_POST["search"]["value"] . '%" ';
            $where .= 'course_name LIKE "%' . $_POST["search"]["value"] . '%" ';
            $where .= 'OR first_name LIKE "%' . $_POST["search"]["value"] . '%" ';
            $where .= 'OR last_name LIKE "%' . $_POST["search"]["value"] . '%" ';
            $where .= 'OR exam_date LIKE "%' . $_POST["search"]["value"] . '%" ';
            $where .= 'OR year LIKE "%' . $_POST["search"]["value"] . '%" ';
            $where .= ")";
        }
        if (isset($_POST['order'])) {
            $where .= 'ORDER BY ' . $_POST['order']['0']['column'] . ' ' . $_POST['order']['0']['dir'] . ' ';
        } else {
            $where .= ' ORDER BY course_name ASC ';
        }

        $other = '';

        if ($_POST['length'] != -1) {
            $other .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
        }

        $query = $obj->select_data($tbl_name, $where);
        $res = $obj->execute_query($conn, $query);
        $filtered_rows = $obj->num_rows($res);
        $data = array();
        while ($row = $obj->fetch_data($res)) {
            $sub_array = array();
            // $sub_array[] .= $row['exam_id'];
            $sub_array[] .= $row['course_name'];
            // $sub_array[] .= $row['first_name'] . " " . $row['last_name'];
            $sub_array[] .= $row['qns_per_set'];
            if ($row['status'] == "created") {
                $sub_array[] .= "<span class='label label-success'>" . $row['status'] . "</span>";
            } elseif ($row['status'] == "started") {
                $sub_array[] .= "<span class='label label-primary'>" . $row['status'] . "</span>";
            } elseif ($row['status'] == "completed") {
                $sub_array[] .= "<span class='label label-danger'>" . $row['status'] . "</span>";
            }
            $sub_array[] .= $row['time_duration'] . " minutes";;
            $sub_array[] .= $row['exam_date'];
            $sub_array[] .= $row['year'];

            if ($row['status'] == "started") {
                # code...
                $sub_array[] .= ''; // '<a type="button" class="btn btn-primary btn-rounded btn-outline view_exam" data-toggle="tooltip" data-placement="top" title="Click to work on the exam." id="' . $row['exam_id'] . '">Start</a>';
                $sub_array[] .= '<a href = "' . SITEURL . 'student/index.php?page=Questions&exam_code=' . $row['exam_id'] . '" class="btn btn-primary  btn-circle start_exam" data-toggle="tooltip" data-placement="top" title="Click to see Questions" ><i class="fa fa-eye "> </i></a>';
                // $sub_array[] .= '<button type="button" class="btn btn-primary btn-sm btn-rounded btn-outline view_exam" data-toggle="tooltip" data-placement="top" title="Click to see your result" id="' . $row['exam_id'] . '">View Result</button>';
            } elseif ($row['status'] == "completed") {
                # code...
                $sub_array[] .= '<button type="button" class="btn btn-primary btn-sm btn-rounded btn-outline view_exam" data-toggle="tooltip" id = "view_result" data-placement="top" title="Click to see your result" data-exam-id="' . $row['exam_id'] . '"> Result</button>';
                $sub_array[] .= '';
            } elseif ($row['status'] == "created") {
                # code...
                $sub_array[] .= '';
                // $sub_array[] .= '';
                $sub_array[] .= '<a href = "' . SITEURL . 'student/index.php?page=Questions&exam_code=' . $row['exam_id'] . '" class="btn btn-primary  btn-circle start_exam" data-toggle="tooltip" data-placement="top" title="Click to see Questions" ><i class="fa fa-eye "> </i></a>';
            }

            $data[] = $sub_array;
        }
        $where = "";
        $query = $obj->select_data($tbl_name, $where);
        $res = $obj->execute_query($conn, $query);
        $total_rows = $obj->num_rows($res);
        $output = array(
            "draw"                =>    intval($_POST["draw"]),
            "recordsTotal"        =>    $total_rows,
            "recordsFiltered"    =>    $filtered_rows,
            "data"                =>    $data
        );
        echo json_encode($output);
    }
    if ($_POST['page'] == 'exam_list') {
        $tbl_name = "tbl_exam inner join tbl_course on tbl_exam.course_id = tbl_course.course_id";
        $where = '
        tbl_course.department_id = "' . $_SESSION['dept_id'] . '" and tbl_course.study_year = "' . $_SESSION['study_year'] . '"
        ';
        $query = $obj->select_data($tbl_name, $where);
        $res = $obj->execute_query($conn, $query);
        $result = '<option></option>';
        while ($row = $obj->fetch_data($res)) {
            if ($row['status'] != 'completed')
                $result .= "<option value = " . $row['exam_id'] . ">" . $row['course_name'] . "  (" . $row['exam_type'] . ")" . "</option>";
        }
        echo $result;
    }
    if ($_POST['page'] == 'exam_detail') {
        $tbl_name = 'tbl_exam inner join tbl_course on tbl_exam.course_id = tbl_course.course_id
        ';
        $where  = 'exam_id = ' . $_POST['exam_id'] . '';
        $query = $obj->select_data($tbl_name, $where);
        $query1 = $obj->get_exam_marks($_POST['exam_id']);
        $res1 = $obj->execute_query($conn, $query1);
        $res = $obj->execute_query($conn, $query);
        $output = '
			<div class="card">
				<div class="card-header bg-primary">Exam Details</div>
				<div class="card-body">
					<table class="table table-striped table-hover table-bordered">
			';
        if ($res) {
            $row = $obj->fetch_data($res);
            $row1 = $obj->fetch_data($res1);
            $output .= '
				<tr>
					<td><b>Examination Name</b></td>
					<td>' . $row["course_name"] . '</td>
				</tr>
				<tr>
					<td><b>Exam Date & Time</b></td>
					<td>' . $row["exam_date"] . '</td>
				</tr>
				<tr>
					<td><b>Time allowed</b></td>
					<td>' . $row["time_duration"] . ' Minutes</td>
				</tr>
				<tr>
					<td><b>Exam Total Question</b></td>
					<td>' . $row["qns_per_set"] . ' </td>
				</tr>
				<tr>
					<td><b>Exam weight</b></td>
					<td>' . $row1["weight"] . ' marks</td>
				</tr>
				
				';
            if (If_user_already_enroll_exam($conn, $obj, $_POST['exam_id'], $_SESSION['student_id'])) {
                $enroll_button = '
					<tr>
						<td colspan="2" align="center">
							<button type="button" name="enroll_button" class="alert alert-danger b-r-xl">Already Enrolled</button>
						&nbsp;&nbsp;&nbsp;<a href = "' . SITEURL . 'student/index.php?page=Questions&exam_code=' . $row['exam_id'] . '" class="btn btn-primary  btn-rounded start_exam" data-toggle="tooltip" data-placement="top" title="Click to see Questions" >Start</a>
                            </td>
					</tr>
					';
            } else {
                // $enroll_button = '
                // <tr>
                // <td colspan="2" align="center">
                // <button type="button" name="enroll_button" id="enroll_button" class="btn btn-success btn-rounded btn-outline" data-exam_id="' . $row['exam_id'] . '">Enroll To This Exam </button>
                // </td>
                // </tr>
                // ';
                $enroll_button = '
					<tr>
						<td colspan="2" align="center">
							<button type="button" name="enroll_button" id="enroll_button" class="btn btn-success btn-rounded btn-outline b-r-xl" data-exam_id="' . $row['exam_id'] . '">Enroll To This Exam</button>
						&nbsp;&nbsp;&nbsp;<a href = "' . SITEURL . 'student/index.php?page=Questions&exam_code=' . $row['exam_id'] . '" class="btn btn-primary  btn-rounded start_exam" data-toggle="tooltip" data-placement="top" title="Click to see Questions" >Start</a>
                            </td>
					</tr>
					';
            }
            $output .= $enroll_button;
            $output .= '</table></div></div></div>';
        } else
            $output = "You have no active exam";
        echo $output;
    }
    if ($_POST['page'] == 'user_detail') {
        $tbl_name = 'tbl_student_exam_enrol join tbl_student on tbl_student_exam_enrol.student_id = tbl_student.student_id join tbl_exam on tbl_student_exam_enrol.exam_id =tbl_exam.exam_id
        join tbl_course on tbl_exam.course_id=tbl_course.course_id';
        $where = 'tbl_student.student_id = "' . $_SESSION['student_id'] . '" and tbl_exam.exam_id = "' . $_POST['exam_id'] . '"';
        $query = $obj->select_data($tbl_name, $where);
        $res = $obj->execute_query($conn, $query);
        $output = '
			<div class="card">
				<div class="card-header "><b>User Details</b></div>
				<div class="card-body">
					<div class="row">
			';
        if ($res) {
            $row = $obj->fetch_data($res);
            $output .= '

				<div class="col-sm-12">
					<table class="table table-bordered">
						<tr>
							<th>Name</th>
							<td>' . $row["username"] . '</td>
						</tr>
						<tr>
							<th>Email ID</th>
							<td>' . $row["email"] . '</td>
						</tr>
						<tr>
							<th>Gendar</th>
							<td>' . $row["gender"] . '</td>
						</tr>
						<tr>
							<th>Total Time</th>
							<td><b>' . $row["time_duration"] . " Minutes" . '</b></td>
						</tr>
						<tr>
							<th>Course Name</th>
							<td><b>' . $row["course_name"] . '</b></td>
						</tr>
					</table>
				</div>
				';
        }
        $output .= '</div></div></div>';
        echo $output;
    }
    if ($_POST['page'] == 'student_result') {
        $tbl_name1  = 'TBL_RESULT AS R
        INNER JOIN TBL_EXAM AS E ON R.EXAM_ID = E.EXAM_ID
        INNER JOIN TBL_COURSE AS C ON E.COURSE_ID = C.COURSE_ID';
        $tbl_name2 = 'TBL_QUESTION ';
        $tbl_name3 = 'TBL_RESULT';
        $where1 = '
        R.exam_id = "' . $_POST['exam_id'] . '" 
        AND R.student_id = "' . $_SESSION['student_id'] . '"
        ';
        $where2 = 'exam_id = "' . $_POST['exam_id'] . '" ';
        $where3 = '
        STUDENT_ID ="' . $_SESSION['student_id'] . '" AND EXAM_ID ="' . $_POST['exam_id'] . '" AND USER_ANSWER=RIGHT_ANSWER
        ';
        $query  = $obj->select_sum_of_column($tbl_name1, $tbl_name2, $tbl_name3, 'marks', $where1, $where2, $where3);
        $res = $obj->execute_query($conn, $query);
        $output = array();
        if ($res) {
            $row = $obj->fetch_data($res);
            $output  = array('weight' => $row['exam_weight'], 'score' => $row['your_score'], 'ques_attempted' => $row['ques_attempted'], 'ques_total' => $row['ques_total'], 'course' => $row['course_name']);
        }
        echo json_encode($output);
    }
    if($_POST['page'] == 'time_counter'){
        $remaining_minutes = '';
        $examm_id = '';
        $exam_status = '';
        $exam_date = '';
        $login_history = '';
        $who_teaches_this_course = ''; //teacher_id
    
        $tbl_name = "tbl_exam join tbl_course on tbl_exam.course_id=tbl_course.course_id";
        $where = "exam_id = '" . $_POST['exam_id'] . "'";
        $query = $obj->select_data($tbl_name, $where);
        $res = $obj->execute_query($conn, $query);
        if ($res) {
            $row = $obj->fetch_data($res);
            $exam_star_time  = $row['exam_date'];
            $exam_date  = $row['exam_date'];
            $exam_status = $row['status'];
            $duration = $row['time_duration'] . ' minute';
            $exam_end_time = strtotime($exam_star_time . '+' . $duration);
            $_SESSION['exam_cocurse_name'] = $row['course_name'];
            $exam_end_time = date('Y-m-d H:i:s', $exam_end_time);
            $remaining_minutes = strtotime($exam_end_time) - time();
            $until_start = strtotime($exam_star_time) - time();
            }

            echo json_encode(array('remaining_time' => $remaining_minutes));
    }
}

if ($_POST['action'] == 'Add') {
    if ($_POST['page'] == 'exam_enrol') {

        $response = array();
        if ($_POST['exam_id'] != '' && !If_user_already_enroll_exam($conn, $obj, $_POST['exam_id'], $_SESSION['student_id'])) {
            $tbl_name = "tbl_student_exam_enrol";
            $data = "
                student_id ='" . $_SESSION['student_id'] . "',
                exam_id = '" . $_POST['exam_id'] . "',
                login_history =0 
                ";
            $query = $obj->insert_data($tbl_name, $data);
            $res = $obj->execute_query($conn, $query);

            if ($res) {
                $response = array('success' =>  "enrolled");
            } else {
                $response = array('failer' => 'failed');
            }
        } else {
            $response = array('success' =>  "already_enrolled");
        }
        echo json_encode($response);
    }
    if ($_POST['page'] == 'answer_option') {
        $tbl_name = "tbl_result";
        $data = "";
        $query = "";
        $response_message = '';
        $class = 'btn-primary';
        if (if_question_is_answered($conn, $obj, $_SESSION['student_id'], $_POST['exam_id'], $_POST['question_id'])) {
            $data = "
            user_answer = '" . $_POST['user_answer'] . "',
            marks = '" . $_POST['marks'] . "',
            added_date = '" . date('Y-m-d ') . "'
            "; // update ONLY   user answer.
            $where = "
            exam_id = '" . $_POST['exam_id'] . "'
            AND question_id = '" . $_POST['question_id'] . "'
            AND student_id = '" . $_SESSION['student_id'] . "'
            ";
            $query = $obj->update_data($tbl_name, $data, $where);
            $response_message = 'update';
        } else {
            $data = "
            exam_id = '" . $_POST['exam_id'] . "',
            question_id = '" . $_POST['question_id'] . "',
            student_id = '" . $_SESSION['student_id'] . "',
            user_answer = '" . $_POST['user_answer'] . "',
            right_answer = '" . $_POST['right_answer'] . "',
            marks = '" . $_POST['marks'] . "',
            added_date = '" . date('Y-m-d') . "'
        ";
            $query = $obj->insert_data($tbl_name, $data);
            $response_message = 'insert';
        }
        $res = $obj->execute_query($conn, $query);
        $response = array();
        if ($res) {
            $response = array('success' =>  $response_message, 'class' => $class);
        } else {
            $response = array('failer' => 'Operartion failed');
        }
        echo json_encode($response);
    }
    if ($_POST['page'] == 'activation_request') {
        $response = array();
        $tbl_name = 'tbl_exam_activation_request';
        $data = "  
            student_id = '" . $_POST['student_id'] . "',
            teacher_id = '" . $_POST['teacher_id'] . "',
            exam_id = '" . $_POST['exam_id'] . "',
            request_time = '" . date('Y-m-d H:i:s') . "'
        ";

        if (!request_already_sent($conn, $obj, $_POST['student_id'], $_POST['exam_id'])) {
            $query = $obj->insert_data($tbl_name, $data);
            $res = $obj->execute_query($conn, $query);
            if ($res) {
                $response = array('success' =>  "request_sent");
            } else {
                $response = array('success' => 'request_failed');
            }
        } else {
            $response = array('success' => 'already_exists');
        }
        echo json_encode($response);
    }
}
