function formatRupiah(angka, prefix) {
    if (angka < 0) {
        // conver to format negative Rupiah like Rp. -1.000.000
        angka = angka.toString().replace(/[^0-9]/g, "");
        angka = angka.replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.");
        return prefix + "-" + angka;
    }

    // convert to format positive Rupiah like Rp. 1.000.000
    angka = angka.toString().replace(/[^0-9]/g, "");
    angka = angka.replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.");
    return prefix + angka;
}
