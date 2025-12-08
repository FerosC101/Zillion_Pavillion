@extends('staff.layout')

@section('title', 'Dashboard')
@section('page-title', 'Staff Dashboard')

@section('content')
<div class="row mb-4">
    <div class="col-md-3 mb-3">
        <div class="stat-card">
            <div class="icon text-primary">
                <i class="bi bi-calendar-check"></i>
            </div>
            <h3>{{ $stats['total_bookings'] }}</h3>
            <p class="text-muted mb-0">Total Bookings</p>
        </div>
    </div>
    <div class="col-md-3 mb-3">
        <div class="stat-card">
            <div class="icon text-warning">
                <i class="bi bi-clock"></i>
            </div>
            <h3>{{ $stats['pending_bookings'] }}</h3>
            <p class="text-muted mb-0">Pending</p>
        </div>
    </div>
    <div class="col-md-3 mb-3">
        <div class="stat-card">
            <div class="icon text-success">
                <i class="bi bi-check-circle"></i>
            </div>
            <h3>{{ $stats['confirmed_bookings'] }}</h3>
            <p class="text-muted mb-0">Confirmed</p>
        </div>
    </div>
    <div class="col-md-3 mb-3">
        <div class="stat-card">
            <div class="icon text-info">
                <i class="bi bi-calendar-event"></i>
            </div>
            <h3>{{ $stats['today_bookings'] }}</h3>
            <p class="text-muted mb-0">Today's Events</p>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <h5 class="mb-0">Upcoming Bookings</h5>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Client</th>
                        <th>Room Type</th>
                        <th>Check-In</th>
                        <th>Check-Out</th>
                        <th>Rooms</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($upcoming_bookings as $booking)
                    <tr>
                        <td>#{{ $booking->id }}</td>
                        <td>{{ $booking->client->full_name }}</td>
                        <td>{{ $booking->room_type ?? 'Standard' }}</td>
                        <td>{{ \Carbon\Carbon::parse($booking->check_in_date)->format('M d, Y') }}</td>
                        <td>{{ \Carbon\Carbon::parse($booking->check_out_date)->format('M d, Y') }}</td>
                        <td>{{ $booking->number_of_rooms }}</td>
                        <td>
                            @if($booking->status == 'pending')
                                <span class="badge bg-warning">Pending</span>
                            @elseif($booking->status == 'confirmed')
                                <span class="badge bg-success">Confirmed</span>
                            @elseif($booking->status == 'completed')
                                <span class="badge bg-primary">Completed</span>
                            @else
                                <span class="badge bg-danger">Cancelled</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('staff.bookings.show', $booking->id) }}" class="btn btn-sm btn-info">
                                <i class="bi bi-eye"></i> View
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center">No upcoming bookings</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
