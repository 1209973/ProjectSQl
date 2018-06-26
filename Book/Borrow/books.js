

$(document).ready(function () {
    $('#addBookData').click(function () {
        $('#insertB').val("Insert");
        $('#insert_formB')[0].reset();

    });
    $(document).on('click', '.edit_dataB', function () {
        var ISBN = $(this).attr("id");

        $.ajax({
            url: "../Book/Borrow/fetchBook.php",
            method: "POST",
            data: {ISBN: ISBN},
            dataType: "json",
            success: function (data) {
                $('#ISBNU').val(data.ISBN);
                $('#ISBN_B').val(data.ISBN);
                $('#Student_id_B').val(data.Student_id);
                $('#Borrow_Date').val(data.Borrow_Date);
                $('#Return_Date').val(data.Return_Date);
                $('#insertB').val("Update");
                $('#add_Book_Modal').modal('show');
            }
//
        });
    });
    $('#insert_formB').on("submit", function (event) {
        event.preventDefault();

            $.ajax({
                url: "../Book/Borrow/insertBook.php",
                method: "POST",
                data: $('#insert_formB').serialize(),
                beforeSend: function () {
                    $('#insertB').val("Inserting");
                },
                success: function (data) {
                    $('#insert_formB')[0].reset();
                    $('#add_Book_Modal').modal('hide');
                    $('#Borrow').html(data);
                }
            });

    });

});
