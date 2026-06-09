<?php

namespace App\Http\Controllers;

use App\Models\Complaint;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ComplaintsExport;

class ComplaintController extends Controller
{
    public function welcome()
    {
        $totalMasuk = Complaint::count();
        $totalSelesai = Complaint::where('status', 'done')->count();

        return view('welcome', compact('totalMasuk', 'totalSelesai'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'no_meter' => 'required|string|max:100',
            'nama_pelapor' => 'required|string|max:150',
            'no_hp' => 'required|string|max:20',
            'alamat' => 'required|string',
            'keterangan' => 'required|string',
        ]);

        Complaint::create([
            'no_meter' => $request->no_meter,
            'nama_pelapor' => $request->nama_pelapor,
            'no_hp' => $request->no_hp,
            'alamat' => $request->alamat,
            'tanggal' => Carbon::today(),
            'keterangan' => $request->keterangan,
            'status' => 'pending',
        ]);

        return redirect()
            ->route('welcome')
            ->with('success', 'Laporan pengaduan berhasil dikirim.');
    }

    public function dashboard()
    {
        $totalPending = Complaint::where('status', 'pending')->count();
        $totalProses = Complaint::where('status', 'proses')->count();
        $totalDone = Complaint::where('status', 'done')->count();
        $totalSemua = Complaint::count();

        $complaints = Complaint::orderBy('id', 'asc')->paginate(10);

        $labels = [];
        $monthlyData = [];

        for ($i = 11; $i >= 0; $i--) {
            $date = Carbon::now()->subMonths($i);

            $labels[] = $date->format('M Y');

            $monthlyData[] = Complaint::whereYear('tanggal', $date->year)
                ->whereMonth('tanggal', $date->month)
                ->count();
        }

        return view('dashboard', compact(
            'totalPending',
            'totalProses',
            'totalDone',
            'totalSemua',
            'complaints',
            'labels',
            'monthlyData'
        ));
    }

    public function updateStatus(Request $request, Complaint $complaint)
    {
        $request->validate([
            'status' => 'required|in:pending,proses,done',
            'bagian' => 'nullable|in:teknisi,administrasi',
            'penyelesaian' => 'nullable|string',
        ]);

        $data = [
            'status' => $request->status,
            'bagian' => $request->bagian,
            'penyelesaian' => $request->penyelesaian,
        ];

        if ($request->status === 'done' && !$complaint->tanggal_selesai) {
            $data['tanggal_selesai'] = now();
        }

        if ($request->status !== 'done') {
            $data['tanggal_selesai'] = null;
        }

        $complaint->update($data);

        return redirect()
            ->route('dashboard')
            ->with('success', 'Status laporan berhasil diperbarui.');
    }

    public function destroy(Complaint $complaint)
    {
        $complaint->delete();

        return redirect()
            ->route('dashboard')
            ->with('success', 'Data laporan berhasil dihapus.');
    }

    public function export(Request $request)
    {
        $month = $request->get('month', Carbon::now()->month);
        $year = $request->get('year', Carbon::now()->year);

        $fileName = 'rekap-pengaduan-' . $month . '-' . $year . '.xlsx';

        return Excel::download(new ComplaintsExport($month, $year), $fileName);
    }
}