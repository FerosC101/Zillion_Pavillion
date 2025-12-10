<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\RoomRate;
use Illuminate\Http\Request;

class ClientRoomController extends Controller
{
    public function index()
    {
        $rooms = Room::with('currentRate')
            ->where('is_available', true)
            ->paginate(12);
        return view('client.rooms.index', compact('rooms'));
    }

    public function show(Room $room)
    {
        $room->load('rates');
        return view('client.rooms.show', compact('room'));
    }
}
