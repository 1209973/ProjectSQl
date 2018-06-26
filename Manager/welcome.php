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

    <div style=" background: #e4e4e4 ; height: 45px;position: absolute;width: 94.5vw;">
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

<!--            <div id ="profDetails">-->
            <div>

                <h3> <?php echo $proffessorDetails['Name'];?> </h3>
                <p> Employee ID: <?php echo $proffessorDetails['Emp_id'];?>  </p>
                <p> Office: <?php echo $proffessorDetails['Office'];?>  </p>
                <p> Phone: <?php echo $proffessorDetails['Phone'];?>  </p>
                <p> Department: <?php echo $proffessorDetails['Department_code'];?>  </p>
            </div>
        </div>
        <!--STUDNETS-->
        <div style="text-align: left;padding-left: 2%;margin-top: 2%">

            <?php

            include'../Student/student.php'
            ?>

<!--            PROFESSOR-->
        <div style="text-align: left;padding-left: 2%;margin-top: 2%">

                <?php

                include'../Proffessor/professor.php'
                ?>
        </div>
<!--DEPARTMENT-->
                <div style="text-align: left;padding-left: 2%;margin-top: 2%">

                    <?php

                    include'../Departmetnt/department.php'
                    ?>
                </div>
            <!--        Company Session -->
            <div style="text-align: left;padding-left: 2%;margin-top: 2%">

                <?php

                include '../Company_session/CompSes.php'
                ?>

            </div>
        <!--GRADES-->

        <div style="text-align: left;padding-left: 2%;margin-top: 2%">

            <?php

            include'../Course/grades.php'
            ?>

        </div>
        <!--        COURSES-->

        <div style="text-align: left;padding-left: 2%;margin-top: 2%">

            <?php

            include'../Course/courses.php'
            ?>

        </div>

<div id="library">
        <!--        BORROW BOOK-->
        <div style="text-align: left;padding-left: 2%;margin-top: 2%">

            <?php

            include '../Book/borrow/book.php'
            ?>

        </div>
        <!--        BOOK DETAILS-->

        <div style="text-align: left;padding-left: 2%;margin-top: 2%">

            <?php

            include '../Book/Details/bookDetails.php'
            ?>

        </div>
</div>

        <div>

            <div id="add_data_Modal" class="modal ">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Student Details</h4>
                        </div>
                        <div class="modal-body">
                            <form method="post" id="insert_form">
                                <label>Enter Students Name</label>
                                <input type="text" name="Name" id="Name" class="form-control"/>
                                <br/>
                                <label>Enter the Address</label>
                                <textarea name="Address" id="Address" class="form-control"></textarea>
                                <br/>

                                <label>Enter Status</label>
                                <select name="Status" id="Status" class="form-control">
                                    <option value="Undergraduate">Undergraduate</option>
                                    <option value="Graduate">Graduate</option>
                                </select>
                                <br/>
                                <?php if(substr( $studentDetails['Status'], 0, 1 ) === "G"){
                                    $graduateForm='<label>Enter Major</label>
                                <input type="text" name="major" id="Major" class="form-control"/>
                                <br/>
                                <label>Enter Thesisopt</label>
                                <input type="text" name="thesisopt" id="Thesiopt" class="form-control"/>
                                <br/>';
                                    echo $graduateForm;
                                }
                                ?>

                                <input type="hidden" name="Student_id" id="Student_id"/>
                                <input type="submit" name="insert" id="insert" value="Insert" class="btn btn-success"/>
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



</html>



