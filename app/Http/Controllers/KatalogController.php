<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Kuota;
use Illuminate\Http\Request;
use Carbon\Carbon;

class KatalogController extends Controller
{
    /**
     * Display the visitor landing page and catalog.
     */
    public function index()
    {
        $today = Carbon::today();

        // Dynamically find Saturday and Sunday of the current weekend
        // If today is Saturday or Sunday, show the current weekend. Otherwise, show the upcoming weekend.
        if ($today->isSaturday()) {
            $saturday = $today->toDateString();
            $sunday = $today->copy()->addDay()->toDateString();
        } elseif ($today->isSunday()) {
            $saturday = $today->copy()->subDay()->toDateString();
            $sunday = $today->toDateString();
        } else {
            $saturday = $today->copy()->next(Carbon::SATURDAY)->toDateString();
            $sunday = $today->copy()->next(Carbon::SUNDAY)->toDateString();
        }

        // Fetch Saturday's quota limit and booked people count
        $kuotaSat = Kuota::where('tanggal', $saturday)->first();
        $maxSat = $kuotaSat ? $kuotaSat->kuota_maks : 20;
        $filledSat = Booking::where('tanggal_kunjungan', $saturday)
            ->whereNotIn('status_booking', ['batal', 'cancel', 'failed'])
            ->sum('jumlah_orang');

        // Fetch Sunday's quota limit and booked people count
        $kuotaSun = Kuota::where('tanggal', $sunday)->first();
        $maxSun = $kuotaSun ? $kuotaSun->kuota_maks : 20;
        $filledSun = Booking::where('tanggal_kunjungan', $sunday)
            ->whereNotIn('status_booking', ['batal', 'cancel', 'failed'])
            ->sum('jumlah_orang');

        $schedule = [
            [
                'date' => $saturday,
                'day' => 'Sabtu',
                'filled' => (int) $filledSat,
                'max' => (int) $maxSat,
            ],
            [
                'date' => $sunday,
                'day' => 'Minggu',
                'filled' => (int) $filledSun,
                'max' => (int) $maxSun,
            ]
        ];

        return view('katalog_user.katalog', compact('schedule'));
    }
}
