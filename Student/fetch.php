<?php
//    $connect = mysqli_connect("localhost", "root", "", "ProjectSQL");
require_once '../config.php';
;    if(isset($_POST["Student_id"]))
    {
        $result = $mysqli-> query("SELECT * FROM student WHERE Student_id = '{$_POST['Student_id']}'");
        $row = mysqli_fetch_array($result);

        echo json_encode($row);

//
    }

