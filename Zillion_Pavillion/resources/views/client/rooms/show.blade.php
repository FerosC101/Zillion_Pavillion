@extends('client.layout')

@section('title', $room->name)
@section('page-title', $room->name)
@section('page-subtitle', 'Room #' . $room->room_number)

@section('content')
<div class="row">
    <div class="col-lg-8">
        <!-- Room Gallery -->
        <div class="room-gallery mb-4">
            @if($room->images && count($room->images) > 0)
                <img src="{{ $room->images[0] }}" alt="{{ $room->name }}" class="main-image img-fluid rounded">
            @else
                <div class="placeholder-image rounded">
                    <i class="fas fa-door-open"></i>
                </div>
            @endif
        </div>

        <!-- Room Info -->
        <div class="card mb-4">
            <div class="card-body">
                <h5 class="card-title">Room Details</h5>
                <div class="row">
                    <div class="col-md-6">
                        <p><strong>Room Type:</strong> {{ $room->type }}</p>
                        <p><strong>Max Occupancy:</strong> {{ $room->max_occupancy }} guests</p>
                        <p><strong>Bed Count:</strong> {{ $room->bed_count }} {{ $room->bed_type }}</p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>Room Size:</strong> {{ $room->size_sqm }}m²</p>
                        <p><strong>Floor:</strong> {{ $room->floor_number }}</p>
                        <p><strong>View:</strong> {{ $room->view_type }}</p>
                    </div>
                </div>

                @if($room->amenities && count($room->amenities) > 0)
                <hr>
                <h6>Amenities</h6>
                <div class="amenities-list">
                    @foreach($room->amenities as $amenity)
                        <span class="badge bg-light text-dark">{{ $amenity }}</span>
                    @endforeach
                </div>
                @endif

                @if($room->description)
                <hr>
                <h6>Description</h6>
                <p>{{ $room->description }}</p>
                @endif
            </div>
        </div>

        <!-- Rates Info -->
        @if($room->rates && count($room->rates) > 0)
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Available Rates</h5>
            </div>
            <div class="card-body">
                <table class="table table-sm">
                    <thead>
                        <tr>
                            <th>Rate Name</th>
                            <th>Price</th>
                            <th>Valid From</th>
                            <th>Valid To</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($room->rates as $rate)
                        <tr>
                            <td>{{ $rate->name }}</td>
                            <td><strong>{{ $rate->currency }} {{ number_format($rate->price, 2) }}</strong></td>
                            <td>{{ $rate->effective_from ? $rate->effective_from->format('M d, Y') : '-' }}</td>
                            <td>{{ $rate->effective_to ? $rate->effective_to->format('M d, Y') : '-' }}</td>
                            <td>
                                @if($rate->is_default)
                                    <span class="badge bg-success">Default</span>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @endif
    </div>

    <!-- Booking Form -->
    <div class="col-lg-4">
        <div class="card sticky-top" style="top: 20px;">
            <div class="card-body">
                <h5 class="card-title mb-4">Book This Room</h5>

                @if($room->currentRate)
                <div class="pricing-box mb-4">
                    <p class="text-muted">Price per night</p>
                    <h3 class="text-primary">
                        {{ $room->currentRate->currency }} {{ number_format($room->currentRate->price, 2) }}
                    </h3>
                </div>
                @endif

                <form action="{{ route('client.booking.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="room_id" value="{{ $room->id }}">

                    <div class="mb-3">
                        <label class="form-label">Check-in Date</label>
                        <input type="date" name="check_in_date" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Check-out Date</label>
                        <input type="date" name="check_out_date" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Number of Rooms</label>
                        <input type="number" name="number_of_rooms" class="form-control" value="1" min="1" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Adults</label>
                        <input type="number" name="adults" class="form-control" value="1" min="1" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Children</label>
                        <input type="number" name="children" class="form-control" value="0" min="0">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Special Requests</label>
                        <textarea name="special_requests" class="form-control" rows="3"></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary w-100 mb-2">
                        <i class="fas fa-calendar-check"></i> Confirm Booking
                    </button>

                    <a href="{{ route('client.rooms.index') }}" class="btn btn-outline-secondary w-100">
                        <i class="fas fa-arrow-left"></i> Back to Rooms
                    </a>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
.placeholder-image {
    width: 100%;
    height: 300px;
    background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 4rem;
    color: rgba(0,0,0,0.2);
}

.amenities-list {
    display: flex;
    flex-wrap: wrap;
    gap: 8px;
}

.pricing-box {
    background: linear-gradient(135deg, #f5f7fa 0%, #f0f2f5 100%);
    padding: 15px;
    border-radius: 8px;
    border-left: 4px solid var(--primary-color);
}
</style>
@endsection
