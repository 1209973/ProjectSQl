<?php
if (isset($_GET['$pagenoST'])) {
    $pagenoST = $_GET['$pagenoST'];
} else {
    $pagenoST = 1;
}
$no_of_records_per_page = 5;
$offsetST = ($pagenoST - 1) * $no_of_records_per_page;

if( $_SESSION['role']=='Admin'){
    $total_rowsSTU  =  mysqli_num_rows($mysqli->query("SELECT * from student where Status ='Undergraduate'"));
    $total_pagesSTU = ceil($total_rowsSTU   / $no_of_records_per_page);
    $res_dataSTU =$mysqli->query("SELECT * from student where Status ='Undergraduate' LIMIT $offset, $no_of_records_per_page");
    $total_rowsSTG  =  mysqli_num_rows($mysqli->query("SELECT Name,student.Student_id,Major,Address,Thesisopt from student, graduate_student where student.Student_Id=graduate_student.Student_ID"));
    $total_pagesSTG = ceil($total_rowsSTG   / $no_of_records_per_page);
    $res_dataSTG =$mysqli->query("SELECT Name,student.Student_id,Major,Address,Thesisopt from student, graduate_student where student.Student_Id=graduate_student.Student_ID LIMIT $offset, $no_of_records_per_page");

}
?>
<section id="student">
<!--undergraduate-->

    <div style="border-bottom: #000 solid .05px">
    <h2>  STUDENT DETAILS
        <button type="button" name="add" id="addStundetsData" data-toggle="modal" data-target="#add_Studentdata_Modal" class="btn btn-warning" style="float: right;margin-right: 1%">Add </button></h2>
    </h2>
    </div>
    <div id="StudentDetails">
    <div style="border-bottom: #000 solid .05px">

                <h3> UNDERGRADUATE STUDENT DETAILS

                </h3>
            </div>
                <div>
                    <?php
                    $Ustudent =' <table width="100%" border=0 style="text-align: center">
                        <tr bgcolor="#CCCCCC" style="height: 40px;font-weight: 600;">
                            <td>Name </td>
                            <td>Student ID</td>
                            <td>Address</td>
                            <td>Edit</td>
                        </tr>';

                        while ($rowSTU = mysqli_fetch_array($res_dataSTU )) {

                            $Ustudent .= ' <tr>
                                <td> '. $rowSTU["Name"] . '</td>
                                <td> '. $rowSTU["Student_id"] .' </td>
                                <td> '. $rowSTU["Address"] . '</td>
                                <td>
                                    <input type="button" name="edit" value="Edit" id="' . $rowSTU["Student_id"] . '" class="btn btn-info btn-xs edit_dataST">
                                     <input type="button" name="delete" value="Delete" id="' . $rowSTU["Student_id"] . '" class="btn btn-danger btn-xs del_dataST"></td> 
    
                            </tr>
    
    
                            ';
                        }


        $Ustudent .= '
                    </table>


                </div>';
                echo  $Ustudent;


                ?>



<!--Graduate-->
<div>
    <div style="border-bottom: #000 solid .05px">

        <h3> GRADUATE STUDENT DETAILS</h3>

    </div>
    <div>
        <?php
        $Gstudent =' <table width="100%" border=0 style="text-align: center">
                        <tr bgcolor="#CCCCCC" style="height: 40px;font-weight: 600;">
                            <td>Name </td>
                            <td>Student ID</td>
                            <td>Address</td>
                            <td>Major</td>
                            <td>Thesisopt</td>
                            <td>Edit</td>
                        </tr>';

        while ($rowSTG = mysqli_fetch_array($res_dataSTG )) {

            $Gstudent .= ' <tr>
                                <td> '. $rowSTG["Name"] . '</td>
                                <td> '. $rowSTG["Student_id"] .' </td>
                                <td> '. $rowSTG["Address"] . '</td>
                                <td> '. $rowSTG["Major"] . '</td>
                                <td> '. $rowSTG["Thesisopt"] . '</td>
                                
                                <td>
                                    <input type="button" name="edit" value="Edit" id="' . $rowSTG["Student_id"] . '" class="btn btn-info btn-xs edit_dataST">
                                     <input type="button" name="delete" value="Delete" id="' . $rowSTG["Student_id"] . '" class="btn btn-danger btn-xs del_dataST"></td> 
    
                            </tr>
    
    
                            ';
        }


        $Gstudent .= '
                    </table>


                </div>';
        echo  $Gstudent;


        ?>


</div>
</div>

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
                                <label>Enter Students ID</label>
                                <input type="text" name="Student_id" id="Student_idST" required class="form-control"/>
                                <br/>
                                <label>Enter the Address</label>
                                <textarea name="Address" id="AddressST" required class="form-control"></textarea>
                                <br/>

                                <label>Enter Status</label>
                                <select name="Status" id="SStatus" onchange="checkStatus(this);" required class="form-control">
                                    <option  value="Undergraduate">Undergraduate</option>
                                    <option  id="STStatus" value="Graduate">Graduate</option>
                                </select>
                                <br/>
<!--                                <div id="Status" style="display: none">-->
<!--                                    <label>Enter Major</label>-->
<!--                                    <input type="text" name="major" id="Major" required class="form-control"/>-->
<!--                                    <br/>-->
<!--                                    <label>Enter Thesisopt</label>-->
<!--                                    <input type="text" name="thesisopt" id="Thesiopt"required class="form-control"/>-->
<!--                                    <br/>-->
<!---->
<!--                                </div>-->

                                <input type="hidden" name="Student_idU" id="Student_idSTU"  class="form-control"/>
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



    <script type="text/javascript" src="A_student.js"></script>
    <script>
        function checkStatus(Status)
        {
            status = document.getElementById("STStatus").value;
            if(Status){
                if(status == Status.value){
                    document.getElementById("Status").style.display = "block";
                }
                else{
                    document.getElementById("Status").style.display = "none";
                }
            }
            else{
                document.getElementById("Status").style.display = "none";
            }
        }

    </script>
</div>




