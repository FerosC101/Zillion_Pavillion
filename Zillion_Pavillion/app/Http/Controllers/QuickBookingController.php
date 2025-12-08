<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class QuickBookingController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'check_in_date' => 'required|date|after_or_equal:today',
            'check_out_date' => 'required|date|after:check_in_date',
            'number_of_rooms' => 'required|integer|min:1',
            'room_type' => 'required|string',
            'adults' => 'required|integer|min:1',
            'children' => 'nullable|integer|min:0',
            'message' => 'nullable|string|max:1000',
        ]);

        // Check if client exists by email
        $client = Client::where('email', $validated['email'])->first();

        if (!$client) {
            // Create new client account
            $username = Str::slug($validated['name']) . '_' . rand(1000, 9999);
            $password = Str::random(10);

            $client = Client::create([
                'full_name' => $validated['name'],
                'email' => $validated['email'],
                'phone' => $validated['phone'],
                'username' => $username,
                'password' => Hash::make($password),
                'is_active' => true,
            ]);

            // You could send email with credentials here
            // Mail::to($client->email)->send(new WelcomeMail($username, $password));
        }

        // Calculate number of nights
        $checkIn = \Carbon\Carbon::parse($validated['check_in_date']);
        $checkOut = \Carbon\Carbon::parse($validated['check_out_date']);
        $nights = $checkIn->diffInDays($checkOut);

        // Create booking
        $booking = Booking::create([
            'client_id' => $client->id,
            'check_in_date' => $validated['check_in_date'],
            'check_out_date' => $validated['check_out_date'],
            'number_of_rooms' => $validated['number_of_rooms'],
            'room_type' => $validated['room_type'],
            'adults' => $validated['adults'],
            'children' => $validated['children'] ?? 0,
            'guest_count' => $validated['adults'] + ($validated['children'] ?? 0),
            'special_requests' => $validated['message'],
            'status' => 'pending',
            'total_amount' => 0, // Will be calculated by admin
        ]);

        return redirect()->route('home')->with('success', 'Booking request submitted successfully! Check your email for confirmation and account details.');
    }
}
