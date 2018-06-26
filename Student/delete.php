<?php
require_once '../config.php';

if(!empty($_POST)) {
    $stDetails = '';
    $message = '';
    $status ='';
    $student_id = mysqli_real_escape_string($mysqli, $_POST["Student_id"]);



    if ($_POST["Student_id"] != '') {
        $studentDetail = mysqli_fetch_array($mysqli->query("select * from student WHERE Student_id ='{$_POST["Student_id"]}'"));
         if  ($studentDetail['Status']== "Undergraduate") {
            $query = " DELETE FROM student WHERE student_id='" . $_POST["Student_id"] . "'";
            $query1 = " DELETE FROM undegraduate_student WHERE student_id='" . $_POST["Student_id"] . "'";
            $message = 'Data Updated';
        } else {
            $query = " DELETE FROM student WHERE student_id='" . $_POST["Student_id"] . "'";
            $query1 = " DELETE FROM graduate_student WHERE student_id='" . $_POST["Student_id"] . "'";
            $message = 'Data Updated';
        }
    }
    if ($mysqli->query($query) && $mysqli->query($query1)) {

        $studentDetails = '<div style="border-bottom: #000 solid .05px">

                <h3> UNDERGRADUATE STUDENT DETAILS

</h3>
            </div>
                <div>
                ';

        $studentDetails .= ' <table width="100%" border=0 style="text-align: center">
                        <tr bgcolor="#CCCCCC" style="height: 40px;font-weight: 600;">
                            <td>Name </td>
                            <td>Student ID</td>
                            <td>Address</td>
                            <td>Edit</td>
                        </tr>';
        $result1=$mysqli->query("SELECT * from student where Status ='Undergraduate' ");
        while ($rowSTU = mysqli_fetch_array($result1)) {

            $studentDetails .= ' <tr>
                                <td> ' . $rowSTU["Name"] . '</td>
                                <td> ' . $rowSTU["Student_id"] . ' </td>
                                <td> ' . $rowSTU["Address"] . '</td>
                                <td>
                                    <input type="button" name="edit" value="Edit" id="' . $rowSTU["Student_id"] . '" class="btn btn-info btn-xs edit_dataST">
                                     <input type="button" name="delete" value="Delete"  class="btn btn-danger btn-xs edit_dataB"></td>

                            </tr>                            ';
        }


        $studentDetails .= '
                    </table>


                </div>
                


<!--Graduate-->
<div>
    <div style="border-bottom: #000 solid .05px">

        <h3> GRADUATE STUDENT DETAILS</h3>

    </div>
    <div>
        
         <table width="100%" border=0 style="text-align: center">
                        <tr bgcolor="#CCCCCC" style="height: 40px;font-weight: 600;">
                            <td>Name </td>
                            <td>Student ID</td>
                            <td>Address</td>
                            <td>Major</td>
                            <td>Thesisopt</td>
                            <td>Edit</td>
                        </tr>';
        $result2=$mysqli->query("SELECT Name,student.Student_id,Major,Address,Thesisopt from student, graduate_student where student.Student_Id=graduate_student.Student_ID ");
        while ($rowSTG = mysqli_fetch_array($result2)) {

            $studentDetails .= ' <tr>
                                <td> ' . $rowSTG["Name"] . '</td>
                                <td> ' . $rowSTG["Student_id"] . ' </td>
                                <td> ' . $rowSTG["Address"] . '</td>
                                <td> ' . $rowSTG["Major"] . '</td>
                                <td> ' . $rowSTG["Thesisopt"] . '</td>

                                <td>
                                    <input type="button" name="edit" value="Edit" id="' . $rowSTG["Student_id"] . '" class="btn btn-info btn-xs edit_dataST">
                                     <input type="button" name="delete" value="Delete"  class="btn btn-danger btn-xs edit_dataB"></td>

                            </tr>


                            ';
        }


        $studentDetails .= '
                    </table>


                </div>
                </div>';
        echo $studentDetails;

    }
}
?>