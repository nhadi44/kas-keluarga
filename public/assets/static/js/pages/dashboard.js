let optionsProfileVisit = {
    annotations: {
        position: "back",
    },
    dataLabels: {
        enabled: false,
    },
    chart: {
        type: "bar",
        height: 300,
    },
    fill: {
        opacity: 1,
    },
    plotOptions: {},
    series: [
        {
            name: "pemasukan",
            data: [],
        },
    ],
    colors: "#435ebe",
    xaxis: {
        categories: [],
    },
};
let optionsVisitorsProfile = {
    series: [],
    labels: [],
    colors: [],
    chart: {
        type: "donut",
        width: "100%",
        height: "350px",
    },
    legend: {
        position: "bottom",
    },
    plotOptions: {
        pie: {
            donut: {
                size: "30%",
            },
        },
    },
};

let chartProfileVisit = new ApexCharts(
    document.querySelector("#chart-profile-visit"),
    optionsProfileVisit
);
let chartVisitorsProfile = new ApexCharts(
    document.getElementById("chart-visitors-profile"),
    optionsVisitorsProfile
);

$(document).ready(function () {
    $.ajax({
        url: "/dashboard/diagram-pemasukan",
        method: "GET",
        dataType: "json",

        success: function (res) {
            let data = res.data;
            // short shorting index

            for (let i = 0; i < data.length; i++) {
                // potong 3 huruf pertama nama bulan
                let namaBulan = data[i].nama_bulan.substring(0, 3);
                optionsProfileVisit.xaxis.categories.push(namaBulan);
                optionsProfileVisit.series[0].data.push(
                    data[i].total_pemasukan
                );
            }

            chartProfileVisit.render();
        },
    });

    $.ajax({
        url: "/dashboard/diagram-pengeluaran",
        method: "GET",
        dataType: "json",

        success: function (res) {
            let data = res.data;

            for (let i = 0; i < data.length; i++) {
                optionsVisitorsProfile.series.push(data[i].series);
                optionsVisitorsProfile.labels.push(data[i].labels);
                optionsVisitorsProfile.colors.push(data[i].colors);
            }
            chartVisitorsProfile.render();
        },
    });
});
