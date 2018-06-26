

$(document).ready(function () {
    $('#addGradeData').click(function () {
        $('#insertG').val("Insert");
        $('#insert_formG')[0].reset();

    });
    $(document).on('click', '.edit_dataG', function () {
        var ID = $(this).attr("id");

        $.ajax({
            url: "../Course/fetchGrades.php",
            method: "POST",
            data: {ID: ID},
            dataType: "json",
            success: function (data) {

                $('#Section_no').val(data.Section_no);
                $('#Student_id').val(data.Student_id);
                $('#Grade').val(data.Grade);
                $('#ID').val(data.ID);
               $('#insertG').val("Update");
                $('#add_grades_Modal').modal('show');
            }
//
        });
    });
    $('#insert_form').on("submit", function (event) {
        event.preventDefault();
        if ($('#name').val() == "") {
            alert("Name is required");
        }
        else if ($('#address').val() == '') {
            alert("Address is required");
        }
        else if ($('#Status').val() == '') {
            alert("Status is required");
        }

        else {

            $.ajax({
                url: "..Course/insertGrades.php",
                method: "POST",
                data: $('#insert_form').serialize(),
                beforeSend: function () {
                    $('#insert').val("Inserting");
                },
                success: function (data) {
                    $('#insert_form')[0].reset();
                    $('#add_data_Modal').modal('hide');
                    $('#employee_table').html(data);
                }
            });
        }
    });

});
