<?php
if (isset($_GET['pagenoAB'])) {
    $pagenoBD = $_GET['pagenoAB'];
} else {
    $pagenoBD = 1;
}
$no_of_records_per_page = 5;
$offsetBD = ($pagenoBD - 1) * $no_of_records_per_page;
$total_rowsBD = mysqli_num_rows($mysqli->query("select * from book "));
$total_pagesBD = ceil($total_rowsBD   / $no_of_records_per_page);
$res_dataBD=$mysqli->query("select * from book LIMIT $offset, $no_of_records_per_page");
?>

<div style="border-bottom: #000 solid .05px;">
    <h2> DETAILS  OF BOOKS AVAILABLE  <button type="button" name="add" id="addBookDetailsData" data-toggle="modal" data-target="#add_BookDetails_Modal" class="btn btn-warning" style="float: right">Add</button></h2>

</div>
<div id="BookDetails">
    <table width="100%" border=0 style="text-align: center">
        <tr bgcolor="#CCCCCC" style="height: 40px;font-weight: 600;">
            <td>ISBN</td>
            <td>Name</td>
            <td>Year</td>
            <td>Publisher </td>
            <td id="editBookDetailscol">Edit</td>
        </tr>
        <?php
        $bookDetails='';

        while ($rowBD = mysqli_fetch_array($res_dataBD )) {

            $bookDetails .= ' <tr>
                        <td> '. $rowBD["ISBN"] . '</td>
                         <td> '. $rowBD["Name"] .' </td>
                        <td> '. $rowBD["Year"] . '</td>
                        <td> '. $rowBD["Publisher"] .' </td>
                        <td class="editBookDetailsData">
                        <input type="button" name="edit" value="Edit" id="' . $rowBD["ISBN"] . '" class="btn btn-info btn-xs edit_dataBD">
                         <input type="button" name="delete" value="Delete"  class="btn btn-danger btn-xs edit_dataB"></td> 
                        </tr>
                       

                        ';
        }
        echo   $bookDetails;
        ?>
        <ul class="pagination" style="float: right">
            <li><a href="?pageno=1">First</a></li>
            <li class=
                <?php if ($pagenoBD <= 1) {
                    echo "disabled";
                } ?>">
                            <a href="<?php if ($pagenoBD <= 1) {
                echo "#";
            } else {
                echo "?pagenoAB=" . ($pagenoBD - 1);
            } ?>">Prev</a>
            </li>
            <li class="<?php if ($pagenoBD >= $total_pagesBD) {
                echo "disabled";
            } ?>">
                <a href="<?php if ($pagenoBD >= $total_pagesBD) {
                    echo "#";
                } else {
                    echo "?pagenoAB=" . ($pagenoBD + 1);
                } ?>">Next</a>
            </li>
            <li><a href="?pageno=<?php echo $total_pagesBD; ?>">Last</a></li>
        </ul>

    </table>
</div>
</div>
<div>
    <div id="add_BookDetails_Modal" class="modal ">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Details</h4>
                </div>
                <div class="modal-body">
                    <form method="post" id="insert_formBD">
                        <label>Enter ISBN</label>
                        <input type="text" name="ISBN_BD" id="ISBN_BD"required class="form-control"/>
                        <br/>
                        <label>Enter Name of the book</label>
                        <input type="text" name="Name_BD" id="Name_BD" required class="form-control">
                        <br/>
                        <label>Year of Publication</label>
                        <input type="text" name="Year" id="Year" required class="form-control"/>
                        <br/>
                        <label>Enter Publisher</label>
                        <input type="text" name="Publisher" id="Publisher" required class="form-control"/>
                        <br/>
                        <?php
                        if($_SESSION['role']=='Professor'){
                            echo '<div style="display: none;">';
                        }
                        else{
                            echo '<div>';
                        }
                        ?>
                            <label>Enter Authored</label>
                            <input type="text" name="Emp_idPF" id="Emp_idPF" class="form-control"/>
                            <br/>
                        </div>
                        <input type="hidden" name="ISBN" id="ISBN"/>
                        <input type="submit" name="insert" id="insertBD" value="Insert" class="btn btn-success"/>
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
<!--</div>-->
<div>
    <div id="add_Book_Modal" class="modal ">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Details</h4>
                </div>
                <div class="modal-body">
                    <form method="post" id="insert_form">
                        <label>Enter ISBN</label>
                        <input type="text" name="ISBN" id="ISBN" class="form-control"/>
                        <br/>
                        <label>Enter Student ID</label>
                        <input type="text" name="Student_id" id="Student_id" class="form-control">
                        <br/>
                        <label>Enter Borrowed Date</label>
                        <input type="date" name="Borrow_Date" id="Borrow_Date" class="form-control"/>
                        <br/>
                        <label>Enter Return Date</label>
                        <input type="date" name="Return_date" id="Return_date" class="form-control"/>
                        <br/>
                        <input type="hidden" name="ISBN" id="ISBN"/>
                        <input type="submit" name="insert" id="insert" value="Insert" class="btn btn-success"/>
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
<script type="text/javascript" src="../Book/Details/bookDetails.js"></script>
<script>
    var role='<?php echo  $_SESSION['role'];?>';
    if( role === "Student" || role === "Professor" ) {
        $("#editBookDetailscol").css("display", "none");
        $(document.getElementsByClassName("editBookDetailsData")).css("display", "none")
        $("#addBookDetailsData").css("display", "none")

    };
</script>
