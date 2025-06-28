<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Rekap_Presensi_Bulanan_{{ $Karyawan->name }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 11px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 6px;
            text-align: center;
        }

        thead {
            background-color: #f2f2f2;
        }

        h3 {
            margin-bottom: 0;
        }

        .info {
            font-size: 12px;
        }
    </style>
</head>

<body>
    <h3>Rekap Presensi Bulanan {{ $Karyawan->name }}</h3>
    <p class="info">
        Periode: {{ \Carbon\Carbon::createFromDate($tahun, $bulan)->translatedFormat('F Y') }}
    </p>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Jam Masuk</th>
                <th>Jam Keluar</th>
                <th>Total Jam</th>
                <th>Terlambat</th>
            </tr>
        </thead>
        <tbody>
            @forelse($data as $i => $row)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>{{ \Carbon\Carbon::parse($row->tanggal_masuk)->translatedFormat('d F Y') }}</td>
                    <td>{{ $row->jam_masuk ? \Carbon\Carbon::parse($row->jam_masuk)->format('H:i:s') : '-' }}</td>
                    <td>{{ $row->jam_keluar ? \Carbon\Carbon::parse($row->jam_keluar)->format('H:i:s') : '-' }}</td>
                    <td>
                        @if ($row->jam_masuk && $row->jam_keluar)
                            {{ \Carbon\Carbon::parse($row->jam_masuk)->diff(\Carbon\Carbon::parse($row->jam_keluar))->format('%h Jam %i Menit') }}
                        @else
                            -
                        @endif
                    </td>
                    <td>
                        @php
                            $terlambat = '0 Jam 0 Menit';
                            if ($row->jam_masuk && $row->lokasiPresensi) {
                                $ideal = \Carbon\Carbon::parse($row->lokasiPresensi->jam_masuk);
                                $masuk = \Carbon\Carbon::parse($row->jam_masuk);
                                if ($masuk->gt($ideal)) {
                                    $terlambat = $ideal->diff($masuk)->format('%h Jam %i Menit');
                                }
                            }
                        @endphp
                        {{ $terlambat }}
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6">Tidak ada data.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>

</html>
