@extends('admin.layouts.index')
@section('content')
    <!-- BEGIN PAGE HEADER -->
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <!-- Page pre-title -->
                    <h2 class="page-title"> <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round"
                                class="icon icon-tabler icons-tabler-outline icon-tabler-users-group">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M10 13a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                <path d="M8 21v-1a2 2 0 0 1 2 -2h4a2 2 0 0 1 2 2v1" />
                                <path d="M15 5a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                <path d="M17 10h2a2 2 0 0 1 2 2v1" />
                                <path d="M5 5a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                <path d="M3 13v-1a2 2 0 0 1 2 -2h2" />
                            </svg>
                        </span> Karyawan
                    </h2>
                </div>
                <!-- Page title actions -->
            </div>
        </div>
    </div>
    <!-- END PAGE HEADER -->
    <!-- BEGIN PAGE BODY -->
    <div class="page-body">
        <div class="container-xl">
            <div class="row">
                <div class="col-6">
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary" id="add-employee" data-bs-toggle="modal"
                        data-bs-target="#addEmployee">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round"
                                class="icon icon-tabler icons-tabler-outline icon-tabler-users-group">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M10 13a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                <path d="M8 21v-1a2 2 0 0 1 2 -2h4a2 2 0 0 1 2 2v1" />
                                <path d="M15 5a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                <path d="M17 10h2a2 2 0 0 1 2 2v1" />
                                <path d="M5 5a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                <path d="M3 13v-1a2 2 0 0 1 2 -2h2" />
                            </svg></span> Add Employee
                    </button>

                    @php
                        if (!empty($nip)) {
                            $nip_db = explode('-', $nip);
                            $no_baru = (int) $nip_db[1] + 1;
                            $nip_baru = 'KAR-' . str_pad($no_baru, 4, 0, STR_PAD_LEFT);
                        } else {
                            $nip_baru = 'KAR-0001';
                        }
                    @endphp

                    <!-- Modal -->
                    <div class="modal fade" id="addEmployee" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel"> <span
                                            class="nav-link-icon d-md-none d-lg-inline-block">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round"
                                                class="icon icon-tabler icons-tabler-outline icon-tabler-users-group">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path d="M10 13a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                                <path d="M8 21v-1a2 2 0 0 1 2 -2h4a2 2 0 0 1 2 2v1" />
                                                <path d="M15 5a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                                <path d="M17 10h2a2 2 0 0 1 2 2v1" />
                                                <path d="M5 5a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                                <path d="M3 13v-1a2 2 0 0 1 2 -2h2" />
                                            </svg></span> Add Employee</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form method="POST" action="{{ route('karyawan.store') }}"
                                        enctype="multipart/form-data">
                                        @csrf

                                        <div class="row">
                                            <div class="col-6">
                                                <div class="col-12">
                                                    <div class="form-floating mb-3">
                                                        <input type="file" name="foto" class="form-control"
                                                            id="floatingInput">
                                                        <label for="floatingInput">Photo</label>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-floating mb-3">
                                                        <input type="text" name="nip" class="form-control"
                                                            id="floatingInput" placeholder="Please Input NIP Employee"
                                                            value="{{ $nip_baru }}" readonly>
                                                        <label for="floatingInput">NIP Employee</label>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-floating mb-3">
                                                        <input type="text" name="name" class="form-control"
                                                            id="floatingInput" placeholder="Please Input Name Employee">
                                                        <label for="floatingInput">Name Employee</label>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <select class="form-select mb-3" name="jenis_kelamin">
                                                        <option value="">-- Please Select Gender Employee --</option>
                                                        <option value="laki-laki">Laki-Laki</option>
                                                        <option value="perempuan">Perempuan</option>
                                                    </select>
                                                </div>
                                                <div class="col-12">
                                                    <select class="form-select mb-3" name="jabatan">
                                                        <option value="">-- Please Select Position Employee --
                                                        </option>
                                                        @foreach ($positions as $position)
                                                            <option value="{{ $position->jabatan }}">
                                                                {{ $position->jabatan }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-floating mb-3">
                                                        <input type="text" name="no_hp" class="form-control"
                                                            id="floatingInput"
                                                            placeholder="Please Input No Handphone Employee">
                                                        <label for="floatingInput">No Handphone Employee</label>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-floating mb-3">
                                                        <textarea class="form-control" name="alamat" placeholder="Please Input Address Employee" id="floatingTextarea"></textarea>
                                                        <label for="floatingTextarea">Address Employee</label>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <select class="form-select" name="lokasi_presensi">
                                                        <option value="">-- Please Select Attendance Location --
                                                        </option>
                                                        @foreach ($locations as $location)
                                                            <option value="{{ $location->nama_lokasi }}">
                                                                {{ $location->nama_lokasi }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="col-12">
                                                    <div class="form-floating mb-3">
                                                        <input type="text" name="username" class="form-control"
                                                            id="floatingInput"
                                                            placeholder="Please Input Employee Username">
                                                        <label for="floatingInput">Username Employee</label>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-floating mb-3">
                                                        <input type="email" name="email" class="form-control"
                                                            id="floatingInput" placeholder="Please Input Employee Email">
                                                        <label for="floatingInput">Email Employee</label>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-floating mb-3">
                                                        <input type="password" name="password" class="form-control"
                                                            id="floatingInput"
                                                            placeholder="Please Input Employee Password">
                                                        <label for="floatingInput">Password Employee</label>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-floating mb-3">
                                                        <input type="password" name="password_confirmation"
                                                            class="form-control" id="floatingInput"
                                                            placeholder="Please Input Employee Password Confirmation">
                                                        <label for="floatingInput">Password Confirmation Employee</label>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <select class="form-select mb-3" name="role">
                                                        <option value="">-- Please Select Employee Role --</option>
                                                        <option value="admin">Admin</option>
                                                        <option value="karyawan">Karyawan</option>
                                                    </select>
                                                </div>
                                                <div class="col-12">
                                                    <select class="form-select" name="status">
                                                        <option value="">-- Please Select Employee Status --</option>
                                                        <option value="active">Active</option>
                                                        <option value="banned">Banned</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Button Add Employee -->
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Save Employee</button>
                                        </div>

                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary float-end" id="filter-employee" data-bs-toggle="modal"
                        data-bs-target="#exampleModal">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-search">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0" />
                                <path d="M21 21l-6 -6" />
                            </svg></span> Filter Employee
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form id="karyawan-form">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="floatingInput"
                                                placeholder="Masukan Nama Karyawan">
                                            <label for="floatingInput">Name</label>
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary">Filter Employee</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card mt-3">
                <div class="card-body p-0">
                    <div id="table-default" class="table-responsive">
                        <table id="karyawan" class="table table-karyawan">
                            <thead>
                                <tr>
                                    <th><button class="table-sort" data-sort="sort-name">No</button></th>
                                    <th><button class="table-sort" data-sort="sort-name">Photo</button></th>
                                    <th><button class="table-sort" data-sort="sort-score">NIP</button></th>
                                    <th><button class="table-sort" data-sort="sort-city">Name</button></th>
                                    <th><button class="table-sort" data-sort="sort-date">Username</button></th>
                                    <th><button class="table-sort" data-sort="sort-type">Position</button></th>
                                    <th><button class="table-sort" data-sort="sort-date">Action</button></th>
                                </tr>
                            </thead>
                            <tbody class="table-tbody">
                                @php
                                    $no = 1;
                                @endphp
                                @forelse ($employees as $employee)
                                    <tr>
                                        <td class="sort-name">
                                            {{ $no++ }}
                                        </td>
                                        <td class="sort-city">
                                            <span class="avatar avatar-sm"
                                                style="background-image: url('{{ !empty($employee->karyawan->foto) ? asset('storage/' . $employee->karyawan->foto) : asset('admin/assets/img/avatars/000m.jpg') }}')">
                                            </span>
                                        </td>
                                        <td class="sort-date">
                                            {{ $employee->karyawan->nip }}
                                        </td>
                                        <td class="sort-type">
                                            {{ $employee->karyawan->name }}
                                        </td>
                                        <td class="sort-quantity">
                                            {{ $employee->username }}
                                        </td>
                                        <td class="sort-score">
                                            {{ $employee->karyawan->jabatan }}
                                        </td>
                                        <td class="sort-quantity">
                                            <button type="button" class="btn btn-sm btn-primary btn-edit rounded-pill"
                                                data-bs-toggle="modal"
                                                data-bs-target="#editEmployee-{{ $employee->karyawan->id }}">
                                                <span class="text">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                        class="icon icon-tabler icons-tabler-outline icon-tabler-edit">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                        <path
                                                            d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" />
                                                        <path
                                                            d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" />
                                                        <path d="M16 5l3 3" />
                                                    </svg>
                                                </span>
                                                Edit
                                            </button>

                                            <!-- Modal -->
                                            <div class="modal fade" id="editEmployee-{{ $employee->karyawan->id }}"
                                                tabindex="-1"
                                                aria-labelledby="editEmployeeLabel-{{ $employee->karyawan->id }}"
                                                aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h1 class="modal-title fs-5" id="exampleModalLabel">
                                                                <span class="nav-link-icon d-md-none d-lg-inline-block">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                        height="24" viewBox="0 0 24 24" fill="none"
                                                                        stroke="currentColor" stroke-width="2"
                                                                        stroke-linecap="round" stroke-linejoin="round"
                                                                        class="icon icon-tabler icons-tabler-outline icon-tabler-users-group">
                                                                        <path stroke="none" d="M0 0h24v24H0z"
                                                                            fill="none" />
                                                                        <path d="M10 13a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                                                        <path
                                                                            d="M8 21v-1a2 2 0 0 1 2 -2h4a2 2 0 0 1 2 2v1" />
                                                                        <path d="M15 5a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                                                        <path d="M17 10h2a2 2 0 0 1 2 2v1" />
                                                                        <path d="M5 5a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                                                        <path d="M3 13v-1a2 2 0 0 1 2 -2h2" />
                                                                    </svg>
                                                                </span>
                                                                Update Employee
                                                            </h1>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form method="POST"
                                                                action="{{ route('karyawan.update', $employee->karyawan->id) }}">
                                                                @csrf
                                                                @method('PUT')

                                                                <div class="row">
                                                                    <div class="col-6">
                                                                        <div class="col-12">
                                                                            <div class="form-floating mb-3">
                                                                                <input type="file" name="foto"
                                                                                    class="form-control"
                                                                                    id="floatingInput">
                                                                                <label for="floatingInput">Photo</label>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-12">
                                                                            <div class="form-floating mb-3">
                                                                                <input type="text" name="nip"
                                                                                    class="form-control"
                                                                                    id="floatingInput"
                                                                                    value="{{ $employee->karyawan->nip }}"
                                                                                    readonly>
                                                                                <label for="floatingInput">NIP
                                                                                    Employee</label>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-12">
                                                                            <div class="form-floating mb-3">
                                                                                <input type="text" name="name"
                                                                                    class="form-control"
                                                                                    id="floatingInput"
                                                                                    value="{{ $employee->karyawan->name }}">
                                                                                <label for="floatingInput">Name
                                                                                    Employee</label>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-12">
                                                                            <select class="form-select mb-3"
                                                                                name="jenis_kelamin">
                                                                                <option value="laki-laki"
                                                                                    {{ $employee->karyawan->jenis_kelamin == 'laki-laki' ? 'selected' : '' }}>
                                                                                    Laki-laki</option>
                                                                                <option value="perempuan"
                                                                                    {{ $employee->karyawan->jenis_kelamin == 'perempuan' ? 'selected' : '' }}>
                                                                                    Perempuan</option>
                                                                            </select>
                                                                        </div>
                                                                        <div class="col-12">
                                                                            <select class="form-select mb-3"
                                                                                name="jabatan">
                                                                                @foreach ($positions as $position)
                                                                                    <option
                                                                                        value="{{ $position->jabatan }}"
                                                                                        {{ $employee->karyawan->jabatan == $position->jabatan ? 'selected' : '' }}>
                                                                                        {{ $position->jabatan }}
                                                                                    </option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                        <div class="col-12">
                                                                            <div class="form-floating mb-3">
                                                                                <input type="text" name="no_hp"
                                                                                    class="form-control"
                                                                                    id="floatingInput"
                                                                                    value="{{ $employee->karyawan->no_hp }}">
                                                                                <label for="floatingInput">No Handphone
                                                                                    Employee</label>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-12">
                                                                            <div class="form-floating mb-3">
                                                                                <textarea class="form-control" name="alamat" id="floatingTextarea">{{ $employee->karyawan->alamat }}</textarea>
                                                                                <label for="floatingTextarea">Address
                                                                                    Employee</label>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-12">
                                                                            <select class="form-select"
                                                                                name="lokasi_presensi">
                                                                                @foreach ($locations as $location)
                                                                                    <option
                                                                                        value="{{ $location->nama_lokasi }}"
                                                                                        {{ $employee->karyawan->lokasi_presensi == $location->nama_lokasi ? 'selected' : '' }}>
                                                                                        {{ $location->nama_lokasi }}
                                                                                    </option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-6">
                                                                        <div class="col-12">
                                                                            <div class="form-floating mb-3">
                                                                                <input type="text" name="username"
                                                                                    class="form-control"
                                                                                    id="floatingInput"
                                                                                    value="{{ $employee->username }}">
                                                                                <label for="floatingInput">Username
                                                                                    Employee</label>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-12">
                                                                            <div class="form-floating mb-3">
                                                                                <input type="email" name="email"
                                                                                    class="form-control"
                                                                                    id="floatingInput"
                                                                                    value="{{ $employee->email }}">
                                                                                <label for="floatingInput">Email
                                                                                    Employee</label>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-12">
                                                                            <div class="form-floating mb-3">
                                                                                <input type="password" name="password"
                                                                                    class="form-control"
                                                                                    id="floatingInput"
                                                                                    placeholder="Leave blank if not changed">
                                                                                <label for="floatingInput">New Password
                                                                                    Employee</label>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-12">
                                                                            <select class="form-select mb-3"
                                                                                name="role">
                                                                                <option value="admin"
                                                                                    {{ $employee->role == 'admin' ? 'selected' : '' }}>
                                                                                    Admin</option>
                                                                                <option value="karyawan"
                                                                                    {{ $employee->role == 'karyawan' ? 'selected' : '' }}>
                                                                                    Karyawan</option>
                                                                            </select>
                                                                        </div>
                                                                        <div class="col-12">
                                                                            <select class="form-select" name="status">
                                                                                <option value="active"
                                                                                    {{ $employee->status == 'active' ? 'selected' : '' }}>
                                                                                    Active</option>
                                                                                <option value="banned"
                                                                                    {{ $employee->status == 'banned' ? 'selected' : '' }}>
                                                                                    Banned</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <!-- Button Update Employee -->
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-bs-dismiss="modal">Close</button>
                                                                    <button type="submit" class="btn btn-primary">
                                                                        Update Employee
                                                                    </button>
                                                                </div>

                                                            </form>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                            <form action="{{ route('karyawan.destroy', $employee->karyawan->id) }}"
                                                method="POST" class="d-inline delete-form">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="btn btn-sm btn-danger rounded-pill text-bg-danger btn-delete">
                                                    <span class="text">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                            height="24" viewBox="0 0 24 24" fill="none"
                                                            stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                            stroke-linejoin="round"
                                                            class="icon icon-tabler icons-tabler-outline icon-tabler-trash">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                            <path d="M4 7l16 0" />
                                                            <path d="M10 11l0 6" />
                                                            <path d="M14 11l0 6" />
                                                            <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                                                            <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                                                        </svg>
                                                    </span>
                                                    Hapus
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="sort-city">
                                            No records found
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
