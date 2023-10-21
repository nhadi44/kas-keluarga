const handleCurrencyInput = (e) => {
    e.addEventListener("input", (event) => {
        let value = event.target.value.replace(/[^0-9]/g, "");

        value = new Intl.NumberFormat("id-ID", {
            style: "currency",
            currency: "IDR",
            minimumFractionDigits: 0,
            maximumFractionDigits: 0,
        }).format(value);

        event.target.value = value;
    });
};

const reverseFormatCurrency = (currency) => {
    return currency.replace(/[^0-9]/g, "");
};
