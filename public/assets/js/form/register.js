import showToas from "../helpers/toast.js";
import {
    validation,
    passwordValidation,
    passwordConfirmValidation,
} from "../helpers/form_validation.js";

let form = $("#register_form");
let email = form.find("#email");
let username = form.find("#username");
let password = form.find("#password");
let password_confirmation = form.find("#password_confirm");

// validation email
validation(email, true);
// usernameValidation
validation(username, false);
// passwordValidation
passwordValidation(password);
// passwordConfirmValidation
passwordConfirmValidation(password_confirmation, password);

form.submit(function (e) {
    e.preventDefault();
    let data = $(this).serialize();

    $.ajax({
        url: "/register",
        method: "POST",
        data: data,
        dataType: "json",

        beforeSend: function () {
            $("#btn_register")
                .html('<i class="fas fa-spinner fa-spin"></i>')
                .attr("disabled", true);
        },

        success: function (res) {
            if (res.status === "success") {
                Swal.fire({
                    title: "Success!",
                    text: res.message,
                    icon: "success",
                    confirmButtonText: "Kembali ke halaman login",
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = "/login";
                    }
                });
            }
        },

        error: function (err) {
            let errMessage = err.responseJSON.message;

            errMessage.email ? email.addClass("is-invalid") : "";
            errMessage.username ? username.addClass("is-invalid") : "";
            errMessage.password ? password.addClass("is-invalid") : "";
            errMessage.password_confirm
                ? password_confirmation.addClass("is-invalid")
                : "";

            Swal.fire({
                title: "Error!",
                text: errMessage,
                icon: "error",
                confirmButtonText: "Coba lagi",
            });
        },

        complete: {
            complete: function () {
                $("#btn_register").html("Daftar").attr("disabled", false);
            },
        },
    });
});
