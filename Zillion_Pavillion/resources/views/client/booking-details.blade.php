@extends('client.layout')

@section('title', 'Booking Details')
@section('page-title', 'Booking Details')
@section('page-subtitle', 'View your booking information')

@push('styles')
<style>
    .detail-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 20px;
        margin-bottom: 25px;
    }

    .detail-box {
        padding: 20px;
        background: #f8f9fa;
        border-radius: 8px;
        border-left: 3px solid var(--primary-color);
    }

    .detail-box label {
        display: block;
        color: #7f8c8d;
        font-size: 0.9rem;
        margin-bottom: 8px;
        font-weight: 500;
    }

    .detail-box .value {
        color: #2c3e50;
        font-size: 1.1rem;
        font-weight: 600;
    }

    .status-banner {
        padding: 20px;
        border-radius: 8px;
        margin-bottom: 25px;
        text-align: center;
        font-size: 1.1rem;
        font-weight: 600;
    }

    .services-table {
        width: 100%;
        border-collapse: collapse;
        margin: 20px 0;
    }

    .services-table th,
    .services-table td {
        padding: 15px;
        text-align: left;
        border-bottom: 1px solid #dee2e6;
    }

    .services-table th {
        background: #f8f9fa;
        font-weight: 600;
        color: #2c3e50;
    }

    .services-table tr:last-child td {
        border-bottom: none;
    }

    .total-row {
        background: #f8f9fa;
        font-weight: 700;
        color: #2c3e50;
        font-size: 1.2rem;
    }

    .timeline {
        position: relative;
        padding: 20px 0;
    }

    .timeline-item {
        position: relative;
        padding-left: 40px;
        margin-bottom: 20px;
    }

    .timeline-item::before {
        content: '';
        position: absolute;
        left: 10px;
        top: 0;
        bottom: -20px;
        width: 2px;
        background: #dee2e6;
    }

    .timeline-item:last-child::before {
        display: none;
    }

    .timeline-dot {
        position: absolute;
        left: 0;
        top: 5px;
        width: 20px;
        height: 20px;
        border-radius: 50%;
        background: var(--primary-color);
    }

    .timeline-content {
        background: #f8f9fa;
        padding: 15px;
        border-radius: 8px;
    }

    .timeline-content strong {
        color: #2c3e50;
        display: block;
        margin-bottom: 5px;
    }

    .timeline-content span {
        color: #7f8c8d;
        font-size: 0.9rem;
    }
</style>
@endpush

@section('content')
<div class="card">
    <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
        <span>Booking #{{ $booking->id }}</span>
        <a href="{{ route('client.bookings.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Back to Bookings
        </a>
    </div>

    <div class="status-banner" style="
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
        <i class="fas fa-info-circle"></i>
        Status: {{ ucfirst($booking->status) }}
    </div>

    <h3 style="margin-bottom: 20px; color: #2c3e50;">
        <i class="fas fa-bed"></i> {{ $booking->room_type ?? 'Standard' }} Room Reservation
    </h3>

    <div class="detail-grid">
        <div class="detail-box">
            <label><i class="fas fa-calendar-check"></i> Check-In Date</label>
            <div class="value">{{ \Carbon\Carbon::parse($booking->check_in_date)->format('F d, Y') }}</div>
        </div>

        <div class="detail-box">
            <label><i class="fas fa-calendar-times"></i> Check-Out Date</label>
            <div class="value">{{ \Carbon\Carbon::parse($booking->check_out_date)->format('F d, Y') }}</div>
        </div>

        <div class="detail-box">
            <label><i class="fas fa-moon"></i> Number of Nights</label>
            <div class="value">{{ \Carbon\Carbon::parse($booking->check_in_date)->diffInDays(\Carbon\Carbon::parse($booking->check_out_date)) }}</div>
        </div>

        <div class="detail-box">
            <label><i class="fas fa-bed"></i> Number of Rooms</label>
            <div class="value">{{ $booking->number_of_rooms }}</div>
        </div>

        <div class="detail-box">
            <label><i class="fas fa-users"></i> Guests</label>
            <div class="value">{{ $booking->adults }} Adult(s)@if($booking->children > 0), {{ $booking->children }} Child(ren)@endif</div>
        </div>

        <div class="detail-box">
            <label><i class="fas fa-calendar-plus"></i> Booked On</label>
            <div class="value">{{ $booking->created_at->format('M d, Y') }}</div>
        </div>
    </div>

    @if($booking->special_requests)
        <div style="margin: 25px 0; padding: 20px; background: #f8f9fa; border-radius: 8px; border-left: 3px solid var(--primary-color);">
            <h4 style="margin: 0 0 10px 0; color: #2c3e50;">
                <i class="fas fa-comment-dots"></i> Special Requests
            </h4>
            <p style="margin: 0; color: #7f8c8d; line-height: 1.6;">{{ $booking->special_requests }}</p>
        </div>
    @endif
</div>

<div class="card">
    <div class="card-header">
        <i class="fas fa-concierge-bell"></i> Services & Pricing
    </div>

    @if($booking->services->count() > 0)
        <table class="services-table">
            <thead>
                <tr>
                    <th>Service</th>
                    <th>Description</th>
                    <th style="text-align: right;">Quantity</th>
                    <th style="text-align: right;">Price</th>
                    <th style="text-align: right;">Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach($booking->services as $service)
                    <tr>
                        <td><strong>{{ $service->name }}</strong></td>
                        <td>{{ $service->description }}</td>
                        <td style="text-align: right;">{{ $service->pivot->quantity }}</td>
                        <td style="text-align: right;">₱{{ number_format($service->pivot->price, 2) }}</td>
                        <td style="text-align: right;">₱{{ number_format($service->pivot->quantity * $service->pivot->price, 2) }}</td>
                    </tr>
                @endforeach
                <tr class="total-row">
                    <td colspan="4" style="text-align: right;">TOTAL AMOUNT:</td>
                    <td style="text-align: right;">₱{{ number_format($booking->total_amount, 2) }}</td>
                </tr>
            </tbody>
        </table>
    @else
        <div style="text-align: center; padding: 40px; color: #7f8c8d;">
            <i class="fas fa-box-open" style="font-size: 3rem; opacity: 0.5; margin-bottom: 15px;"></i>
            <p>No services selected for this booking</p>
        </div>
    @endif
</div>

@if($booking->status === 'pending')
    <div class="card">
        <div class="card-header" style="color: #856404;">
            <i class="fas fa-exclamation-triangle"></i> Actions
        </div>
        <p style="margin-bottom: 20px; color: #7f8c8d;">
            Your booking is currently pending approval. You can cancel this booking if needed.
        </p>
        <form action="{{ route('client.booking.cancel', $booking->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to cancel this booking? This action cannot be undone.');">
            @csrf
            @method('PATCH')
            <button type="submit" class="btn btn-secondary">
                <i class="fas fa-times-circle"></i> Cancel Booking
            </button>
        </form>
    </div>
@endif
@endsection
