<?php
require_once '../../config.php';


if(!empty($_POST))
{
    $output = '';
    $message = '';
    $ISBN = mysqli_real_escape_string($mysqli, $_POST["ISBN"]);
    $Name = mysqli_real_escape_string($mysqli, $_POST["Name_BD"]);
    $Year= mysqli_real_escape_string($mysqli, $_POST["Year"]);
    $Publisher=mysqli_real_escape_string($mysqli, $_POST["Publisher"]);
    $Author =mysqli_real_escape_string($mysqli, $_POST["Emp_idPF"]);


    if($_POST["ISBN"] != '')
    {
        $query = " UPDATE book SET isbn='$ISBN',name='$Name', year='$Year' ,publisher='$Publisher' WHERE isbn='".$_POST["ISBN"]."'";
        $message = 'Data Updated';
    }
    else
    {
        $query = "INSERT INTO book VALUES('$ISBN','$Name',$Year,'$Publisher')";
        $message = 'Data Inserted';
    }
    if($mysqli-> query($query))
    {
//        $output .= '<label class="text-success">' . $message . '</label>';
        $res_dataBD =$mysqli->query("select * from book ");
        $bookDetails = '
                <table width="100%" border=0 style="text-align: center">
        <tr bgcolor="#CCCCCC" style="height: 40px;font-weight: 600;">
            <td>ISBN</td>
            <td>Name</td>
            <td>Year</td>
            <td>Publisher </td>
            <td id="editBookDetailscol">Edit</td>
        </tr>
           ';
        while ($rowBD = mysqli_fetch_array($res_dataBD )) {
        $bookDetails .= ' <tr>
                        <td> '. $rowBD["ISBN"] . '</td>
                         <td> '. $rowBD["Name"] .' </td>
                        <td> '. $rowBD["Year"] . '</td>
                        <td> '. $rowBD["Publisher"] .' </td>
                        <td class="editBookDetailsData">
                        <input type="button" name="edit" value="Edit" id="' . $rowBD["ISBN"] . '" class="btn btn-info btn-xs edit_dataBD"></td>
                        </tr>
                       

                        ';
        }

    }
    echo  $bookDetails;
}
?>