<?php
require_once '../config.php';

if(!empty($_POST))
{
    $output = '';
    $message = '';
    $CSession_no = mysqli_real_escape_string($mysqli, $_POST["CSession_no"]);



    if($_POST["CSession_no"] != '')
    {

        $query = " DELETE FROM company_sessionWHERE CSession_no='".$_POST["CSession_no"]."'";
        $message = 'Data Updated';

    }

    if($mysqli-> query($query))
    {
//        $output .= '<label class="text-success">' . $message . '</label>';
        $res_dataCS = $mysqli->query("SELECT csession_undergrad.student_id,company_session.csession_no,company_name,company_assesment,year,semester,session_manager FROM company_session,csession_undergrad WHERE company_session.csession_no=csession_undergrad.csession_no");
        $CompSec = '
         <table  width="100%" border=0 style="text-align: center">
        <tr bgcolor="#CCCCCC" style="height: 40px;font-weight: 600;">
            <td>Year</td>
            <td>Semester</td>
            <td>Session Manager</td>
            <td>Company Session No </td>
            <td>Company Name </td>
            <td>Company Assessment </td>
            <td class="editCompSecData"> Student ID</td>
            <td id="editCompSeccol">Edit</td>
        </tr>
           ';
        while ($rowCS = mysqli_fetch_array($res_dataCS )) {
            $CompSec .= ' <tr>
                        <td> '. $rowCS["year"] . '</td>
                         <td> '. $rowCS["semester"] .' </td>
                        <td> '. $rowCS["session_manager"] . '</td>
                        <td> '. $rowCS["csession_no"] .' </td>
                         <td> '. $rowCS["company_name"] .' </td>
                          <td class="editCompSecData"> '. $rowCS["student_id"] .' </td>
                          <td> '. $rowCS["company_assesment"] .' </td>
                        <td class="editCompSecData">
                        <input type="button" name="edit" value="Edit" id="' . $rowCS["csession_no"] . '" class="btn btn-info btn-xs edit_dataCSS"></td>
                        </tr>
                       

                        ';
        }
        echo  $CompSec;
    }

}
?>