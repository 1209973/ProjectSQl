<?php
//    $connect = mysqli_connect("localhost", "root", "", "ProjectSQL");
require_once '../config.php';
;    if(isset($_POST["ID"]))
{
        $result = $mysqli-> query("SELECT * FROM student_section WHERE ID = '{$_POST['ID']}'");
    $row = mysqli_fetch_array($result);

    echo json_encode($row);

//
}
