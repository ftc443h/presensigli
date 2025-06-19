@extends('admin.layouts.index')
@section('content')
    <!-- BEGIN PAGE HEADER -->
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <!-- Page pre-title -->
                    <h2 class="page-title">
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
                            </svg>
                        </span> Master Data | Location
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
                    <button type="button" class="btn btn-primary" id="add-location" data-bs-toggle="modal"
                        data-bs-target="#addLocation">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-map-2">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M12 18.5l-3 -1.5l-6 3v-13l6 -3l6 3l6 -3v7.5" />
                                <path d="M9 4v13" />
                                <path d="M15 7v5.5" />
                                <path
                                    d="M21.121 20.121a3 3 0 1 0 -4.242 0c.418 .419 1.125 1.045 2.121 1.879c1.051 -.89 1.759 -1.516 2.121 -1.879z" />
                                <path d="M19 18v.01" />
                            </svg>
                        </span> Add Location
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="addLocation" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel"> <span
                                            class="nav-link-icon d-md-none d-lg-inline-block">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round"
                                                class="icon icon-tabler icons-tabler-outline icon-tabler-map-2">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path d="M12 18.5l-3 -1.5l-6 3v-13l6 -3l6 3l6 -3v7.5" />
                                                <path d="M9 4v13" />
                                                <path d="M15 7v5.5" />
                                                <path
                                                    d="M21.121 20.121a3 3 0 1 0 -4.242 0c.418 .419 1.125 1.045 2.121 1.879c1.051 -.89 1.759 -1.516 2.121 -1.879z" />
                                                <path d="M19 18v.01" />
                                            </svg>
                                        </span> Add Location
                                    </h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form method="POST" action="{{ route('lokasi-presensi.store') }}">
                                        @csrf

                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-floating mb-3">
                                                    <input type="text" name="nama_lokasi" class="form-control"
                                                        id="floatingInput" placeholder="Please Input Name Location">
                                                    <label for="floatingInput">Name Location</label>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-floating mb-3">
                                                    <textarea class="form-control" name="alamat_lokasi" placeholder="Please Input Address Location" id="floatingTextarea"></textarea>
                                                    <label for="floatingTextarea">Address Location</label>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-floating mb-3">
                                                    <input type="text" name="latitude" class="form-control"
                                                        id="floatingInput" placeholder="Please Input Latitude">
                                                    <label for="floatingInput">Latitude</label>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-floating mb-3">
                                                    <input type="text" name="longitude" class="form-control"
                                                        id="floatingInput" placeholder="Please Input Longitude">
                                                    <label for="floatingInput">Longitude</label>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-floating mb-3">
                                                    <input type="text" name="radius" class="form-control"
                                                        id="floatingInput" placeholder="Please Input Radius">
                                                    <label for="floatingInput">Radius</label>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <select class="form-select mb-3" name="zona_waktu">
                                                    <option value="">-- Please Select Time Zone --</option>
                                                    <option value="WIB">WIB</option>
                                                    <option value="WITA">WITA</option>
                                                    <option value="WIT">WIT</option>
                                                </select>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-floating mb-3">
                                                    <input type="time" name="jam_masuk" class="form-control"
                                                        id="floatingInput" placeholder="Please Input Time In">
                                                    <label for="floatingInput">Time In</label>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-floating mb-3">
                                                    <input type="time" name="jam_pulang" class="form-control"
                                                        id="floatingInput" placeholder="Please Input Time Out">
                                                    <label for="floatingInput">Time Out</label>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Button Add Location -->
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Save Location</button>
                                        </div>

                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary float-end" id="filter-location" data-bs-toggle="modal"
                        data-bs-target="#exampleModal">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-search">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0" />
                                <path d="M21 21l-6 -6" />
                            </svg></span> Filter Location
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Filter Location</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form id="lokasi-form">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="floatingInput"
                                                placeholder="Masukan Nama Lokasi">
                                            <label for="floatingInput">Name</label>
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary">Filter Location</button>
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
                                            Name Location
                                        </button>
                                    </th>
                                    <th>
                                        <button class="table-sort" data-sort="sort-name">
                                            Address
                                        </button>
                                    </th>
                                    <th>
                                        <button class="table-sort" data-sort="sort-name">
                                            Latitude/Longitude
                                        </button>
                                    </th>
                                    <th>
                                        <button class="table-sort" data-sort="sort-name">
                                            Radius
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
                                @forelse ($locations as $location)
                                    <tr>
                                        <td class="sort-city">
                                            {{ $no++ }}
                                        </td>
                                        <td class="sort-city">
                                            {{ $location->nama_lokasi }}
                                        </td>
                                        <td class="sort-city">
                                            {{ $location->alamat_lokasi }}
                                        </td>
                                        <td class="sort-city">
                                            {{ $location->latitude }}/{{ $location->longitude }}
                                        </td>
                                        <td class="sort-city">
                                            {{ $location->radius }}
                                        </td>
                                        <td class="sort-city">
                                            <button type="button" class="btn btn-sm btn-primary btn-edit rounded-pill"
                                                data-bs-toggle="modal" data-bs-target="#editLocation-{{ $location->id }}">
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
                                            <div class="modal fade" id="editLocation-{{ $location->id }}" tabindex="-1"
                                                aria-labelledby="editLocationLabel-{{ $location->id }}"
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
                                                                Update Location
                                                            </h1>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form method="POST"
                                                                action="{{ route('lokasi-presensi.update', $location->id) }}">
                                                                @csrf
                                                                @method('PUT')

                                                                <div class="row">
                                                                    <div class="col-12">
                                                                        <div class="form-floating mb-3">
                                                                            <input type="text" name="nama_lokasi"
                                                                                class="form-control" id="floatingInput"
                                                                                value="{{ $location->nama_lokasi }}">
                                                                            <label for="floatingInput">
                                                                                Name Location
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12">
                                                                        <div class="form-floating mb-3">
                                                                            <textarea class="form-control" name="alamat_lokasi" id="floatingTextarea">{{ $location->alamat_lokasi }}</textarea>
                                                                            <label for="floatingTextarea">
                                                                                Address Location
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12">
                                                                        <div class="form-floating mb-3">
                                                                            <input type="text" name="latitude"
                                                                                class="form-control" id="floatingInput"
                                                                                value="{{ $location->latitude }}">
                                                                            <label for="floatingInput">Latitude</label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12">
                                                                        <div class="form-floating mb-3">
                                                                            <input type="text" name="longitude"
                                                                                class="form-control" id="floatingInput"
                                                                                value="{{ $location->longitude }}">
                                                                            <label for="floatingInput">Longitude</label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12">
                                                                        <div class="form-floating mb-3">
                                                                            <input type="text" name="radius"
                                                                                class="form-control" id="floatingInput"
                                                                                value="{{ $location->radius }}">
                                                                            <label for="floatingInput">Radius</label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12">
                                                                        <select class="form-select mb-3" name="zona_waktu">
                                                                            <option value="WIB"
                                                                                {{ $location->zona_waktu == 'WIB' ? 'selected' : '' }}>
                                                                                WIB
                                                                            </option>
                                                                            <option value="WITA"
                                                                                {{ $location->zona_waktu == 'WITA' ? 'selected' : '' }}>
                                                                                WITA
                                                                            </option>
                                                                            <option value="WIT"
                                                                                {{ $location->zona_waktu == 'WIT' ? 'selected' : '' }}>
                                                                                WIT
                                                                            </option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="col-12">
                                                                        <div class="form-floating mb-3">
                                                                            <input type="time" name="jam_masuk"
                                                                                class="form-control" id="floatingInput"
                                                                                value="{{ \Carbon\Carbon::parse($location->jam_masuk)->format('H:i') }}">
                                                                            <label for="floatingInput">Time In</label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12">
                                                                        <div class="form-floating mb-3">
                                                                            <input type="time" name="jam_pulang"
                                                                                class="form-control" id="floatingInput"
                                                                                value="{{ \Carbon\Carbon::parse($location->jam_pulang)->format('H:i') }}">
                                                                            <label for="floatingInput">Time Out</label>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <!-- Button Update Location -->
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-bs-dismiss="modal">Close</button>
                                                                    <button type="submit" class="btn btn-primary">
                                                                        Update Location
                                                                    </button>
                                                                </div>

                                                            </form>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                            <form action="{{ route('lokasi-presensi.destroy', $location->id) }}"
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
