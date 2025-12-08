@extends('admin.layout')

@section('page-title', 'Room Details')

@section('content')
<div class="row">
    <div class="col-md-10 mx-auto">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Room #{{ $room->room_number }} - {{ $room->name }}</h5>
                <div>
                    <a href="{{ route('admin.rooms.edit', $room) }}" class="btn btn-sm btn-primary me-2">
                        <i class="bi bi-pencil"></i> Edit
                    </a>
                    <a href="{{ route('admin.rooms.index') }}" class="btn btn-sm btn-outline-secondary">
                        <i class="bi bi-arrow-left"></i> Back
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="row mb-4">
                    <div class="col-md-6">
                        <h6 class="text-muted mb-3">Room Information</h6>
                        <table class="table table-sm">
                            <tr>
                                <th width="40%">Room Number:</th>
                                <td><strong>{{ $room->room_number }}</strong></td>
                            </tr>
                            <tr>
                                <th>Name:</th>
                                <td>{{ $room->name }}</td>
                            </tr>
                            <tr>
                                <th>Type:</th>
                                <td><span class="badge bg-info">{{ $room->type }}</span></td>
                            </tr>
                            <tr>
                                <th>Price Per Night:</th>
                                <td><strong class="text-success">₱{{ number_format($room->price_per_night, 2) }}</strong></td>
                            </tr>
                            <tr>
                                <th>Status:</th>
                                <td>
                                    @if($room->is_available)
                                        <span class="badge bg-success">Available</span>
                                    @else
                                        <span class="badge bg-secondary">Unavailable</span>
                                    @endif
                                </td>
                            </tr>
                        </table>
                    </div>

                    <div class="col-md-6">
                        <h6 class="text-muted mb-3">Room Specifications</h6>
                        <table class="table table-sm">
                            <tr>
                                <th width="40%">Max Occupancy:</th>
                                <td>{{ $room->max_occupancy }} guests</td>
                            </tr>
                            <tr>
                                <th>Bed Count:</th>
                                <td>{{ $room->bed_count }} bed(s)</td>
                            </tr>
                            <tr>
                                <th>Bed Type:</th>
                                <td>{{ $room->bed_type }}</td>
                            </tr>
                            <tr>
                                <th>Size:</th>
                                <td>{{ $room->size_sqm }} m²</td>
                            </tr>
                            <tr>
                                <th>View Type:</th>
                                <td>{{ $room->view_type }}</td>
                            </tr>
                            <tr>
                                <th>Floor:</th>
                                <td>{{ $room->floor_number }}</td>
                            </tr>
                        </table>
                    </div>
                </div>

                <div class="mb-4">
                    <h6 class="text-muted mb-3">Description</h6>
                    <div class="p-3 bg-light rounded">
                        {{ $room->description }}
                    </div>
                </div>

                <div class="mb-4">
                    <h6 class="text-muted mb-3">Amenities</h6>
                    <div class="d-flex flex-wrap gap-2">
                        @foreach($room->amenities as $amenity)
                            <span class="badge bg-secondary">
                                <i class="bi bi-check-circle"></i> {{ $amenity }}
                            </span>
                        @endforeach
                    </div>
                </div>

                <div class="mb-4">
                    <h6 class="text-muted mb-3">Images</h6>
                    <div class="row g-3">
                        @foreach($room->images as $image)
                            <div class="col-md-4">
                                <img src="{{ asset('images/' . $image) }}" 
                                    alt="{{ $room->name }}" 
                                    class="img-fluid rounded shadow-sm"
                                    onerror="this.src='https://via.placeholder.com/300x200?text=No+Image'">
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
