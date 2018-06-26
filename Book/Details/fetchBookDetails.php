<?php
//    $connect = mysqli_connect("localhost", "root", "", "ProjectSQL");
require_once '../../config.php';
;    if(isset($_POST["ISBN"]))
{
    $row = mysqli_fetch_array($mysqli-> query("SELECT * FROM  book WHERE ISBN = '{$_POST['ISBN']}'"));

    echo json_encode($row);


//
}
