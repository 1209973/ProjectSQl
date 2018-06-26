<?php
//    $connect = mysqli_connect("localhost", "root", "", "ProjectSQL");
require_once '../config.php';
;    if(isset($_POST["CSession_no"]))
{
    $row = mysqli_fetch_array($mysqli-> query("SELECT * FROM  company_session WHERE CSession_no = '{$_POST['CSession_no']}'"));

    echo json_encode($row);


//
}
