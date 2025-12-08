<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Service;
use App\Models\Client;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ClientDashboardController extends Controller
{
    public function index()
    {
        $client = Auth::guard('web')->user();
        $bookings = $client->bookings()->with('services')->orderBy('created_at', 'desc')->take(5)->get();
        
        $stats = [
            'total_bookings' => $client->bookings()->count(),
            'pending_bookings' => $client->bookings()->where('status', 'pending')->count(),
            'confirmed_bookings' => $client->bookings()->where('status', 'confirmed')->count(),
            'upcoming_bookings' => $client->bookings()->where('event_date', '>=', today())->where('status', '!=', 'cancelled')->count(),
        ];

        return view('client.dashboard', compact('bookings', 'stats'));
    }

    public function bookings()
    {
        $client = Auth::guard('web')->user();
        $bookings = $client->bookings()->with('services')->orderBy('created_at', 'desc')->get();
        
        return view('client.bookings', compact('bookings'));
    }

    public function createBooking()
    {
        $services = Service::where('is_available', true)->orderBy('name')->get();
        $rooms = Room::where('is_available', true)->orderBy('type')->orderBy('price_per_night')->get();
        return view('client.booking', compact('services', 'rooms'));
    }

    public function storeBooking(Request $request)
    {
        $validated = $request->validate([
            'room_id' => 'required|exists:rooms,id',
            'check_in_date' => 'required|date|after_or_equal:today',
            'check_out_date' => 'required|date|after:check_in_date',
            'number_of_rooms' => 'required|integer|min:1|max:50',
            'adults' => 'required|integer|min:1|max:100',
            'children' => 'nullable|integer|min:0|max:100',
            'special_requests' => 'nullable|string|max:1000',
            'services' => 'nullable|array',
            'services.*' => 'exists:services,id',
        ], [
            'check_in_date.after_or_equal' => 'Check-in date must be today or a future date.',
            'check_out_date.after' => 'Check-out date must be after check-in date.',
        ]);

        $client = Auth::guard('web')->user();
        $room = Room::findOrFail($validated['room_id']);
        
        // Calculate nights
        $checkIn = \Carbon\Carbon::parse($validated['check_in_date']);
        $checkOut = \Carbon\Carbon::parse($validated['check_out_date']);
        $nights = $checkIn->diffInDays($checkOut);
        
        // Calculate room total
        $roomTotal = $room->price_per_night * $nights;
        
        // Create booking
        $booking = Booking::create([
            'client_id' => $client->id,
            'room_id' => $room->id,
            'check_in_date' => $validated['check_in_date'],
            'check_out_date' => $validated['check_out_date'],
            'number_of_rooms' => $validated['number_of_rooms'],
            'room_type' => $room->type,
            'adults' => $validated['adults'],
            'children' => $validated['children'] ?? 0,
            'guest_count' => $validated['adults'] + ($validated['children'] ?? 0),
            'special_requests' => $validated['special_requests'] ?? null,
            'status' => 'pending',
            'total_amount' => $roomTotal,
        ]);

        // Attach services and calculate total
        $totalAmount = $roomTotal;
        if ($request->has('services') && is_array($request->services)) {
            foreach ($request->services as $serviceId) {
                $service = Service::find($serviceId);
                if ($service && $service->is_available) {
                    $booking->services()->attach($serviceId, [
                        'quantity' => 1,
                        'price' => $service->price,
                    ]);
                    $totalAmount += $service->price;
                }
            }
        }

        // Update total amount
        $booking->update(['total_amount' => $totalAmount]);

        return redirect()->route('client.dashboard')->with('success', 'Booking created successfully! Our team will review and confirm your booking soon.');
    }

    public function showBooking(Booking $booking)
    {
        // Ensure the booking belongs to the authenticated client
        if ($booking->client_id !== Auth::guard('web')->id()) {
            abort(403, 'Unauthorized access to this booking.');
        }

        $booking->load('services');
        return view('client.booking-details', compact('booking'));
    }

    public function cancelBooking(Booking $booking)
    {
        // Ensure the booking belongs to the authenticated client
        if ($booking->client_id !== Auth::guard('web')->id()) {
            abort(403, 'Unauthorized access to this booking.');
        }

        // Only allow cancellation of pending bookings
        if ($booking->status !== 'pending') {
            return back()->with('error', 'Only pending bookings can be cancelled.');
        }

        $booking->update(['status' => 'cancelled']);

        return redirect()->route('client.bookings.index')->with('success', 'Booking cancelled successfully.');
    }

    public function profile()
    {
        return view('client.profile');
    }

    public function updateProfile(Request $request)
    {
        $client = Auth::guard('web')->user();

        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:clients,email,' . $client->id,
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:500',
            'current_password' => 'nullable|required_with:new_password',
            'new_password' => 'nullable|min:6|confirmed',
        ]);

        // Update basic information
        $client->full_name = $validated['full_name'];
        $client->email = $validated['email'];
        $client->phone = $validated['phone'] ?? null;
        $client->address = $validated['address'] ?? null;

        // Update password if provided
        if ($request->filled('current_password')) {
            if (!Hash::check($request->current_password, $client->password)) {
                return back()->withErrors(['current_password' => 'Current password is incorrect.'])->withInput();
            }

            if ($request->filled('new_password')) {
                $client->password = Hash::make($request->new_password);
            }
        }

        $client->save();

        return back()->with('success', 'Profile updated successfully!');
    }
}
