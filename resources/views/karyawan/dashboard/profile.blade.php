@extends('karyawan.layouts.index')
@section('content')
    <!-- BEGIN PAGE HEADER -->
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <!-- Page pre-title -->
                    <h2 class="page-title">
                        Profile Karyawan
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
                                <img src="{{ $karyawan->karyawan->foto ? asset('storage/' . $karyawan->karyawan->foto) : asset('admin/assets/img/avatars/000m.jpg') }}"
                                    alt="Photo_Admin" class="avatar avatar-xl rounded-circle mb-3">
                            </div>
                            <table class="table table-borderless text-start">
                                <tr>
                                    <td><strong>Nama</strong></td>
                                    <td>: {{ $karyawan->karyawan->name }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Jenis Kelamin</strong></td>
                                    <td>
                                        :
                                        {{ $karyawan->karyawan->jenis_kelamin == 'perempuan' ? 'Perempuan' : 'Laki-laki' }}
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>Alamat</strong></td>
                                    <td>: {{ $karyawan->karyawan->alamat }}</td>
                                </tr>
                                <tr>
                                    <td><strong>No. Handphone</strong></td>
                                    <td>: {{ $karyawan->karyawan->no_hp }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Jabatan</strong></td>
                                    <td>: {{ $karyawan->karyawan->jabatan }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Username</strong></td>
                                    <td>: {{ $karyawan->username }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Role</strong></td>
                                    <td>
                                        : {{ $karyawan->role == 'admin' ? 'Admin' : 'Karyawan' }}
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>Lokasi Presensi</strong></td>
                                    <td>
                                        : {{ $karyawan->karyawan->lokasi_presensi }}
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>Status</strong></td>
                                    <td>
                                        :
                                        @if ($karyawan->status == 'active')
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
