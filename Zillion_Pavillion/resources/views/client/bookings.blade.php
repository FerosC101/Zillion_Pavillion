@extends('client.layout')

@section('title', 'My Bookings')
@section('page-title', 'My Bookings')
@section('page-subtitle', 'Manage all your reservations')

@push('styles')
<style>
    .filters {
        display: flex;
        gap: 15px;
        margin-bottom: 25px;
        flex-wrap: wrap;
    }

    .filter-btn {
        padding: 10px 20px;
        border-radius: 5px;
        border: 2px solid #dee2e6;
        background: #fff;
        color: #2c3e50;
        cursor: pointer;
        font-weight: 500;
        transition: all 0.3s;
    }

    .filter-btn:hover {
        border-color: var(--primary-color);
        color: var(--primary-color);
    }

    .filter-btn.active {
        background: var(--primary-color);
        border-color: var(--primary-color);
        color: #fff;
    }

    .booking-card {
        background: #fff;
        border-radius: 12px;
        padding: 20px;
        margin-bottom: 20px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        border-left: 4px solid var(--primary-color);
        transition: all 0.3s;
    }

    .booking-card:hover {
        box-shadow: 0 4px 16px rgba(0,0,0,0.12);
        transform: translateY(-2px);
    }

    .booking-header {
        display: flex;
        justify-content: space-between;
        align-items: start;
        margin-bottom: 15px;
        flex-wrap: wrap;
        gap: 10px;
    }

    .booking-title {
        font-size: 1.3rem;
        font-weight: 600;
        color: #2c3e50;
        margin: 0;
    }

    .booking-details {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 15px;
        margin: 15px 0;
    }

    .detail-item {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .detail-item i {
        color: var(--primary-color);
        width: 20px;
    }

    .detail-item span {
        color: #7f8c8d;
        font-size: 0.9rem;
    }

    .services-list {
        margin: 15px 0;
        padding: 15px;
        background: #f8f9fa;
        border-radius: 8px;
    }

    .services-list h5 {
        margin: 0 0 10px 0;
        color: #2c3e50;
        font-size: 1rem;
    }

    .service-tag {
        display: inline-block;
        padding: 5px 12px;
        background: #fff;
        border-radius: 20px;
        margin: 5px 5px 5px 0;
        font-size: 0.85rem;
        color: #2c3e50;
        border: 1px solid #dee2e6;
    }

    .booking-actions {
        display: flex;
        gap: 10px;
        margin-top: 15px;
        flex-wrap: wrap;
    }
</style>
@endpush

@section('content')
<div class="filters">
    <button class="filter-btn active" onclick="filterBookings('all')">All Bookings</button>
    <button class="filter-btn" onclick="filterBookings('pending')">Pending</button>
    <button class="filter-btn" onclick="filterBookings('confirmed')">Confirmed</button>
    <button class="filter-btn" onclick="filterBookings('completed')">Completed</button>
    <button class="filter-btn" onclick="filterBookings('cancelled')">Cancelled</button>
</div>

<div id="bookingsContainer">
    @if($bookings->count() > 0)
        @foreach($bookings as $booking)
            <div class="booking-card" data-status="{{ $booking->status }}">
                <div class="booking-header">
                    <div>
                        <h3 class="booking-title">{{ $booking->room_type ?? 'Standard' }} Room</h3>
                        <span style="color: #7f8c8d; font-size: 0.9rem;">Booking #{{ $booking->id }}</span>
                    </div>
                    <span class="badge-{{ $booking->status }}" style="
                        padding: 8px 16px;
                        border-radius: 20px;
                        font-size: 0.9rem;
                        font-weight: 500;
                        @if($booking->status === 'pending')
                            background: #fff3cd; color: #856404;
                        @elseif($booking->status === 'confirmed')
                            background: #d1ecf1; color: #0c5460;
                        @elseif($booking->status === 'completed')
                            background: #d4edda; color: #155724;
                        @else
                            background: #f8d7da; color: #721c24;
                        @endif
                    ">
                        {{ ucfirst($booking->status) }}
                    </span>
                </div>

                <div class="booking-details">
                    <div class="detail-item">
                        <i class="fas fa-calendar-check"></i>
                        <div>
                            <strong>Check-In:</strong>
                            <span>{{ \Carbon\Carbon::parse($booking->check_in_date)->format('M d, Y') }}</span>
                        </div>
                    </div>
                    <div class="detail-item">
                        <i class="fas fa-calendar-times"></i>
                        <div>
                            <strong>Check-Out:</strong>
                            <span>{{ \Carbon\Carbon::parse($booking->check_out_date)->format('M d, Y') }}</span>
                        </div>
                    </div>
                    <div class="detail-item">
                        <i class="fas fa-moon"></i>
                        <span><strong>{{ \Carbon\Carbon::parse($booking->check_in_date)->diffInDays(\Carbon\Carbon::parse($booking->check_out_date)) }}</strong> Night(s)</span>
                    </div>
                    <div class="detail-item">
                        <i class="fas fa-bed"></i>
                        <span><strong>{{ $booking->number_of_rooms }}</strong> Room(s)</span>
                    </div>
                    <div class="detail-item">
                        <i class="fas fa-users"></i>
                        <span><strong>{{ $booking->adults }}</strong> Adult(s)
                        @if($booking->children > 0)
                            , <strong>{{ $booking->children }}</strong> Child(ren)
                        @endif
                        </span>
                    </div>
                    <div class="detail-item">
                        <i class="fas fa-money-bill-wave"></i>
                        <span><strong>₱{{ number_format($booking->total_amount, 2) }}</strong></span>
                    </div>
                </div>

                @if($booking->services->count() > 0)
                    <div class="services-list">
                        <h5><i class="fas fa-concierge-bell"></i> Additional Services</h5>
                        @foreach($booking->services as $service)
                            <span class="service-tag">{{ $service->name }}</span>
                        @endforeach
                    </div>
                @endif

                @if($booking->special_requests)
                    <div style="margin: 15px 0; padding: 15px; background: #f8f9fa; border-radius: 8px;">
                        <strong style="color: #2c3e50;"><i class="fas fa-comment-dots"></i> Special Requests:</strong>
                        <p style="margin: 10px 0 0 0; color: #7f8c8d;">{{ $booking->special_requests }}</p>
                    </div>
                @endif

                <div class="booking-actions">
                    <a href="{{ route('client.booking.show', $booking->id) }}" class="btn btn-primary">
                        <i class="fas fa-eye"></i> View Details
                    </a>
                    @if($booking->status === 'pending')
                        <form action="{{ route('client.booking.cancel', $booking->id) }}" method="POST" style="display: inline-block;" onsubmit="return confirm('Are you sure you want to cancel this booking?');">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn btn-secondary">
                                <i class="fas fa-times-circle"></i> Cancel Booking
                            </button>
                        </form>
                    @endif
                </div>
            </div>
        @endforeach
    @else
        <div class="card" style="text-align: center; padding: 60px 20px;">
            <i class="fas fa-calendar-times" style="font-size: 4rem; color: #dee2e6; margin-bottom: 20px;"></i>
            <h3 style="color: #7f8c8d; margin-bottom: 15px;">No bookings found</h3>
            <p style="color: #adb5bd; margin-bottom: 25px;">Start by creating your first booking</p>
            <a href="{{ route('client.booking.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Create New Booking
            </a>
        </div>
    @endif
</div>
@endsection

@push('scripts')
<script>
    function filterBookings(status) {
        const cards = document.querySelectorAll('.booking-card');
        const buttons = document.querySelectorAll('.filter-btn');
        
        // Update active button
        buttons.forEach(btn => btn.classList.remove('active'));
        event.target.classList.add('active');
        
        // Filter cards
        cards.forEach(card => {
            if (status === 'all' || card.dataset.status === status) {
                card.style.display = 'block';
            } else {
                card.style.display = 'none';
            }
        });
    }
</script>
@endpush
