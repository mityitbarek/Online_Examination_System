   
<!-- <?php //include_once('./top_nav_update.php')?> -->
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
               <?php
                $tbl_name = 'tbl_exam_activation_request join tbl_student on tbl_exam_activation_request.student_id = tbl_student.student_id
                    join tbl_exam on tbl_exam_activation_request.exam_id = tbl_exam.exam_id
                    join tbl_course on tbl_exam.course_id=tbl_course.course_id';
                $where = "tbl_exam_activation_request.teacher_id = '" . $_SESSION['teacher_id'] . "' and request_status='Pending'";
                $query = $obj->select_data($tbl_name, $where);
                $res = $obj->execute_query($conn, $query);
                ?>
               <a class="dropdown-toggle count-info request_counter" data-toggle="dropdown" href="#">
                   <i class="fa fa-bell"></i><?php
                                                if ($obj->num_rows($res) > 0) { ?>
                       <span id='number_of_requests' class="label label-danger"><?php echo $obj->num_rows($res) ?></span>
                   <?php } ?>
               </a>
                

               <ul class="dropdown-menu dropdown-messages">
                   <?php
                if($obj->num_rows($res)>0){
                    while ($row = $obj->fetch_data($res)) {
                        $requst_time = $row['request_time'];
                        $start_date = new DateTime(($requst_time));
                        $since_start = $start_date->diff(new DateTime(date("Y-m-d H:i:s")));
                        $days = $since_start->d;
                        $hours = $since_start->h;
                        $minutes = $since_start->i;
                        $seconds = $since_start->s;
                    ?>
                       <li>
                           <div class="dropdown-messages-box">
                               <a class="dropdown-item float-left" href="#">
                                   <img alt="image" class="rounded-circle" src="<?php echo SITEURL; ?>images/logo.jpg">
                               </a>
                               <div class="media-body">
                                   <small class="float-right">
                                       <?php

                                        echo ($days > 0) ? $days . ' d' : ($hours > 0 ? $hours . ' h' : ($minutes > 0 ? $minutes . ' m' : $seconds . ' s'));
                                        echo ' ago';

                                        ?>
                                   </small>
                                   <strong><?php echo $row['first_name'] . " " . $row['last_name'] ?></strong> sent activation request for <?php echo $row['course_name'] ?> <br>
                                   <small class="text-muted"><?php echo $row['request_time'] ?></small><br>
                                   <button type="button" class="btn btn-primary float-left  btn-outline btn-circle activate_request" data-toggle="tooltip" data-placement="top" title="Click to activate" data-request_value="activate" data-request_id="<?php echo $row['request_id'] ?>"><i class="fa fa-check "> </i></button>
                                   <button type="button" class="btn btn-danger float-right  btn-outline btn-circle cancel_request" data-toggle="tooltip" data-placement="top" title="Click to cancel" data-request_value="discard" data-request_id="<?php echo $row['request_id'] ?>"><i class="fa fa-times "> </i></button>

                               </div>
                           </div>
                       </li>

                       <li class="dropdown-divider"></li>
                   <?php } 
                
                } else {

                    echo "<span class ='alert alert-danger dropdown-messages-box float-right'><h2>No activation requests exist</h2>.</span>";
                    }
                ?>
               </ul>
           </li>
           <li>
               <a href="<?php echo SITEURL ?>teacher/index.php?page=logout">
                   <i class="fa fa-sign-out"></i> Log out
               </a>
           </li>
       </ul>

   </nav>


   <style>
       .dropdown-menu {
           height: 450px;
           width: 400px;
           overflow: scroll;
       }
   </style>