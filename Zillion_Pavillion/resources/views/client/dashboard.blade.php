@extends('client.layout')

@section('title', 'Dashboard')
@section('page-title', 'My Dashboard')
@section('page-subtitle', 'Welcome back, {{ auth()->guard('web')->user()->full_name }}!')

@push('styles')
<style>
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 1.5rem;
        margin-bottom: 2rem;
    }

    .stat-card {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-radius: 20px;
        padding: 2rem;
        color: #fff;
        position: relative;
        overflow: hidden;
        transition: all 0.3s;
    }

    .stat-card:nth-child(1) {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    }

    .stat-card:nth-child(2) {
        background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
    }

    .stat-card:nth-child(3) {
        background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
    }

    .stat-card:nth-child(4) {
        background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);
    }

    .stat-card:hover {
        transform: translateY(-10px) scale(1.02);
        box-shadow: 0 20px 40px rgba(0,0,0,0.2);
    }

    .stat-card::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -50%;
        width: 200%;
        height: 200%;
        background: rgba(255,255,255,0.1);
        transform: rotate(45deg);
    }

    .stat-icon {
        font-size: 3rem;
        margin-bottom: 1rem;
        opacity: 0.9;
    }

    .stat-number {
        font-size: 3rem;
        font-weight: 700;
        margin-bottom: 0.5rem;
    }

    .stat-label {
        font-size: 1rem;
        opacity: 0.9;
        font-weight: 500;
    }

    .quick-actions {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 1.5rem;
        margin-bottom: 2rem;
    }

    .action-card {
        background: #fff;
        border-radius: 16px;
        padding: 2rem;
        text-align: center;
        transition: all 0.3s;
        border: 2px solid transparent;
    }

    .action-card:hover {
        border-color: var(--primary-color);
        transform: translateY(-5px);
        box-shadow: 0 10px 30px rgba(255, 59, 48, 0.2);
    }

    .action-icon {
        width: 80px;
        height: 80px;
        margin: 0 auto 1rem;
        background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2rem;
        color: #fff;
    }

    .action-card h3 {
        color: var(--secondary-color);
        margin-bottom: 0.5rem;
    }

    .action-card p {
        color: #7f8c8d;
        margin-bottom: 1.5rem;
    }
</style>
@endpush

@section('content')
<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-icon">
            <i class="fas fa-calendar-check"></i>
        </div>
        <div class="stat-number">{{ $stats['total_bookings'] }}</div>
        <div class="stat-label">Total Bookings</div>
    </div>

    <div class="stat-card">
        <div class="stat-icon">
            <i class="fas fa-clock"></i>
        </div>
        <div class="stat-number">{{ $stats['pending_bookings'] }}</div>
        <div class="stat-label">Pending Approval</div>
    </div>

    <div class="stat-card">
        <div class="stat-icon">
            <i class="fas fa-check-circle"></i>
        </div>
        <div class="stat-number">{{ $stats['confirmed_bookings'] }}</div>
        <div class="stat-label">Confirmed Stays</div>
    </div>

    <div class="stat-card">
        <div class="stat-icon">
            <i class="fas fa-calendar-alt"></i>
        </div>
        <div class="stat-number">{{ $stats['upcoming_bookings'] }}</div>
        <div class="stat-label">Upcoming Stays</div>
    </div>
</div>

<div class="quick-actions">
    <div class="action-card">
        <div class="action-icon">
            <i class="fas fa-plus"></i>
        </div>
        <h3>Book a Room</h3>
        <p>Reserve your accommodation</p>
        <a href="{{ route('client.booking.create') }}" class="btn btn-primary">
            Book Now
        </a>
    </div>

    <div class="action-card">
        <div class="action-icon" style="background: linear-gradient(135deg, #667eea, #764ba2);">
            <i class="fas fa-list"></i>
        </div>
        <h3>My Reservations</h3>
        <p>View and manage your bookings</p>
        <a href="{{ route('client.bookings.index') }}" class="btn btn-outline">
            View All
        </a>
    </div>

    <div class="action-card">
        <div class="action-icon" style="background: linear-gradient(135deg, #f093fb, #f5576c);">
            <i class="fas fa-concierge-bell"></i>
        </div>
        <h3>Service Requests</h3>
        <p>Request housekeeping & services</p>
        <a href="{{ route('client.service-requests.create') }}" class="btn btn-outline">
            New Request
        </a>
    </div>

    <div class="action-card">
        <div class="action-icon" style="background: linear-gradient(135deg, #43e97b, #38f9d7);">
            <i class="fas fa-user"></i>
        </div>
        <h3>My Profile</h3>
        <p>Update your personal information</p>
        <a href="{{ route('client.profile') }}" class="btn btn-outline">
            Edit Profile
        </a>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <span><i class="fas fa-history"></i> Recent Bookings</span>
        <a href="{{ route('client.bookings.index') }}" class="btn btn-outline">
            View All <i class="fas fa-arrow-right"></i>
        </a>
    </div>

    @if($bookings->count() > 0)
        <div style="overflow-x: auto;">
            <table style="width: 100%; border-collapse: collapse;">
                <thead>
                    <tr style="background: #f8f9fa; text-align: left;">
                        <th style="padding: 12px; border-bottom: 2px solid #dee2e6;">Room Type</th>
                        <th style="padding: 12px; border-bottom: 2px solid #dee2e6;">Check-In</th>
                        <th style="padding: 12px; border-bottom: 2px solid #dee2e6;">Check-Out</th>
                        <th style="padding: 12px; border-bottom: 2px solid #dee2e6;">Rooms</th>
                        <th style="padding: 12px; border-bottom: 2px solid #dee2e6;">Guests</th>
                        <th style="padding: 12px; border-bottom: 2px solid #dee2e6;">Status</th>
                        <th style="padding: 12px; border-bottom: 2px solid #dee2e6;">Total</th>
                        <th style="padding: 12px; border-bottom: 2px solid #dee2e6;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($bookings as $booking)
                        <tr style="border-bottom: 1px solid #dee2e6;">
                            <td style="padding: 12px;">{{ $booking->room_type ?? 'Standard' }}</td>
                            <td style="padding: 12px;">{{ \Carbon\Carbon::parse($booking->check_in_date)->format('M d, Y') }}</td>
                            <td style="padding: 12px;">{{ \Carbon\Carbon::parse($booking->check_out_date)->format('M d, Y') }}</td>
                            <td style="padding: 12px;">{{ $booking->number_of_rooms }}</td>
                            <td style="padding: 12px;">{{ $booking->adults }}A @if($booking->children > 0), {{ $booking->children }}C @endif</td>
                            <td style="padding: 12px;">
                                <span class="badge-{{ $booking->status }}" style="
                                    padding: 5px 12px;
                                    border-radius: 20px;
                                    font-size: 0.85rem;
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
                            </td>
                            <td style="padding: 12px; font-weight: 600;">₱{{ number_format($booking->total_amount, 2) }}</td>
                            <td style="padding: 12px;">
                                <a href="{{ route('client.booking.show', $booking->id) }}" class="btn btn-primary" style="padding: 6px 12px; font-size: 0.9rem;">
                                    <i class="fas fa-eye"></i> View
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div style="text-align: center; padding: 40px; color: #7f8c8d;">
            <i class="fas fa-bed" style="font-size: 3rem; margin-bottom: 15px; opacity: 0.5;"></i>
            <p style="font-size: 1.1rem; margin-bottom: 20px;">No reservations yet</p>
            <a href="{{ route('client.booking.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Make Your First Reservation
            </a>
        </div>
    @endif
</div>
@endsection
