@extends('admin.layouts.index')
@section('content')
    <!-- BEGIN PAGE HEADER -->
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <!-- Page pre-title -->
                    <h2 class="page-title">
                        Profile Admin
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
            <div class="row justify-content-center">
                <div class="col-sm-6 text-center">
                    <div class="card">
                        <div class="card-body">
                            <div class="text-center mb-3">
                                <img src="{{ $admin->karyawan->foto ? asset('storage/' . $admin->karyawan->foto) : asset('admin/assets/img/avatars/000m.jpg') }}"
                                    alt="Photo_Admin" class="avatar avatar-xl rounded-circle mb-3">
                            </div>
                            <table class="table table-borderless text-start">
                                <tr>
                                    <td><strong>Nama</strong></td>
                                    <td>: {{ $admin->karyawan->name }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Jenis Kelamin</strong></td>
                                    <td>
                                        :
                                        {{ $admin->karyawan->jenis_kelamin == 'perempuan' ? 'Perempuan' : 'Laki-laki' }}
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>Alamat</strong></td>
                                    <td>: {{ $admin->karyawan->alamat }}</td>
                                </tr>
                                <tr>
                                    <td><strong>No. Handphone</strong></td>
                                    <td>: {{ $admin->karyawan->no_hp }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Jabatan</strong></td>
                                    <td>: {{ $admin->karyawan->jabatan }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Username</strong></td>
                                    <td>: {{ $admin->username }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Role</strong></td>
                                    <td>
                                        : {{ $admin->role == 'admin' ? 'Admin' : 'Karyawan' }}
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>Lokasi Presensi</strong></td>
                                    <td>
                                        : {{ $admin->karyawan->lokasi_presensi }}
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>Status</strong></td>
                                    <td>
                                        :
                                        @if ($admin->status == 'active')
                                            <span class="badge bg-success">
                                                Active
                                            </span>
                                        @else
                                            <span class="badge bg-danger">
                                                Banned
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
