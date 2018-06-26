<?php
require_once '../config.php';
if(isset($_POST["Course_id"]))
{

    $resultSes= $mysqli->query("SELECT * FROM section WHERE Course_code='".$_POST["Course_id"]."'");
    $resultLab = $mysqli->query("SELECT Lab_session_num, Lab_location,Topic,Time FROM lab_session WHERE section_num IN(SELECT section_no FROM student_section WHERE student_id='ST18001')");
//    $rowSes= mysqli_fetch_array($mysqli->query("SELECT * FROM section WHERE Course_id='".$_POST["Course_id"]."';"));
//    $rowSes= mysqli_fetch_array($mysqli->query("SELECT Lab_session_num, Lab_location,Topic,Time FROM lab_session WHERE section_num IN(SELECT section_no FROM student WHERE student_id='".$_SESSION["Student_id"]."';"));

    $labSession = '  
      <div>
    <table width="100%" border=0 style="text-align: center">"
        <tr bgcolor="#CCCCCC" style="height: 40px;font-weight: 600;">
        <td>Course Code</td>
            <td>Section No</td>
            <td>Year</td>
            <td>Semester </td>
            <td>Classroom</td>
            <td>Class Time </td>
            <td>Class Size</td>
           
            ';
    ?>
    <?php
        while($rowSes = mysqli_fetch_array($resultSes ))
        {
            $labSession .= '
            
            <tr><td>'. $rowSes["Course_code"].'</td>
                <td>'. $rowSes["Section_no"].'</td>
                <td> '.$rowSes["Year"] .'</td>
                <td> '.$rowSes["Semester"] .'</td>
                <td> '. $rowSes["Classroom"] .' </td>
                <td> '. $rowSes["Class_time"] .'</td>
                <td> '. $rowSes["Class_size"] .'</td>
           
                <td>
               
            </tr>';

        }
        ?>
<?php
    $labSession .= '  
           </table>  
      </div>  
      ';
    echo  $labSession;
}
?>

