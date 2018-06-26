<?php
require_once '../config.php';

if(!empty($_POST)) {
    $stDetails = '';
    $message = '';
    $name = mysqli_real_escape_string($mysqli, $_POST["Name"]);
    $address = mysqli_real_escape_string($mysqli, $_POST["Address"]);
    $status = mysqli_real_escape_string($mysqli, $_POST["Status"]);
    $student_id = mysqli_real_escape_string($mysqli, $_POST["Student_id"]);



    if ($_POST["Student_id"] != '') {
        if ($_POST["Status"] == "Undergraduate") {
            $query = " UPDATE student SET Name='$name',Address='$address', Status='$status'  WHERE Student_id='" . $_POST["Student_id"] . "'";
            $message = 'Data Updated';
        } else {
            $Major = mysqli_real_escape_string($mysqli, $_POST["Major"]);
            $Thesisopt = mysqli_real_escape_string($mysqli, $_POST["Thesisopt"]);
            $query = " UPDATE graduate_student SET Thesisopt='$Thesisopt',Major='$Major'  WHERE Student_id='" . $_POST["Student_id"] . "'";
            $query1 = " UPDATE student SET Name='$name',Address='$address', Status='$status'  WHERE Student_id='" . $_POST["Student_id"] . "'";
            $mysqli->query($query1);
            $message = 'Data Updated';
        }
    } else {
        if ($_POST["Status"] == "Undergraduate") {
            $query = " UPDATE student SET Name='$name',Address='$address', Status='$status'  WHERE Student_id='" . $_POST["Student_id"] . "'";
            $message = 'Data Inserted';
        } else {
            $Major = mysqli_real_escape_string($mysqli, $_POST["Major"]);
            $Thesisopt = mysqli_real_escape_string($mysqli, $_POST["Thesisopt"]);
            $query = " UPDATE student SET Name='$name',Address='$address', Status='$status'  WHERE Student_id='" . $_POST["Student_id"] . "'";
            $message = 'Data Inserted';
        }
    }
    if ($mysqli->query($query)) {
//        $stDetails .= '<label class="text-success">' . $message . '</label>';
        $studentDetailsnew = mysqli_fetch_array($mysqli->query("select * from student WHERE Student_id ='{$_POST["Student_id"]}'"));
        $stDetails .= '
                <div id="StudentDetails">
                <h3> ' . $studentDetailsnew["Name"] . ' </h3>
                <p> Student ID:' . $studentDetailsnew["Student_id"] . '  </p>
                <p> Address:' . $studentDetailsnew["Address"] . '  </p>
                <p> Status:' . $studentDetailsnew["Status"] . '  </p>
                ';

        if (substr($studentDetailsnew["Status"], 0, 1) === "G") {
            $stDetails .= '<p> Major:'.$studentDetailsnew["Major"]. '</p>";
                   <p> Thesisopt:'.$studentDetailsnew["Thesisopt"]. '</p>";
                ';
        }


        $stDetails .= '
            </div>
           ';


        echo $stDetails;

    }
}
    ?>