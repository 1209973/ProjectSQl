<?php
require_once 'config.php';
echo $_POST["ID"];
if(!empty($_POST))
{
    $output = '';
    $message = '';
    $ID = mysqli_real_escape_string($mysqli, $_POST["ID"]);



    if($_POST["ID"] != '')
    {
        $query = " DELETE FROM student  WHERE Department_code='".$_POST["Department_code"]."'";
        $message = 'Data deleted';
    }

    if($mysqli-> query($query))
    {
        $output .= '<label class="text-success">' . $message . '</label>';
        $result = $mysqli->query("select * from student_section WHERE Student_id ='ST18002' LIMIT $offset, $no_of_records_per_page");
        $grades = '
                <table width="100%" border=0 style="text-align: center">
            <tr bgcolor="#CCCCCC" style="height: 40px;font-weight: 600;">
                <td>Section NO</td>
                <td>Year</td>
                <td>Semester</td>
                <td>Course Code</td>
                <td>Grade</td>
                <td id="editGradecol">Edit</td>
            </tr>
           ';
        while ($row = mysqli_fetch_array($res_data)) {
            $grades .= ' <tr>
                        <td> '. $row["Section_no"] . '</td>
                         <td> '. $row["Year"] .' </td>
                        <td> '. $row["Semester"] . '</td>
                        <td> '. $row["Course_code"] .' </td>
                        <td> '. $row["Grade"] . '</td>
                        <td class="editGradeData">
                       <input type="button" name="edit" value="Edit" id="' . $rowG["ID"] . '" class="btn btn-info btn-xs edit_dataG">
                         <input type="button" name="delete" value="Delete"  id="' . $rowG["ID"] . '" class="btn btn-danger btn-xs edit_dataG"></td>
                        </tr>
                       

                        ';
        }

    }
    echo  $grades;
}
?>