<div class="modal-header">
    <h1 class="modal-title fs-5" id="exampleModalLabel">
        <span class="nav-link-icon d-md-none d-lg-inline-block">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                class="icon icon-tabler icons-tabler-outline icon-tabler-alert-square-rounded">
                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                <path d="M12 3c7.2 0 9 1.8 9 9s-1.8 9 -9 9s-9 -1.8 -9 -9s1.8 -9 9 -9z" />
                <path d="M12 8v4" />
                <path d="M12 16h.01" />
            </svg>
        </span>
        Update Absence
    </h1>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
    <form method="POST" action="{{ route('ketidakhadiran.update', $absence->id) }}">
        @csrf
        @method('PUT')

        <div class="row">
            <div class="col-12">
                <div class="form-floating mb-3">
                    <input type="date" name="tanggal" class="form-control" id="floatingInput"
                        value="{{ $absence->tanggal }}">
                    <label for="floatingInput">
                        Absence Date
                    </label>
                </div>
            </div>
            <div class="col-12">
                <select class="form-select mb-3" name="keterangan">
                    <option value="Cuti" {{ $absence->keterangan == 'Cuti' ? 'selected' : '' }}>
                        Cuti
                    </option>
                    <option value="Izin" {{ $absence->keterangan == 'Izin' ? 'selected' : '' }}>
                        Izin
                    </option>
                    <option value="Sakit" {{ $absence->keterangan == 'Sakit' ? 'selected' : '' }}>
                        Sakit
                    </option>
                </select>
            </div>
            <div class="col-12">
                <div class="form-floating mb-3">
                    <textarea class="form-control" name="deskripsi" id="floatingTextarea">{{ $absence->deskripsi }}</textarea>
                    <label for="floatingTextarea">
                        Absence Description
                    </label>
                </div>
            </div>
            <div class="col-12">
                <div class="form-floating mb-3">
                    <input type="file" name="foto" class="form-control" id="floatingInput">
                    <label for="floatingInput">Attachment</label>
                </div>
            </div>
        </div>

        <!-- Button Update Absence -->
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">
                Update Absence
            </button>
        </div>
    </form>
</div>
