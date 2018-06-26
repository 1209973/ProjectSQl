<?php


require_once '../config.php';

session_start();


// If session variable is not set it will redirect to login page

if (!isset($_SESSION['ID']) || empty($_SESSION['ID'])) {

    header("location: ../login.php");

    exit;

}


if (isset($_GET['pagenoG'])) {
    $pageno = $_GET['pagenoG'];
} else {
    $pageno = 1;
}
$no_of_records_per_page = 5;
$offset = ($pageno - 1) * $no_of_records_per_page;





?>


<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">

    <title>Welcome</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"/>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/all.css">
    <link rel="stylesheet" href="../css/navbar.css">



</head>

<body>
<div class="col-lg-2">
    <?php include_once '../navbar.php' ?>
</div>

<div class="col-lg-10" style="float: right;width: 96%">

    <div style=" background: #e4e4e4 ; height: 45px;position: absolute;width: 94.5vw;top:0">
        <p><a href="../logout.php" class="btn" style="float: right;color: #000000"><span
                        class="glyphicon glyphicon-log-out"></span> Sign Out </a></p>
    </div>
    <div style="float: right ;width: 98%;padding-right: 1%;margin-top: 2%">

        <!--DETAILS-->
        <div style="text-align: left;padding-left: 2%">


            <div style="border-bottom: #000 solid .05px">

                <h2>DETAILS  <?php

                    $proffessorDetails = mysqli_fetch_array($mysqli->query("select * from proffessor WHERE Emp_id ='{$_SESSION['ID']}'"));
                    echo "<input type=\"button\" name=\"edit\" value=\"Edit\" id=\"$proffessorDetails[Emp_id]\" class=\"btn btn-info btn-sm edit_dataPF\" style=\"float: right;\" />";
                    ?>
                </h2>


            </div>

            <div id ="profDetails">

                <h3> <?php echo $proffessorDetails['Name'];?> </h3>
                <p> Employee ID: <?php echo $proffessorDetails['Emp_id'];?>  </p>
                <p> Office: <?php echo $proffessorDetails['Office'];?>  </p>
                <p> Phone: <?php echo $proffessorDetails['Phone'];?>  </p>
                <p> Department: <?php echo $proffessorDetails['Department_code'];?>  </p>
            </div>
        </div>


        <!--GRADES-->

        <div style="text-align: left;padding-left: 2%;margin-top: 2%">

            <?php

            include'../Course/grades.php'
            ?>

        </div>


        <!--        AUTHORED BOOK-->
        <div style="text-align: left;padding-left: 2%;margin-top: 2%">

            <?php
            include '../Book/Details/authoredBooks.php'

            ?>

        </div>
        <!--        BOOK DETAILS-->

        <div style="text-align: left;padding-left: 2%;margin-top: 2%">

            <?php

            include '../Book/Details/bookDetails.php'
            ?>

        </div>



        <div>

            <div id="add_Profdata_Modal" class="modal ">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Professor's Details</h4>
                        </div>
                        <div class="modal-body">
                            <form method="post" id="insert_formPF">
                                <label>Enter Professor's Name</label>
                                <input type="text" name="NamePF" id="NamePF" required class="form-control"/>
                                <br/>
                                <label>Enter the Offfice</label>
                                <input type="text" name="Office" id="Office" required  class="form-control">
                                <br/>
                                <label>Enter the Phone No</label>
                                <input type="text" name="Phone" id="Phone" required  class="form-control">
                                <br/>
                                <?php if($_SESSION['role']=="Admin"){
                                    $profForm ='<label>Enter the Department Code</label>
                                <input type="text" name="Department_codePF" id="Department_codePF" required  class="form-control">
                                <br/>
                                <label>Enter the Employee ID</label>
                                <input type="text" name="Emp_id" id="Emp_id" required  class="form-control">
                                <br/>';
                                    echo $profForm;
                                }



                                ?>

                                <input type="hidden" name="Emp_id" id="Emp_idU"/>
                                <input type="submit" name="insert" id="insertPF" value="Insert" class="btn btn-success"/>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default close" style="font-size: 20px"
                                    data-dismiss="modal">Close
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="../navbar.js"></script>
    <script type="text/javascript" src="professor.js"></script>

</html>



