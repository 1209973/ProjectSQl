<?php
require_once '../config.php';

if(!empty($_POST)) {
    $stDetails = '';
    $message = '';
    $status ='';
    $student_id = mysqli_real_escape_string($mysqli, $_POST["Prof_id"]);



    if ($_POST["Prof_id"] != '') {

        $query = " DELETE FROM proffessor WHERE Emp_id='" . $_POST["Prof_id"] . "'";
        $message = 'Data Updated';


    }
    if ($mysqli->query($query)) {
        $res_dataPF =$mysqli->query("select * from proffessor");

        $Professor =' <table id="ProfesssorDetails" width="100%" border=0 style="text-align: center">
                        <tr bgcolor="#CCCCCC" style="height: 40px;font-weight: 600;">
                            <td>Name </td>
                            <td>Employee ID</td>
                            <td>Office</td>
                            <td>Phone</td>
                            <td>Department</td>
                            <td>Edit</td>
                        </tr>';

        while ($rowPF = mysqli_fetch_array($res_dataPF )) {

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