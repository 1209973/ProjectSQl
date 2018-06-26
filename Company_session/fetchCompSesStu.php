<?php
//    $connect = mysqli_connect("localhost", "root", "", "ProjectSQL");
require_once '../config.php';
print_r($_POST);
;    if(isset($_POST["CSession_no"]))
{
    $row = mysqli_fetch_array($mysqli-> query("SELECT * FROM  csession_undergrad WHERE CSession_no = '{$_POST['CSession_no']}' AND student_id ='{$_POST['CSession_no']}'"));

    echo json_encode($row);


//
}
