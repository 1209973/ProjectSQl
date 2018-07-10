<?php
if (isset($_GET['pagenoAB'])) {
    $pagenoB = $_GET['pagenoAB'];
} else {
    $pagenoB = 1;
}
$no_of_records_per_page = 5;
$offsetB = ($pagenoB - 1) * $no_of_records_per_page;
$res_dataBookDetails=$mysqli->query("select * from book LIMIT $offset, $no_of_records_per_page");
if( $_SESSION['role']=='Student'){
    $total_rowsB  =  mysqli_num_rows($mysqli->query("SELECT borrow.ISBN,name,Borrow_Date FROM book,borrow WHERE book.isbn=borrow.isbn AND status=0 AND student_id ='{$_SESSION['ID']}'"));
    $total_pagesB = ceil($total_rowsB   / $no_of_records_per_page);
    $res_dataB = $mysqli->query("SELECT borrow.ISBN,name,Borrow_Date FROM book,borrow WHERE book.isbn=borrow.isbn AND status=0 AND student_id ='{$_SESSION['ID']}' LIMIT $offset, $no_of_records_per_page");

}
if( $_SESSION['role']=='Professor'){

    $total_rowsG = mysqli_num_rows($mysqli->query("SELECT student.student_id,Grade,Year,Semester,Course_code,name FROM student,student_section, section WHERE student.student_id=student_section.student_id AND section.section_no=student_section.section_no AND section.course_code=student_section.course_code AND section.year=student_section.year AND section.semester=student_section.semester AND prof_id='PF12346'"));[0];
    $total_pagesG = ceil($total_rowsG/ $no_of_records_per_page);
    $res_dataG = $mysqli->query("select * from student_section WHERE Student_id ='ST18002' LIMIT $offset, $no_of_records_per_page");
}
if( $_SESSION['role']=='Admin'){
    $total_rowsB = mysqli_num_rows($mysqli->query("SELECT borrow.ISBN,name,Borrow_Date,Return_Date,Student_id FROM book,borrow WHERE book.isbn=borrow.isbn "));
    $total_pagesB = ceil($total_rowsB   / $no_of_records_per_page);
    $res_dataB = $mysqli->query("SELECT borrow.ISBN,name,Borrow_Date,Return_Date,Student_id FROM book,borrow WHERE book.isbn=borrow.isbn  LIMIT $offset, $no_of_records_per_page");

}

if($_SESSION['role']== "Student"){

    $borrowedBook='

            <div style="border-bottom: #000 solid .05px;">
                <h2>BORROWED DETAILS </h2>
            
            </div>
            
            
            <div>
                <table width="100%" border=0 style="text-align: center">
                    <tr bgcolor="#CCCCCC" style="height: 40px;font-weight: 600;">
                        <td>ISBN</td>
                        <td>Book Name</td>
                        <td>Borrow Date</td>
                    </tr>
                    ';


        while ($rowB = mysqli_fetch_array($res_dataB )) {
            $borrowedBook .= ' <tr>
                        <td> '. $rowB["ISBN"] . '</td>
                         <td> '. $rowB["name"] .' </td>
                        <td> '. $rowB["Borrow_Date"] . '</td>
                        </tr>
                      ';
        }

$borrowedBook.=' </table>
    </div>';
echo  $borrowedBook;

}

if($_SESSION['role']=="Admin"){
    $book='<div style="border-bottom: #000 solid .05px;">
    <h2>BORROWED DETAILS  <button type="button" name="add" id="addBookData" data-toggle="modal" data-target="#add_Book_Modal" class="btn btn-warning" style="float: right">Add</button></h2>

</div>


<div id="Borrow">
    <table width="100%" border=0 style="text-align: center">
        <tr bgcolor="#CCCCCC" style="height: 40px;font-weight: 600;">
            <td>ISBN</td>
            <td>Student ID</td>
            <td>Borrow Date</td>
            <td>Returned Date </td>
            <td id="editBookcol">Edit</td>
        </tr>
        
';

        while ($rowB = mysqli_fetch_array($res_dataB )) {
            $book .= ' <tr>
                        <td> '. $rowB["ISBN"] . '</td>
                        <td> '. $rowB["Student_id"] .' </td>
                         <td> '. $rowB["Borrow_Date"] .' </td>
                        <td> '. $rowB["Return_Date"] . '</td>
                        <td class="editBookData">
                        <input type="button" name="edit" value="Edit" id="' . $rowB["ISBN"] . '" class="btn btn-info btn-xs edit_dataB">
                         <input type="button" name="delete" value="Delete"  class="btn btn-danger btn-xs edit_dataB"></td> 
                        </tr>
                       

                        ';
        }
    $book.=' </table>
    </div>';

        echo  $book;


}
?>
<!--<ul class="pagination" style="float: right">-->
<!--            <li><a href="?pageno=1">First</a></li>-->
<!--            <li class=-->
<!--                --><?php //if ($pagenoB <= 1) {
//                    echo "disabled";
//                } ?><!--">-->
<!--                            <a href="--><?php //if ($pagenoB <= 1) {
//                echo "#";
//            } else {
//                echo "?pagenoAB=" . ($pagenoB - 1);
//            } ?><!--">Prev</a>-->
<!--            </li>-->
<!--            <li class="--><?php //if ($pagenoC >= $total_pagesB) {
//                echo "disabled";
//            } ?><!--">-->
<!--                <a href="--><?php //if ($pagenoB >= $total_pagesB) {
//                    echo "#";
//                } else {
//                    echo "?pagenoAB=" . ($pagenoB + 1);
//                } ?><!--">Next</a>-->
<!--            </li>-->
<!--            <li><a href="?pageno=--><?php //echo $total_pagesB; ?><!--">Last</a></li>-->
<!--        </ul>-->

<div>
    <div id="add_Book_Modal" class="modal ">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"> Borrow Details</h4>
                </div>
                <div class="modal-body">
                    <form method="post" id="insert_formB">
                        <label>Enter ISBN</label>
                        <input type="text" name="ISBN_B" id="ISBN_B" class="form-control"/>
                        <br/>
                        <label>Enter Student ID</label>
                        <input type="text" name="Student_id" id="Student_id_B" class="form-control">
                        <br/>
                        <label>Date of Borrow</label>
                        <input type="date" name="Borrow_Date" id="Borrow_Date" class="form-control"/>
                        <br/>
                        <label>Date of Return</label>
                        <input type="date" name="Return_Date" id="Return_Date" class="form-control"/>
                        <br/>
                        <input type="hidden" name="ISBNU" id="ISBNU"/>
                        <input type="submit" name="insert" id="insertB" value="Insert" class="btn btn-success"/>
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

<script type="text/javascript" src="../Book/Borrow/books.js"></script>
<script>
    var role='<?php echo  $_SESSION['role'];?>';
    if( role === "Student" || role === "Professor" ) {
        $("#editBookcol").css("display", "none");
        $(document.getElementsByClassName("editBookData")).css("display", "none")
        $("#addBookData").css("display", "none")

    };
</script>
