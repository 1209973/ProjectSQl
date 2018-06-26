

$(document).ready(function () {
    $('#add').click(function () {
        $('#insertPF').val("Insert");
        $('#insert_formPF')[0].reset();

    });
    $(document).on('click', '.edit_dataPF', function () {
        var  Emp_id= $(this).attr("id");

        $.ajax({
            url: "fetch.php",
            method: "POST",
            data: {Emp_id: Emp_id},
            dataType: "json",
            success: function (data) {

                $('#Emp_idU').val(data.Emp_id);
                $('#NamePF').val(data.Name);
                $('#Office').val(data.Office);
                $('#Phone').val(data.Phone);
                $('#Department_codePF').val(data.Department_code);
                $('#insertPF').val("Update");
                $('#insertPF').val("Update");
                $('#add_Profdata_Modal').modal('show');
            }
//
        });
    });
    $('#insert_formPF').on("submit", function (event) {
        event.preventDefault();
        console.log("theh")
        $.ajax({
                url: "insertProfessor.php",
                method: "POST",
                data: $('#insert_formPF').serialize(),
                beforeSend: function () {
                    $('#insertPF').val("Inserting");
                },
                success: function (data) {
                    $('#insert_formPF')[0].reset();
                    $('#add_Profdata_Modal').modal('hide');
                    $('#profDetails').html(data);
                }
            });

    });

});
