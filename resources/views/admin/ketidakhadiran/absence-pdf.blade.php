<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>
        Ketidakhadiran_Periode_{{ \Carbon\Carbon::parse($startDate)->translatedFormat('d F Y') }}-{{ \Carbon\Carbon::parse($endDate)->translatedFormat('d F Y') }}
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

        .badge {
            padding: 0.5em 1em;
            border-radius: 0.5em;
            color: #fff;
            font-size: 0.875em;
        }

        .bg-warning {
            background-color: #ffc107;
            color: #212529;
        }

        .bg-success {
            background-color: #28a745;
            color: #fff;
        }

        .bg-danger {
            background-color: #dc3545;
            color: #fff;
        }

        .bg-secondary {
            background-color: #6c757d;
            color: #fff;
        }

        .badge-pill {
            border-radius: 50px;
        }

        .text-dark {
            color: #212529;
        }
    </style>
</head>

<body>
    <h3>Ketidakhadiran Karyawan</h3>
    <p class="info">Periode: {{ \Carbon\Carbon::parse($startDate)->translatedFormat('d F Y') }} -
        {{ \Carbon\Carbon::parse($endDate)->translatedFormat('d F Y') }}</p>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>NIP</th>
                <th>Nama</th>
                <th>Tanggal</th>
                <th>Keterangan</th>
                <th>Deskripsi</th>
                <th>Status Pengajuan</th>
            </tr>
        </thead>
        <tbody>
            @forelse($data as $i => $row)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>{{ $row->karyawan->nip }}</td>
                    <td>{{ $row->karyawan->name }}</td>
                    <td>{{ \Carbon\Carbon::parse($row->tanggal)->translatedFormat('d F Y') }}</td>
                    <td>{{ $row->keterangan }}</td>
                    <td>{{ $row->deskripsi }}</td>
                    <td>
                        @if ($row->status_pengajuan == 'pending')
                            <span class="badge bg-warning text-dark badge-pill">PENDING</span>
                        @elseif ($row->status_pengajuan == 'approved')
                            <span class="badge bg-success badge-pill">APPROVED</span>
                        @elseif ($row->status_pengajuan == 'rejected')
                            <span class="badge bg-danger badge-pill">REJECTED</span>
                        @else
                            <span class="badge bg-secondary badge-pill">UNKNOWN</span>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7">Tidak ada data.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>

</html>