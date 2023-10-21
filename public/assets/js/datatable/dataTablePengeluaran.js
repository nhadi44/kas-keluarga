let tablePengeluaran = $("#table-data-pengeluaran");
let windowWidth = $(window).width();
let scrollX = windowWidth < 768;

tablePengeluaran
    .DataTable({
        processing: true,
        serverSide: true,
        scrollX: scrollX,
        ajax: {
            url: "/dashboard/pengeluaran/get-data",
            type: "POST",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        },
        columns: [
            {
                data: null,
                render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                },
            },
            {
                render: function (data, type, row, meta) {
                    return moment(row.tanggal_pengeluaran).format(
                        "DD MMMM YYYY"
                    );
                },
            },
            {
                data: "kategori_pengeluaran",
                name: "kategori_pengeluaran",
            },
            {
                data: "deskripsi_pengeluaran",
                name: "deskripsi_pengeluaran",
            },
            {
                data: "jumlah_pengeluaran",
                name: "jumlah_pengeluaran",
            },
            {
                data: "metode_pengeluaran",
                name: "metode_pengeluaran",
            },
        ],
        columnDefs: [
            {
                targets: 6,
                render: function (data, type, row, meta) {
                    return `
                        <div class="d-flex gap-2">
                            <button type="button" class="btn btn-warning" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Edit" id="edit-data-pengeluaran">
                            <i class="bi bi-pen"></i>
                            </button>
                            <button type="button" class="btn btn-danger" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Hapus" id="delete-data-pengeluaran">
                            <i class="bi bi-trash"></i>
                            </button>
                        </div>
                        `;
                },
            },
        ],
    })
    .on("draw.dt", function () {
        $('[data-bs-toggle="tooltip"]').tooltip();
    });

tablePengeluaran.on("click", "#edit-data-pengeluaran", function () {
    let modal = $("#modal-update-data-pengeluaran");
    let data = tablePengeluaran.DataTable().row($(this).parents("tr")).data();

    let jumlahPengeluaran = new Intl.NumberFormat("id-ID", {
        style: "currency",
        currency: "IDR",
        minimumFractionDigits: 0,
        maximumFractionDigits: 0,
    }).format(data.jumlah_pengeluaran);

    modal.modal("show");
    modal.find("#id").val(data.id);
    modal.find("#tanggal_pengeluaran").val(data.tanggal_pengeluaran);
    modal.find("#kategori_pengeluaran").val(data.kategori_pengeluaran);
    modal.find("#deskripsi_pengeluaran").val(data.deskripsi_pengeluaran);
    modal.find("#jumlah_pengeluaran_update").val(jumlahPengeluaran);
    modal.find("#metode_pengeluaran").val(data.metode_pengeluaran);
});
