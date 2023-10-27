let formDeletePemasukan = $("#form-hapus-data-keuangan");

formDeletePemasukan.on("submit", function (e) {
    e.preventDefault();
    let data = {
        _token: $('meta[name="csrf-token"]').attr("content"),
        id: formDeletePemasukan.find("#deleteId").val(),
    };

    $.ajax({
        url: "/dashboard/pemasukan/delete",
        method: "POST",
        data: data,
        dataType: "JSON",

        beforeSend: function () {
            $("#modal-delete-data-keuangan")
                .find("#hapus")
                .html('<i class="fas fa-spinner fa-spin"></i>')
                .attr("disabled", true);

            $("#modal-delete-data-keuangan")
                .find("#batalkan")
                .attr("disabled", true);
        },

        success: function (res) {
            Swal.fire({
                title: "Berhasil!",
                text: "Data berhasil dihapus.",
                icon: "success",
                confirmButtonText: "OK",
            });

            $("#table-manajemen-keuangan").DataTable().ajax.reload();
            $("#modal-delete-data-keuangan").modal("hide");

            refreshSaldo(
                "/dashboard/pemasukan/get-saldo-by-user-id",
                res.data.saldo.user_id
            );
        },

        error: function (err) {
            Swal.fire({
                title: "Error",
                text: "Data gagal dihapus.",
                icon: "error",
                confirmButtonText: "OK",
            });
        },

        complete: function () {
            $("#modal-delete-data-keuangan")
                .find("#hapus")
                .html("Hapus")
                .attr("disabled", false);

            $("#modal-delete-data-keuangan")
                .find("#batalkan")
                .attr("disabled", false);
        },
    });
});
