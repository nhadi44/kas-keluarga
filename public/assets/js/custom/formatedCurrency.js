const inputNominalPemasukan = document.getElementById("nominal_pemasukan");
const inputNominalPemasukanUpdate = document.getElementById(
    "nominal_pemasukan_update"
);
const sisaSaldoUpdate = document.getElementById("sisa_saldo_update");

const inputJumlahPengeluaran = document.getElementById("jumlah_pengeluaran");
const inputJumlahPengeluaranUpdate = document.getElementById(
    "jumlah_pengeluaran_update"
);

sisaSaldoUpdate ? handleCurrencyInput(sisaSaldoUpdate) : null;
inputNominalPemasukan ? handleCurrencyInput(inputNominalPemasukan) : null;
inputNominalPemasukanUpdate
    ? handleCurrencyInput(inputNominalPemasukanUpdate)
    : null;
inputJumlahPengeluaran ? handleCurrencyInput(inputJumlahPengeluaran) : null;

inputJumlahPengeluaranUpdate
    ? handleCurrencyInput(inputJumlahPengeluaranUpdate)
    : null;
