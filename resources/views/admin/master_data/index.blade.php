@extends('admin.layouts.index')
@section('content')
    <!-- BEGIN PAGE HEADER -->
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <!-- Page pre-title -->
                    <h2 class="page-title"> <span
                            class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler.io/icons/icon/home -->
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
                            </svg></span> Master Data</h2>
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
                    <button type="button" class="btn btn-primary" id="add-jobTitle" data-bs-toggle="modal"
                        data-bs-target="#addJobTitle">
                        <span
                            class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler.io/icons/icon/home -->
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
                            </svg></span> Add Job Title
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="addJobTitle" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel"> <span
                                            class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler.io/icons/icon/home -->
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
                                            </svg></span> Add Job Title</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form method="POST" action="{{ route('jabatan.store') }}">
                                        @csrf

                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-floating mb-3">
                                                    <input type="text" name="jabatan" class="form-control"
                                                        id="floatingInput" placeholder="Please Input Job Title">
                                                    <label for="floatingInput">Job Title</label>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Button Add Employee -->
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Save Job Title</button>
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
                        <span
                            class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler.io/icons/icon/home -->
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-search">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0" />
                                <path d="M21 21l-6 -6" />
                            </svg></span> Filter Job Title
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Filter Job Title</h1>
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
                                    <button type="button" class="btn btn-primary">Filter Job Title</button>
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
                                    <th>
                                        <button class="table-sort" data-sort="sort-name">
                                            No
                                        </button>
                                    </th>
                                    <th>
                                        <button class="table-sort" data-sort="sort-name">
                                            Name
                                        </button>
                                    </th>
                                    <th>
                                        <button class="table-sort" data-sort="sort-name">
                                            Action
                                        </button>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="table-tbody">
                                @php
                                    $no = 1;
                                @endphp
                                @forelse ($jabatans as $jabatan)
                                    <tr>
                                        <td class="sort-city">
                                            {{ $no++ }}
                                        </td>
                                        <td class="sort-city">
                                            {{ $jabatan->jabatan }}
                                        </td>
                                        <td class="sort-city">
                                            <button type="button" class="btn btn-sm btn-primary btn-edit rounded-pill"
                                                data-bs-toggle="modal" data-bs-target="#editJobTitle-{{ $jabatan->id }}">
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
                                            <div class="modal fade" id="editJobTitle-{{ $jabatan->id }}" tabindex="-1"
                                                aria-labelledby="editJobTitleLabel-{{ $jabatan->id }}"
                                                aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h1 class="modal-title fs-5" id="exampleModalLabel"> 
                                                                <span
                                                                    class="nav-link-icon d-md-none d-lg-inline-block">
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
                                                                Update Job Title
                                                            </h1>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form method="POST"
                                                                action="{{ route('jabatan.update', $jabatan->id) }}">
                                                                @csrf
                                                                @method('PUT')

                                                                <div class="row">
                                                                    <div class="col-12">
                                                                        <div class="form-floating mb-3">
                                                                            <input type="text" name="jabatan"
                                                                                class="form-control" id="floatingInput"
                                                                                value="{{ $jabatan->jabatan }}">
                                                                            <label for="floatingInput">Job Title</label>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <!-- Button Add Employee -->
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-bs-dismiss="modal">Close</button>
                                                                    <button type="submit" class="btn btn-primary">Update
                                                                        Job Title</button>
                                                                </div>

                                                            </form>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                            <form action="{{ route('jabatan.destroy', $jabatan->id) }}" method="POST"
                                                class="d-inline delete-form">
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
