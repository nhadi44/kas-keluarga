$(document).ready(function () {
    let windowWidth = $(window).width();
    let scrollX = windowWidth < 768;
    let table = $("#table-manajemen-keuangan");

    $("#table-manajemen-keuangan")
        .DataTable({
            processing: true,
            serverSide: true,
            // responsive: "true",
            scrollX: scrollX,
            ajax: {
                url: "/dashboard/pemasukan/get-data",
                type: "POST",
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
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
                    data: "sumber_pemasukan",
                    name: "sumber_pemasukan",
                },
                {
                    render: function (data, type, row, meta) {
                        return moment(row.tanggal_pemasukan).format(
                            "DD MMMM YYYY"
                        );
                    },
                },
                {
                    render: function (data, type, row, meta) {
                        return new Intl.NumberFormat("id-ID", {
                            style: "currency",
                            currency: "IDR",
                            minimumFractionDigits: 0,
                            maximumFractionDigits: 0,
                        }).format(row.nominal_pemasukan);
                    },
                },
                {
                    render: function (data, type, row, meta) {
                        return new Intl.NumberFormat("id-ID", {
                            style: "currency",
                            currency: "IDR",
                            minimumFractionDigits: 0,
                            maximumFractionDigits: 0,
                        }).format(row.sisa_saldo);
                    },
                },
                {
                    render: function (data, type, row, meta) {
                        return moment(row.created_at).format("DD MMMM YYYY");
                    },
                },
                {
                    render: function (data, type, row, meta) {
                        return moment(row.updated_at).format("DD MMMM YYYY");
                    },
                },
                {
                    data: "username",
                    name: "username",
                },
            ],
            columnDefs: [
                {
                    targets: 8,
                    render: function (data, type, row, meta) {
                        return `
                        <div class="d-flex gap-2">
                            <button type="button" class="btn btn-warning" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Edit" id="edit-data-pemasukan">
                            <i class="bi bi-pen"></i>
                            </button>
                            <button type="button" class="btn btn-danger" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Hapus" id="delete-data-pemasukan">
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

    table.on("click", "#edit-data-pemasukan", function () {
        let data = table.DataTable().row($(this).parents("tr")).data();
        let nominal = data.nominal_pemasukan;
        let sisaSaldo = data.sisa_saldo;

        let formatedNominal = new Intl.NumberFormat("id-ID", {
            style: "currency",
            currency: "IDR",
            minimumFractionDigits: 0,
            maximumFractionDigits: 0,
        }).format(nominal);

        let formatedSisaSaldo = new Intl.NumberFormat("id-ID", {
            style: "currency",
            currency: "IDR",
            minimumFractionDigits: 0,
            maximumFractionDigits: 0,
        }).format(sisaSaldo);

        $("#modal-edit-data-keuangan").modal("show");
        $("#modal-edit-data-keuangan").find("#updateId").val(data.id);
        $("#modal-edit-data-keuangan")
            .find("#sumber_pemasukan")
            .val(data.sumber_pemasukan);
        $("#modal-edit-data-keuangan")
            .find("#tanggal_pemasukan")
            .val(moment(data.tanggal_pemasukan).format("YYYY-MM-DD"));

        $("#modal-edit-data-keuangan")
            .find("#nominal_pemasukan_update")
            .val(formatedNominal);

        $("#modal-edit-data-keuangan")
            .find("#sisa_saldo_update")
            .val(formatedSisaSaldo);
    });

    table.on("click", "#delete-data-pemasukan", function () {
        let data = table.DataTable().row($(this).parents("tr")).data();
        let id = data.id;
        let sumber_pemasukan = data.sumber_pemasukan;

        $("#modal-delete-data-keuangan").modal("show");
        $("#modal-delete-data-keuangan").find("#deleteId").val(id);
        $("#modal-delete-data-keuangan")
            .find("#sumber_pemasukan")
            .html(sumber_pemasukan);
    });
});
