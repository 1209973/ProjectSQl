<?php


if (isset($_GET['pagenoG'])) {
    $pagenoG = $_GET['pagenoG'];
} else {
    $pagenoG = 1;
}
$no_of_records_per_page = 5;
$offsetG = ($pagenoG - 1) * $no_of_records_per_page;
if( $_SESSION['role']=='Student'){
    $total_rowsG =  mysqli_num_rows($mysqli->query("select * from student_section WHERE Student_id ='{$_SESSION['ID']}'"));
    $total_pagesG = ceil($total_rowsG/ $no_of_records_per_page);
    $res_dataG = $mysqli->query("select * from student_section WHERE Student_id ='{$_SESSION['ID']}' LIMIT $offset, $no_of_records_per_page");
}
if( $_SESSION['role']=='Professor'){

    $total_rowsG = mysqli_num_rows($mysqli->query("SELECT student.student_id,Grade,section.Year,section.Semester,section.Course_code,student.name FROM student,student_section, section WHERE student.student_id=student_section.student_id AND section.section_no=student_section.section_no AND section.course_code=student_section.course_code AND section.year=student_section.year AND section.semester=student_section.semester AND prof_id='{$_SESSION['ID']}'"));
    $total_pagesG = ceil($total_rowsG/ $no_of_records_per_page);
    $res_dataG = $mysqli->query("SELECT student.student_id,Grade,section.Year,section.Semester,section.Course_code,student.name FROM student,student_section, section WHERE student.student_id=student_section.student_id AND section.section_no=student_section.section_no AND section.course_code=student_section.course_code AND section.year=student_section.year AND section.semester=student_section.semester AND prof_id='{$_SESSION['ID']}' LIMIT $offset, $no_of_records_per_page");
}
if( $_SESSION['role']=='Admin'){
    $total_rowsG = mysqli_num_rows($mysqli->query("select * from student_section order by Course_code, Section_no"));[0];
    $total_pagesG = ceil($total_rowsG/ $no_of_records_per_page);
    $res_dataG = $mysqli->query("select * from student_section order by Course_code, Section_no LIMIT $offset, $no_of_records_per_page");
}
?>
<div id="grades">
<div style="border-bottom: #000 solid .05px;">
    <h2>GRADES  <button type="button" name="add" id="addGradeData" data-toggle="modal" data-target="#add_grades_Modal" class="btn btn-warning" style="float: right">Add</button></h2>

</div>
<?php
if( $_SESSION['role']=='Student'){
    $grades='<div>
        <table width="100%" border=0 style="text-align: center">
            <tr bgcolor="#CCCCCC" style="height: 40px;font-weight: 600;">
                <td>Section NO</td>
                <td>Year</td>
                <td>Semester</td>
                <td>Course Code</td>
                <td id="editGradecol">Student ID</td>
                <td>Grade</td>
                <td id="editGradecol">Edit</td>
            </tr>';



             while ($rowG = mysqli_fetch_array($res_dataG )) {
                 $grades .= ' <tr>
                        <td> '. $rowG["Section_no"] . '</td>
                         <td> '. $rowG["Year"] .' </td>
                        <td> '. $rowG["Semester"] . '</td>
                        <td> '. $rowG["Course_code"] .' </td>
                        <td class="studentGrade"> '. $rowG["Student_id"] .' </td>
                        <td> '. $rowG["Grade"] . '</td>
                        <td class="editGradeData">
                        <input type="button" name="edit" value="Edit" id="' . $rowG["ID"] . '" class="btn btn-info btn-xs edit_dataG">
                         <input type="button" name="delete" value="Delete"  class="btn btn-danger btn-xs edit_dataB"></td> 
                        </tr>
                       

                        ';
                    }
                    echo  $grades;


}
if( $_SESSION['role']=='Professor'){
    $grades='<div>
        <table width="100%" border=0 style="text-align: center">
            <tr bgcolor="#CCCCCC" style="height: 40px;font-weight: 600;">
                <td>Section NO</td>
                <td>Year</td>
                <td>Semester</td>
                <td>Course Code</td>
                <td id="editGradecol">Student ID</td>
                <td>Grade</td>
                <td id="editGradecol">Edit</td>
            </tr>';



    while ($rowG = mysqli_fetch_array($res_dataG )) {
        $grades .= ' <tr>
                        <td> '. $rowG["Section_no"] . '</td>
                         <td> '. $rowG["Year"] .' </td>
                        <td> '. $rowG["Semester"] . '</td>
                        <td> '. $rowG["Course_code"] .' </td>
                        <td class="studentGrade"> '. $rowG["Student_id"] .' </td>
                        <td> '. $rowG["Grade"] . '</td>
                        <td class="editGradeData">
                        <input type="button" name="edit" value="Edit" id="' . $rowG["ID"] . '" class="btn btn-info btn-xs edit_dataG">
                         <input type="button" name="delete" value="Delete"  class="btn btn-danger btn-xs edit_dataB"></td> 
                        </tr>
                       

                        ';
    }
    echo  $grades;


}
if( $_SESSION['role']=='Admin'){
    $grades='<div>
        <table width="100%" border=0 style="text-align: center">
            <tr bgcolor="#CCCCCC" style="height: 40px;font-weight: 600;">
                <td>Section NO</td>
                <td>Year</td>
                <td>Semester</td>
                <td>Course Code</td>
                <td id="editGradecol">Student ID</td>
                <td>Grade</td>
                <td id="editGradecol">Edit</td>
            </tr>';



    while ($rowG = mysqli_fetch_array($res_dataG )) {
        $grades .= ' <tr>
                        <td> '. $rowG["Section_no"] . '</td>
                         <td> '. $rowG["Year"] .' </td>
                        <td> '. $rowG["Semester"] . '</td>
                        <td> '. $rowG["Course_code"] .' </td>
                        <td class="studentGrade"> '. $rowG["Student_id"] .' </td>
                        <td> '. $rowG["Grade"] . '</td>
                        <td class="editGradeData">
                        <input type="button" name="edit" value="Edit" id="' . $rowG["ID"] . '" class="btn btn-info btn-xs edit_dataG">
                         <input type="button" name="delete" value="Delete"  id="' . $rowG["ID"] . '" class="btn btn-danger btn-xs edit_dataG"></td> 
                        </tr>
                       

                        ';
    }
    echo  $grades;


}

?>
<ul class="pagination" style="float: right">
    <li><a href="?pageno=1">First</a></li>
    <li class=
        <?php if ($pagenoG <= 1) {
            echo "disabled";
        } ?>">
                            <a href="<?php if ($pagenoG <= 1) {
        echo "#";
    } else {
        echo "?pagenoG=" . ($pagenoG - 1);
    } ?>">Prev</a>
    </li>
    <li class="<?php if ($pagenoG >= $total_pagesG) {
        echo "disabled";
    } ?>">
        <a href="<?php if ($pagenoG >= $total_pagesG) {
            echo "#";
        } else {
            echo "?pagenoG=" . ($pagenoG + 1);
        } ?>">Next</a>
    </li>
    <li><a href="?pageno=<?php echo $total_pagesG; ?>">Last</a></li>
</ul>

</table>


</div>



<div>
                            <div id="add_grades_Modal" class="modal ">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h4 class="modal-title">Details</h4>
                                        </div>
                                        <div class="modal-body">
                                            <form method="post" id="insert_formG">
                                                <label>Enter Students ID</label>
                                                <input type="text" name="Student_id" id="Student_id" class="form-control"/>
                                                <br/>
                                                <label>Enter the Section No</label>
                                                <input type="text" name="Section_no" id="Section_no" class="form-control">
                                                <br/>
                                                 <label>Enter the Grade</label>
                                                <input type="text" name="Grade" id="Grade" class="form-control"/>
                                                <br/>
                                                <input type="hidden" name="ID" id="ID"/>
                                                <input type="submit" name="insert" id="insertG" value="Insert" class="btn btn-success"/>
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
<script type="text/javascript" src="../Course/grades.js"></script>
<script>
    var role='<?php echo  $_SESSION['role'];?>';
    if( role == "Student") {
        $("#editGradecol").css("display", "none");
        $(document.getElementsByClassName("editGradeData")).css("display", "none");
        $(document.getElementsByClassName("studentGrade")).css("display", "none")
        $("#addGradeData").css("display", "none")
    };
</script>
</div>



