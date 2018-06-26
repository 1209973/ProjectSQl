<?php
if (isset($_GET['pagenoC'])) {
    $pagenoC = $_GET['pagenoC'];
} else {
    $pagenoC = 1;
}
$no_of_records_per_page = 5;
$offsetC = ($pagenoC - 1) * $no_of_records_per_page;
if( $_SESSION['role']=='Student'){
    $total_rowsC  =  mysqli_num_rows($mysqli->query("SELECT course_id,course_name,credit_hours,name FROM course,department WHERE course.department_code=department.department_code"));
    $total_pagesC = ceil($total_rowsC   / $no_of_records_per_page);
    $res_dataEC = $mysqli->query("SELECT Course_id,Course_name,Credit_hours,Prerequisites_code,College,Department_code FROM course,student_section WHERE student_section.course_code=course.course_id AND student_id='{$_SESSION['ID']}'");
    $res_dataC =$mysqli->query("SELECT Course_id,Course_name,Credit_hours,Prerequisites_code,College,name FROM course,department WHERE course.department_code=department.department_code LIMIT $offset, $no_of_records_per_page");
}
if( $_SESSION['role']=='Professor'){

    $total_rowsG = mysqli_num_rows($mysqli->query("SELECT student.student_id,Grade,Year,Semester,Course_code,name FROM student,student_section, section WHERE student.student_id=student_section.student_id AND section.section_no=student_section.section_no AND section.course_code=student_section.course_code AND section.year=student_section.year AND section.semester=student_section.semester AND prof_id='PF12346'"));[0];
    $total_pagesG = ceil($total_rowsG/ $no_of_records_per_page);
    $res_dataG = $mysqli->query("select * from student_section WHERE Student_id ='ST18002' LIMIT $offset, $no_of_records_per_page");
}
if( $_SESSION['role']=='Admin'){
    $total_rowsC  =  mysqli_num_rows($mysqli->query("SELECT course_id,course_name,credit_hours,name FROM course,department WHERE course.department_code=department.department_code"));
    $total_pagesC = ceil($total_rowsC   / $no_of_records_per_page);
    $res_dataEC = $mysqli->query("SELECT Course_id,Course_name,Credit_hours,Prerequisites_code,College,Department_code FROM course,student_section WHERE student_section.course_code=course.course_id AND student_id='{$_SESSION['ID']}'");
    $res_dataC =$mysqli->query("SELECT Course_id,Course_name,Credit_hours,Prerequisites_code,College,name FROM course,department WHERE course.department_code=department.department_code LIMIT $offset, $no_of_records_per_page");

}
?>

    <?php

    if($_SESSION['status']==="Undergraduate") {
        $enrolCourse= '<div style="border-bottom: #000 solid .05px;">
   
     <h2> ENROLLED COURSE
       
  <button type="button" name="add" id="addEnrolCourseData" data-toggle="modal" data-target="#add_Course_Modal" class="btn btn-warning" style="float: right;margin-right: 1%">Add Course</button></h2>

</div>


<div>
    <table width="100%" border=0 style="text-align: center">
        <tr bgcolor="#CCCCCC" style="height: 40px;font-weight: 600;">
            <td>Course Code</td>
            <td>Course Name</td>
            <td>Credit Hours</td>
            <td>Prerequisite </td>
            <td>College</td>
            <td>Department </td>
            <td>Sections</td>
            <td id="editEnCoursecol">Edit</td>
        </tr>';




        while ($rowEC = mysqli_fetch_array($res_dataEC )) {

            $enrolCourse .= ' <tr>
                        <td> '. $rowEC["Course_id"] . '</td>
                         <td> '. $rowEC["Course_name"] .' </td>
                        <td> '. $rowEC["Credit_hours"] . '</td>
                        <td> '. $rowEC["Prerequisites_code"] .' </td>
                        <td> '. $rowEC["College"] . '</td>
                        <td> '. $rowEC["Department_code"] . '</td>
                        <td><input type="button" name="view" value="view" id="'. $rowEC["Course_id"].'" class="btn btn-info btn-xs view_dataC" /></td>
                        <td class="editCourseData">
                        <input type="button" name="edit" value="Edit" id="' . $rowEC["Course_id"] . '" class="btn btn-info btn-xs edit_dataC"></td>
                        
                        </tr>
                       

                        ';
        }


            $enrolCourse .= '
                </table>
            
            
            </div>';
            echo  $enrolCourse;
    }

    ?>
<div id="courses">
<div style="border-bottom: #000 solid .05px;">
    <h2>COURSE
        <button type="button" name="add" id="addLabData" data-toggle="modal" data-target="#add_Lab_Modal" class="btn btn-warning" style="float: right;">Add Lab Session </button>
        <button type="button" name="add" id="addSectionData" data-toggle="modal" data-target="#add_Section_Modal" class="btn btn-warning" style="float: right;margin-right: 1%">Add Section</button>
        <button type="button" name="add" id="addCourseData" data-toggle="modal" data-target="#add_Course_Modal" class="btn btn-warning" style="float: right;margin-right: 1%">Add Course</button></h2>

</div>


<div>
    <table width="100%" border=0 style="text-align: center">
        <tr bgcolor="#CCCCCC" style="height: 40px;font-weight: 600;">
            <td>Course Code</td>
            <td>Course Name</td>
            <td>Credit Hours</td>
            <td>Prerequisite </td>
            <td>College</td>
            <td>Department </td>
            <td>Sections</td>
            <td id="editCoursecol">Edit</td>
        </tr>
        <?php

        $course='';
        while ($rowC = mysqli_fetch_array($res_dataC )) {

            $course .= ' <tr>
                        <td> '. $rowC["Course_id"] . '</td>
                         <td> '. $rowC["Course_name"] .' </td>
                        <td> '. $rowC["Credit_hours"] . '</td>
                        <td> '. $rowC["Prerequisites_code"] .' </td>
                        <td> '. $rowC["College"] . '</td>
                        <td> '. $rowC["name"] . '</td>
                        <td><input type="button" name="view" value="view" id="'. $rowC["Course_id"].'" class="btn btn-info btn-xs view_dataC" /></td>
                        <td class="editCourseData">
                        <input type="button" name="edit" value="Edit" id="' . $rowC["Course_id"] . '" class="btn btn-info btn-xs edit_dataC">
                         <input type="button" name="delete" value="Delete" id="' . $rowC["Course_id"] . '" class="btn btn-danger btn-xs edit_datac"></td> 
                        
                        </tr>
                       

                        ';
        }
        echo  $course;
        ?>
        <?php
        while($rowC = mysqli_fetch_array($res_dataC ))
        {
            ?>
            <tr>
                <td><?php echo $rowC["Course_id"]; ?></td>
                <td> <?php echo$rowC["Course_name"] ?> </td>
                <td> <?php echo $rowC["Credit_hours"] ?></td>
                <td> <?php echo $rowC["Prerequisites_code"] ?> </td>
                <td> <?php echo $rowC["College"] ?></td>
                <td> <?php echo $rowC["Department_code"] ?></td>

                <td><input type="button" name="edit" value="Edit" id="<?php echo $rowC["Course_id"]; ?>" class="btn btn-info btn-xs edit_dataC" /></td>
                <td><input type="button" name="view" value="view" id="<?php echo $rowC["Course_id"]; ?>" class="btn btn-info btn-xs view_dataC" /></td>
            </tr>
            <?php
        }
        ?>
        <ul class="pagination" style="float: right">
            <li><a href="?pageno=1">First</a></li>
            <li class=
                <?php if ($pagenoC <= 1) {
                    echo "disabled";
                } ?>">
                            <a href="<?php if ($pagenoC <= 1) {
                echo "#";
            } else {
                echo "?pagenoC=" . ($pagenoC - 1);
            } ?>">Prev</a>
            </li>
            <li class="<?php if ($pagenoC >= $total_pagesC) {
                echo "disabled";
            } ?>">
                <a href="<?php if ($pagenoC >= $total_pagesC) {
                    echo "#";
                } else {
                    echo "?pagenoC=" . ($pagenoC + 1);
                } ?>">Next</a>
            </li>
            <li><a href="?pageno=<?php echo $total_pagesC; ?>">Last</a></li>
        </ul>

    </table>


</div>
<!--view lab Session-->
<div id="session_lab_ViewModal" class="modal fade">
    <div class="modal-dialog modal-dialog-centered" style="width: 70%" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Sections and Lab Session</h4>
            </div>
            <div class="modal-body" id="session_detail">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!--add courses-->
<div>
    <div id="add_Course_Modal" class="modal ">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Details</h4>
                </div>
                <div class="modal-body">
                    <form method="post" id="insert_formC">
                        <label>Enter Course Code</label>
                        <input type="text" name="Course_id" id="Course_id" class="form-control"/>
                        <br/>
                        <label>Enter Course Name</label>
                        <input type="text" name="Course_name" id="Course_name" class="form-control">
                        <br/>
                        <label>Enter Credit hours</label>
                        <input type="number" name="Credit_hours" id="Credit_hours" class="form-control"/>
                        <br/>
                        <label>Enter Prerequisites code</label>
                        <input type="text" name="Prerequisites_code" id="Prerequisites_code" class="form-control"/>
                        <br/>
                        <label>Enter Department Code</label>
                        <input type="text" name="Department_code" id="Department_code" class="form-control"/>
                        <br/>
                        <input type="hidden" name="Course_id" id="Course_id"/>
                        <input type="submit" name="insert" id="insertC" value="Insert" class="btn btn-success"/>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default close" style="font-size: 20px"
                            data-dismiss="modal">Close
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
<!--add sections-->
<div>
    <div id="add_Section_Modal" class="modal ">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Section Details</h4>
                </div>
                <div class="modal-body">
                    <form method="post" id="insert_formSes">
                        <label>Enter Course Code</label>
                        <input type="text" name="Course_code" id="Course_code" class="form-control"/>
                        <br/>
                        <label>Enter Section No</label>
                        <input type="text" name="Section_no" id="Section_no" class="form-control">
                        <br/>
                        <label>Enter Year</label>
                        <input type="number" name="Year" id="Year" class="form-control"/>
                        <br/>
                        <label>Enter Semester</label>
                        <input type="text" name="Semester" id="Semester" class="form-control"/>
                        <br/>
                        <label>Enter Classroom</label>
                        <input type="text" name="Classroom" id="Classroom" class="form-control"/>
                        <br/>
                        <label>Enter Class Time</label>
                        <input type="time" name="Class_time" id="Class_time" class="form-control"/>
                        <br/>
                        <label>Enter Class Size</label>
                        <input type="number" name="Class_size" id="Class_size" class="form-control"/>
                        <br/>
                        <label>Enter Professor ID</label>
                        <input type="text" name="Class_size" id="Prof_id" class="form-control"/>
                        <br/>
                        <input type="hidden" name="Course_id" id="Section_no"/>
                        <input type="submit" name="insert" id="insertSes" value="Insert" class="btn btn-success"/>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default close" style="font-size: 20px"
                            data-dismiss="modal">Close
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
<!--add lab Sessions-->
<div>
    <div id="add_Lab_Modal" class="modal ">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Lab Session Details</h4>
                </div>
                <div class="modal-body">
                    <form method="post" id="insert_formLab">
                        <label>Enter Section Code</label>
                        <input type="text" name="Section_noLab" id="Section_noLab" class="form-control"/>
                        <br/>
                        <label>Enter Lab Session Code</label>
                        <input type="text" name="Lab_session_num" id="Lab_session_num" class="form-control">
                        <br/>
                        <label>Enter Location</label>
                        <input type="text" name="Lab_location" id="Lab_location" class="form-control"/>
                        <br/>
                        <label>Enter Student ID of the conductor </label>
                        <input type="text" name="Student_idLab" id="Student_idLab" class="form-control"/>
                        <br/>
                        <label>Enter Topic</label>
                        <input type="text" name="Topic" id="Topic" class="form-control"/>
                        <br/>
                        <label>Enter Time</label>
                        <input type="time" name="Time" id="Time" class="form-control"/>
                        <br/>
                        <input type="hidden" name="Section_noLab" id="Section_noLab"/>
                        <input type="submit" name="insert" id="insertLab" value="Insert" class="btn btn-success"/>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default close" style="font-size: 20px"
                            data-dismiss="modal">Close
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<script type="text/javascript" src="../Course/courses.js"></script>
<script>
   var role='<?php echo  $_SESSION['role'];?>';
   if( role === "Student" || role === "Professor" ) {
       $("#addLabData").css("display", "none");
       $("#addSectionData").css("display", "none");
       $("#editCoursecol").css("display", "none");
      $(document.getElementsByClassName("editCourseData")).css("display", "none");
       $("#addEnrolCourseData").css("display", "none");
       $("#addCourseData").css("display", "none")

   };
</script>
