{{-- Modal create --}}
<x-modal :id="'modal-tambah-data-pengeluaran'" :title="'Tambah Data Pengeluaran'" :headerClass="'bg-primary'" :formId="'form-tambah-data-pengeluaran'">
    <x-slot:body>
        <div class="form-group mb-3">
            <label for="tanggal_pengeluaran" class="form-label">Tanggal Pengeluaran</label>
            <input type="date" class="form-control" id="tanggal_pengeluaran" name="tanggal_pengeluaran">
        </div>
        <div class="form-group mb-3">
            <label for="kategori_pengeluaran" class="form-label">Kategori</label>
            <input type="text" class="form-control" id="kategori_pengeluaran" name="kategori_pengeluaran"
                class="form-control" placeholder="Masukan Kategori">
        </div>
        <div class="form-group mb-3">
            <label for="deskripsi_pengeluaran" class="form-label">Deskripsi Pengeluaran</label>
            <textarea name="deskripsi_pengeluaran" id="deskripsi_pengeluaran" cols="30" rows="3" class="form-control"
                placeholder="Masukan deskripsi pengeluaran"></textarea>
        </div>
        <div class="form-group mb-3">
            <label for="jumlah_pengeluaran" class="form-label">Jumlah Pengeluaran</label>
            <input type="text" class="form-control" id="jumlah_pengeluaran" name="jumlah_pengeluaran"
                placeholder="Masukan jumlah pengeluaran">
        </div>
        <div class="form-group mb-3">
            <label for="metode_pengeluaran" class="form-label">Metode Pengeluaran</label>
            <select name="metode_pengeluaran" id="metode_pengeluaran" class="form-select">
                <option selected disabled>Pilih metode pengeluaran</option>
                <option value="debit">Debit</option>
                <option value="transfer">Transfer</option>
                <option value="tunai">Tunai</option>
            </select>
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
{{-- Modal update --}}
<x-modal :id="'modal-update-data-pengeluaran'" :title="'Edit Data Pengeluaran'" :headerClass="'bg-warning'" :formId="'form-update-data-pengeluaran'">
    <x-slot:body>
        <div class="form-group">
            <input type="text" id="user_id" name="user_id" hidden>
            <input type="text" id="pengeluaran_id" name="pengeluaran_id" hidden>
        </div>
        <div class="form-group mb-3">
            <label for="tanggal_pengeluaran" class="form-label">Tanggal Pengeluaran</label>
            <input type="date" class="form-control" id="tanggal_pengeluaran" name="tanggal_pengeluaran">
        </div>
        <div class="form-group mb-3">
            <label for="kategori_pengeluaran" class="form-label">Kategori</label>
            <input type="text" class="form-control" id="kategori_pengeluaran" name="kategori_pengeluaran"
                class="form-control" placeholder="Masukan Kategori">
        </div>
        <div class="form-group mb-3">
            <label for="deskripsi_pengeluaran" class="form-label">Deskripsi Pengeluaran</label>
            <textarea name="deskripsi_pengeluaran" id="deskripsi_pengeluaran" cols="30" rows="3" class="form-control"
                placeholder="Masukan deskripsi pengeluaran"></textarea>
        </div>
        <div class="form-group mb-3">
            <label for="jumlah_pengeluaran_update" class="form-label">Jumlah Pengeluaran</label>
            <input type="text" class="form-control" id="jumlah_pengeluaran_update" name="jumlah_pengeluaran_update"
                placeholder="Masukan jumlah pengeluaran">
        </div>
        <div class="form-group mb-3">
            <label for="metode_pengeluaran" class="form-label">Metode Pengeluaran</label>
            <select name="metode_pengeluaran" id="metode_pengeluaran" class="form-select">
                <option selected disabled>Pilih metode pengeluaran</option>
                <option value="debit">Debit</option>
                <option value="transfer">Transfer</option>
                <option value="tunai">Tunai</option>
            </select>
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
{{-- Delete Modal --}}
<x-modal :id="'modal-delete-data-pengeluaran'" :title="'Hapus Data Pengeluaran'" :headerClass="'bg-danger'" :formId="'form-delete-data-pengeluaran'">
    <x-slot:body>
        <p>Apakah anda ingin menghapus pengeluaran <strong><span id="kategori_pengeluaran"></span></strong>?</p>
        <div class="form-group">
            <input type="text" id="pengeluaran_id" name="pengeluaran_id" hidden>
        </div>
    </x-slot:body>
    <x-slot:footer>
        <button type="button" class="btn btn-light-secondary" id="batal" data-bs-dismiss="modal">
            <i class="bx bx-x d-block d-sm-none"></i>
            <span class="d-none d-sm-block">Batal</span>
        </button>
        <button type="submit" class="btn btn-danger ms-1" id="simpan">
            <i class="bx bx-check d-block d-sm-none"></i>
            <span class="d-none d-sm-block">Hapus</span>
        </button>
    </x-slot:footer>
</x-modal>
