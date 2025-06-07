@extends('admin.layouts.index')
@section('content')

<!-- BEGIN PAGE HEADER -->
<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
                <!-- Page pre-title -->
                <h2 class="page-title"> <span class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler.io/icons/icon/home -->
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-users-group">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M10 13a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                            <path d="M8 21v-1a2 2 0 0 1 2 -2h4a2 2 0 0 1 2 2v1" />
                            <path d="M15 5a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                            <path d="M17 10h2a2 2 0 0 1 2 2v1" />
                            <path d="M5 5a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                            <path d="M3 13v-1a2 2 0 0 1 2 -2h2" />
                        </svg></span> Karyawan</h2>
            </div>
            <!-- Page title actions -->
        </div>
    </div>
</div>
<!-- END PAGE HEADER -->
<!-- BEGIN PAGE BODY -->
<div class="page-body">
    <div class="container-xl">
        <div class="card">
            <div class="card-body p-0">
                <div id="table-default" class="table-responsive">
                    <table id="karyawan" class="table table-karyawan">
                        <thead>
                            <tr>
                                <th><button class="table-sort" data-sort="sort-name">Photo</button></th>
                                <th><button class="table-sort" data-sort="sort-city">Name</button></th>
                                <th><button class="table-sort" data-sort="sort-type">Position</button></th>
                                <th><button class="table-sort" data-sort="sort-score">Gender</button></th>
                                <th><button class="table-sort" data-sort="sort-date">Address</button></th>
                            </tr>
                        </thead>
                        <tbody class="table-tbody">
                            <tr>
                                <td class="sort-city">Cedar Point, United States</td>
                                <td class="sort-type">RMC Hybrid</td>
                                <td class="sort-score">100,0%</td>
                                <td class="sort-date" data-date="1733615799">December 08, 2024</td>
                                <td class="sort-quantity">74</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection