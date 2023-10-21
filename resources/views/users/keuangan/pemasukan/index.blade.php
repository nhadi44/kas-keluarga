@extends('layouts.default')

@push('styles')
    <link
        href="https://cdn.datatables.net/v/bs5/jszip-3.10.1/dt-1.13.6/b-2.4.2/b-html5-2.4.2/b-print-2.4.2/fc-4.3.0/fh-3.4.0/r-2.5.0/sc-2.2.0/sb-1.6.0/datatables.min.css"
        rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
    <script
        src="https://cdn.datatables.net/v/bs5/jszip-3.10.1/dt-1.13.6/b-2.4.2/b-html5-2.4.2/b-print-2.4.2/fc-4.3.0/fh-3.4.0/r-2.5.0/sc-2.2.0/sb-1.6.0/datatables.min.js">
    </script>
@endpush

@section('title', 'Data Pemasukan')
@section('subtitle', 'Data Pemasukan')
@section('content')
    <div class="col-12">
        <div class="card">
            <div class="card-body px-4 py-4-5">
                <div class="d-flex justify-content-between align-items-center mb-5">
                    <button class="btn btn-primary" id="tambah-data-keuangan" data-bs-toggle="tooltip"
                        data-bs-placement="bottom" data-bs-title="Tambah Data Pemasukan">
                        <i class="bi bi-plus"></i>
                        Tambah Data Pemasukan
                    </button>

                    <div class="d-flex align-items-center gap-4">
                        <span class=" fs-5">Saldo:</span>
                        <span type="text" class="form-control-plaintext fs-5 text-end" id="sisa_saldo_title">
                            {{ $saldo->sisa_saldo ?? 0 }}
                        </span>
                    </div>
                </div>

                <div class="table-responsive">
                    <table id="table-manajemen-keuangan" class="table table-striped" style="width: 100%"
                        aria-describedby="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Sumber Pemasukan</th>
                                <th>Tanggal Pemasukan</th>
                                <th>Nominal Pemasukan</th>
                                <th>Sisa Saldo</th>
                                <th>Dibuat Pada Tanggal</th>
                                <th>Diubah Pada Tanggal</th>
                                <th>Oleh</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @include('users.keuangan.pemasukan.modal')
@endsection

@push('scripts')
    <script src="/assets/js/datatable/datatableFinance.js"></script>
    <script src="/assets/js/modal/openModal.js"></script>
    <script src="/assets/js/form/pemasukan/create.js"></script>
    <script src="/assets/js/form/pemasukan/update.js"></script>
    <script src="/assets/js/form/pemasukan/delete.js"></script>
    <script src="/assets/js/helpers/currency.js"></script>
    <script src="/assets/js/custom/formatedCurrency.js"></script>
    <script src="/assets/js/helpers/formatRupiah.js"></script>
    <script>
        let sisaSaldoTitle = document.getElementById('sisa_saldo_title');
        console.log(typeof sisaSaldoTitle.innerHTML)
        // sring to number
        let sisaSaldoNumber = sisaSaldoTitle.innerHTML = parseInt(sisaSaldoTitle.innerHTML);
        // format rupiah
        sisaSaldoTitle.innerHTML = formatRupiah(sisaSaldoNumber.toString(), 'Rp. ');
    </script>
@endpush
