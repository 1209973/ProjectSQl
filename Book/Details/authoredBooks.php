<?php
if (isset($_GET['pagenoAB'])) {
    $pagenoAB = $_GET['pagenoAB'];
} else {
    $pagenoAB = 1;
}
$no_of_records_per_page = 5;
$offsetAB = ($pagenoAB - 1) * $no_of_records_per_page;
$total_rowsAB = mysqli_fetch_array($mysqli->query("select * from course WHERE Course_id ='ST18001'"));[0];
$total_pagesAB = ceil($total_rowsAB   / $no_of_records_per_page);
$res_dataAB=$mysqli->query("select * from book LIMIT $offset, $no_of_records_per_page");
?>

<div style="border-bottom: #000 solid .05px;">
    <h2> AUTHORED <button type="button" name="add" id="addAuthoredBookDetailsData" data-toggle="modal" data-target="#add_BookDetails_Modal" class="btn btn-warning" style="float: right">Add</button></h2>

</div>
<div id='AuthoredBookDetails'>
    <table width="100%" border=0 style="text-align: center">
        <tr bgcolor="#CCCCCC" style="height: 40px;font-weight: 600;">
            <td>ISBN</td>
            <td>Name</td>
            <td>Year</td>
            <td>Publisher </td>
            <td id="editAuthoredBookDetailscol">Edit</td>
        </tr>
        <?php

        $authoredBookDetails= '';
        while ($rowAB = mysqli_fetch_array($res_dataAB )) {
            $authoredBookDetails .= ' <tr>
                        <td> '. $rowAB["ISBN"] . '</td>
                         <td> '. $rowAB["Name"] .' </td>
                        <td> '. $rowAB["Year"] . '</td>
                        <td> '. $rowAB["Publisher"] .' </td>
                        <td class="editAuthoredBookDetailsData">
                        <input type="button" name="edit" value="Edit" id="' . $rowAB["ISBN"] . '" class="btn btn-info btn-xs edit_dataBD">
                        <input type="button" name="delete" value="Delete"  class="btn btn-danger btn-xs edit_dataB"></td> 
                        </tr>
                       

                        ';
        }
        echo   $authoredBookDetails;
        ?>
        <ul class="pagination" style="float: right">
            <li><a href="?pageno=1">First</a></li>
            <li class=
                <?php if ($pagenoAB <= 1) {
                    echo "disabled";
                } ?>">
                            <a href="<?php if ($pagenoAB <= 1) {
                echo "#";
            } else {
                echo "?pagenoAB=" . ($pagenoAB - 1);
            } ?>">Prev</a>
            </li>
            <li class="<?php if ($pagenoAB >= $total_pagesAB) {
                echo "disabled";
            } ?>">
                <a href="<?php if ($pagenoAB >= $total_pagesAB) {
                    echo "#";
                } else {
                    echo "?pagenoAB=" . ($pagenoAB + 1);
                } ?>">Next</a>
            </li>
            <li><a href="?pageno=<?php echo $total_pagesAB; ?>">Last</a></li>
        </ul>

    </table>

</div>

<script type="text/javascript" src="../Book/Details/bookDetails.js"></script>
<script>
    var role='<?php echo  $_SESSION['role'];?>';
    if( role == "Student"  ) {
        $("#editAuthoredBookDetailsData").css("display", "none");
        $(document.getElementsByClassName("editAuthoredBookDetailsData")).css("display", "none")
        $("#addBookDetailsData").css("display", "none")

    };
</script>
