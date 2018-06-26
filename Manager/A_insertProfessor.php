<?php
require_once '../config.php';

if(!empty($_POST)) {

    $stDetails = '';
    $message = '';
    $name = mysqli_real_escape_string($mysqli, $_POST["NamePF"]);
    $Office = mysqli_real_escape_string($mysqli, $_POST["Office"]);
    $Phone = mysqli_real_escape_string($mysqli, $_POST["Phone"]);
    $Emp_id = mysqli_real_escape_string($mysqli, $_POST["Emp_id"]);



    if ($_POST["Emp_idU"] != '') {

            $query = " UPDATE proffessor SET Name='$name',Office='$Office', Phone='$Phone'  WHERE Emp_id='" . $_POST["Emp_id"] . "'";
            $message = 'Data Updated';

          }
          else {
        $Department_code = mysqli_real_escape_string($mysqli, $_POST["Department_codePF"]);
            $query = " INSERT INTO proffessor (Emp_id,Name,Office,Phone,Department_code) VALUES('$Emp_id','$name','$Office','$Phone','$Department_code');";
            $message = 'Data Inserted';

        }

    if ($mysqli->query($query)) {
//        $stDetails .= '<label class="text-success">' . $message . '</label>';
        $result=$mysqli->query("select * from proffessor ");

            $Professor =' <table id="ProfesssorDetails" width="100%" border=0 style="text-align: center">
                                    <tr bgcolor="#CCCCCC" style="height: 40px;font-weight: 600;">
                                        <td>Name </td>
                                        <td>Employee ID</td>
                                        <td>Office</td>
                                        <td>Phone</td>
                                        <td>Department</td>
                                        <td>Edit</td>
                                    </tr>';

            while ($rowPF =  mysqli_fetch_array($result) )
            {
                                    $Professor .= ' <tr>
                                            <td> '. $rowPF["Name"] . '</td>
                                            <td> '. $rowPF["Emp_id"] .' </td>
                                            <td> '. $rowPF["Office"] . '</td>
                                            <td> '. $rowPF["Phone"] . '</td>
                                            <td> '. $rowPF["Department_code"] . '</td>
                                            <td>
                                                <input type="button" name="edit" value="Edit" id="' . $rowPF["Emp_id"] . '" class="btn btn-info btn-xs edit_dataPF">
                                                <input type="button" name="delete" value="Delete" id="' . $rowPF["Emp_id"] . '"  class="btn btn-danger btn-xs del_dataPF"></td> 
                
                                        </tr>
                               
                                        ';
            }


            $Professor .= '
                                </table>
            
            
                            </div>';
            echo  $Professor;



}
}
    ?>