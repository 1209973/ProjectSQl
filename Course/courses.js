

$(document).ready(function () {
    $('#addCourseData').click(function () {
        $('#insertC').val("Insert");
        $('#insert_formC')[0].reset();

    });
    $(document).on('click', '.edit_dataC', function () {
        var Course_id = $(this).attr("id");

        $.ajax({
            url: "../Course/fetchCourse.php",
            method: "POST",
            data: {Course_id: Course_id},
            dataType: "json",
            success: function (data) {

                $('#Course_id').val(data.Course_id);
                $('#Course_name').val(data.Course_name);
                $('#Credit_hours').val(data.Credit_hours);
                $('#Prerequisites_code').val(data.Prerequisites_code);
                $('#Department_code').val(data.Department_code);
                $('#College').val(data.College);
                $('#insertC').val("Update");
                $('#add_Course_Modal').modal('show');
            }
//
        });
    });
    $('#insert_formC').on("submit", function (event) {
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
                data: $('#insert_formC').serialize(),
                beforeSend: function () {
                    $('#insert').val("Inserting");
                },
                success: function (data) {
                    $('#insert_formC')[0].reset();
                    $('#add_data_Modal').modal('hide');
                    $('#employee_table').html(data);
                }
            });

        }

    });
    $(document).on('click', '.view_dataC', function () {

        var Course_id = $(this).attr("id");
        if (Course_id != '') {
            $.ajax({
                url: "../Course/viewLabSession.php",
                method: "POST",
                data: {Course_id: Course_id},
                success: function (data) {
                    $('#session_detail').html(data);
                    $('#session_lab_ViewModal').modal('show');
                }
            });
        }

    });
});

