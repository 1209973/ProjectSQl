<?php
//    $connect = mysqli_connect("localhost", "root", "", "ProjectSQL");
require_once '../config.php';
;    if(isset($_POST["Department_code"]))
{
    $row = mysqli_fetch_array($mysqli-> query("SELECT * FROM  department WHERE Department_code = '{$_POST['Department_code']}'"));

    echo json_encode($row);


//
}
