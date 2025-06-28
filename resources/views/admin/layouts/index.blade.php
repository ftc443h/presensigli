<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>PT. Global Lintas Iramada</title>

    <link rel="icon" type="image/x-icon" href="{{ asset('admin/assets/img/logo/logo.png') }}" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- BEGIN PAGE LEVEL STYLES -->
    <link href="{{ asset('admin/assets/libs/jsvectormap/dist/jsvectormap.css?1744816593') }}" rel="stylesheet" />
    <!-- END PAGE LEVEL STYLES -->
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="{{ asset('admin/assets/css/tabler.css?1744816593') }}" rel="stylesheet" />
    <!-- END GLOBAL MANDATORY STYLES -->
    <!-- BEGIN PLUGINS STYLES -->
    <link href="{{ asset('admin/assets/css/tabler-flags.css?1744816593') }}" rel="stylesheet" />
    <link href="{{ asset('admin/assets/css/tabler-socials.css?1744816593') }}" rel="stylesheet" />
    <link href="{{ asset('admin/assets/css/tabler-payments.css?1744816593') }}" rel="stylesheet" />
    <link href="{{ asset('admin/assets/css/tabler-vendors.css?1744816593') }}" rel="stylesheet" />
    <link href="{{ asset('admin/assets/css/tabler-marketing.css?1744816593') }}" rel="stylesheet" />
    <link href="{{ asset('admin/assets/css/tabler-themes.css?1744816593') }}" rel="stylesheet" />
    <!-- END PLUGINS STYLES -->
    <!-- BEGIN DEMO STYLES -->
    <link href="{{ asset('admin/assets/preview/css/demo.css?1744816593') }}" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('admin/assets/css/custome.css') }}">

    <link href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@4/dark.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- CSS -->
    {{-- <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script> --}}
    
    <!-- END DEMO STYLES -->

    <!-- OTHER PACKAGE CSS Icon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/v4-shims.min.css">

    <!-- OTHER PACKAGE -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

        
    <!-- BEGIN CUSTOM FONT -->
    <style>
        @import url("https://rsms.me/inter/inter.css");
    </style>
    <!-- END CUSTOM FONT -->

    <!-- SWEET ALERT -->
    {{-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> --}}
    <!-- DATATABLES -->
    <link href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.dataTables.min.css" rel="stylesheet" />
    <!-- END DATATABLES -->
</head>

<body data-success="{{ session('success') }}" data-error="{{ session('error') }}">
    <!-- BEGIN GLOBAL THEME SCRIPT -->
    <script src="{{ asset('admin/assets/js/tabler-theme.min.js?1744816593') }}"></script>
    <!-- END GLOBAL THEME SCRIPT -->
    <div class="page">
        <!-- BEGIN NAVBAR  -->
        <header class="navbar navbar-expand-md d-print-none" id="nav-sidebar">

            <!-- Sidebar Start -->
            @include('admin.layouts.sidebar.index')
            <!-- Sidebar End -->

        </header>
        <header class="navbar-expand-md">

            <!-- Navbar Start -->
            @include('admin.layouts.navbar.index')
            <!-- Navbar End -->

        </header>
        <!-- END NAVBAR  -->
        <div class="page-wrapper">

            <!-- Dashboard Start -->
            @yield('content')
            <!-- Dashboard End -->

            <!-- Footer Start -->
            @include('admin.layouts.footer.index')
            <!-- Footer End -->

        </div>
    </div>
    <!-- BEGIN PAGE MODALS -->
    <div class="modal modal-blur fade" id="modal-report" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">New report</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Name</label>
                        <input type="text" class="form-control" name="example-text-input"
                            placeholder="Your report name" />
                    </div>
                    <label class="form-label">Report type</label>
                    <div class="form-selectgroup-boxes row mb-3">
                        <div class="col-lg-6">
                            <label class="form-selectgroup-item">
                                <input type="radio" name="report-type" value="1" class="form-selectgroup-input"
                                    checked />
                                <span class="form-selectgroup-label d-flex align-items-center p-3">
                                    <span class="me-3">
                                        <span class="form-selectgroup-check"></span>
                                    </span>
                                    <span class="form-selectgroup-label-content">
                                        <span class="form-selectgroup-title strong mb-1">Simple</span>
                                        <span class="d-block text-secondary">Provide only basic data needed for the
                                            report</span>
                                    </span>
                                </span>
                            </label>
                        </div>
                        <div class="col-lg-6">
                            <label class="form-selectgroup-item">
                                <input type="radio" name="report-type" value="1"
                                    class="form-selectgroup-input" />
                                <span class="form-selectgroup-label d-flex align-items-center p-3">
                                    <span class="me-3">
                                        <span class="form-selectgroup-check"></span>
                                    </span>
                                    <span class="form-selectgroup-label-content">
                                        <span class="form-selectgroup-title strong mb-1">Advanced</span>
                                        <span class="d-block text-secondary">Insert charts and additional advanced
                                            analyses to be inserted in the report</span>
                                    </span>
                                </span>
                            </label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="mb-3">
                                <label class="form-label">Report url</label>
                                <div class="input-group input-group-flat">
                                    <span class="input-group-text"> https://tabler.io/reports/ </span>
                                    <input type="text" class="form-control ps-0" value="report-01"
                                        autocomplete="off" />
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="mb-3">
                                <label class="form-label">Visibility</label>
                                <select class="form-select">
                                    <option value="1" selected>Private</option>
                                    <option value="2">Public</option>
                                    <option value="3">Hidden</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label">Client name</label>
                                <input type="text" class="form-control" />
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label">Reporting period</label>
                                <input type="date" class="form-control" />
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div>
                                <label class="form-label">Additional information</label>
                                <textarea class="form-control" rows="3"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="#" class="btn btn-link link-secondary btn-3" data-bs-dismiss="modal"> Cancel </a>
                    <a href="#" class="btn btn-primary btn-5 ms-auto" data-bs-dismiss="modal">
                        <!-- Download SVG icon from http://tabler.io/icons/icon/plus -->
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="icon icon-2">
                            <path d="M12 5l0 14" />
                            <path d="M5 12l14 0" />
                        </svg>
                        Create new report
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- END PAGE MODALS -->

    <!-- BEGIN PAGE LIBRARIES -->
    <script src="{{ asset('admin/assets/libs/apexcharts/dist/apexcharts.min.js?1744816593') }}" defer></script>
    <script src="{{ asset('admin/assets/libs/jsvectormap/dist/jsvectormap.min.js?1744816593') }}" defer></script>
    <script src="{{ asset('admin/assets/libs/jsvectormap/dist/maps/world.js?1744816593') }}" defer></script>
    <script src="{{ asset('admin/assets/libs/jsvectormap/dist/maps/world-merc.js?1744816593') }}" defer></script>
    <!-- END PAGE LIBRARIES -->
    <!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
    <script src="{{ asset('admin/assets/js/tabler.min.js?1744816593') }}" defer></script>
    <!-- END GLOBAL MANDATORY SCRIPTS -->
    <!-- BEGIN DEMO SCRIPTS -->
    <script src="{{ asset('admin/assets/preview/js/demo.min.js?1744816593') }}" defer></script>
    <!-- END DEMO SCRIPTS -->

    <!-- DATATABLES SCRIPTS -->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
    <!-- END DATATABLES SCRIPTS -->
    
    <!-- BEGIN PAGE SCRIPTS -->

    @yield('scripts')

    {{-- <script>
        document.addEventListener("DOMContentLoaded", function() {
            window.ApexCharts &&
                new ApexCharts(document.getElementById("chart-revenue-bg"), {
                    chart: {
                        type: "area",
                        fontFamily: "inherit",
                        height: 40,
                        sparkline: {
                            enabled: true,
                        },
                        animations: {
                            enabled: false,
                        },
                    },
                    dataLabels: {
                        enabled: false,
                    },
                    fill: {
                        colors: ["color-mix(in srgb, transparent, var(--tblr-primary) 16%)",
                            "color-mix(in srgb, transparent, var(--tblr-primary) 16%)"
                        ],
                        type: "solid",
                    },
                    stroke: {
                        width: 2,
                        lineCap: "round",
                        curve: "smooth",
                    },
                    series: [{
                        name: "Profits",
                        data: [37, 35, 44, 28, 36, 24, 65, 31, 37, 39, 62, 51, 35, 41, 35, 27, 93, 53,
                            61, 27, 54, 43, 19, 46, 39, 62, 51, 35, 41, 67
                        ],
                    }, ],
                    tooltip: {
                        theme: "dark",
                    },
                    grid: {
                        strokeDashArray: 4,
                    },
                    xaxis: {
                        labels: {
                            padding: 0,
                        },
                        tooltip: {
                            enabled: false,
                        },
                        axisBorder: {
                            show: false,
                        },
                        type: "datetime",
                    },
                    yaxis: {
                        labels: {
                            padding: 4,
                        },
                    },
                    labels: [
                        "2020-06-20",
                        "2020-06-21",
                        "2020-06-22",
                        "2020-06-23",
                        "2020-06-24",
                        "2020-06-25",
                        "2020-06-26",
                        "2020-06-27",
                        "2020-06-28",
                        "2020-06-29",
                        "2020-06-30",
                        "2020-07-01",
                        "2020-07-02",
                        "2020-07-03",
                        "2020-07-04",
                        "2020-07-05",
                        "2020-07-06",
                        "2020-07-07",
                        "2020-07-08",
                        "2020-07-09",
                        "2020-07-10",
                        "2020-07-11",
                        "2020-07-12",
                        "2020-07-13",
                        "2020-07-14",
                        "2020-07-15",
                        "2020-07-16",
                        "2020-07-17",
                        "2020-07-18",
                        "2020-07-19",
                    ],
                    colors: ["color-mix(in srgb, transparent, var(--tblr-primary) 100%)"],
                    legend: {
                        show: false,
                    },
                }).render();
        });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            window.ApexCharts &&
                new ApexCharts(document.getElementById("chart-new-clients"), {
                    chart: {
                        type: "line",
                        fontFamily: "inherit",
                        height: 40,
                        sparkline: {
                            enabled: true,
                        },
                        animations: {
                            enabled: false,
                        },
                    },
                    stroke: {
                        width: [2, 1],
                        dashArray: [0, 3],
                        lineCap: "round",
                        curve: "smooth",
                    },
                    series: [{
                            name: "May",
                            data: [37, 35, 44, 28, 36, 24, 65, 31, 37, 39, 62, 51, 35, 41, 35, 27, 93, 53,
                                61, 27, 54, 43, 4, 46, 39, 62, 51, 35, 41, 67
                            ],
                        },
                        {
                            name: "April",
                            data: [93, 54, 51, 24, 35, 35, 31, 67, 19, 43, 28, 36, 62, 61, 27, 39, 35, 41,
                                27, 35, 51, 46, 62, 37, 44, 53, 41, 65, 39, 37
                            ],
                        },
                    ],
                    tooltip: {
                        theme: "dark",
                    },
                    grid: {
                        strokeDashArray: 4,
                    },
                    xaxis: {
                        labels: {
                            padding: 0,
                        },
                        tooltip: {
                            enabled: false,
                        },
                        type: "datetime",
                    },
                    yaxis: {
                        labels: {
                            padding: 4,
                        },
                    },
                    labels: [
                        "2020-06-20",
                        "2020-06-21",
                        "2020-06-22",
                        "2020-06-23",
                        "2020-06-24",
                        "2020-06-25",
                        "2020-06-26",
                        "2020-06-27",
                        "2020-06-28",
                        "2020-06-29",
                        "2020-06-30",
                        "2020-07-01",
                        "2020-07-02",
                        "2020-07-03",
                        "2020-07-04",
                        "2020-07-05",
                        "2020-07-06",
                        "2020-07-07",
                        "2020-07-08",
                        "2020-07-09",
                        "2020-07-10",
                        "2020-07-11",
                        "2020-07-12",
                        "2020-07-13",
                        "2020-07-14",
                        "2020-07-15",
                        "2020-07-16",
                        "2020-07-17",
                        "2020-07-18",
                        "2020-07-19",
                    ],
                    colors: ["color-mix(in srgb, transparent, var(--tblr-primary) 100%)",
                        "color-mix(in srgb, transparent, var(--tblr-gray-600) 100%)"
                    ],
                    legend: {
                        show: false,
                    },
                }).render();
        });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            window.ApexCharts &&
                new ApexCharts(document.getElementById("chart-active-users"), {
                    chart: {
                        type: "bar",
                        fontFamily: "inherit",
                        height: 40,
                        sparkline: {
                            enabled: true,
                        },
                        animations: {
                            enabled: false,
                        },
                    },
                    plotOptions: {
                        bar: {
                            columnWidth: "50%",
                        },
                    },
                    dataLabels: {
                        enabled: false,
                    },
                    series: [{
                        name: "Profits",
                        data: [37, 35, 44, 28, 36, 24, 65, 31, 37, 39, 62, 51, 35, 41, 35, 27, 93, 53,
                            61, 27, 54, 43, 19, 46, 39, 62, 51, 35, 41, 67
                        ],
                    }, ],
                    tooltip: {
                        theme: "dark",
                    },
                    grid: {
                        strokeDashArray: 4,
                    },
                    xaxis: {
                        labels: {
                            padding: 0,
                        },
                        tooltip: {
                            enabled: false,
                        },
                        axisBorder: {
                            show: false,
                        },
                        type: "datetime",
                    },
                    yaxis: {
                        labels: {
                            padding: 4,
                        },
                    },
                    labels: [
                        "2020-06-20",
                        "2020-06-21",
                        "2020-06-22",
                        "2020-06-23",
                        "2020-06-24",
                        "2020-06-25",
                        "2020-06-26",
                        "2020-06-27",
                        "2020-06-28",
                        "2020-06-29",
                        "2020-06-30",
                        "2020-07-01",
                        "2020-07-02",
                        "2020-07-03",
                        "2020-07-04",
                        "2020-07-05",
                        "2020-07-06",
                        "2020-07-07",
                        "2020-07-08",
                        "2020-07-09",
                        "2020-07-10",
                        "2020-07-11",
                        "2020-07-12",
                        "2020-07-13",
                        "2020-07-14",
                        "2020-07-15",
                        "2020-07-16",
                        "2020-07-17",
                        "2020-07-18",
                        "2020-07-19",
                    ],
                    colors: ["color-mix(in srgb, transparent, var(--tblr-primary) 100%)"],
                    legend: {
                        show: false,
                    },
                }).render();
        });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            window.ApexCharts &&
                new ApexCharts(document.getElementById("chart-mentions"), {
                    chart: {
                        type: "bar",
                        fontFamily: "inherit",
                        height: 240,
                        parentHeightOffset: 0,
                        toolbar: {
                            show: false,
                        },
                        animations: {
                            enabled: false,
                        },
                        stacked: true,
                    },
                    plotOptions: {
                        bar: {
                            columnWidth: "50%",
                        },
                    },
                    dataLabels: {
                        enabled: false,
                    },
                    series: [{
                            name: "Web",
                            data: [1, 0, 0, 0, 0, 1, 1, 0, 0, 0, 2, 12, 5, 8, 22, 6, 8, 6, 4, 1, 8, 24, 29,
                                51, 40, 47, 23, 26, 50, 26, 41, 22, 46, 47, 81, 46, 6
                            ],
                        },
                        {
                            name: "Social",
                            data: [2, 5, 4, 3, 3, 1, 4, 7, 5, 1, 2, 5, 3, 2, 6, 7, 7, 1, 5, 5, 2, 12, 4, 6,
                                18, 3, 5, 2, 13, 15, 20, 47, 18, 15, 11, 10, 0
                            ],
                        },
                        {
                            name: "Other",
                            data: [2, 9, 1, 7, 8, 3, 6, 5, 5, 4, 6, 4, 1, 9, 3, 6, 7, 5, 2, 8, 4, 9, 1, 2,
                                6, 7, 5, 1, 8, 3, 2, 3, 4, 9, 7, 1, 6
                            ],
                        },
                    ],
                    tooltip: {
                        theme: "dark",
                    },
                    grid: {
                        padding: {
                            top: -20,
                            right: 0,
                            left: -4,
                            bottom: -4,
                        },
                        strokeDashArray: 4,
                        xaxis: {
                            lines: {
                                show: true,
                            },
                        },
                    },
                    xaxis: {
                        labels: {
                            padding: 0,
                        },
                        tooltip: {
                            enabled: false,
                        },
                        axisBorder: {
                            show: false,
                        },
                        type: "datetime",
                    },
                    yaxis: {
                        labels: {
                            padding: 4,
                        },
                    },
                    labels: [
                        "2020-06-20",
                        "2020-06-21",
                        "2020-06-22",
                        "2020-06-23",
                        "2020-06-24",
                        "2020-06-25",
                        "2020-06-26",
                        "2020-06-27",
                        "2020-06-28",
                        "2020-06-29",
                        "2020-06-30",
                        "2020-07-01",
                        "2020-07-02",
                        "2020-07-03",
                        "2020-07-04",
                        "2020-07-05",
                        "2020-07-06",
                        "2020-07-07",
                        "2020-07-08",
                        "2020-07-09",
                        "2020-07-10",
                        "2020-07-11",
                        "2020-07-12",
                        "2020-07-13",
                        "2020-07-14",
                        "2020-07-15",
                        "2020-07-16",
                        "2020-07-17",
                        "2020-07-18",
                        "2020-07-19",
                        "2020-07-20",
                        "2020-07-21",
                        "2020-07-22",
                        "2020-07-23",
                        "2020-07-24",
                        "2020-07-25",
                        "2020-07-26",
                    ],
                    colors: [
                        "color-mix(in srgb, transparent, var(--tblr-primary) 100%)",
                        "color-mix(in srgb, transparent, var(--tblr-primary) 80%)",
                        "color-mix(in srgb, transparent, var(--tblr-green) 80%)",
                    ],
                    legend: {
                        show: false,
                    },
                }).render();
        });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const map = new jsVectorMap({
                selector: "#map-world",
                map: "world",
                backgroundColor: "transparent",
                regionStyle: {
                    initial: {
                        fill: "var(--tblr-bg-surface-secondary)",
                        stroke: "var(--tblr-border-color)",
                        strokeWidth: 2,
                    },
                },
                zoomOnScroll: false,
                zoomButtons: false,
                series: {
                    regions: [{
                        attribute: "fill",
                        scale: {
                            scale1: "color-mix(in srgb, transparent, var(--tblr-primary) 10%)",
                            scale2: "color-mix(in srgb, transparent, var(--tblr-primary) 20%)",
                            scale3: "color-mix(in srgb, transparent, var(--tblr-primary) 30%)",
                            scale4: "color-mix(in srgb, transparent, var(--tblr-primary) 40%)",
                            scale5: "color-mix(in srgb, transparent, var(--tblr-primary) 50%)",
                            scale6: "color-mix(in srgb, transparent, var(--tblr-primary) 60%)",
                            scale7: "color-mix(in srgb, transparent, var(--tblr-primary) 70%)",
                            scale8: "color-mix(in srgb, transparent, var(--tblr-primary) 80%)",
                            scale9: "color-mix(in srgb, transparent, var(--tblr-primary) 90%)",
                            scale10: "color-mix(in srgb, transparent, var(--tblr-primary) 100%)",
                        },
                        values: {
                            AF: "scale2",
                            AL: "scale2",
                            DZ: "scale4",
                            AO: "scale3",
                            AG: "scale1",
                            AR: "scale5",
                            AM: "scale1",
                            AU: "scale7",
                            AT: "scale5",
                            AZ: "scale3",
                            BS: "scale1",
                            BH: "scale2",
                            BD: "scale4",
                            BB: "scale1",
                            BY: "scale3",
                            BE: "scale5",
                            BZ: "scale1",
                            BJ: "scale1",
                            BT: "scale1",
                            BO: "scale2",
                            BA: "scale2",
                            BW: "scale2",
                            BR: "scale8",
                            BN: "scale2",
                            BG: "scale2",
                            BF: "scale1",
                            BI: "scale1",
                            KH: "scale2",
                            CM: "scale2",
                            CA: "scale7",
                            CV: "scale1",
                            CF: "scale1",
                            TD: "scale1",
                            CL: "scale4",
                            CN: "scale9",
                            CO: "scale5",
                            KM: "scale1",
                            CD: "scale2",
                            CG: "scale2",
                            CR: "scale2",
                            CI: "scale2",
                            HR: "scale3",
                            CY: "scale2",
                            CZ: "scale4",
                            DK: "scale5",
                            DJ: "scale1",
                            DM: "scale1",
                            DO: "scale3",
                            EC: "scale3",
                            EG: "scale5",
                            SV: "scale2",
                            GQ: "scale2",
                            ER: "scale1",
                            EE: "scale2",
                            ET: "scale2",
                            FJ: "scale1",
                            FI: "scale5",
                            FR: "scale8",
                            GA: "scale2",
                            GM: "scale1",
                            GE: "scale2",
                            DE: "scale8",
                            GH: "scale2",
                            GR: "scale5",
                            GD: "scale1",
                            GT: "scale2",
                            GN: "scale1",
                            GW: "scale1",
                            GY: "scale1",
                            HT: "scale1",
                            HN: "scale2",
                            HK: "scale5",
                            HU: "scale4",
                            IS: "scale2",
                            IN: "scale7",
                            ID: "scale6",
                            IR: "scale5",
                            IQ: "scale3",
                            IE: "scale5",
                            IL: "scale5",
                            IT: "scale8",
                            JM: "scale2",
                            JP: "scale9",
                            JO: "scale2",
                            KZ: "scale4",
                            KE: "scale2",
                            KI: "scale1",
                            KR: "scale6",
                            KW: "scale4",
                            KG: "scale1",
                            LA: "scale1",
                            LV: "scale2",
                            LB: "scale2",
                            LS: "scale1",
                            LR: "scale1",
                            LY: "scale3",
                            LT: "scale2",
                            LU: "scale3",
                            MK: "scale1",
                            MG: "scale1",
                            MW: "scale1",
                            MY: "scale5",
                            MV: "scale1",
                            ML: "scale1",
                            MT: "scale1",
                            MR: "scale1",
                            MU: "scale1",
                            MX: "scale7",
                            MD: "scale1",
                            MN: "scale1",
                            ME: "scale1",
                            MA: "scale3",
                            MZ: "scale2",
                            MM: "scale2",
                            NA: "scale2",
                            NP: "scale2",
                            NL: "scale6",
                            NZ: "scale4",
                            NI: "scale1",
                            NE: "scale1",
                            NG: "scale5",
                            NO: "scale5",
                            OM: "scale3",
                            PK: "scale4",
                            PA: "scale2",
                            PG: "scale1",
                            PY: "scale2",
                            PE: "scale4",
                            PH: "scale4",
                            PL: "scale10",
                            PT: "scale5",
                            QA: "scale4",
                            RO: "scale4",
                            RU: "scale7",
                            RW: "scale1",
                            WS: "scale1",
                            ST: "scale1",
                            SA: "scale5",
                            SN: "scale2",
                            RS: "scale2",
                            SC: "scale1",
                            SL: "scale1",
                            SG: "scale5",
                            SK: "scale3",
                            SI: "scale2",
                            SB: "scale1",
                            ZA: "scale5",
                            ES: "scale7",
                            LK: "scale2",
                            KN: "scale1",
                            LC: "scale1",
                            VC: "scale1",
                            SD: "scale3",
                            SR: "scale1",
                            SZ: "scale1",
                            SE: "scale5",
                            CH: "scale6",
                            SY: "scale3",
                            TW: "scale5",
                            TJ: "scale1",
                            TZ: "scale2",
                            TH: "scale5",
                            TL: "scale1",
                            TG: "scale1",
                            TO: "scale1",
                            TT: "scale2",
                            TN: "scale2",
                            TR: "scale6",
                            TM: "scale1",
                            UG: "scale2",
                            UA: "scale4",
                            AE: "scale5",
                            GB: "scale8",
                            US: "scale10",
                            UY: "scale2",
                            UZ: "scale2",
                            VU: "scale1",
                            VE: "scale5",
                            VN: "scale4",
                            YE: "scale2",
                            ZM: "scale2",
                            ZW: "scale1",
                        },
                    }, ],
                },
            });
            window.addEventListener("resize", () => {
                map.updateSize();
            });
        });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            window.ApexCharts &&
                new ApexCharts(document.getElementById("sparkline-activity"), {
                    chart: {
                        type: "radialBar",
                        fontFamily: "inherit",
                        height: 40,
                        width: 40,
                        animations: {
                            enabled: false,
                        },
                        sparkline: {
                            enabled: true,
                        },
                    },
                    tooltip: {
                        enabled: false,
                    },
                    plotOptions: {
                        radialBar: {
                            hollow: {
                                margin: 0,
                                size: "75%",
                            },
                            track: {
                                margin: 0,
                            },
                            dataLabels: {
                                show: false,
                            },
                        },
                    },
                    colors: ["var(--tblr-primary)"],
                    series: [35],
                }).render();
        });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            window.ApexCharts &&
                new ApexCharts(document.getElementById("chart-development-activity"), {
                    chart: {
                        type: "area",
                        fontFamily: "inherit",
                        height: 192,
                        sparkline: {
                            enabled: true,
                        },
                        animations: {
                            enabled: false,
                        },
                    },
                    dataLabels: {
                        enabled: false,
                    },
                    fill: {
                        colors: ["color-mix(in srgb, transparent, var(--tblr-primary) 16%)",
                            "color-mix(in srgb, transparent, var(--tblr-primary) 16%)"
                        ],
                        type: "solid",
                    },
                    stroke: {
                        width: 2,
                        lineCap: "round",
                        curve: "smooth",
                    },
                    series: [{
                        name: "Purchases",
                        data: [3, 5, 4, 6, 7, 5, 6, 8, 24, 7, 12, 5, 6, 3, 8, 4, 14, 30, 17, 19, 15, 14,
                            25, 32, 40, 55, 60, 48, 52, 70
                        ],
                    }, ],
                    tooltip: {
                        theme: "dark",
                    },
                    grid: {
                        strokeDashArray: 4,
                    },
                    xaxis: {
                        labels: {
                            padding: 0,
                        },
                        tooltip: {
                            enabled: false,
                        },
                        axisBorder: {
                            show: false,
                        },
                        type: "datetime",
                    },
                    yaxis: {
                        labels: {
                            padding: 4,
                        },
                    },
                    labels: [
                        "2020-06-20",
                        "2020-06-21",
                        "2020-06-22",
                        "2020-06-23",
                        "2020-06-24",
                        "2020-06-25",
                        "2020-06-26",
                        "2020-06-27",
                        "2020-06-28",
                        "2020-06-29",
                        "2020-06-30",
                        "2020-07-01",
                        "2020-07-02",
                        "2020-07-03",
                        "2020-07-04",
                        "2020-07-05",
                        "2020-07-06",
                        "2020-07-07",
                        "2020-07-08",
                        "2020-07-09",
                        "2020-07-10",
                        "2020-07-11",
                        "2020-07-12",
                        "2020-07-13",
                        "2020-07-14",
                        "2020-07-15",
                        "2020-07-16",
                        "2020-07-17",
                        "2020-07-18",
                        "2020-07-19",
                    ],
                    colors: ["color-mix(in srgb, transparent, var(--tblr-primary) 100%)"],
                    legend: {
                        show: false,
                    },
                    point: {
                        show: false,
                    },
                }).render();
        });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            window.ApexCharts &&
                new ApexCharts(document.getElementById("sparkline-bounce-rate-1"), {
                    chart: {
                        type: "line",
                        fontFamily: "inherit",
                        height: 24,
                        animations: {
                            enabled: false,
                        },
                        sparkline: {
                            enabled: true,
                        },
                    },
                    tooltip: {
                        enabled: false,
                    },
                    stroke: {
                        width: 2,
                        lineCap: "round",
                    },
                    series: [{
                        color: "var(--tblr-primary)",
                        data: [17, 24, 20, 10, 5, 1, 4, 18, 13],
                    }, ],
                }).render();
        });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            window.ApexCharts &&
                new ApexCharts(document.getElementById("sparkline-bounce-rate-2"), {
                    chart: {
                        type: "line",
                        fontFamily: "inherit",
                        height: 24,
                        animations: {
                            enabled: false,
                        },
                        sparkline: {
                            enabled: true,
                        },
                    },
                    tooltip: {
                        enabled: false,
                    },
                    stroke: {
                        width: 2,
                        lineCap: "round",
                    },
                    series: [{
                        color: "var(--tblr-primary)",
                        data: [13, 11, 19, 22, 12, 7, 14, 3, 21],
                    }, ],
                }).render();
        });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            window.ApexCharts &&
                new ApexCharts(document.getElementById("sparkline-bounce-rate-3"), {
                    chart: {
                        type: "line",
                        fontFamily: "inherit",
                        height: 24,
                        animations: {
                            enabled: false,
                        },
                        sparkline: {
                            enabled: true,
                        },
                    },
                    tooltip: {
                        enabled: false,
                    },
                    stroke: {
                        width: 2,
                        lineCap: "round",
                    },
                    series: [{
                        color: "var(--tblr-primary)",
                        data: [10, 13, 10, 4, 17, 3, 23, 22, 19],
                    }, ],
                }).render();
        });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            window.ApexCharts &&
                new ApexCharts(document.getElementById("sparkline-bounce-rate-4"), {
                    chart: {
                        type: "line",
                        fontFamily: "inherit",
                        height: 24,
                        animations: {
                            enabled: false,
                        },
                        sparkline: {
                            enabled: true,
                        },
                    },
                    tooltip: {
                        enabled: false,
                    },
                    stroke: {
                        width: 2,
                        lineCap: "round",
                    },
                    series: [{
                        color: "var(--tblr-primary)",
                        data: [6, 15, 13, 13, 5, 7, 17, 20, 19],
                    }, ],
                }).render();
        });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            window.ApexCharts &&
                new ApexCharts(document.getElementById("sparkline-bounce-rate-5"), {
                    chart: {
                        type: "line",
                        fontFamily: "inherit",
                        height: 24,
                        animations: {
                            enabled: false,
                        },
                        sparkline: {
                            enabled: true,
                        },
                    },
                    tooltip: {
                        enabled: false,
                    },
                    stroke: {
                        width: 2,
                        lineCap: "round",
                    },
                    series: [{
                        color: "var(--tblr-primary)",
                        data: [2, 11, 15, 14, 21, 20, 8, 23, 18, 14],
                    }, ],
                }).render();
        });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            window.ApexCharts &&
                new ApexCharts(document.getElementById("sparkline-bounce-rate-6"), {
                    chart: {
                        type: "line",
                        fontFamily: "inherit",
                        height: 24,
                        animations: {
                            enabled: false,
                        },
                        sparkline: {
                            enabled: true,
                        },
                    },
                    tooltip: {
                        enabled: false,
                    },
                    stroke: {
                        width: 2,
                        lineCap: "round",
                    },
                    series: [{
                        color: "var(--tblr-primary)",
                        data: [22, 12, 7, 14, 3, 21, 8, 23, 18, 14],
                    }, ],
                }).render();
        });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var themeConfig = {
                theme: "light",
                "theme-base": "gray",
                "theme-font": "sans-serif",
                "theme-primary": "blue",
                "theme-radius": "1",
            };
            var url = new URL(window.location);
            var form = document.getElementById("offcanvasSettings");
            var resetButton = document.getElementById("reset-changes");
            var checkItems = function() {
                for (var key in themeConfig) {
                    var value = window.localStorage["tabler-" + key] || themeConfig[key];
                    if (!!value) {
                        var radios = form.querySelectorAll(`[name="${key}"]`);
                        if (!!radios) {
                            radios.forEach((radio) => {
                                radio.checked = radio.value === value;
                            });
                        }
                    }
                }
            };
            form.addEventListener("change", function(event) {
                var target = event.target,
                    name = target.name,
                    value = target.value;
                for (var key in themeConfig) {
                    if (name === key) {
                        document.documentElement.setAttribute("data-bs-" + key, value);
                        window.localStorage.setItem("tabler-" + key, value);
                        url.searchParams.set(key, value);
                    }
                }
                window.history.pushState({}, "", url);
            });
            resetButton.addEventListener("click", function() {
                for (var key in themeConfig) {
                    var value = themeConfig[key];
                    document.documentElement.removeAttribute("data-bs-" + key);
                    window.localStorage.removeItem("tabler-" + key);
                    url.searchParams.delete(key);
                }
                checkItems();
                window.history.pushState({}, "", url);
            });
            checkItems();
        });
    </script> --}}
    <!-- END PAGE SCRIPTS -->

    <!-- SWEET ALERT -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- ALERT -->
    <script>
        // validation
        @if ($errors->any())
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 5000,
                timerProgressBar: true,
            });

            @foreach ($errors->all() as $error)
                Toast.fire({
                    icon: 'error',
                    title: '{{ $error }}',
                });
            @endforeach
        @endif

        // Success message
        @if (session('success'))
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 5000,
                timerProgressBar: true,
            });


            Toast.fire({
                icon: 'success',
                title: '{{ session('success') }}',
            });
        @endif

        // Error processing
        @if (session('error'))
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 5000,
                timerProgressBar: true,
            });


            Toast.fire({
                icon: 'error',
                title: '{{ session('error') }}',
            });
        @endif

        // confirmation delete
        document.querySelectorAll('.btn-delete').forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault(); // Jangan langsung submit form

                const form = this.closest('form');

                Swal.fire({
                    title: "Yakin hapus?",
                    text: "Data yang sudah dihapus tidak bisa dikembalikan!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Ya, hapus!",
                    cancelButtonText: "Batal"
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    </script>
</body>

</html>
