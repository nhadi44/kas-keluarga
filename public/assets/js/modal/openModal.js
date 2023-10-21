let btnTambahDataKeuangan = $("#tambah-data-keuangan");
let modalTambahDataKeuangan = $("#modal-tambah-data-pemasukan");
let inputSumberPemasukan = $("#sumber_pemasukan");

let btnTambahDataPengeluaran = $("#tambah-data-pengeluaran");
let modalTambahDataPengeluaran = $("#modal-tambah-data-pengeluaran");
let kategoriPengeluaran = modalTambahDataPengeluaran.find(
    "#kategori_pengeluaran"
);

btnTambahDataKeuangan.click(function () {
    modalTambahDataKeuangan.modal("show");
});

modalTambahDataKeuangan.on("shown.bs.modal", function () {
    inputSumberPemasukan.focus();
});

modalTambahDataKeuangan.on("hidden.bs.modal", function () {
    // reset modal
    $(this).find("form").trigger("reset");
});

btnTambahDataPengeluaran.click(function () {
    modalTambahDataPengeluaran.modal("show");
});

modalTambahDataPengeluaran.on("shown.bs.modal", function () {
    kategoriPengeluaran.focus();
});

modalTambahDataPengeluaran.on("hidden.bs.modal", function () {
    // reset modal
    $(this).find("form").trigger("reset");
});
