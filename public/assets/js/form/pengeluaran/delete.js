let formPengeluaranDelete = $("#form-delete-data-pengeluaran");

formPengeluaranDelete.submit(function (e) {
    e.preventDefault();
    let data = {
        _token: $('meta[name="csrf-token"]').attr("content"),
        id: formPengeluaranDelete.find("#pengeluaran_id").val(),
    };

    $.ajax({
        url: "/dashboard/pengeluaran/delete",
        method: "POST",
        data: data,
        dataType: "json",

        success: function (res) {
            Swal.fire({
                title: "Berhasil!",
                text: "Data berhasil dihapus.",
                icon: "success",
                confirmButtonText: "OK",
            });
            $("#table-data-pengeluaran").DataTable().ajax.reload();
            $("#modal-delete-data-pengeluaran").modal("hide");

            refreshSaldo(
                "/dashboard/pengeluaran/get-saldo-by-user-id",
                res.data.saldo.user_id
            );
        },

        error: function (err) {
            console.log(err);
        },
    });
});
