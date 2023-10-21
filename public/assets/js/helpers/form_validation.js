const validation = (field, isEmail) => {
    field.on("keyup", function () {
        let data = $(this).val();
        let regexEmail = /\S+@\S+\.\S+/;
        let count = data.length;

        if (isEmail) {
            if (count <= 0) {
                field.addClass("is-invalid");
            } else if (!regexEmail.test(data)) {
                field.addClass("is-invalid");
            } else {
                field.removeClass("is-invalid");
                field.addClass("is-valid");
            }
        }

        if (!isEmail) {
            if (count <= 0) {
                field.addClass("is-invalid");
            } else {
                field.removeClass("is-invalid");
                field.addClass("is-valid");
            }
        }
    });
};

const passwordValidation = (field) => {
    field.on("keyup", function () {
        let data = $(this).val();
        let count = data.length;

        if (count <= 0) {
            field.addClass("is-invalid");
        } else if (count < 8) {
            field.addClass("is-invalid");
        } else {
            field.removeClass("is-invalid");
            field.addClass("is-valid");
        }
    });
};

const passwordConfirmValidation = (field, firstPassword) => {
    field.on("keyup", function () {
        let data = $(this).val();

        if (data !== firstPassword.val()) {
            field.addClass("is-invalid");
        } else {
            field.removeClass("is-invalid");
            field.addClass("is-valid");
        }
    });
};

export { validation, passwordValidation, passwordConfirmValidation };
