@extends('layouts.default')
@section('title', 'Laporan Keuangan')
@section('subtitle', 'Laporan Keuangan')
@section('content')
    <div class="col-12">
        <div class="row">
            <div class="col-lg-3 d-flex align-items-stretch">
                <div class="card w-100">
                    <div class="card-body px-4 py-4-5">
                        <div class="row">
                            <div class="col-12">
                                <h6 class="text-muted font-semibold">Total Pemasukan</h6>
                                <h6 class="font-extrabold mb-0" id="total_pemasukan">112000</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 d-flex align-items-stretch">
                <div class="card w-100">
                    <div class="card-body px-4 py-4-5">
                        <div class="row">
                            <div class="col-12">
                                <h6 class="text-muted font-semibold">Total Pengeluaran</h6>
                                <h6 class="font-extrabold mb-0" id="total_pengeluaran">183000</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 d-flex align-items-stretch">
                <div class="card w-100">
                    <div class="card-body px-4 py-4-5">
                        <div class="row">
                            <div class="col-12">
                                <h6 class="text-muted font-semibold">Saldo</h6>
                                <h6 class="font-extrabold mb-0" id="total_saldo">80000</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 d-flex align-items-stretch">
                <div class="card w-100">
                    <div class="card-body px-4 py-4-5">
                        <div class="row">
                            <div class="col-12">
                                <h6 class="text-muted font-semibold">Sumber Pemasukan</h6>
                                <h6 class="font-extrabold mb-0">PT. Bringin Inti Teknologi</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6 col-sm-12">
                <div class="card">
                    <div class="card-body">
                        left
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-sm-12">
                <div class="card">
                    <div class="card-body">
                        right
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="/assets/js/helpers/formatRupiah.js"></script>
    <script>
        let totalPemasukan = document.getElementById('total_pemasukan');
        let totalPengeluaran = document.getElementById('total_pengeluaran');
        let totalSaldp = document.getElementById('total_saldo');

        let totalPemasukanNumber = totalPemasukan.innerHTML = parseInt(totalPemasukan.innerHTML);
        let totalPengeluaranNumber = totalPengeluaran.innerHTML = parseInt(totalPengeluaran.innerHTML);
        let totalSaldoNumber = totalSaldp.innerHTML = parseInt(totalSaldp.innerHTML);

        totalPemasukan.innerHTML = formatRupiah(totalPemasukanNumber, 'Rp. ');
        totalPengeluaran.innerHTML = formatRupiah(totalPengeluaranNumber, 'Rp. ');
        totalSaldp.innerHTML = formatRupiah(totalSaldoNumber, 'Rp. ');
    </script>
@endpush
