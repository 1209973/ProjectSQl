

$(document).ready(function () {
    // company Session
    $('#addCompSecData').click(function () {
        $('#insertCS').val("Insert");
        $('#insert_formCS')[0].reset();

    });
    $(document).on('click', '.edit_dataCS', function () {
        var CSession_no = $(this).attr("id");

        $.ajax({
            url: "../Company_session/fetchCompSes.php",
            method: "POST",
            data: {CSession_no: CSession_no},
            dataType: "json",
            success: function (data) {

                $('#CSession_noCS').val(data.CSession_no);
                $('#CSession_no').val(data.CSession_no);
                $('#Session_Manager').val(data.Session_Manager);
                $('#Semester_CS').val(data.Semester);
                $('#Year_CS').val(data.Year);
                $('#insertCS').val("Update");
                $('#add_CompSec_Modal').modal('show');
            }
//
        });
    });
    $(document).on('click', '.del_dataC', function () {
        var  CSession_no= $(this).attr("id");
        console.log("thth");
        $.ajax({
            url: "../Company_session/deleteCompSes.php",
            method: "POST",
            data: {CSession_no: CSession_no},

            success: function (data) {
                $('#companySessions_students').html(data);

            }
//
        });
    });
    $('#insert_formCS').on("submit", function (event) {
        event.preventDefault();

        // var  CSession_no= $(this).attr("id");
            $.ajax({
                url: "../Company_session/insertCompSes.php",
                method: "POST",
                // data: {CSession_no:CSession_no},
                data: $('#insert_formCS').serialize(),
                beforeSend: function () {
                    $('#insertCS').val("Inserting");
                },
                success: function (data) {
                    $('#insert_formCS')[0].reset();
                    $('#add_CompSec_Modal').modal('hide');
                    $('#companySessions').html(data);
                }
            });

    });
// company Session Student
    $('#add_CompSec_Stu_Modal').click(function () {
        $('#insertCSS').val("Insert");
        $('#insert_formCSS')[0].reset();

    });
    $(document).on('click', '.edit_dataCSS', function () {
        var CSession_no = $(this).attr("id");

        console.log("hhtht");
        $.ajax({
            url: "../Company_session/fetchCompSesStu.php",
            method: "POST",
            data: {CSession_no: CSession_no,
                    Student_id: $("#student_idCSS").val},
            dataType: "json",
            success: function (data) {

                $('#CSession_noCS').val(data.CSession_no);
                $('#CSession_no').val(data.CSession_no);
                $('#student_idCSS').val(data.Student_id);
                $('#company_assesment').val(data.company_assesment);
                $('#company_name').val(data.company_name);
                $('#insertCSS').val("Update");
                $('#add_CompSec_Stu_Modal').modal('show');
            }
//
        });
    });
    $('#insert_formCS').on("submit", function (event) {
        event.preventDefault();


        $.ajax({
            url: "../Company_session/insertCompSes.php",
            method: "POST",
            data: $('#insert_formCSS').serialize(),
            beforeSend: function () {
                $('#insertCSS').val("Inserting");
            },
            success: function (data) {
                $('#insert_formCSS')[0].reset();
                $('#add_CompSec_Stu_Modal').modal('hide');
                $('#companySessions_students').html(data);
            }
        });

    });

});
