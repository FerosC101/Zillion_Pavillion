<?php

namespace App\Http\Controllers;

use App\Models\ServiceRequest;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientServiceRequestController extends Controller
{
    public function index()
    {
        $client = Auth::guard('web')->user();
        $requests = ServiceRequest::where('client_id', $client->id)
            ->with(['booking', 'staff'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('client.service-requests.index', compact('requests'));
    }

    public function create()
    {
        $client = Auth::guard('web')->user();
        $bookings = Booking::where('client_id', $client->id)
            ->whereIn('status', ['confirmed', 'checked_in'])
            ->orderBy('check_in_date', 'desc')
            ->get();

        return view('client.service-requests.create', compact('bookings'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'booking_id' => 'nullable|exists:bookings,id',
            'service_type' => 'required|in:housekeeping,room_service,laundry,maintenance,delivery,other',
            'room_number' => 'nullable|string|max:20',
            'description' => 'required|string|max:1000',
            'priority' => 'required|in:low,normal,high,urgent',
        ]);

        $client = Auth::guard('web')->user();

        ServiceRequest::create([
            'client_id' => $client->id,
            'booking_id' => $validated['booking_id'] ?? null,
            'service_type' => $validated['service_type'],
            'room_number' => $validated['room_number'] ?? null,
            'description' => $validated['description'],
            'priority' => $validated['priority'],
            'status' => 'pending',
        ]);

        return redirect()->route('client.service-requests.index')
            ->with('success', 'Service request submitted successfully!');
    }

    public function show(ServiceRequest $serviceRequest)
    {
        // Ensure the request belongs to the authenticated client
        if ($serviceRequest->client_id !== Auth::guard('web')->id()) {
            abort(403, 'Unauthorized access to this service request.');
        }

        $serviceRequest->load(['booking', 'staff']);
        return view('client.service-requests.show', compact('serviceRequest'));
    }

    public function cancel(ServiceRequest $serviceRequest)
    {
        // Ensure the request belongs to the authenticated client
        if ($serviceRequest->client_id !== Auth::guard('web')->id()) {
            abort(403, 'Unauthorized access to this service request.');
        }

        if ($serviceRequest->status === 'pending') {
            $serviceRequest->update(['status' => 'cancelled']);
            return redirect()->route('client.service-requests.index')
                ->with('success', 'Service request cancelled successfully.');
        }

        return redirect()->route('client.service-requests.index')
            ->with('error', 'Cannot cancel a request that is already in progress or completed.');
    }
}
