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
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
        <section id="details"style="text-align: left;padding-left: 2%">


            <div style="border-bottom: #000 solid .05px">

                <h2>DETAILS <?php

                    $studentDetails = mysqli_fetch_array($mysqli->query("select * from student WHERE Student_id ='{$_SESSION['ID']}'"));
                     if(substr( $studentDetails['Status'], 0, 1 ) === "G"){
                        $studentDetails = mysqli_fetch_array($mysqli->query("select * from student ,graduate_student WHERE student.Student_id ='{$_SESSION['ID']}' AND graduate_student.Student_id='{$_SESSION['ID']}'"));
                    }

                    echo "<input type=\"button\" name=\"edit\" value=\"Edit\" id=\"$studentDetails[Student_id]\" class=\"btn btn-info btn-sm edit_dataST\" style=\"float: right;\" />";
                    ?></h2>


            </div>

            <div id="StudentDetails">

                <h3> <?php echo $studentDetails['Name'];?> </h3>
                <p> Student ID:<?php echo $studentDetails['Student_id'];?>  </p>
                <p> Address:<?php echo $studentDetails['Address'];?>  </p>
                <p> Status:<?php echo $studentDetails['Status'];?>  </p>
                <?php if(substr( $studentDetails['Status'], 0, 1 ) === "G"){
                    echo "<p> Major:".$studentDetails['Major']. "</p>";
                    echo "<p> Thesisopt:".$studentDetails['Thesisopt']. "</p>";
                }
                ?>




            </div>
        </section>


        <!--GRADES-->

        <section id="grades" style="text-align: left;padding-left: 2%;margin-top: 2%">

            <?php

            include'../Course/grades.php'
            ?>

        </section>
        <!--        COURSES-->

        <section id="courses" style="text-align: left;padding-left: 2%;margin-top: 2%">

            <?php

            include'../Course/courses.php'
            ?>

        </section>
<section id="libaray">
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
</section>
        <section id="Compnay_sesions">
            <div style="text-align: left;padding-left: 2%;margin-top: 2%">

                <?php

                include '../Company_session/CompSes.php';
                ?>

            </div>
        </section>

<!--        modal-edit student details-->
        <div>

            <div id="add_Studentdata_Modal" class="modal ">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Student Details</h4>
                        </div>
                        <div class="modal-body">
                            <form method="post" id="insert_formST">
                                <label>Enter Students Name</label>
                                <input type="text" name="Name" id="NameST" required class="form-control"/>
                                <br/>
                                <label>Enter the Address</label>
                                <textarea name="Address" id="AddressST" required class="form-control"></textarea>
                                <br/>

                                <label>Enter Status</label>
                                <select name="Status" id="Status" required class="form-control">
                                    <option value="Undergraduate">Undergraduate</option>
                                    <option value="Graduate">Graduate</option>
                                </select>
                                <br/>
                                <?php if(substr( $studentDetails['Status'], 0, 1 ) === "G"){
                                    $graduateForm='<label>Enter Major</label>
                                <input type="text" name="major" id="Major" requiredclass="form-control"/>
                                <br/>
                                <label>Enter Thesisopt</label>
                                <input type="text" name="thesisopt" id="Thesiopt"required class="form-control"/>
                                <br/>';
                                    echo $graduateForm;
                                }
                                ?>

                                <input type="hidden" name="Student_id" id="Student_idST"/>
                                <input type="submit" name="insert" id="insertST" value="Insert" class="btn btn-success"/>
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
    <script type="text/javascript" src="student.js"></script>

</html>



