let formChangePassword = $("#form-change-password");

formChangePassword.submit(function (e) {
    e.preventDefault();
    let data = $(this).serialize();

    $.ajax({
        url: "auth/change-password",
        type: "POST",
        data: data,
        dataType: "JSON",

        success: function (res) {
            Swal.fire({
                icon: "success",
                title: "Success",
                text: res.message,
            });

            $('#modal-change-password').modal('hide');
            formChangePassword[0].reset();
        },

        error: function (err) {
            console.log(err);
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text:
                    typeof err.responseJSON.message === "object"
                        ? err.responseJSON.data
                        : err.responseJSON.message,
            });
        },
    });
});
