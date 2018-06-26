<?php
if (isset($_GET['pagenoCS'])) {
    $pagenoCS = $_GET['pagenoCS'];
} else {
    $pagenoCS = 1;
}
$no_of_records_per_page = 5;
$offsetCS = ($pagenoCS - 1) * $no_of_records_per_page;

if( $_SESSION['role']=='Student'){
    $total_rowsCSS  =  mysqli_num_rows($mysqli->query("SELECT company_session.csession_no,company_name,company_assesment,year,semester,session_manager FROM company_session,csession_undergrad WHERE company_session.csession_no=csession_undergrad.csession_no AND student_id ='{$_SESSION['ID']}'"));
    $total_pagesCSS = ceil($total_rowsCSS   / $no_of_records_per_page);
    $total_rowsCS  =  mysqli_num_rows($mysqli->query("SELECT * FROM  company_session"));
    $total_pagesCS = ceil($total_rowsCS   / $no_of_records_per_page);
    $res_dataCS = $mysqli->query("SELECT * FROM  company_session");
    $res_dataCSS = $mysqli->query("SELECT csession_undergrad.student_id ,company_session.csession_no,company_name,company_assesment,year,semester,session_manager FROM company_session,csession_undergrad WHERE company_session.csession_no=csession_undergrad.csession_no AND student_id ='{$_SESSION['ID']}' LIMIT $offset, $no_of_records_per_page");
}
if( $_SESSION['role']=='Professor'){

    $total_rowsCSS  =  mysqli_num_rows($mysqli->query("SELECT company_session.csession_no,company_name,company_assesment,year,semester,session_manager FROM company_session,csession_undergrad WHERE company_session.csession_no=csession_undergrad.csession_no AND student_id ='{$_SESSION['ID']}'"));
    $total_pagesCSS= ceil($total_rowsCSS   / $no_of_records_per_page);
    $res_dataCSS = $mysqli->query("SELECT company_session.csession_no,company_name,company_assesment,year,semester,session_manager FROM company_session,csession_undergrad WHERE company_session.csession_no=csession_undergrad.csession_no AND student_id ='{$_SESSION['ID']}' LIMIT $offset, $no_of_records_per_page");
}
if( $_SESSION['role']=='Admin'){
    $total_rowsCS  =  mysqli_num_rows($mysqli->query("SELECT company_session.csession_no,company_name,company_assesment,year,semester,session_manager FROM company_session,csession_undergrad WHERE company_session.csession_no=csession_undergrad.csession_no "));
    $total_pagesCS = ceil($total_rowsCS   / $no_of_records_per_page);
    $res_dataCS = $mysqli->query("SELECT * FROM  company_session");

    $res_dataCSS = $mysqli->query("SELECT csession_undergrad.student_id,company_session.csession_no,company_name,company_assesment,year,semester,session_manager FROM company_session,csession_undergrad WHERE company_session.csession_no=csession_undergrad.csession_no  LIMIT $offset, $no_of_records_per_page");
}


?>
<div id="CompanySession">
<div style="border-bottom: #000 solid .05px;">
    <h2>COMPANY SESSION DETAILS  <button type="button" name="add" id="addCompSecData" data-toggle="modal" data-target="#add_CompSec_Modal" class="btn btn-warning" style="float: right">Add</button></h2>

</div>


<div id="companySessions" >
    <table width="100%" border=0 style="text-align: center">
        <tr bgcolor="#CCCCCC" style="height: 40px;font-weight: 600;">
            <td>Year</td>
            <td>Semester</td>
            <td>Session Manager</td>
            <td>Company Session No </td>
            <td id="editCompSeccol">Edit</td>
        </tr>
        <?php

        $CompSec="";
        while ($rowCS = mysqli_fetch_array($res_dataCS )) {

            $CompSec .= ' <tr>
                        <td> '. $rowCS["Year"] . '</td>
                         <td> '. $rowCS["Semester"] .' </td>
                        <td> '. $rowCS["Session_Manager"] . '</td>
                        <td> '. $rowCS["CSession_no"] .' </td>
                        <td class="editCompSecData">
                        <input type="button" name="edit" value="Edit" id="' . $rowCS["CSession_no"] . '" class="btn btn-info btn-xs edit_dataCS">
                         <input type="button" name="delete" value="Delete"  class="btn btn-danger btn-xs edit_dataB"></td> 
                        </tr>
                       

                        ';
        }
        echo  $CompSec;
        ?>
        <ul class="pagination" style="float: right">
            <li><a href="?pageno=1">First</a></li>
            <li class=
                <?php if ($pagenoCS <= 1) {
                    echo "disabled";
                } ?>">
                            <a href="<?php if ($pagenoCS <= 1) {
                echo "#";
            } else {
                echo "?pagenoCS=" . ($pagenoCS - 1);
            } ?>">Prev</a>
            </li>
            <li class="<?php if ($pagenoCS >= $total_pagesCS) {
                echo "disabled";
            } ?>">
                <a href="<?php if ($pagenoCS >= $total_pagesCS) {
                    echo "#";
                } else {
                    echo "?pagenoCS=" . ($pagenoCS + 1);
                } ?>">Next</a>
            </li>
            <li><a href="?pageno=<?php echo $total_pagesCS; ?>">Last</a></li>
        </ul>

    </table>


</div>
<div style="border-bottom: #000 solid .05px;">
    <h2> COMPANY SESSION ENROLLED BY STUDENT  <button type="button" id="editCompSecsData" name="add" id="addCompSecStuData" data-toggle="modal" data-target="#add_CompSec_Stu_Modal" class="btn btn-warning" style="float: right">Add</button></h2>

</div>


<div id="companySessions_students">
    <table  width="100%" border=0 style="text-align: center">
        <tr bgcolor="#CCCCCC" style="height: 40px;font-weight: 600;">
            <td>Year</td>
            <td>Semester</td>
            <td>Session Manager</td>
            <td>Company Session No </td>
            <td>Company Name </td>
            <td>Company Assessment </td>
            <td class="editCompSecData"> Student ID</td>
            <td class="editCompSecData">Edit</td>
        </tr>
        <?php

        $CompSecStu="";
        while ($rowCSS = mysqli_fetch_array($res_dataCSS )) {
            $CompSecStu .= ' <tr>
                        <td> '. $rowCSS["year"] . '</td>
                         <td> '. $rowCSS["semester"] .' </td>
                        <td> '. $rowCSS["session_manager"] . '</td>
                        <td> '. $rowCSS["csession_no"] .' </td>
                         <td> '. $rowCSS["company_name"] .' </td>
                          <td class="editCompSecData"> '. $rowCSS["student_id"] .' </td>
                          <td> '. $rowCSS["company_assesment"] .' </td>
                        <td class="editCompSeccData">
                        <input type="button" name="edit" value="Edit" id="' . $rowCSS["csession_no"] . '" class="btn btn-info btn-xs edit_dataCSS">
                         <input type="button" name="delete" value="Delete"  class="btn btn-danger btn-xs edit_dataB"></td> 
                        </tr>
                       

                        ';
        }
        echo  $CompSecStu;
        ?>
        <ul class="pagination" style="float: right">
            <li><a href="?pageno=1">First</a></li>
            <li class=
                <?php if ($pagenoCS <= 1) {
                    echo "disabled";
                } ?>">
                            <a href="<?php if ($pagenoCS <= 1) {
                echo "#";
            } else {
                echo "?pagenoCS=" . ($pagenoCS - 1);
            } ?>">Prev</a>
            </li>
            <li class="<?php if ($pagenoCS >= $total_pagesCS) {
                echo "disabled";
            } ?>">
                <a href="<?php if ($pagenoCS >= $total_pagesCS) {
                    echo "#";
                } else {
                    echo "?pagenoCS=" . ($pagenoCS + 1);
                } ?>">Next</a>
            </li>
            <li><a href="?pageno=<?php echo $total_pagesCS; ?>">Last</a></li>
        </ul>

    </table>


</div>



<!--add company session-->
<div>
    <div id="add_CompSec_Modal" class="modal ">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"> Company Session Details</h4>
                </div>
                <div class="modal-body">
                    <form method="post" id="insert_formCS">
                        <label>Enter Year</label>
                        <input type="text" name="Year_CS" id="Year_CS" class="form-control"/>
                        <br/>
                        <label>Enter Semester</label>
                        <input type="text" name="Semester_CS" id="Semester_CS" class="form-control">
                        <br/>
                        <label>Enter Session Manager</label>
                        <input type="text" name="Session_Manager" id="Session_Manager" class="form-control"/>
                        <br/>
                        <label>Enter Company Session No</label>
                        <input type="text" name="CSession_noCS" id="CSession_noCS" class="form-control"/>
                        <br/>

                        <input type="hidden" name="CSession_no" id="CSession_no"/>
                        <input type="submit" name="insert" id="insertCS" value="Insert" class="btn btn-success"/>
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
<!--add student to company session-->
<div>
    <div id="add_CompSec_Stu_Modal" class="modal ">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"> Student Details in Company Session </h4>
                </div>
                <div class="modal-body">
                    <form method="post" id="insert_formCSS">
                        <label>Enter Student ID</label>
                        <input type="text" name="student_idCSS" required id="student_idCSS" class="form-control"/>
                        <br/>
                        <label>Enter Company Assessment</label>
                        <input type="text" name="company_assesment" required id="company_assesment" class="form-control">
                        <br/>
                        <label>Enter Company Name </label>
                        <input type="text" name="company_name" required id="company_name" class="form-control"/>
                        <br/>
                        <label>Enter Company Session No</label>
                        <input type="text" name="CSession_noCSS" required id="CSession_noCSS" class="form-control"/>
                        <br/>

                        <input type="hidden" name="CSession_no" id="CSession_no"/>
                        <input type="submit" name="insert" id="insertCSS" value="Insert" class="btn btn-success"/>
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
<script type="text/javascript" src="../Company_session/CompSes.js"></script>
<script>
    var role='<?php echo  $_SESSION['role'];?>';
    if( role === "Student" || role === "Professor" ) {
        $("#editCompSeccol").css("display", "none");
        $("#editCompSecsData").css("display", "none");
        $(document.getElementsByClassName("editCompSecData")).css("display", "none");
        $(document.getElementsByClassName("editCompSeccData")).css("display", "none");
        $("#addCompSecData").css("display", "none")

    };
</script>
</div>