<?php
require_once '../config.php';

if(!empty($_POST)) {

    $stDetails = '';
    $message = '';
    $name = mysqli_real_escape_string($mysqli, $_POST["NamePF"]);
    $Office = mysqli_real_escape_string($mysqli, $_POST["Office"]);
    $Phone = mysqli_real_escape_string($mysqli, $_POST["Phone"]);
     $Emp_id = mysqli_real_escape_string($mysqli, $_POST["Emp_id"]);



    if ($_POST["Emp_id"] != '') {

            $query = " UPDATE proffessor SET Name='$name',Office='$Office', Phone='$Phone'  WHERE Emp_id='" . $_POST["Emp_id"] . "'";
            $message = 'Data Updated';

          }
          else {
        $Department_code = mysqli_real_escape_string($mysqli, $_POST["Department_codePF"]);
            $query = " INSERT INTO proffessor VALUES('$Emp_id','$name','$Office','$Phone','$Department_code');";
            $message = 'Data Inserted';

        }

    if ($mysqli->query($query)) {
//        $stDetails .= '<label class="text-success">' . $message . '</label>';
        $proffessorDetailsnew = mysqli_fetch_array($mysqli->query("select * from proffessor WHERE Emp_id ='" . $_POST["Emp_id"] . "'"));
        $stDetails = '
                <div id ="profDetails">

                <h3> '. $proffessorDetailsnew['Name'].' </h3>
                <p> Employee ID:'. $proffessorDetailsnew['Emp_id'].'  </p>
                <p> Office:'. $proffessorDetailsnew['Office'].'  </p>
                <p> Phone: '. $proffessorDetailsnew['Phone'].' </p>
                <p> Department: '. $proffessorDetailsnew['Department_code'].'  </p>
            </div>
                ';

                echo $stDetails;

    }
}
    ?>