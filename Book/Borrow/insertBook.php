<?php
require_once '../../config.php';
//echo $_POST["ISBN"];
if(!empty($_POST))
{
    $output = '';
    $message = '';
    $ISBN = mysqli_real_escape_string($mysqli, $_POST["ISBN_B"]);
    $Name = mysqli_real_escape_string($mysqli, $_POST["Student_id"]);
    $Borrow_Date= mysqli_real_escape_string($mysqli, $_POST["Borrow_Date"]);
    $Return_Date=mysqli_real_escape_string($mysqli, $_POST["Return_Date"]);


    if($_POST["ISBNU"] != '')
    {
        $query = " UPDATE borrow SET ISBN='$ISBN',Student_id='$Name', Borrow_Date='$Borrow_Date',Return_Date='$Return_Date'  WHERE ISBN='ISBNU' AND Student_id='$Name'";
        $message = 'Data Updated';

    }
    else
    {
        $query = "INSERT INTO borrow (ISBN,Student_id,Borrow_Date,Return_Date) VALUES('$ISBN','$Name','$Borrow_Date','$Return_Date')";
        $message = 'Data Inserted';
    }
    if($mysqli-> query($query))
    {   
        $output .= '<label class="text-success">' . $message . '</label>';
        $res_dataCS = $mysqli->query("SELECT borrow.ISBN,name,Borrow_Date,Return_Date,Student_id FROM book,borrow WHERE book.isbn=borrow.isbn  ");
        $book = '
                <table width="100%" border=0 style="text-align: center">
        <tr bgcolor="#CCCCCC" style="height: 40px;font-weight: 600;">
            <td>ISBN</td>
            <td>Student ID</td>
            <td>Borrow Date</td>
            <td>Returned Date </td>
            <td id="editBookcol">Edit</td>
        </tr>
           ';
        while ($rowB = mysqli_fetch_array($res_dataCS )) {
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

    }
    echo  $book;
}
?>