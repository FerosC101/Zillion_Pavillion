<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Room;
use App\Models\RoomRate;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function index()
    {
        $rooms = Room::with('currentRate')->orderBy('room_number')->paginate(15);
        return view('admin.rooms.index', compact('rooms'));
    }

    public function create()
    {
        return view('admin.rooms.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'room_number' => 'required|string|unique:rooms,room_number',
            'name' => 'required|string|max:255',
            'type' => 'required|in:Standard,Deluxe,Suite,Executive,Family',
            'description' => 'required|string',
            'price_per_night' => 'required|numeric|min:0',
            'max_occupancy' => 'required|integer|min:1',
            'bed_count' => 'required|integer|min:1',
            'bed_type' => 'required|string',
            'size_sqm' => 'required|numeric|min:0',
            'amenities' => 'required|array',
            'amenities.*' => 'string',
            'images' => 'required|array',
            'images.*' => 'string',
            'view_type' => 'required|string',
            'is_available' => 'required|boolean',
            'floor_number' => 'required|integer',
        ]);

        Room::create($validated);

        return redirect()->route('admin.rooms.index')
            ->with('success', 'Room created successfully!');
    }

    public function show(Room $room)
    {
        return view('admin.rooms.show', compact('room'));
    }

    public function edit(Room $room)
    {
        $room->load('rates');
        return view('admin.rooms.edit', compact('room'));
    }

    public function update(Request $request, Room $room)
    {
        $validated = $request->validate([
            'room_number' => 'required|string|unique:rooms,room_number,' . $room->id,
            'name' => 'required|string|max:255',
            'type' => 'required|in:Standard,Deluxe,Suite,Executive,Family',
            'description' => 'required|string',
            'price_per_night' => 'required|numeric|min:0',
            'max_occupancy' => 'required|integer|min:1',
            'bed_count' => 'required|integer|min:1',
            'bed_type' => 'required|string',
            'size_sqm' => 'required|numeric|min:0',
            'amenities' => 'required|array',
            'amenities.*' => 'string',
            'images' => 'required|array',
            'images.*' => 'string',
            'view_type' => 'required|string',
            'is_available' => 'required|boolean',
            'floor_number' => 'required|integer',
        ]);

        $room->update($validated);

        return redirect()->route('admin.rooms.index')
            ->with('success', 'Room updated successfully!');
    }

    public function destroy(Room $room)
    {
        $room->delete();

        return redirect()->route('admin.rooms.index')
            ->with('success', 'Room deleted successfully!');
    }

    // Rate management
    public function createRate(Room $room)
    {
        return view('admin.rooms.create_rate', compact('room'));
    }

    public function storeRate(Request $request, Room $room)
    {
        $data = $request->validate([
            'name' => 'nullable|string|max:255',
            'price' => 'required|numeric|min:0',
            'currency' => 'nullable|string|max:8',
            'effective_from' => 'nullable|date',
            'effective_to' => 'nullable|date',
            'is_default' => 'boolean',
        ]);

        if (!empty($data['is_default'])) {
            RoomRate::where('room_id', $room->id)->update(['is_default' => false]);
        }

        $data['room_id'] = $room->id;
        RoomRate::create($data);

        return redirect()->route('admin.rooms.edit', $room->id)->with('success', 'Rate added.');
    }

    public function destroyRate(Room $room, RoomRate $rate)
    {
        $rate->delete();
        return redirect()->route('admin.rooms.edit', $room->id)->with('success', 'Rate deleted.');
    }
}
