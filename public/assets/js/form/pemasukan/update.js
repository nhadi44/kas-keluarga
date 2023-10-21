let updateForm = $("#form-edit-data-keuangan");

updateForm.on("submit", function (e) {
    e.preventDefault();
    let data = {
        _token: $('meta[name="csrf-token"]').attr("content"),
        id: updateForm.find("#updateId").val(),
        sumber_pemasukan: updateForm.find("#sumber_pemasukan").val(),
        tanggal_pemasukan: updateForm.find("#tanggal_pemasukan").val(),
        nominal_pemasukan: updateForm.find("#nominal_pemasukan_update").val(),
    };

    data.nominal_pemasukan = data.nominal_pemasukan.replace(/[^0-9]/g, "");

    $.ajax({
        url: "/dashboard/pemasukan/update",
        method: "POST",
        data: data,
        dataType: "JSON",
        beforeSend: function () {
            $("#modal-edit-data-keuangan")
                .find("#simpan")
                .html('<i class="fas fa-spinner fa-spin"></i>')
                .attr("disabled", true);

            $("#modal-edit-data-keuangan")
                .find("#batal")
                .attr("disabled", true);
        },
        success: function (res) {
            Swal.fire({
                title: "Berhasil!",
                text: "Data berhasil diupdate.",
                icon: "success",
                confirmButtonText: "OK",
            });

            $("#table-manajemen-keuangan").DataTable().ajax.reload();
            $("#modal-edit-data-keuangan").modal("hide");
        },

        error: function (res) {
            Swal.fire({
                title: "Error",
                text: "Data gagal diupdate.",
                icon: "error",
                confirmButtonText: "OK",
            });
        },

        complete: function () {
            $("#modal-edit-data-keuangan")
                .find("#simpan")
                .html("Simpan")
                .attr("disabled", false);

            $("#modal-edit-data-keuangan")
                .find("#batal")
                .attr("disabled", false);
        },
    });
});
