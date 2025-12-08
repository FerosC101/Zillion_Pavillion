<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Client;
use App\Models\Service;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index()
    {
        $bookings = Booking::with('client')->orderBy('created_at', 'desc')->paginate(15);
        return view('admin.bookings.index', compact('bookings'));
    }

    public function create()
    {
        $clients = Client::where('is_active', true)->get();
        $services = Service::where('is_available', true)->get();
        return view('admin.bookings.create', compact('clients', 'services'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'client_id' => 'required|exists:clients,id',
            'event_type' => 'required|string',
            'event_date' => 'required|date',
            'event_time' => 'required',
            'venue' => 'nullable|string',
            'guest_count' => 'required|integer|min:1',
            'total_amount' => 'required|numeric|min:0',
            'paid_amount' => 'nullable|numeric|min:0',
            'status' => 'required|in:pending,confirmed,completed,cancelled',
            'notes' => 'nullable|string',
            'special_requests' => 'nullable|string',
            'services' => 'nullable|array',
            'services.*.id' => 'exists:services,id',
            'services.*.quantity' => 'integer|min:1',
        ]);

        $booking = Booking::create($validated);

        if ($request->has('services')) {
            foreach ($request->services as $service) {
                $serviceModel = Service::find($service['id']);
                $booking->services()->attach($service['id'], [
                    'quantity' => $service['quantity'] ?? 1,
                    'price' => $serviceModel->price,
                ]);
            }
        }

        return redirect()->route('admin.bookings.index')->with('success', 'Booking created successfully.');
    }

    public function edit(Booking $booking)
    {
        $clients = Client::where('is_active', true)->get();
        $services = Service::where('is_available', true)->get();
        return view('admin.bookings.edit', compact('booking', 'clients', 'services'));
    }

    public function update(Request $request, Booking $booking)
    {
        $validated = $request->validate([
            'client_id' => 'required|exists:clients,id',
            'event_type' => 'required|string',
            'event_date' => 'required|date',
            'event_time' => 'required',
            'venue' => 'nullable|string',
            'guest_count' => 'required|integer|min:1',
            'total_amount' => 'required|numeric|min:0',
            'paid_amount' => 'nullable|numeric|min:0',
            'status' => 'required|in:pending,confirmed,completed,cancelled',
            'notes' => 'nullable|string',
            'special_requests' => 'nullable|string',
        ]);

        $booking->update($validated);

        if ($request->has('services')) {
            $booking->services()->detach();
            foreach ($request->services as $service) {
                $serviceModel = Service::find($service['id']);
                $booking->services()->attach($service['id'], [
                    'quantity' => $service['quantity'] ?? 1,
                    'price' => $serviceModel->price,
                ]);
            }
        }

        return redirect()->route('admin.bookings.index')->with('success', 'Booking updated successfully.');
    }

    public function destroy(Booking $booking)
    {
        $booking->delete();
        return redirect()->route('admin.bookings.index')->with('success', 'Booking deleted successfully.');
    }

    public function show(Booking $booking)
    {
        $booking->load('client', 'services');
        return view('admin.bookings.show', compact('booking'));
    }
}
