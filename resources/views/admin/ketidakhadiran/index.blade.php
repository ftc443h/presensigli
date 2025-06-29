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
                <div class="col-md-6">
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary" id="export-absenceSummary" data-bs-toggle="modal"
                        data-bs-target="#exportAbsenceSummary">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="currentColor" class="icon icon-tabler icons-tabler-filled icon-tabler-file-download">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path
                                    d="M12 2l.117 .007a1 1 0 0 1 .876 .876l.007 .117v4l.005 .15a2 2 0 0 0 1.838 1.844l.157 .006h4l.117 .007a1 1 0 0 1 .876 .876l.007 .117v9a3 3 0 0 1 -2.824 2.995l-.176 .005h-10a3 3 0 0 1 -2.995 -2.824l-.005 -.176v-14a3 3 0 0 1 2.824 -2.995l.176 -.005zm0 8a1 1 0 0 0 -1 1v3.585l-.793 -.792a1 1 0 0 0 -1.32 -.083l-.094 .083a1 1 0 0 0 0 1.414l2.5 2.5l.044 .042l.068 .055l.11 .071l.114 .054l.105 .035l.15 .03l.116 .006l.117 -.007l.117 -.02l.108 -.033l.081 -.034l.098 -.052l.092 -.064l.094 -.083l2.5 -2.5a1 1 0 0 0 0 -1.414l-.094 -.083a1 1 0 0 0 -1.32 .083l-.793 .791v-3.584a1 1 0 0 0 -.883 -.993zm2.999 -7.001l4.001 4.001h-4z" />
                            </svg>
                        </span> Export Absence
                    </button>

                    <!-- Modal Export Format -->
                    <div class="modal fade" id="exportAbsenceSummary" tabindex="-1"
                        aria-labelledby="exportAbsenceSummaryLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <form id="exportForm" method="GET" target="_blank">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Export Absence</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>

                                    <div class="modal-body">
                                        <div class="form-floating mb-3">
                                            <label for="start_date">Start Date</label>
                                            <input type="date" id="start_date" name="start_date" class="form-control"
                                                required>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <label for="end_date">End Date</label>
                                            <input type="date" id="end_date" name="end_date" class="form-control"
                                                required>
                                        </div>

                                        <div class="text-center">
                                            <button type="submit" class="btn btn-success me-2" id="exportExcel">
                                                <i class="fas fa-file-excel me-1"></i> Export Excel
                                            </button>
                                            <button type="submit" class="btn btn-danger" id="exportPdf">
                                                <i class="fas fa-file-pdf me-1"></i> Export PDF
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- End Modal Export Format -->
                </div>
                <div class="col-md-6">
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
                                            <select class="form-select mb-3" name="keterangan" id="statusFilter">
                                                <option value="">-- Please Select Status for Absence --</option>
                                                <option value="Pending">Pending</option>
                                                <option value="Approved">Approved</option>
                                                <option value="Rejected">Rejected</option>
                                            </select>
                                            <label for="statusFilter">Status for Absence</label>
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary" form="filter-form">
                                        Filter Absence
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
                        <table id="datatable-absence" class="table table-vcenter card-table table-striped w-100">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
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

    <script>
        $(document).ready(function() {
            let table = $('#datatable-absence').DataTable({
                responsive: true,
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{{ route('ketidakhadiran.admin.data') }}',
                    data: function(d) {
                        d.keterangan = $('#statusFilter').val();
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
                        data: 'name',
                        name: 'karyawan.name',
                        className: 'text-center'
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


            // Handle export modal
            let exportForm = $('#exportForm');

            $('#exportExcel').on('click', function(e) {
                e.preventDefault();

                let startDate = $('#start_date').val();
                let endDate = $('#end_date').val();

                if (startDate && endDate) {
                    exportForm.attr('action', '{{ route('ketidakhadiran.admin.export.excel') }}');
                    exportForm.attr('target', '_blank');
                    exportForm.submit();
                    $('#exportAbsenceSummary').modal('hide');
                } else {
                    Swal.fire({
                        title: 'Error!',
                        text: 'Please select both start and end dates.',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                }
            });

            $('#exportPdf').on('click', function(e) {
                e.preventDefault();

                let startDate = $('#start_date').val();
                let endDate = $('#end_date').val();

                if (startDate && endDate) {
                    exportForm.attr('action', '{{ route('ketidakhadiran.admin.export.pdf') }}');
                    exportForm.attr('target', '_blank');
                    exportForm.submit();
                    $('#exportAbsenceSummary').modal('hide');
                } else {
                    Swal.fire({
                        title: 'Error!',
                        text: 'Please select both start and end dates.',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                }
            });
        });
    </script>
@endsection
