<?php
require_once '../config.php';
echo $_POST["Course_id"];
if(!empty($_POST))
{
    $output = '';
    $message = '';
    $Course_id = mysqli_real_escape_string($mysqli, $_POST["Course_id"]);
    $Course_name = mysqli_real_escape_string($mysqli, $_POST["Course_name"]);
    $Credit_hours= mysqli_real_escape_string($mysqli, $_POST["Credit_hours"]);
    $Prerequisites_code =mysqli_real_escape_string($mysqli, $_POST["Prerequisites_code"]);
    $Department_code =mysqli_real_escape_string($mysqli, $_POST["Department_code"]);



    if($_POST["Course_id"] != '')
    {
        $query = " UPDATE student SET Name='$name',Address='$address', Status='$status'  WHERE Student_id='".$_POST["Student_id"]."'";
        $message = 'Data Updated';
    }
    else
    {
        $query = "INSERT INTO student (Name,Address) vALUES('$name','$address')";
        $message = 'Data Inserted';
    }
    if($mysqli-> query($query))
    {
        $output .= '<label class="text-success">' . $message . '</label>';
        $result = $mysqli->query("select * from student_section WHERE Student_id ='ST18002' LIMIT $offset, $no_of_records_per_page");
        $course = '
                <table width="100%" border=0 style="text-align: center">
        <tr bgcolor="#CCCCCC" style="height: 40px;font-weight: 600;">
            <td>Course Code</td>
            <td>Course Name</td>
            <td>Credit Hours</td>
            <td>Prerequisite </td>
            <td>College</td>
            <td>Department </td>
            <td id="editCoursecol">Edit</td>
        </tr>
           ';
        while ($rowC = mysqli_fetch_array($res_dataC )) {
            $course .= ' <tr>
                        <td> '. $rowC["Course_id"] . '</td>
                         <td> '. $rowC["Course_name"] .' </td>
                        <td> '. $rowC["Credit_hours"] . '</td>
                        <td> '. $rowC["Prerequisites_code"] .' </td>
                        <td> '. $rowC["College"] . '</td>
                        <td> '. $rowC["Department_code"] . '</td>
                        <td class= "editCourseData">
                        <input type="button" name="edit" value="Edit" id="' . $rowC["Course_id"] . '" class="btn btn-info btn-xs edit_dataC"></td>
                        </tr>
                       

                        ';
        }

    }
    echo  $course;
}
?>