const form = $("#form-tambah-data-pemasukan");

form.on("submit", function (e) {
    e.preventDefault();
    const data = {
        _token: $('meta[name="csrf-token"]').attr("content"),
        sumber_pemasukan: $("#sumber_pemasukan").val(),
        tanggal_pemasukan: $("#tanggal_pemasukan").val(),
        nominal_pemasukan: $("#nominal_pemasukan").val(),
    };

    data.nominal_pemasukan = data.nominal_pemasukan.replace(/[^0-9]/g, "");

    // let data = $(this).serialize();

    $.ajax({
        url: "/dashboard/pemasukan/store",
        method: "POST",
        data: data,
        dataType: "JSON",

        beforeSend: function () {
            $("#modal-tambah-data-pemasukan")
                .find("#simpan")
                .html('<i class="fas fa-spinner fa-spin"></i>')
                .attr("disabled", true);

            $("#modal-tambah-data-pemasukan")
                .find("#batal")
                .attr("disabled", true);
        },

        success: function (res) {
            if (res.status_code >= 200) {
                Swal.fire({
                    title: "Berhasil!",
                    text: "Data berhasil ditambahkan.",
                    icon: "success",
                    confirmButtonText: "OK",
                });
                $("#table-manajemen-keuangan").DataTable().ajax.reload();
                $("#modal-tambah-data-pemasukan").modal("hide");

                $.ajax({
                    url: "/dashboard/pemasukan/get-saldo-by-user-id",
                    method: "POST",
                    dataType: "json",
                    data: {
                        _token: $('meta[name="csrf-token"]').attr("content"),
                        id: res.data.saldo.user_id,
                    },

                    success: function (response) {
                        console.log(response.data.sisa_saldo);
                        let sisa_saldo = formatRupiah(
                            response.data.sisa_saldo.toString(),
                            "Rp. "
                        );
                        $("#sisa_saldo_title").html(sisa_saldo);
                    },
                });
            }
        },

        error: function (xhr, status, error) {
            Swal.fire({
                title: "Gagal!",
                text: "Data gagal ditambahkan.",
                icon: "error",
                confirmButtonText: "OK",
            });
        },

        complete: function () {
            $("#modal-tambah-data-pemasukan")
                .find("#simpan")
                .html("Simpan")
                .attr("disabled", false);

            $("#modal-tambah-data-pemasukan")
                .find("#batal")
                .attr("disabled", false);
        },
    });
});
