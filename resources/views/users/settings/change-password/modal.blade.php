<x-modal :id="'modal-change-password'" :title="'Ubah Password'" :headerClass="'bg-primary'" :formId="'form-change-password'">
    <x-slot:body>
        <div class="form-group mb-3">
            <label for="password_lama" class="form-label">Password Lama</label>
            <input type="password" class="form-control" id="password_lama" name="password_lama" placeholder="Password Lama">
        </div>
        <div class="form-group mb-3">
            <label for="password_baru" class="form-label">Password Baru</label>
            <input type="password" class="form-control" id="password_baru" name="password_baru"
                placeholder="Password Baru">
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
