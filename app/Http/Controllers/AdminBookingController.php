<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;

class AdminBookingController extends Controller
{
    /**
     * Display all bookings for admin management.
     */
    public function index(Request $request)
    {
        $query = Booking::with(['user', 'details'])
            ->orderBy('tanggal_booking', 'desc');

        // Filter by status
        if ($request->filled('status') && $request->status !== 'semua') {
            $query->where('status_booking', $request->status);
        }

        // Search by kode or user name
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('kode_booking', 'like', "%{$search}%")
                  ->orWhereHas('user', fn($u) => $u->where('nama_lengkap', 'like', "%{$search}%"));
            });
        }

        $bookings = $query->paginate(15)->withQueryString();

        // Stats
        $stats = [
            'total'   => Booking::count(),
            'pending' => Booking::whereIn('status_booking', ['pending', 'menunggu'])->count(),
            'dibayar' => Booking::whereIn('status_booking', ['dibayar', 'lunas', 'success', 'settlement'])->count(),
            'batal'   => Booking::whereIn('status_booking', ['batal', 'cancel', 'failed'])->count(),
        ];

        return view('booking.manage', compact('bookings', 'stats'));
    }

    /**
     * Update booking status.
     */
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => ['required', 'in:pending,dibayar,selesai,batal'],
        ]);

        $booking = Booking::findOrFail($id);
        $booking->update(['status_booking' => $request->status]);

        return redirect()->route('admin.booking.index')
            ->with('success', "Status booking <strong>{$booking->kode_booking}</strong> berhasil diubah menjadi <strong>{$request->status}</strong>.");
    }

    /**
     * Delete a booking permanently.
     */
    public function destroy($id)
    {
        $booking = Booking::findOrFail($id);
        $kode = $booking->kode_booking;
        $booking->delete();

        return redirect()->route('admin.booking.index')
            ->with('success', "Booking <strong>{$kode}</strong> berhasil dihapus secara permanen.");
    }
}
