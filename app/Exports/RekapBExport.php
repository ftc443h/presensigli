<?php

namespace App\Exports;

use App\Models\Presensi;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;

class RekapBExport implements FromCollection, WithHeadings, WithStyles, ShouldAutoSize
{
    protected $bulan;
    protected $tahun;

    public function __construct($bulan, $tahun)
    {
        $this->bulan = $bulan;
        $this->tahun = $tahun;
    }

    public function collection(): Collection
    {
        \Carbon\Carbon::setLocale('id');

        $presensis = Presensi::with('lokasiPresensi', 'karyawan')
            ->whereMonth('tanggal_masuk', $this->bulan)
            ->whereYear('tanggal_masuk', $this->tahun)
            ->orderBy('tanggal_masuk', 'desc')
            ->get();

        return $presensis->map(function ($p, $i) {
            $jamMasuk = $p->jam_masuk ? \Carbon\Carbon::parse($p->jam_masuk)->format('H:i:s') : '-';
            $jamKeluar = $p->jam_keluar ? \Carbon\Carbon::parse($p->jam_keluar)->format('H:i:s') : '-';
            $totalJam = ($p->jam_masuk && $p->jam_keluar)
                ? \Carbon\Carbon::parse($p->jam_masuk)->diff(\Carbon\Carbon::parse($p->jam_keluar))->format('%h Jam %i Menit')
                : '-';

            $terlambat = '0 Jam 0 Menit';
            if ($p->jam_masuk && $p->lokasiPresensi) {
                $ideal = \Carbon\Carbon::parse($p->lokasiPresensi->jam_masuk);
                $masuk = \Carbon\Carbon::parse($p->jam_masuk);
                if ($masuk->gt($ideal)) {
                    $terlambat = $ideal->diff($masuk)->format('%h Jam %i Menit');
                }
            }

            return [
                $i + 1,
                $p->karyawan->nip,
                $p->karyawan->name,
                \Carbon\Carbon::parse($p->tanggal_masuk)->translatedFormat('d F Y'),
                $jamMasuk,
                $jamKeluar,
                $totalJam,
                $terlambat,
            ];
        });
    }

    public function headings(): array
    {
        return ['No', 'NIP', 'Nama', 'Tanggal', 'Jam Masuk', 'Jam Keluar', 'Total Jam', 'Terlambat'];
    }

    public function styles(Worksheet $sheet)
    {
        $lastRow = $sheet->getHighestRow();
        $lastColumn = $sheet->getHighestColumn();
        $range = "A1:{$lastColumn}{$lastRow}";

        $sheet->getStyle($range)->applyFromArray([
            'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                ]
            ]
        ]);

        $sheet->getStyle('A1:' . $lastColumn . '1')->applyFromArray([
            'font' => ['bold' => true],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['argb' => 'FFEFEFEF']
            ]
        ]);

        return [];
    }
}
