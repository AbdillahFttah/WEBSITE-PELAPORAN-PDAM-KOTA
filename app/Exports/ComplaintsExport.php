<?php

namespace App\Exports;

use App\Models\Complaint;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ComplaintsExport implements FromCollection, WithHeadings
{
    protected int $month;
    protected int $year;

    public function __construct(int $month, int $year)
    {
        $this->month = $month;
        $this->year = $year;
    }

    public function collection()
    {
        return Complaint::whereMonth('tanggal', $this->month)
            ->whereYear('tanggal', $this->year)
            ->orderBy('id', 'asc')
            ->get()
            ->values()
            ->map(function ($complaint, $index) {
                return [
                    'no' => $index + 1,
                    'no_meter' => $complaint->no_meter,
                    'nama_pelapor' => $complaint->nama_pelapor,
                    'alamat' => $complaint->alamat,
                    'keterangan' => $complaint->keterangan,
                    'tanggal_laporan_masuk' => optional($complaint->tanggal)->format('d-m-Y'),
                    'tanggal_diselesaikan' => $complaint->tanggal_selesai
                        ? $complaint->tanggal_selesai->format('d-m-Y H:i')
                        : '',
                    'bagian' => $complaint->bagian
                        ? ucfirst($complaint->bagian)
                        : '',
                    'penyelesaian' => $complaint->penyelesaian,
                ];
            });
    }

    public function headings(): array
    {
        return [
            'No',
            'Nomor Meter',
            'Nama Pelapor',
            'Alamat',
            'Keterangan Keluhan',
            'Tanggal Laporan Masuk',
            'Tanggal Diselesaikan',
            'Bagian',
            'Penyelesaian',
        ];
    }
}