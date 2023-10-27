@extends('layouts.default')
@section('title', 'Dashboard')
@section('subtitle', 'Dashboard Kas Keluarga')
@section('content')
    <div class="col-12 col-lg-9">
        <div class="row">
            <div class="col-6 col-lg-3 col-md-6">
                <div class="card">
                    <div class="card-body px-4 py-4-5">
                        <div class="row">
                            <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                <div class="stats-icon green mb-2">
                                    <i class="iconly-boldWallet"></i>
                                </div>
                            </div>
                            <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                <h6 class="text-muted font-semibold">Pemasukan</h6>
                                <h6 class="font-extrabold mb-0" id="dashboard_total_pemasukan">{{ $pemasukan }}</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-lg-3 col-md-6">
                <div class="card">
                    <div class="card-body px-4 py-4-5">
                        <div class="row">
                            <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                <div class="stats-icon blue mb-2">
                                    <i class="iconly-boldWallet"></i>
                                </div>
                            </div>
                            <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                <h6 class="text-muted font-semibold">Pengeluaran</h6>
                                <h6 class="font-extrabold mb-0" id="dashboard_total_pengeluaran">{{ $pengeluaran }}</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-lg-3 col-md-6">
                <div class="card">
                    <div class="card-body px-4 py-4-5">
                        <div class="row">
                            <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                <div class="stats-icon purple mb-2">
                                    <i class="iconly-boldWallet"></i>
                                </div>
                            </div>
                            <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                <h6 class="text-muted font-semibold">Saldo</h6>
                                <h6 class="font-extrabold mb-0" id="dashboard_total_saldo">{{ $saldo }}</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Diagram Pemasukan</h4>
                    </div>
                    <div class="card-body">
                        <div id="chart-profile-visit"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-lg-3">
        <div class="card">
            <div class="card-body py-4 px-4">
                <div class="d-flex align-items-center">
                    <div class="avatar avatar-xl">
                        <img src="/assets/compiled/jpg/1.jpg" alt="Face 1">
                    </div>
                    <div class="ms-3 name">
                        <h5 class="font-bold">{{auth()->user()->username}}</h5>
                        <h6 class="text-muted mb-0">{{auth()->user()->email}}</h6>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <h4>Diagram Pengeluaran</h4>
            </div>
            <div class="card-body">
                <div id="chart-visitors-profile"></div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <!-- Need: Apexcharts -->
    <script src="/assets/extensions/apexcharts/apexcharts.min.js"></script>
    <script src="/assets/static/js/pages/dashboard.js"></script>
    <script src="/assets/js/helpers/formatRupiah.js"></script>
    <script>
        let dashboardTotalPemasukan = document.getElementById('dashboard_total_pemasukan');
        let dashboardTotalPengeluaran = document.getElementById('dashboard_total_pengeluaran');
        let dashboardTotalSaldo = document.getElementById('dashboard_total_saldo');

        let dashboardTotalPemasukanNumber = dashboardTotalPemasukan.innerHTML = parseInt(dashboardTotalPemasukan.innerHTML);
        let dashboardTotalPengeluaranNumber = dashboardTotalPengeluaran.innerHTML = parseInt(dashboardTotalPengeluaran.innerHTML);
        let dashboardTotalSaldoNumber = dashboardTotalSaldo.innerHTML = parseInt(dashboardTotalSaldo.innerHTML)

        dashboardTotalPemasukan.innerHTML = formatRupiah(dashboardTotalPemasukanNumber, 'Rp. ');
        dashboardTotalPengeluaran.innerHTML = formatRupiah(dashboardTotalPengeluaranNumber, 'Rp. ');
        dashboardTotalSaldo.innerHTML = formatRupiah(dashboardTotalSaldoNumber, 'Rp. ');

    </script>
@endpush
