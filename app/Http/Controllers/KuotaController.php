<?php

namespace App\Http\Controllers;

use App\Models\Kuota;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KuotaController extends Controller
{
    /**
     * Display all quota data.
     */
    public function index()
    {
        $kuotas = Kuota::orderBy('tanggal', 'desc')->get();

        // Hitung terisi dari booking jika kuota_terisi belum sinkron
        $kuotas->each(function ($k) {
            $actual = Booking::where('tanggal_kunjungan', $k->tanggal->format('Y-m-d'))
                ->whereNotIn('status_booking', ['batal', 'cancel', 'failed'])
                ->sum('jumlah_orang');
            $k->actual_terisi = $actual;
            $k->sisa = max(0, $k->kuota_maks - $actual);
        });

        return view('kuota.index', compact('kuotas'));
    }

    /**
     * Store or update a quota for a specific date.
     */
    public function store(Request $request)
    {
        $request->validate([
            'tanggal'    => ['required', 'date'],
            'kuota_maks' => ['required', 'integer', 'min:1', 'max:100'],
        ], [
            'tanggal.required'    => 'Tanggal wajib dipilih.',
            'kuota_maks.required' => 'Batas kuota wajib diisi.',
            'kuota_maks.min'      => 'Minimum kuota adalah 1 orang.',
            'kuota_maks.max'      => 'Maksimum kuota adalah 100 orang.',
        ]);

        $terisi = Booking::where('tanggal_kunjungan', $request->tanggal)
            ->whereNotIn('status_booking', ['batal', 'cancel', 'failed'])
            ->sum('jumlah_orang');

        Kuota::updateOrCreate(
            ['tanggal'    => $request->tanggal],
            ['kuota_maks' => $request->kuota_maks, 'kuota_terisi' => $terisi]
        );

        $formatted = \Carbon\Carbon::parse($request->tanggal)->translatedFormat('d M Y');
        return redirect()->route('admin.kuota.index')
            ->with('success', "Kuota untuk <strong>{$formatted}</strong> berhasil disimpan (Maks: {$request->kuota_maks} orang).");
    }

    /**
     * Sync kuota_terisi with actual booking data.
     */
    public function sync($tanggal)
    {
        $kuota = Kuota::findOrFail($tanggal);

        $actual = Booking::where('tanggal_kunjungan', $tanggal)
            ->whereNotIn('status_booking', ['batal', 'cancel', 'failed'])
            ->sum('jumlah_orang');

        $kuota->update(['kuota_terisi' => $actual]);

        $formatted = \Carbon\Carbon::parse($tanggal)->translatedFormat('d M Y');
        return redirect()->route('admin.kuota.index')
            ->with('success', "Data kuota <strong>{$formatted}</strong> berhasil disinkronkan. Terisi: {$actual} orang.");
    }

    /**
     * Delete a quota record.
     */
    public function destroy($tanggal)
    {
        $kuota = Kuota::findOrFail($tanggal);
        $formatted = \Carbon\Carbon::parse($tanggal)->translatedFormat('d M Y');
        $kuota->delete();

        return redirect()->route('admin.kuota.index')
            ->with('success', "Data kuota <strong>{$formatted}</strong> berhasil dihapus.");
    }
}
