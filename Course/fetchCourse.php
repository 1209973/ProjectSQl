<?php
//    $connect = mysqli_connect("localhost", "root", "", "ProjectSQL");
require_once '../config.php';
;    if(isset($_POST["Course_id"]))
{
    $row = mysqli_fetch_array($mysqli-> query("SELECT * FROM  course WHERE Course_id = '{$_POST['Course_id']}'"));

    echo json_encode($row);


//
}
