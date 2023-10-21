{{-- Modal Create --}}
<x-modal :id="'modal-tambah-data-pemasukan'" :title="'Tambah Data Pemasukan'" :headerClass="'bg-primary'" :formId="'form-tambah-data-pemasukan'">
    <x-slot:body>
        <div class="form-group mb-3">
            <label for="sumber_pemasukan" class="form-label">Sumber Pemasukan</label>
            <input type="text" class="form-control" id="sumber_pemasukan" name="sumber_pemasukan" class="sumber_pemasukan"
                placeholder="Masukan Sumber Pemasukan">
        </div>
        <div class="form-group mb-3">
            <label for="tanggal_pemasukan" class="form-label">Tanggal Pemasukan</label>
            <input type="date" class="form-control" id="tanggal_pemasukan" name="tanggal_pemasukan"
                class="tanggal_pemasukan" placeholder="Masukan Tanggal Pemasukan">
        </div>
        <div class="form-group mb-3">
            <label for="nominal_pemasukan" class="form-label">Nominal Pemasukan</label>
            <input type="text" class="form-control" id="nominal_pemasukan" name="nominal_pemasukan"
                class="nominal_pemasukan" placeholder="Masukan Tanggal Pemasukan">
        </div>
    </x-slot:body>
    <x-slot:footer>
        <button type="button" class="btn btn-light-secondary" id="batal" data-bs-dismiss="modal">
            <i class="bx bx-x d-block d-sm-none"></i>
            <span class="d-none d-sm-block">Batal</span>
        </button>
        <button type="submit" class="btn btn-primary ms-1" id="simpan">
            <i class="bx bx-check d-block d-sm-none"></i>
            <span class="d-none d-sm-block">Simpan</span>
        </button>
    </x-slot:footer>
</x-modal>
{{-- Modal Edit --}}
<x-modal :id="'modal-edit-data-keuangan'" :title="'Edit Data Pemasukan'" :headerClass="'bg-warning'" :formId="'form-edit-data-keuangan'">
    <x-slot:body>
        <div class="form-group">
            <input type="text" class="form-control" id="updateId" name="updateId" hidden>
        </div>
        <div class="form-group mb-3">
            <label for="sumber_pemasukan" class="form-label">Sumber Pemasukan</label>
            <input type="text" class="form-control" id="sumber_pemasukan" class="sumber_pemasukan"
                placeholder="Masukan Sumber Pemasukan">
        </div>
        <div class="form-group mb-3">
            <label for="tanggal_pemasukan" class="form-label">Tanggal Pemasukan</label>
            <input type="date" class="form-control" id="tanggal_pemasukan" class="tanggal_pemasukan"
                placeholder="Masukan Tanggal Pemasukan">
        </div>
        <div class="form-group mb-3">
            <label for="nominal_pemasukan_update" class="form-label">Nominal Pemasukan</label>
            <input type="text" class="form-control" id="nominal_pemasukan_update" class="nominal_pemasukan_update"
                placeholder="Masukan Tanggal Pemasukan">
        </div>
        <div class="form-group mb-3">
            <label for="sisa_saldo_update" class="form-label">Sisa Saldo</label>
            <input type="text" class="form-control" id="sisa_saldo_update" class="form-control"
                placeholder="Sisa saldo" disabled readonly>
        </div>
    </x-slot:body>
    <x-slot:footer>
        <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
            <i class="bx bx-x d-block d-sm-none"></i>
            <span class="d-none d-sm-block">Batal</span>
        </button>
        <button type="submit" class="btn btn-primary ms-1">
            <i class="bx bx-check d-block d-sm-none"></i>
            <span class="d-none d-sm-block">Simpan</span>
        </button>
    </x-slot:footer>
</x-modal>

<x-modal :id="'modal-delete-data-keuangan'" :title="'Hapus Data Pemasukan'" :headerClass="'bg-danger'" :formId="'form-hapus-data-keuangan'">
    <x-slot:body>
        Apakah anda yakin ingin menghapus data pemasukan dari <strong><span id="sumber_pemasukan"></span></strong>?
        <div class="form-group">
            <input type="text" class="form-control" id="deleteId" name="deleteId" hidden>
        </div>
    </x-slot:body>
    <x-slot:footer>
        <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal" id="batalkan">
            <i class="bx bx-x d-block d-sm-none"></i>
            <span class="d-none d-sm-block">Batal</span>
        </button>
        <button type="submit" class="btn btn-danger ms-1" id="hapus">
            <i class="bx bx-check d-block d-sm-none"></i>
            <span class="d-none d-sm-block">Hapus</span>
        </button>
    </x-slot:footer>
</x-modal>
