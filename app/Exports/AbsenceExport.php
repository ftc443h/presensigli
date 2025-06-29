<?php

namespace App\Exports;

use Carbon\Carbon;
use App\Models\Ketidakhadiran;
use Illuminate\Support\Collection;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Style\Border;
use Maatwebsite\Excel\Concerns\WithHeadings;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class AbsenceExport implements FromCollection, WithHeadings, WithStyles, ShouldAutoSize
{
    protected $startDate;
    protected $endDate;

    public function __construct($startDate, $endDate)
    {
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }

    public function collection(): Collection
    {
        Carbon::setLocale('id');

        $absence = Ketidakhadiran::with('karyawan')
            ->whereBetween('tanggal', [$this->startDate, $this->endDate])
            ->orderBy('tanggal', 'desc')
            ->get();

        return $absence->map(function ($a, $i) {
            return [
                $i + 1,
                $a->karyawan->nip,
                $a->karyawan->name,
                Carbon::parse($a->tanggal)->translatedFormat('d F Y'),
                $a->keterangan,
                $a->deskripsi,
                strtoupper($a->status_pengajuan),
            ];
        });
    }

    public function headings(): array
    {
        return [
            'No',
            'NIP',
            'Nama',
            'Tanggal',
            'Keterangan',
            'Deskripsi',
            'Status Pengajuan'
        ];
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
