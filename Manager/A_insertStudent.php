<?php
require_once '../config.php';

if(!empty($_POST)) {
    $stDetails = '';
    $message = '';
    $name = mysqli_real_escape_string($mysqli, $_POST["Name"]);
    $address = mysqli_real_escape_string($mysqli, $_POST["Address"]);
    $status = mysqli_real_escape_string($mysqli, $_POST["Status"]);
    $student_id = mysqli_real_escape_string($mysqli, $_POST["Student_id"]);



    if ($_POST["Student_idU"] != '') {

        if ($_POST["Status"] == "Undergraduate") {
            $query = " UPDATE student SET Name='$name',Address='$address', Status='$status'  WHERE Student_id='" . $_POST["Student_idU"] . "'";
            $message = 'Data Updated';

        }
        else {
            $Major = mysqli_real_escape_string($mysqli, $_POST["Major"]);
            $Thesisopt = mysqli_real_escape_string($mysqli, $_POST["Thesisopt"]);
            $query = " UPDATE graduate_student SET Thesisopt='$Thesisopt',Major='$Major'  WHERE Student_id='" . $_POST["Student_idU"] . "'";
            $query1 = " UPDATE student SET Name='$name',Address='$address', Status='$status'  WHERE Student_id='" . $_POST["Student_idU"] . "'";
            $mysqli->query($query1);
            $message = 'Data Updated';
        }
    }
    else {
        if ($_POST["Status"] == "Undergraduate") {

            $query = "INSERT INTO student (Name,Address,Student_id,Status) VALUES('$name','$address','$student_id','$status')";
            $query1 = "INSERT INTO undegraduate_student  VALUES('$student_id')";

            $message = 'Data Inserted';
        }
        else {
            $Major = mysqli_real_escape_string($mysqli, $_POST["Major"]);
            $Thesisopt = mysqli_real_escape_string($mysqli, $_POST["Thesisopt"]);
            $query = "INSERT INTO student (Name,Address,Office,Status,Student_id) VALUES('$name','$address','$Office','$status','$student_id')";
            $query1 = "INSERT INTO undegraduate_student  VALUES('$student_id')";
            $message = 'Data Inserted';
        }
    }
    if ($mysqli->query($query) && $mysqli->query($query1)) {
//        $stDetails .= '<label class="text-success">' . $message . '</label>';

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
                                     <input type="button" name="delete" value="Delete"  class="btn btn-danger btn-xs del_dataST"></td> 

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
                                      <input type="button" name="delete" value="Delete"  class="btn btn-danger btn-xs del_dataST"></td> 

                            </tr>


                            ';
            }


            $studentDetails .= '
                    </table>


                </div>
                </div>';
            echo $studentDetails;

        }
     echo $mysqli->error;


    }




