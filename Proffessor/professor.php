<?php
if (isset($_GET['$pagenoST'])) {
    $pagenoST = $_GET['$pagenoST'];
} else {
    $pagenoST = 1;
}
$no_of_records_per_page = 5;
$offsetST = ($pagenoST - 1) * $no_of_records_per_page;

if( $_SESSION['role']=='Admin'){
    $total_rowsPF  =  mysqli_num_rows($mysqli->query("select * from proffessor"));
    $total_pagesPF = ceil($total_rowsPF  / $no_of_records_per_page);
    $res_dataPF =$mysqli->query("select * from proffessor LIMIT $offset, $no_of_records_per_page");

}
?>
<section id="professor">


    <div style="border-bottom: #000 solid .05px">

        <h2> PROFESSOR'S DETAILS <button type="button" name="add" id="addProfessorData" data-toggle="modal" data-target="#add_Profdata_Modal" class="btn btn-warning" style="float: right;margin-right: 1%">Add </button></h2>

        </h2>
    </div>
    <div id="ProfesssorDetails">
        <?php
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


        ?>





    <div id="add_Profdata_Modal" class="modal ">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Professor's Details</h4>
                </div>
                <div class="modal-body">
                    <form method="post" id="insert_formPF">
                        <label>Enter Professor's Name</label>
                        <input type="text" name="NamePF" id="NamePF" required class="form-control"/>
                        <br/>
                        <label>Enter the Offfice</label>
                        <input type="text" name="Office" id="Office" required  class="form-control">
                        <br/>
                        <label>Enter the Phone No</label>
                        <input type="number" name="Phone" id="Phone" required  class="form-control">
                        <br/>
                        <?php if($_SESSION['role']=="Admin"){
                            $profForm ='<label>Enter the Department Code</label>
                                <input type="text" name="Department_codePF" id="Department_codePF" required  class="form-control">
                                <br/>
                                <label>Enter the Employee ID</label>
                                <input type="text" name="Emp_id" id="Emp_id" required  class="form-control">
                                <br/>';
                            echo $profForm;
                        }



                        ?>

                        <input type="hidden" name="Emp_idU" id="Emp_idU"/>
                        <input type="submit" name="insert" id="insertPF" value="Insert" class="btn btn-success"/>
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



    <script type="text/javascript" src="A_professor.js"></script>

</section>



