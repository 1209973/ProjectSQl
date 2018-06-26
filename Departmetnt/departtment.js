

$(document).ready(function () {
    $('#addDeptData').click(function () {
        $('#insertDP').val("Insert");
        $('#insert_formDP')[0].reset();

    });
    $(document).on('click', '.edit_dataDP', function () {
        var  Department_code= $(this).attr("id");

        $.ajax({
            url: "../Departmetnt/fetchDept.php",
            method: "POST",
            data: {Department_code: Department_code},
            dataType: "json",
            success: function (data) {

                $('#Department_code').val(data.Department_code);
                $('#Department_codeU').val(data.Department_code);
                $('#Name_DP').val(data.Name);
                $('#Head_professor_id').val(data.Head_Proffessor_id);
                $('#insertDP').val("Update");
                $('#add_Dept_Modal').modal('show');
            }
//
        });
    });
    $(document).on('click', '.del_dataDP', function () {
        var  Department_code= $(this).attr("id");
        console.log("thth");
        $.ajax({
            url: "../Departmetnt/deleteDept.php",
            method: "POST",
            data: {Department_code: Department_code},

            success: function (data) {
                $('#department').html(data);

            }
//
        });
    });
    $('#insert_formDP').on("submit", function (event) {
        event.preventDefault();
                    $.ajax({
                url: "../Departmetnt/insertDept.php",
                method: "POST",
                data: $('#insert_formDP').serialize(),
                beforeSend: function () {
                    $('#insertDP').val("Inserting");
                },
                success: function (data) {
                    $('#insert_formDP')[0].reset();
                    $('#add_Dept_Modal').modal('hide');
                    $('#department').html(data);
                }
            });

    });

});
