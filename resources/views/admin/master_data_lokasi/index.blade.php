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
                                                        id="lokasiInput" placeholder="Please Input Name Location">
                                                    <label for="lokasiInput">Name Location</label>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-floating mb-3">
                                                    <textarea class="form-control" name="alamat_lokasi" placeholder="Please Input Address Location" id="addressTextarea"></textarea>
                                                    <label for="addressTextarea">Address Location</label>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-floating mb-3">
                                                    <input type="text" name="latitude" class="form-control"
                                                        id="latitudeInput" placeholder="Please Input Latitude">
                                                    <label for="latitudeInput">Latitude</label>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-floating mb-3">
                                                    <input type="text" name="longitude" class="form-control"
                                                        id="longitudeInput" placeholder="Please Input Longitude">
                                                    <label for="longitudeInput">Longitude</label>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-floating mb-3">
                                                    <input type="text" name="radius" class="form-control"
                                                        id="radiusInput" placeholder="Please Input Radius">
                                                    <label for="radiusInput">Radius</label>
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
                                                        id="timeInInput" placeholder="Please Input Time In">
                                                    <label for="timeInInput">Time In</label>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-floating mb-3">
                                                    <input type="time" name="jam_pulang" class="form-control"
                                                        id="timeOutInput" placeholder="Please Input Time Out">
                                                    <label for="timeOutInput">Time Out</label>
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
                        data-bs-target="#filterLocation">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-search">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0" />
                                <path d="M21 21l-6 -6" />
                            </svg>
                        </span> Filter Location
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="filterLocation" tabindex="-1" aria-labelledby="filterLocationLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="filterLocationLabel">Filter Location</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form id="lokasi-form">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="filterLokasi"
                                                name="nama_lokasi" placeholder="Masukan Nama Lokasi">
                                            <label for="filterLokasi">Name</label>
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary" form="lokasi-form">
                                        Filter Location
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card mt-3">
                <div class="card-body">
                    <div id="table-default" class="table-responsive">
                        <table id="datatable-location" class="table table-vcenter card-table table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Name Location</th>
                                    <th>Address</th>
                                    <th>Latitude/Longitude</th>
                                    <th>Radius</th>
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
    <div class="modal fade" id="editLocation" tabindex="-1" aria-labelledby="editLocationLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content" id="editLocationContent">
                {{-- Isi modal akan dimuat via Ajax --}}
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            let table = $('#datatable-location').DataTable({
                responsive: true,
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('lokasi-presensi.data') }}",
                    data: function(d) {
                        d.nama_lokasi = $('#filterLokasi').val();
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
                        data: 'nama_lokasi',
                        name: 'nama_lokasi',
                        className: 'text-center'
                    },
                    {
                        data: 'alamat_lokasi',
                        name: 'alamat_lokasi',
                        className: 'text-center'
                    },
                    {
                        data: 'latlng',
                        name: 'latlng',
                        className: 'text-center',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'radius',
                        name: 'radius',
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
            $('#lokasi-form').on('submit', function(e) {
                e.preventDefault();
                table.ajax.reload();
                $('#filterLocation').modal('hide');
            });

            // Tambahan: tombol filter juga bisa trigger submit form
            $('[form="lokasi-form"]').on('click', function() {
                $('#lokasi-form').submit();
            });

            // Handle edit button click
            $(document).on('click', '.btn-edit', function() {
                let locationId = $(this).data('id');
                $.ajax({
                    url: `/master-data/lokasi-presensi/${locationId}/edit`,
                    type: 'GET',
                    success: function(data) {
                        $('#editLocationContent').html(data);
                        $('#editLocation').modal('show');
                    },
                    error: function(xhr) {
                        console.error('Error fetching location data:', xhr);
                        Swal.fire({
                            title: 'Error!',
                            text: 'Failed to load location data. Please try again.',
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    }
                });
            });
        });
    </script>
@endsection
