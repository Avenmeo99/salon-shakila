<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index()
    {
        $bookings = Booking::with('service','user')->latest()->paginate(15);
        return view('admin.bookings.index', compact('bookings'));
    }

    public function show($id)
    {
        $booking = Booking::with('service','user')->findOrFail($id);
        return view('admin.bookings.show', compact('booking'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,confirmed,completed,cancelled',
            'payment_status' => 'nullable|in:unpaid,paid,refunded',
        ]);

        $booking = Booking::findOrFail($id);
        $booking->status = $request->status;
        if ($request->filled('payment_status')) {
            $booking->payment_status = $request->payment_status;
        }
        $booking->save();

        return back()->with('success', 'Status booking diperbarui.');
    }
}
