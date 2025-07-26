@extends('admin.layouts.index')

@section('content')
    <!-- BEGIN PAGE HEADER -->
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <h2 class="page-title">Dashboard</h2>
                </div>
            </div>
        </div>
    </div>
    <!-- END PAGE HEADER -->

    <!-- BEGIN PAGE BODY -->
    <div class="page-body">
        <div class="container-xl">
            <div class="row row-deck row-cards">
                <!-- Cards Summary -->
                @php
                    $summary = [
                        ['title' => 'Total Karyawan Aktif', 'value' => $user, 'color' => 'primary', 'icon' => 'user'],
                        ['title' => 'Total Hadir', 'value' => $hadir, 'color' => 'green', 'icon' => 'user-check'],
                        ['title' => 'Total Alpa', 'value' => $alpa, 'color' => 'x', 'icon' => 'user-x'],
                        ['title' => 'Total Sakit, Izin, & Cuti', 'value' => $sakit + $izin + $cuti, 'color' => 'facebook', 'icon' => 'user-minus']
                    ];
                @endphp

                @foreach ($summary as $item)
                    <div class="col-sm-6 col-lg-3">
                        <div class="card card-sm">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-auto">
                                        <span class="bg-{{ $item['color'] }} text-white avatar">
                                            <x-tabler-icon :name="$item['icon']" />
                                        </span>
                                    </div>
                                    <div class="col">
                                        <div class="font-weight-medium">{{ $item['title'] }}</div>
                                        <div class="text-secondary">{{ $item['value'] }} Karyawan</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

                <!-- Chart -->
                <div class="col-md-12 mt-4">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Grafik Kehadiran Karyawan</h3>
                        </div>
                        <div class="card-body">
                            <canvas id="attendanceChart" class="position-relative w-100" style="height: 200px;"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Include Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- Chart Script -->
    <script>
        const ctx = document.getElementById('attendanceChart').getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Hadir', 'Sakit', 'Izin', 'Cuti', 'Alpa'],
                datasets: [{
                    label: 'Jumlah Karyawan',
                    data: [{{ $hadir }}, {{ $sakit }}, {{ $izin }}, {{ $cuti }}, {{ $alpa }}],
                    backgroundColor: [
                        '#28a74566', // Hadir
                        '#dc354566', // Sakit
                        '#ffc10766', // Izin
                        '#17a2b866', // Cuti
                        '#6f42c166'  // Alpa
                    ],
                    borderColor: [
                        '#28a745',
                        '#dc3545',
                        '#ffc107',
                        '#17a2b8',
                        '#6f42c1'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Jumlah Karyawan'
                        }
                    }
                },
                plugins: {
                    legend: {
                        display: true,
                        position: 'top',
                    },
                    title: {
                        display: true,
                        text: 'Kehadiran Karyawan Bulan Ini'
                    }
                }
            }
        });
    </script>
@endsection
