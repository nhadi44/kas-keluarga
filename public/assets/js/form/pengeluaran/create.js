let formPengeluaran = $("#form-tambah-data-pengeluaran");

formPengeluaran.submit(function (e) {
    e.preventDefault();
    let data = {
        _token: $('meta[name="csrf-token"]').attr("content"),
        kategori_pengeluaran: $("#kategori_pengeluaran").val(),
        tanggal_pengeluaran: $("#tanggal_pengeluaran").val(),
        deskripsi_pengeluaran: $("#deskripsi_pengeluaran").val(),
        jumlah_pengeluaran: $("#jumlah_pengeluaran").val(),
        metode_pengeluaran: $("#metode_pengeluaran").val(),
    };

    data.jumlah_pengeluaran = data.jumlah_pengeluaran.replace(/[^0-9]/g, "");

    $.ajax({
        url: "/dashboard/pengeluaran/store",
        method: "POST",
        data: data,
        dataType: "json",

        beforeSend: function () {
            $("#modal-tambah-data-pengeluaran")
                .find("#simpan")
                .html('<i class="fas fa-spinner fa-spin"></i>')
                .attr("disabled", true);

            $("#modal-tambah-data-pengeluaran")
                .find("#batal")
                .attr("disabled", true);
        },

        success: function (res) {
            Swal.fire({
                title: "Berhasil!",
                text: "Data berhasil ditambahkan.",
                icon: "success",
                confirmButtonText: "OK",
            });
            $("#table-data-pengeluaran").DataTable().ajax.reload();
            $("#modal-tambah-data-pengeluaran").modal("hide");

            refreshSaldo(
                "/dashboard/pengeluaran/get-saldo-by-user-id",
                res.data.saldo.user_id
            );
        },

        error: function (err) {
            Swal.fire({
                title: "Gagal!",
                text: "Data gagal ditambahkan.",
                icon: "error",
                confirmButtonText: "OK",
            });
        },

        complete: function () {
            $("#modal-tambah-data-pengeluaran")
                .find("#simpan")
                .html("Simpan")
                .attr("disabled", false);

            $("#modal-tambah-data-pengeluaran")
                .find("#batal")
                .attr("disabled", false);
        },
    });
});
