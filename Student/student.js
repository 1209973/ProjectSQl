

$(document).ready(function () {
    $('#add').click(function () {
        $('#insertST').val("Insert");
        $('#insert_formST')[0].reset();

    });
    $(document).on('click', '.edit_dataST', function () {
        var  Student_id= $(this).attr("id");

        $.ajax({
            url: "fetch.php",
            method: "POST",
            data: {Student_id: Student_id},
            dataType: "json",
            success: function (data) {

                $('#Student_idST').val(data.Student_id);
                $('#NameST').val(data.Name);
                $('#AddressST').val(data.Address);
                $('#Status').val(data.Status);
                $('#Major').val(data.Major);
                $('#Thesisopt').val(data.Thesisopt);
                $('#insertST').val("Update");
                $('#add_Studentdata_Modal').modal('show');
            }
//
        });
    });
    $('#insert_formST').on("submit", function (event) {
        event.preventDefault();
        console.log("theh")
        $.ajax({
                url: "insertStudent.php",
                method: "POST",
                data: $('#insert_formST').serialize(),
                beforeSend: function () {
                    $('#insertST').val("Inserting");
                },
                success: function (data) {
                    $('#insert_formST')[0].reset();
                    $('#add_Studentdata_Modal').modal('hide');
                    $('#StudentDetails').html(data);
                }
            });

    });

});
