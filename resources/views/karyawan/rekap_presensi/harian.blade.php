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
                                stroke-linejoin="round" class="icon icon-tabler icon-tabler-calendar-month">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M4 7h16" />
                                <path d="M10 3v4" />
                                <path d="M14 3v4" />
                                <path d="M5 11h14v10h-14z" />
                            </svg>
                        </span> Rekap Presensi Harian
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
            <div class="row mb-3">
                <div class="col-md-6">
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary" id="export-attendanceSummary" data-bs-toggle="modal"
                        data-bs-target="#exportAttendanceSummary">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="currentColor" class="icon icon-tabler icons-tabler-filled icon-tabler-file-download">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path
                                    d="M12 2l.117 .007a1 1 0 0 1 .876 .876l.007 .117v4l.005 .15a2 2 0 0 0 1.838 1.844l.157 .006h4l.117 .007a1 1 0 0 1 .876 .876l.007 .117v9a3 3 0 0 1 -2.824 2.995l-.176 .005h-10a3 3 0 0 1 -2.995 -2.824l-.005 -.176v-14a3 3 0 0 1 2.824 -2.995l.176 -.005zm0 8a1 1 0 0 0 -1 1v3.585l-.793 -.792a1 1 0 0 0 -1.32 -.083l-.094 .083a1 1 0 0 0 0 1.414l2.5 2.5l.044 .042l.068 .055l.11 .071l.114 .054l.105 .035l.15 .03l.116 .006l.117 -.007l.117 -.02l.108 -.033l.081 -.034l.098 -.052l.092 -.064l.094 -.083l2.5 -2.5a1 1 0 0 0 0 -1.414l-.094 -.083a1 1 0 0 0 -1.32 .083l-.793 .791v-3.584a1 1 0 0 0 -.883 -.993zm2.999 -7.001l4.001 4.001h-4z" />
                            </svg>
                        </span> Export Attendance Summary
                    </button>

                    <!-- Modal Export Format -->
                    <div class="modal fade" id="exportAttendanceSummary" tabindex="-1"
                        aria-labelledby="exportAttendanceSummaryLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">
                                        Choose Export Format
                                    </h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div id="export-loading" class="d-none mb-3">
                                    <div class="spinner-border text-primary" role="status">
                                        <span class="visually-hidden">Loading...</span>
                                    </div>
                                    <p class="mt-2">Sedang menyiapkan file...</p>
                                </div>
                                <div id="export-buttons" class="modal-body text-center">
                                    <button type="button" class="btn btn-success me-2" id="exportExcel">
                                        <i class="fas fa-file-excel me-1"></i> Export Excel
                                    </button>
                                    <button type="button" class="btn btn-danger" id="exportPdf">
                                        <i class="fas fa-file-pdf me-1"></i> Export PDF
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Modal Export Format -->

                </div>
                <div class="col-md-6">
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary" id="filter-attendanceSummary" data-bs-toggle="modal"
                        data-bs-target="#filterAttendanceSummary">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-search">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0" />
                                <path d="M21 21l-6 -6" />
                            </svg>
                        </span> Filter Attendance Summary
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="filterAttendanceSummary" tabindex="-1"
                        aria-labelledby="filterAttendanceSummaryLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="filterAttendanceSummaryLabel">Filter Attendance Summary
                                    </h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form id="filter-form">
                                        <div class="form-floating mb-3">
                                            <input type="date" class="form-control" id="jam_masuk">
                                            <label for="jam_masuk">Date Start</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input type="date" class="form-control" id="jam_keluar">
                                            <label for="jam_keluar">Date End</label>
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary" form="filter-form">Filter
                                        Attendance</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- TABLE -->
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="rp-harian-karyawan"
                            class="table table-bordered table-striped table-hover w-100 text-center">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Date</th>
                                    <th>Clock In</th>
                                    <th>Clock Out</th>
                                    <th>Hours Worked</th>
                                    <th>Late Duration</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- SCRIPT DATATABLES -->
    <script>
        $(document).ready(function() {
            let table = $('#rp-harian-karyawan').DataTable({
                responsive: true,
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{{ route('rekap-harian.karyawan.data') }}',
                    data: function(d) {
                        d.start_date = $('#jam_masuk').val();
                        d.end_date = $('#jam_keluar').val();
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
                        data: 'jam_masuk',
                        name: 'jam_masuk',
                        className: 'text-center'
                    },
                    {
                        data: 'jam_keluar',
                        name: 'jam_keluar',
                        className: 'text-center'
                    },
                    {
                        data: 'total_jam',
                        name: 'total_jam',
                        className: 'text-center',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'terlambat',
                        name: 'terlambat',
                        className: 'text-center',
                        orderable: false,
                        searchable: false
                    },
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

            // Submit Filter
            $('#filter-form').on('submit', function(e) {
                e.preventDefault();
                table.ajax.reload();
                $('#filterAttendanceSummary').modal('hide');
            });

            // Tambahan: tombol filter juga bisa trigger submit form
            $('[form="filter-form"]').on('click', function() {
                $('#filter-form').submit();
            });

            // EXPORT HANDLER
            function showExportLoading() {
                $('#export-buttons').addClass('d-none');
                $('#export-loading').removeClass('d-none');
            }

            function hideExportModal() {
                setTimeout(() => {
                    $('#exportAttendanceSummary').modal('hide');
                    $('#export-buttons').removeClass('d-none');
                    $('#export-loading').addClass('d-none');
                }, 800); // waktu tampil spinner
            }

            function exportData(format) {
                showExportLoading();

                const start = $('#jam_masuk').val();
                const end = $('#jam_keluar').val();
                const baseRoutes = {
                    excel: '{{ route('rekap-harian.karyawan.export.excel') }}',
                    pdf: '{{ route('rekap-harian.karyawan.export.pdf') }}'
                };

                const url = `${baseRoutes[format]}?start_date=${start}&end_date=${end}`;
                window.open(url, '_blank');

                hideExportModal();
            }

            $('#exportExcel').on('click', function(e) {
                e.preventDefault();
                exportData('excel');
            });

            $('#exportPdf').on('click', function(e) {
                e.preventDefault();
                exportData('pdf');
            });

        });
    </script>
@endsection
