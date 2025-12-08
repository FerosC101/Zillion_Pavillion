@extends('staff.layout')

@section('title', 'Bookings')
@section('page-title', 'All Bookings')

@section('content')
<div class="table-responsive">
    <table class="table table-hover">
        <thead>
            <tr>
                <th>ID</th>
                <th>Client</th>
                <th>Event Type</th>
                <th>Event Date</th>
                <th>Check-In</th>
                <th>Check-Out</th>
                <th>Rooms</th>
                <th>Guests</th>
                <th>Status</th>
                <th>Amount</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($bookings as $booking)
            <tr>
                <td>#{{ $booking->id }}</td>
                <td>{{ $booking->client->full_name }}</td>
                <td>{{ $booking->room_type ?? 'Standard' }}</td>
                <td>{{ \Carbon\Carbon::parse($booking->check_in_date)->format('M d, Y') }}</td>
                <td>{{ \Carbon\Carbon::parse($booking->check_out_date)->format('M d, Y') }}</td>
                <td>{{ $booking->number_of_rooms }}</td>
                <td>{{ $booking->adults }}A @if($booking->children > 0), {{ $booking->children }}C @endif</td>
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
                <td>₱{{ number_format($booking->total_amount, 2) }}</td>
                <td>
                    <a href="{{ route('staff.bookings.show', $booking->id) }}" class="btn btn-sm btn-info">
                        <i class="bi bi-eye"></i>
                    </a>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="9" class="text-center">No bookings found</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-3">
    {{ $bookings->links() }}
</div>
@endsection
