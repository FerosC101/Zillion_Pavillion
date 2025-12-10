@extends('staff.layout')

@section('title', 'Booking Details')
@section('page-title', 'Booking #' . $booking->id)

@section('content')
<div class="row">
    <div class="col-lg-8">
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Booking Details</h5>
                <span class="badge bg-{{ $booking->status === 'pending' ? 'warning' : ($booking->status === 'confirmed' ? 'success' : ($booking->status === 'completed' ? 'primary' : 'danger')) }}">
                    {{ ucfirst($booking->status) }}
                </span>
            </div>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <strong>Booking ID:</strong>
                        <p>#{{ $booking->id }}</p>
                    </div>
                    <div class="col-md-6">
                        <strong>Client:</strong>
                        <p>{{ $booking->client->full_name }}</p>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <strong>Check-In Date:</strong>
                        <p>{{ \Carbon\Carbon::parse($booking->check_in_date)->format('M d, Y') }}</p>
                    </div>
                    <div class="col-md-6">
                        <strong>Check-Out Date:</strong>
                        <p>{{ \Carbon\Carbon::parse($booking->check_out_date)->format('M d, Y') }}</p>
                    </div>
                </div>

                @if($booking->room)
                <div class="row mb-3">
                    <div class="col-md-6">
                        <strong>Room Number:</strong>
                        <p>{{ $booking->room->room_number }}</p>
                    </div>
                    <div class="col-md-6">
                        <strong>Room Type:</strong>
                        <p>{{ $booking->room->type }}</p>
                    </div>
                </div>
                @else
                <div class="row mb-3">
                    <div class="col-md-6">
                        <strong>Room Type:</strong>
                        <p>{{ $booking->room_type ?? 'Standard' }}</p>
                    </div>
                </div>
                @endif

                <div class="row mb-3">
                    <div class="col-md-6">
                        <strong>Adults:</strong>
                        <p>{{ $booking->adults }}</p>
                    </div>
                    <div class="col-md-6">
                        <strong>Children:</strong>
                        <p>{{ $booking->children ?? 0 }}</p>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-12">
                        <strong>Total Amount:</strong>
                        <p class="h5">₱{{ number_format($booking->total_amount, 2) }}</p>
                    </div>
                </div>

                @if($booking->special_requests)
                <div class="row mb-3">
                    <div class="col-md-12">
                        <strong>Special Requests:</strong>
                        <p>{{ $booking->special_requests }}</p>
                    </div>
                </div>
                @endif
            </div>
        </div>

        @if($booking->services && $booking->services->count() > 0)
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="mb-0">Services Booked</h5>
            </div>
            <div class="card-body">
                <ul class="list-group list-group-flush">
                    @foreach($booking->services as $service)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <span>{{ $service->name }}</span>
                        <span class="badge bg-info">₱{{ number_format($service->price, 2) }}</span>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
        @endif
    </div>

    <div class="col-lg-4">
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="mb-0">Client Information</h5>
            </div>
            <div class="card-body">
                <p><strong>Name:</strong> {{ $booking->client->full_name }}</p>
                <p><strong>Email:</strong> <a href="mailto:{{ $booking->client->email }}">{{ $booking->client->email }}</a></p>
                <p><strong>Phone:</strong> {{ $booking->client->phone ?? 'N/A' }}</p>
                <p><strong>Address:</strong> {{ $booking->client->address ?? 'N/A' }}</p>
                <p><strong>City:</strong> {{ $booking->client->city ?? 'N/A' }}, {{ $booking->client->state ?? 'N/A' }}</p>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Update Status</h5>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('staff.bookings.updateStatus', $booking->id) }}">
                    @csrf
                    <div class="mb-3">
                        <label for="status" class="form-label">Booking Status</label>
                        <select name="status" id="status" class="form-select">
                            <option value="pending" {{ $booking->status === 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="confirmed" {{ $booking->status === 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                            <option value="completed" {{ $booking->status === 'completed' ? 'selected' : '' }}>Completed</option>
                            <option value="cancelled" {{ $booking->status === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Update Status</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="mt-4">
    <a href="{{ route('staff.bookings.index') }}" class="btn btn-secondary">Back to Bookings</a>
</div>
@endsection
