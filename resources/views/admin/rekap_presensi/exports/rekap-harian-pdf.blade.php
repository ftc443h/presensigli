<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>
        Rekap_Presensi_Harian_Periode_{{ \Carbon\Carbon::parse($startDate)->translatedFormat('d F Y') }}-{{ \Carbon\Carbon::parse($endDate)->translatedFormat('d F Y') }}
    </title>
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
    <h3>Rekap Presensi Harian</h3>
    <p class="info">Periode: {{ \Carbon\Carbon::parse($startDate)->translatedFormat('d F Y') }} -
        {{ \Carbon\Carbon::parse($endDate)->translatedFormat('d F Y') }}</p>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>NIP</th>
                <th>Nama</th>
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
                    <td>{{ $row->karyawan->nip }}</td>
                    <td>{{ $row->karyawan->name }}</td>
                    <td>{{ \Carbon\Carbon::parse($row->tanggal_masuk)->translatedFormat('d F Y') }}</td>
                    <td>{{ \Carbon\Carbon::parse($row->jam_masuk)->format('H:i:s') }}</td>
                    <td>{{ $row->jam_keluar ? \Carbon\Carbon::parse($row->jam_keluar)->format('H:i:s') : '-' }}</td>
                    <td>
                        @if ($row->jam_keluar)
                            {{ \Carbon\Carbon::parse($row->jam_masuk)->diff(\Carbon\Carbon::parse($row->jam_keluar))->format('%h Jam %i Menit') }}
                        @else
                            -
                        @endif
                    </td>
                    <td>
                        @php
                            $ideal = \Carbon\Carbon::parse($row->lokasiPresensi->jam_masuk);
                            $masuk = \Carbon\Carbon::parse($row->jam_masuk);
                        @endphp
                        {{ $masuk->gt($ideal) ? $ideal->diff($masuk)->format('%h Jam %i Menit') : '0 Jam 0 Menit' }}
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
