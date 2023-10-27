let formPengeluaranUpdate = $("#form-update-data-pengeluaran");
let modalPengeluaran = $("#modal-update-data-pengeluaran");

formPengeluaranUpdate.submit(function (e) {
    e.preventDefault();
    let data = {
        _token: $('meta[name="csrf-token"]').attr("content"),
        id: formPengeluaranUpdate.find("#pengeluaran_id").val(),
        user_id: formPengeluaranUpdate.find("#user_id").val(),
        tanggal_pengeluaran: formPengeluaranUpdate
            .find("#tanggal_pengeluaran")
            .val(),
        kategori_pengeluaran: formPengeluaranUpdate
            .find("#kategori_pengeluaran")
            .val(),
        deskripsi_pengeluaran: formPengeluaranUpdate
            .find("#deskripsi_pengeluaran")
            .val(),
        jumlah_pengeluaran: formPengeluaranUpdate
            .find("#jumlah_pengeluaran_update")
            .val(),
        metode_pengeluaran: formPengeluaranUpdate
            .find("#metode_pengeluaran")
            .val(),
    };

    data.jumlah_pengeluaran = data.jumlah_pengeluaran.replace(/[^0-9]/g, "");

    $.ajax({
        url: "/dashboard/pengeluaran/update",
        method: "POST",
        data: data,
        dataType: "json",

        success: function (res) {
            console.log(res);
            Swal.fire({
                title: "Berhasil!",
                text: "Data berhasil diupdate.",
                icon: "success",
                confirmButtonText: "OK",
            });
            $("#table-data-pengeluaran").DataTable().ajax.reload();
            modalPengeluaran.modal("hide");

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
