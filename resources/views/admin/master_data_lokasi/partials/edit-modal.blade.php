<div class="modal-header">
    <h1 class="modal-title fs-5" id="exampleModalLabel">
        <span class="nav-link-icon d-md-none d-lg-inline-block">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                class="icon icon-tabler icons-tabler-outline icon-tabler-users-group">
                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                <path d="M10 13a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                <path d="M8 21v-1a2 2 0 0 1 2 -2h4a2 2 0 0 1 2 2v1" />
                <path d="M15 5a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                <path d="M17 10h2a2 2 0 0 1 2 2v1" />
                <path d="M5 5a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                <path d="M3 13v-1a2 2 0 0 1 2 -2h2" />
            </svg>
        </span>
        Update Location
    </h1>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
    <form method="POST" action="{{ route('lokasi-presensi.update', $location->id) }}">
        @csrf
        @method('PUT')

        <div class="row">
            <div class="col-12">
                <div class="form-floating mb-3">
                    <input type="text" name="nama_lokasi" class="form-control" id="lokasiInput"
                        value="{{ $location->nama_lokasi }}">
                    <label for="lokasiInput">
                        Name Location
                    </label>
                </div>
            </div>
            <div class="col-12">
                <div class="form-floating mb-3">
                    <textarea class="form-control" name="alamat_lokasi" id="addressTextarea">{{ $location->alamat_lokasi }}</textarea>
                    <label for="addressTextarea">
                        Address Location
                    </label>
                </div>
            </div>
            <div class="col-12">
                <div class="form-floating mb-3">
                    <input type="text" name="latitude" class="form-control" id="latitudeInput"
                        value="{{ $location->latitude }}">
                    <label for="latitudeInput">Latitude</label>
                </div>
            </div>
            <div class="col-12">
                <div class="form-floating mb-3">
                    <input type="text" name="longitude" class="form-control" id="longitudeInput"
                        value="{{ $location->longitude }}">
                    <label for="longitudeInput">Longitude</label>
                </div>
            </div>
            <div class="col-12">
                <div class="form-floating mb-3">
                    <input type="text" name="radius" class="form-control" id="radiusInput"
                        value="{{ $location->radius }}">
                    <label for="radiusInput">Radius</label>
                </div>
            </div>
            <div class="col-12">
                <select class="form-select mb-3" name="zona_waktu">
                    <option value="WIB" {{ $location->zona_waktu == 'WIB' ? 'selected' : '' }}>
                        WIB
                    </option>
                    <option value="WITA" {{ $location->zona_waktu == 'WITA' ? 'selected' : '' }}>
                        WITA
                    </option>
                    <option value="WIT" {{ $location->zona_waktu == 'WIT' ? 'selected' : '' }}>
                        WIT
                    </option>
                </select>
            </div>
            <div class="col-12">
                <div class="form-floating mb-3">
                    <input type="time" name="jam_masuk" class="form-control" id="timeInInput"
                        value="{{ \Carbon\Carbon::parse($location->jam_masuk)->format('H:i') }}">
                    <label for="timeInInput">Time In</label>
                </div>
            </div>
            <div class="col-12">
                <div class="form-floating mb-3">
                    <input type="time" name="jam_pulang" class="form-control" id="timeOutInput"
                        value="{{ \Carbon\Carbon::parse($location->jam_pulang)->format('H:i') }}">
                    <label for="timeOutInput">Time Out</label>
                </div>
            </div>
        </div>

        <!-- Button Update Location -->
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">
                Update Location
            </button>
        </div>

    </form>
</div>
