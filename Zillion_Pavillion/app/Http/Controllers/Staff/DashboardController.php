<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\ServiceRequest;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_bookings' => Booking::count(),
            'pending_bookings' => Booking::where('status', 'pending')->count(),
            'confirmed_bookings' => Booking::where('status', 'confirmed')->count(),
            'today_bookings' => Booking::whereDate('check_in_date', today())->count(),
            'pending_service_requests' => ServiceRequest::where('status', '!=', 'completed')->count(),
        ];

        $upcoming_bookings = Booking::with('client')
            ->where('check_in_date', '>=', today())
            ->orderBy('check_in_date', 'asc')
            ->take(10)
            ->get();

        $pending_service_requests = ServiceRequest::with('client', 'booking')
            ->where('status', '!=', 'completed')
            ->orderBy('priority', 'desc')
            ->orderBy('requested_at', 'desc')
            ->take(8)
            ->get();

        return view('staff.dashboard', compact('stats', 'upcoming_bookings', 'pending_service_requests'));
    }

    public function markServiceRequestDone(ServiceRequest $serviceRequest)
    {
        $serviceRequest->update([
            'status' => 'completed',
            'completed_at' => now(),
        ]);

        return redirect()->back()->with('success', 'Service request marked as completed.');
    }
}
