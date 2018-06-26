

$(document).ready(function () {
    $('#addBookDetailsData').click(function () {
        $('#insertBD').val("Insert");
        $('#insert_formBD')[0].reset();
        console.log("thth");

    });
    $('#addAuthoredBookDetailsData').click(function () {
        $('#insertBD').val("Insert");
        $('#insert_formBD')[0].reset();
        console.log("thth");

    });
    $(document).on('click', '.edit_dataBD', function () {
        console.log("thth");
        var ISBN = $(this).attr("id");
        $.ajax({
            url: "../Book/Details/fetchBookDetails.php",
            method: "POST",
            data: {ISBN: ISBN},
            dataType: "json",
            success: function (data) {

                $('#ISBN_BD').val(data.ISBN);
                $('#ISBN').val(data.ISBN);
                $('#Name_BD').val(data.Name);
                $('#Year').val(data.Year);
                $('#Publisher').val(data.Publisher);
                $('#Emp_idPF').val(data.Author);
                $('#insertBD').val("Update");
                $('#add_BookDetails_Modal').modal('show');
            }
                    });
    });

    $('#insert_formBD').on("submit", function (event) {
        event.preventDefault();
        $.ajax({
                url: "../Book/Details/insertBookDetails.php",
                method: "POST",
                data: $('#insert_formBD').serialize(),
                beforeSend: function () {
                    $('#insertBD').val("Inserting");
                },
                success: function (data) {
                    $('#insert_formBD')[0].reset();
                    $('#add_BookDetails_Modal').modal('hide');
                    // $('#BookDetails').html(data);
                    $('#AuthoredBookDetails').html(data);
                }
            });

    });

});
