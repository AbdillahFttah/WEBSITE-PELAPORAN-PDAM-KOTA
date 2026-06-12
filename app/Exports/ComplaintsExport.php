<?php

namespace App\Exports;

use App\Models\Complaint;
use Illuminate\Support\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ComplaintsExport implements FromCollection, WithHeadings
{
    protected array $filters;

    public function __construct(array $filters = [])
    {
        $this->filters = $filters;
    }

    public function collection()
    {
        $query = Complaint::query();

        if (!empty($this->filters['nama_pelapor'])) {
            $query->where('nama_pelapor', 'like', '%' . $this->filters['nama_pelapor'] . '%');
        }

        if (!empty($this->filters['bulan'])) {
            $date = Carbon::createFromFormat('Y-m', $this->filters['bulan']);

            $query->whereYear('tanggal', $date->year)
                  ->whereMonth('tanggal', $date->month);
        }

        if (!empty($this->filters['status'])) {
            $query->where('status', $this->filters['status']);
        }

        if (!empty($this->filters['tanggal'])) {
            $query->whereDate('tanggal', $this->filters['tanggal']);
        }

        return $query->orderBy('id', 'asc')
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