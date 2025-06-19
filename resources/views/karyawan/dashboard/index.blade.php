@extends('admin.layouts.index')
@section('content')
    <!-- BEGIN PAGE HEADER -->
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <!-- Page pre-title -->
                    {{-- <div class="page-pretitle">Overview</div> --}}
                    <h2 class="page-title">Dashboard</h2>
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
                <div class="col-md-2"></div>
                <div class="col-md-4">
                    <div class="card text-center">
                        <div class="card-header">Presensi Masuk</div>
                        <div class="card-body">
                            <div id="date-in" class="fs-2"></div>
                            <div id="time-in" class="fs-1 fw-bolder"></div>
                            <form action="" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-primary mt-3">Masuk</button>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card text-center">
                        <div class="card-header">Presensi Keluar</div>
                        <div class="card-body">
                            <div id="date-out" class="fs-2"></div>
                            <div id="time-out" class="fs-1 fw-bolder"></div>
                            <form action="" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-danger mt-3">Keluar</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-2"></div>
            </div>
        </div>
    </div>

    <script>
        function updateClock() {
            const now = new Date();

            const dateOptions = {
                day: '2-digit',
                month: 'long',
                year: 'numeric'
            };
            const timeOptions = {
                hour: '2-digit',
                minute: '2-digit',
                second: '2-digit',
                hour12: false
            };

            const date = now.toLocaleDateString('id-ID', dateOptions);
            const time = now.toLocaleTimeString('en-GB', timeOptions);

            document.getElementById('date-in').innerText = date;
            document.getElementById('time-in').innerText = time;

            document.getElementById('date-out').innerText = date;
            document.getElementById('time-out').innerText = time;
        }

        setInterval(updateClock, 1000);
        updateClock();
    </script>
@endsection
