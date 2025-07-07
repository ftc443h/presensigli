<div class="modal-header">
    <h1 class="modal-title fs-5" id="editEmployeeLabel">
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
        Update Employee
    </h1>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
    <form method="POST" action="{{ route('karyawan.update', $employee->id) }}">
        @csrf
        @method('PUT')

        <div class="row">
            <div class="col-6">
                <div class="col-12">
                    <div class="form-floating mb-3">
                        <input type="file" name="foto" class="form-control" id="photoInput">
                        <label for="photoInput">Photo</label>
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-floating mb-3">
                        <input type="text" name="nip" class="form-control" id="nipInput"
                            value="{{ $employee->nip }}" readonly>
                        <label for="nipInput">NIP
                            Employee</label>
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-floating mb-3">
                        <input type="text" name="name" class="form-control" id="nameInput"
                            value="{{ $employee->name }}">
                        <label for="nameInput">Name
                            Employee</label>
                    </div>
                </div>
                <div class="col-12">
                    <select class="form-select mb-3" name="jenis_kelamin">
                        <option value="laki-laki"
                            {{ $employee->jenis_kelamin == 'laki-laki' ? 'selected' : '' }}>
                            Laki-laki</option>
                        <option value="perempuan"
                            {{ $employee->jenis_kelamin == 'perempuan' ? 'selected' : '' }}>
                            Perempuan</option>
                    </select>
                </div>
                <div class="col-12">
                    <select class="form-select mb-3" name="jabatan">
                        @foreach ($positions as $position)
                            <option value="{{ $position->jabatan }}"
                                {{ $employee->jabatan == $position->jabatan ? 'selected' : '' }}>
                                {{ $position->jabatan }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-12">
                    <div class="form-floating mb-3">
                        <input type="text" name="no_hp" class="form-control" id="hpInput"
                            value="{{ $employee->no_hp }}">
                        <label for="hpInput">No Handphone
                            Employee</label>
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-floating mb-3">
                        <textarea class="form-control" name="alamat" id="addressTextarea">{{ $employee->alamat }}</textarea>
                        <label for="addressTextarea">Address
                            Employee</label>
                    </div>
                </div>
                <div class="col-12">
                    <select class="form-select" name="lokasi_presensi">
                        @foreach ($locations as $location)
                            <option value="{{ $location->nama_lokasi }}"
                                {{ $employee->lokasi_presensi == $location->nama_lokasi ? 'selected' : '' }}>
                                {{ $location->nama_lokasi }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-6">
                <div class="col-12">
                    <div class="form-floating mb-3">
                        <input type="text" name="username" class="form-control" id="usernameInput"
                            value="{{ $employee->user->username }}">
                        <label for="usernameInput">Username
                            Employee</label>
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-floating mb-3">
                        <input type="email" name="email" class="form-control" id="emailInput"
                            value="{{ $employee->user->email }}">
                        <label for="emailInput">Email
                            Employee</label>
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-floating mb-3">
                        <input type="password" name="password" class="form-control" id="passwordInput"
                            placeholder="Leave blank if not changed">
                        <label for="passwordInput">New Password
                            Employee</label>
                    </div>
                </div>
                <div class="col-12">
                    <select class="form-select mb-3" name="role">
                        <option value="admin" {{ $employee->user->role == 'admin' ? 'selected' : '' }}>
                            Admin</option>
                        <option value="karyawan" {{ $employee->user->role == 'karyawan' ? 'selected' : '' }}>
                            Karyawan</option>
                    </select>
                </div>
                <div class="col-12">
                    <select class="form-select" name="status">
                        <option value="active" {{ $employee->user->status == 'active' ? 'selected' : '' }}>
                            Active</option>
                        <option value="banned" {{ $employee->user->status == 'banned' ? 'selected' : '' }}>
                            Banned</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- Button Update Employee -->
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">
                Update Employee
            </button>
        </div>
    </form>
</div>
