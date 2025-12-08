<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_bookings' => Booking::count(),
            'pending_bookings' => Booking::where('status', 'pending')->count(),
            'confirmed_bookings' => Booking::where('status', 'confirmed')->count(),
            'today_bookings' => Booking::whereDate('event_date', today())->count(),
        ];

        $upcoming_bookings = Booking::with('client')
            ->where('event_date', '>=', today())
            ->orderBy('event_date', 'asc')
            ->take(10)
            ->get();

        return view('staff.dashboard', compact('stats', 'upcoming_bookings'));
    }
}
