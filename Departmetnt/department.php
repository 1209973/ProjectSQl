<?php
if (isset($_GET['pagenoDP'])) {
    $pagenoDP = $_GET['pagenoDP'];
} else {
    $pagenoDP = 1;
}
$no_of_records_per_page = 5;
$offsetDP = ($pagenoDP - 1) * $no_of_records_per_page;
$total_rowsDP = mysqli_num_rows($mysqli->query("select * from department"));
$total_pagesDP = ceil($total_rowsDP   / $no_of_records_per_page);
$res_dataDP=$mysqli->query("select * from department LIMIT $offset, $no_of_records_per_page");
?>
<div style="border-bottom: #000 solid .05px;">
    <h2>DEPARTMENT  <button type="button" name="add" id="addDeptData" data-toggle="modal" data-target="#add_Dept_Modal" class="btn btn-warning" style="float: right">Add</button></h2>

</div>


<div id="department">
    <table  width="100%" border=0 style="text-align: center">
        <tr bgcolor="#CCCCCC" style="height: 40px;font-weight: 600;">
            <td>Department Code</td>
            <td>Name</td>
            <td>Head of the Department</td>
            <td id="editDeptcol">Edit</td>
        </tr>
        <?php

        $dept="";
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
        ?>
        <ul class="pagination" style="float: right">
            <li><a href="?pageno=1">First</a></li>
            <li class=
                <?php if ($pagenoDP <= 1) {
                    echo "disabled";
                } ?>">
                            <a href="<?php if ($pagenoDP <= 1) {
                echo "#";
            } else {
                echo "?pagenoDP=" . ($pagenoDP - 1);
            } ?>">Prev</a>
            </li>
            <li class="<?php if ($pagenoDP >= $total_pagesDP) {
                echo "disabled";
            } ?>">
                <a href="<?php if ($pagenoDP >= $total_pagesDP) {
                    echo "#";
                } else {
                    echo "?pagenoDP=" . ($pagenoDP + 1);
                } ?>">Next</a>
            </li>
            <li><a href="?pageno=<?php echo $total_pagesDP; ?>">Last</a></li>
        </ul>

    </table>


</div>


<div>
    <div id="add_Dept_Modal" class="modal ">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"> Department Details</h4>
                </div>
                <div class="modal-body">
                    <form method="post" id="insert_formDP">
                        <label>Enter Department Code</label>
                        <input type="text" name="Department_code" id="Department_code" class="form-control"/>
                        <br/>
                        <label>Enter Name</label>
                        <input type="text" name="Name_DP" id="Name_DP" class="form-control">
                        <br/>
                        <label>Enter the ID of the head </label>
                        <input type="text" name="Head_professor_id" id="Head_professor_id" class="form-control"/>
                        <input type="hidden" name="Department_codeU" id="Department_codeU"/>
                        <input type="submit" name="insert" id="insertDP" value="Insert" class="btn btn-success"/>
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

<script type="text/javascript" src="../Departmetnt/departtment.js"></script>
<script>
    var role='<?php echo  $_SESSION['role'];?>';
    if( role === "Student" || role === "Professor" ) {
        $("#editDeptcol").css("display", "none");
        $(document.getElementsByClassName("editDeptData")).css("display", "none")
        $("#addDeptData").css("display", "none")

    };
</script>
