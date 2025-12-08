@extends('admin.layout')

@section('page-title', 'Room Management')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Rooms</h2>
    <a href="{{ route('admin.rooms.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> Add New Room
    </a>
</div>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Room #</th>
                        <th>Name</th>
                        <th>Type</th>
                        <th>Price/Night</th>
                        <th>Occupancy</th>
                        <th>Beds</th>
                        <th>Size</th>
                        <th>Floor</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($rooms as $room)
                        <tr>
                            <td><strong>{{ $room->room_number }}</strong></td>
                            <td>{{ $room->name }}</td>
                            <td><span class="badge bg-info">{{ $room->type }}</span></td>
                            <td><strong>₱{{ number_format($room->price_per_night, 2) }}</strong></td>
                            <td>{{ $room->max_occupancy }} guests</td>
                            <td>{{ $room->bed_count }} {{ $room->bed_type }}</td>
                            <td>{{ $room->size_sqm }}m²</td>
                            <td>{{ $room->floor_number }}</td>
                            <td>
                                @if($room->is_available)
                                    <span class="badge bg-success">Available</span>
                                @else
                                    <span class="badge bg-secondary">Unavailable</span>
                                @endif
                            </td>
                            <td>
                                <div class="btn-group btn-group-sm">
                                    <a href="{{ route('admin.rooms.show', $room) }}" class="btn btn-outline-info" title="View">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.rooms.edit', $room) }}" class="btn btn-outline-primary" title="Edit">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form action="{{ route('admin.rooms.destroy', $room) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger" title="Delete" 
                                            onclick="return confirm('Are you sure you want to delete this room?')">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="10" class="text-center py-4">
                                <i class="bi bi-door-open" style="font-size: 3rem; opacity: 0.3;"></i>
                                <p class="mt-2">No rooms found</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-3">
            {{ $rooms->links() }}
        </div>
    </div>
</div>
@endsection
