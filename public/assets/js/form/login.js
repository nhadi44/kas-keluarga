import { passwordValidation, validation } from "../helpers/form_validation.js";

let form = $("#login_form");
let username = form.find("#username");
let password = form.find("#password");
let count = 60;

$("#countdown").html(count);
validation(username, false);
passwordValidation(password);

form.submit(function (e) {
    e.preventDefault();
    let data = $(this).serialize();
    $.ajax({
        url: "/login",
        method: "POST",
        data: data,
        dataType: "json",

        beforeSend: function () {
            form.find("#btn_login")
                .html('<i class="fas fa-spinner fa-spin"></i>')
                .attr("disabled", true);
        },

        success: function (res) {
            Swal.fire({
                title: "Success!",
                text: res.message,
                icon: "success",
                confirmButtonText: "OK",
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "/dashboard";
                }
            });
        },

        error: function (err) {
            let status_code = err.responseJSON.status_code;

            if (status_code >= 400) {
                Swal.fire({
                    title: "Error!",
                    text: err.responseJSON.message,
                    icon: "error",
                    confirmButtonText: "OK",
                });

                username.addClass("is-invalid");
                password.addClass("is-invalid");
            }

            if (err.status === 429) {
                Swal.fire({
                    icon: "error",
                    text: "Terlalu banyak aksi",
                    showConfirmButton: false,
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                    html: ` 
                            <h5>Anda terlalu banyak melakukan aksi</h5>
                            <p>Silahkan coba lagi dalam waktu</p>
                            <p id="countdown"></p>detik
                          `,
                });

                setInterval(countDown, 1000);
            }
        },

        complete: function () {
            form.find("#btn_login").html("Masuk").attr("disabled", false);
        },
    });
});

// 1 menit
function countDown() {
    if (count > 0) {
        count--;
        console.log(count);
        $("#countdown").html(count);
    } else {
        window.location.reload();
    }
}
