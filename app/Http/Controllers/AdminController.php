<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    /**
     * Show the admin dashboard with real-time statistics.
     */
    public function index()
    {
        // 1. Total Booking Count
        $totalBookings = DB::table('booking')->count();

        // 2. Total Earnings (payments settled)
        $totalEarnings = DB::table('booking')
            ->whereIn('status_booking', ['dibayar', 'lunas', 'success', 'settlement', 'selesai'])
            ->sum('total_harga');

        // 3. Total Registered Users
        $totalUsers = DB::table('users')->count();

        // 4. Remaining Quota for Today
        $today = date('Y-m-d');
        $quotaToday = DB::table('kuota')->where('tanggal', $today)->first();
        
        $actualTerisiToday = DB::table('booking')
            ->where('tanggal_kunjungan', $today)
            ->whereNotIn('status_booking', ['batal', 'cancel', 'failed'])
            ->sum('jumlah_orang');

        if ($quotaToday) {
            $maxQuota = $quotaToday->kuota_maks;
            $remainingQuota = max(0, $maxQuota - $quotaToday->kuota_terisi);
        } else {
            $maxQuota = 50; // Default max quota
            $remainingQuota = max(0, $maxQuota - $actualTerisiToday);
        }

        // 5. Recent Bookings List
        $recentBookings = DB::table('booking')
            ->join('users', 'booking.id_user', '=', 'users.id_user')
            ->select('booking.*', 'users.nama_lengkap', 'users.email', 'users.no_hp')
            ->orderBy('booking.tanggal_booking', 'desc')
            ->limit(5)
            ->get();

        // 6. Weekly Quota Data (Dynamic 7-day range from -3 days to +3 days)
        $weeklyQuota = collect([]);
        for ($i = -3; $i <= 3; $i++) {
            $date = date('Y-m-d', strtotime("$i days"));
            $quota = DB::table('kuota')->where('tanggal', $date)->first();
            
            // Count actual active bookings for this date
            $actualTerisi = DB::table('booking')
                ->where('tanggal_kunjungan', $date)
                ->whereNotIn('status_booking', ['batal', 'cancel', 'failed'])
                ->sum('jumlah_orang');

            $weeklyQuota->push((object)[
                'tanggal' => $date,
                'kuota_maks' => $quota->kuota_maks ?? 50,
                'kuota_terisi' => $quota ? $quota->kuota_terisi : $actualTerisi,
            ]);
        }

        return view('dashboard.index', compact(
            'totalBookings',
            'totalEarnings',
            'totalUsers',
            'remainingQuota',
            'maxQuota',
            'recentBookings',
            'weeklyQuota'
        ));
    }
}
