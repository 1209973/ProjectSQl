<?php
//    $connect = mysqli_connect("localhost", "root", "", "ProjectSQL");
require_once '../config.php';
;    if(isset($_POST["Emp_id"]))
    {
        $result = $mysqli-> query("SELECT Emp_id,Name,Office,Phone,Department_code FROM proffessor WHERE Emp_id= '{$_POST['Emp_id']}'");
        $row = mysqli_fetch_array($result);

        echo json_encode($row);

//
    }

