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
                                                            id="photoInput">
                                                        <label for="photoInput">Photo</label>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-floating mb-3">
                                                        <input type="text" name="nip" class="form-control"
                                                            id="nipInput" placeholder="Please Input NIP Employee"
                                                            value="{{ $nip_baru }}" readonly>
                                                        <label for="nipInput">NIP Employee</label>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-floating mb-3">
                                                        <input type="text" name="name" class="form-control"
                                                            id="nameInput" placeholder="Please Input Name Employee">
                                                        <label for="nameInput">Name Employee</label>
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
                                                            id="hpInput"
                                                            placeholder="Please Input No Handphone Employee">
                                                        <label for="hpInput">No Handphone Employee</label>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-floating mb-3">
                                                        <textarea class="form-control" name="alamat" placeholder="Please Input Address Employee" id="addressTextarea"></textarea>
                                                        <label for="addressTextarea">Address Employee</label>
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
                                                            id="usernameInput"
                                                            placeholder="Please Input Employee Username">
                                                        <label for="usernameInput">Username Employee</label>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-floating mb-3">
                                                        <input type="email" name="email" class="form-control"
                                                            id="emailInput" placeholder="Please Input Employee Email">
                                                        <label for="emailInput">Email Employee</label>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-floating mb-3">
                                                        <input type="password" name="password" class="form-control"
                                                            id="passwordInput"
                                                            placeholder="Please Input Employee Password">
                                                        <label for="passwordInput">Password Employee</label>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-floating mb-3">
                                                        <input type="password" name="password_confirmation"
                                                            class="form-control" id="newPasswordInput"
                                                            placeholder="Please Input Employee Password Confirmation">
                                                        <label for="newPasswordInput">Password Confirmation Employee</label>
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
                        data-bs-target="#filterEmployee">
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
                    <div class="modal fade" id="filterEmployee" tabindex="-1" aria-labelledby="exampleModalLabel"
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
                                            <input type="text" class="form-control" id="employee-name"
                                                placeholder="Masukan Nama Karyawan">
                                            <label for="employee-name">Name</label>
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary" form="karyawan-form">Filter Employee</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card mt-3">
                <div class="card-body">
                    <div id="table-default" class="table-responsive">
                        <table id="karyawan" class="table table-vcenter card-table table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Photo</th>
                                    <th>NIP</th>
                                    <th>Name</th>
                                    <th>Username</th>
                                    <th>Position</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="editEmployee" tabindex="-1" aria-labelledby="editEmployeeLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content" id="editEmployeeContent">
                {{-- Isi modal akan dimuat via Ajax --}}
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            let table = $('#karyawan').DataTable({
                responsive: true,
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{{ route('karyawan.data') }}',
                    data: function(d) {
                        d.name = $('#employee-name').val();
                    }
                },
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        className: 'text-center',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'photo',
                        name: 'photo',
                        className: 'text-center'
                    },
                    {
                        data: 'nip',
                        name: 'nip',
                        className: 'text-center'
                    },
                    {
                        data: 'name',
                        name: 'name',
                        className: 'text-center'
                    },
                    {
                        data: 'username',
                        name: 'username',
                        className: 'text-center'
                    },
                    {
                        data: 'jabatan',
                        name: 'jabatan',
                        className: 'text-center'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        className: 'text-center',
                        orderable: false,
                        searchable: false
                    }
                ],
                language: {
                    processing: '<i class="fa fa-spinner fa-spin"></i> Loading...',
                    search: 'Search:',
                    lengthMenu: 'Show _MENU_ entries',
                    info: 'Showing _START_ to _END_ of _TOTAL_ entries',
                    infoEmpty: 'No entries found',
                    infoFiltered: '(filtered from _MAX_ total entries)',
                    paginate: {
                        first: 'First',
                        last: 'Last',
                        next: 'Next',
                        previous: 'Previous'
                    }
                },
            });

            // Submit filter
            $('#karyawan-form').on('submit', function(e) {
                e.preventDefault();
                table.ajax.reload();
                $('#filterEmployee').modal('hide');
            });

            // Tambahan: tombol filter juga bisa trigger submit form
            $('[form="karyawan-form"]').on('click', function() {
                $('#karyawan-form').submit();
            });

            // Handle edit button click
            $(document).on('click', '.btn-edit', function() {
                let employeeId = $(this).data('id');
                $.ajax({
                    url: `/karyawan/karyawan/${employeeId}/edit`,
                    type: 'GET',
                    success: function(data) {
                        $('#editEmployeeContent').html(data);
                        $('#editEmployee').modal('show');
                    },
                    error: function(xhr) {
                        console.error('Error fetching employee data:', xhr);
                        Swal.fire({
                            title: 'Error!',
                            text: 'Failed to load employee data. Please try again.',
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    }
                });
            });
        });
    </script>
@endsection
