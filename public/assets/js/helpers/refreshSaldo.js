function refreshSaldo(url, user_id) {
    $.ajax({
        url: url,
        method: "POST",
        dataType: "json",
        data: {
            _token: $('meta[name="csrf-token"]').attr("content"),
            id: user_id,
        },

        success: function (response) {
            let sisa_saldo = formatRupiah(
                response.data.sisa_saldo.toString(),
                "Rp. "
            );
            $("#sisa_saldo_title").html(sisa_saldo);
        },
    });
}
