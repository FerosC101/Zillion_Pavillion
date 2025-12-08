<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index()
    {
        $bookings = Booking::with('client')->orderBy('event_date', 'desc')->paginate(15);
        return view('staff.bookings.index', compact('bookings'));
    }

    public function show(Booking $booking)
    {
        $booking->load('client', 'services');
        return view('staff.bookings.show', compact('booking'));
    }

    public function updateStatus(Request $request, Booking $booking)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,confirmed,completed,cancelled',
        ]);

        $booking->update($validated);

        return redirect()->back()->with('success', 'Booking status updated successfully.');
    }
}
