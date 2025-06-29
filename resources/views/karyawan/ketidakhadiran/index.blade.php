@extends('karyawan.layouts.index')
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
                                class="icon icon-tabler icons-tabler-outline icon-tabler-alert-square-rounded">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M12 3c7.2 0 9 1.8 9 9s-1.8 9 -9 9s-9 -1.8 -9 -9s1.8 -9 9 -9z" />
                                <path d="M12 8v4" />
                                <path d="M12 16h.01" />
                            </svg>
                        </span> Ketidakhadiran
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
                    <button type="button" class="btn btn-primary" id="add-absence" data-bs-toggle="modal"
                        data-bs-target="#addAbsence">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round"
                                class="icon icon-tabler icons-tabler-outline icon-tabler-clipboard-plus">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path
                                    d="M9 5h-2a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-12a2 2 0 0 0 -2 -2h-2" />
                                <path d="M9 3m0 2a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v0a2 2 0 0 1 -2 2h-2a2 2 0 0 1 -2 -2z" />
                                <path d="M10 14h4" />
                                <path d="M12 12v4" />
                            </svg>
                        </span> Add Absence
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="addAbsence" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">
                                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round"
                                                class="icon icon-tabler icons-tabler-outline icon-tabler-alert-square-rounded">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path d="M12 3c7.2 0 9 1.8 9 9s-1.8 9 -9 9s-9 -1.8 -9 -9s1.8 -9 9 -9z" />
                                                <path d="M12 8v4" />
                                                <path d="M12 16h.01" />
                                            </svg>
                                        </span> Add Absence
                                    </h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form method="POST" action="{{ route('ketidakhadiran.store') }}"
                                        enctype="multipart/form-data">
                                        @csrf

                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-floating mb-3">
                                                    <input type="date" name="tanggal" class="form-control"
                                                        id="floatingInput" placeholder="Please Input Absence Date">
                                                    <label for="floatingInput">Absence Date</label>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <select class="form-select mb-3" name="keterangan">
                                                    <option value="">-- Please Select Reason for Absence --</option>
                                                    <option value="Cuti">Cuti</option>
                                                    <option value="Izin">Izin</option>
                                                    <option value="Sakit">Sakit</option>
                                                </select>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-floating mb-3">
                                                    <textarea class="form-control" name="deskripsi" placeholder="Please Input Absence Description" id="floatingTextarea"></textarea>
                                                    <label for="floatingTextarea">Absence Description</label>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-floating mb-3">
                                                    <input type="file" name="file" class="form-control"
                                                        id="floatingInput">
                                                    <label for="floatingInput">Attachment</label>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Button Add Absence -->
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Save Absence</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary float-end" id="filter-absence" data-bs-toggle="modal"
                        data-bs-target="#filterAbsence">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-search">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0" />
                                <path d="M21 21l-6 -6" />
                            </svg></span> Filter Absence
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="filterAbsence" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form id="filter-form">
                                        <div class="form-floating mb-3">
                                            <input type="date" class="form-control" id="dateFilter" name="tanggal"
                                                placeholder="Enter Absence Date">
                                            <label for="dateFilter">Absence Date</label>
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary" form="filter-form">Filter
                                        Absence</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card mt-3">
                <div class="card-body">
                    <div id="table-default" class="table-responsive">
                        <table id="employee-absence" class="table table-vcenter card-table table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Date</th>
                                    <th>Reason</th>
                                    <th>Description</th>
                                    <th>Attachment</th>
                                    <th>Status</th>
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
    <div class="modal fade" id="editAbsenceModal" tabindex="-1" aria-labelledby="editAbsenceModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content" id="editAbsenceModalContent">
                {{-- Isi modal akan dimuat via Ajax --}}
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            let table = $('#employee-absence').DataTable({
                responsive: true,
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{{ route('ketidakhadiran.data') }}',
                    data: function(d) {
                        d.tanggal = $('#dateFilter').val();
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
                        data: 'tanggal',
                        name: 'tanggal',
                        className: 'text-center'
                    },
                    {
                        data: 'keterangan',
                        name: 'keterangan',
                        className: 'text-center'
                    },
                    {
                        data: 'deskripsi',
                        name: 'deskripsi',
                        className: 'text-center'
                    },
                    {
                        data: 'file',
                        name: 'file',
                        className: 'text-center',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'status_pengajuan',
                        name: 'status_pengajuan',
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
            $('#filter-form').on('submit', function(e) {
                e.preventDefault();
                table.ajax.reload();
                $('#filterAbsence').modal('hide');
            });

            // Tambahan: tombol filter juga bisa trigger submit form
            $('[form="filter-form"]').on('click', function() {
                $('#filter-form').submit();
            });

            // Handle edit button click
            $(document).on('click', '.btn-edit', function() {
                let absenceId = $(this).data('id');
                $.ajax({
                    url: `/ketidakhadiran/ketidakhadiran/${absenceId}/edit`,
                    type: 'GET',
                    success: function(data) {
                        $('#editAbsenceModalContent').html(data);
                        $('#editAbsenceModal').modal('show');
                    },
                    error: function(xhr) {
                        console.error('Error fetching absence data:', xhr);
                        Swal.fire({
                            title: 'Error!',
                            text: 'Failed to load absence data. Please try again.',
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    }
                });
            });
        });
    </script>
@endsection
