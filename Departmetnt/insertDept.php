<?php
require_once '../config.php';

if(!empty($_POST))
{
    $output = '';
    $message = '';
    $Department_code = mysqli_real_escape_string($mysqli, $_POST["Department_code"]);
    $Name = mysqli_real_escape_string($mysqli, $_POST["Name_DP"]);
    $Head_professor_id= mysqli_real_escape_string($mysqli, $_POST["Head_professor_id"]);



    if($_POST["Department_codeU"] != '')
    {
        $query = " UPDATE department SET Department_code='$Department_code',Name='$Name', Head_Proffessor_id='$Head_professor_id'  WHERE Department_code='".$_POST["Department_codeU"]."'";
        $message = 'Data Updated';
    }
    else
    {
        $query = "INSERT INTO department (Name,Department_code,Head_Proffessor_id) vALUES('$Name','$Department_code','$Head_professor_id')";
        $message = 'Data Inserted';
    }
    if($mysqli-> query($query))
    {
        $output .= '<label class="text-success">' . $message . '</label>';
        $res_dataDP = $mysqli->query("select * from department ");
        $dept = '
              <table id="department" width="100%" border=0 style="text-align: center">
        <tr bgcolor="#CCCCCC" style="height: 40px;font-weight: 600;">
            <td>Department Code</td>
            <td>Name</td>
            <td>Head of the Department</td>
            <td id="editDeptcol">Edit</td>
        </tr>
           ';
        while ($rowDP = mysqli_fetch_array($res_dataDP )) {
        $dept .= ' <tr>
                        <td> '. $rowDP["Department_code"] . '</td>
                         <td> '. $rowDP["Name"] .' </td>
                        <td> '. $rowDP["Head_Proffessor_id"] . '</td>
                         <td class="editDeptData">
                        <input type="button" name="edit" value="Edit" id="' . $rowDP["Department_code"] . '" class="btn btn-info btn-xs edit_dataDP">
                         <input type="button" name="delete" value="Delete" id="' . $rowDP["Department_code"] . '"  class="btn btn-danger btn-xs del_dataDP"></td> 
                        </tr>
                     
                        ';
        }
        echo  $dept;
    }

}
?>