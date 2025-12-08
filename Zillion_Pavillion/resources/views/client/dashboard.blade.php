@extends('client.layout')

@section('title', 'Dashboard')
@section('page-title', 'My Dashboard')
@section('page-subtitle', 'Welcome back, {{ auth()->guard("web")->user()->full_name }}!')

@push('styles')
<style>
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 1.5rem;
        margin-bottom: 2rem;
    }

    .stat-card {
        background: #fff;
        border-radius: 10px;
        padding: 2rem;
        color: #333;
        position: relative;
        overflow: hidden;
        box-shadow: 0 5px 20px rgba(0,0,0,0.1);
    }

    .stat-icon {
        font-size: 2.5rem;
        margin-bottom: 1rem;
        color: var(--primary-color);
    }

    .stat-number {
        font-size: 3rem;
        font-weight: 700;
        margin-bottom: 0.5rem;
        color: var(--secondary-color);
    }

    .stat-label {
        font-size: 1rem;
        color: #7f8c8d;
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
        border-radius: 10px;
        padding: 2rem;
        text-align: center;
        box-shadow: 0 5px 20px rgba(0,0,0,0.1);
    }

    .action-icon {
        width: 80px;
        height: 80px;
        margin: 0 auto 1rem;
        background: var(--primary-color);
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
        font-size: 1.2rem;
    }

    .action-card p {
        color: #7f8c8d;
        margin-bottom: 1.5rem;
        font-size: 0.95rem;
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
        <div class="action-icon">
            <i class="fas fa-list"></i>
        </div>
        <h3>My Reservations</h3>
        <p>View and manage your bookings</p>
        <a href="{{ route('client.bookings.index') }}" class="btn btn-outline">
            View All
        </a>
    </div>

    <div class="action-card">
        <div class="action-icon">
            <i class="fas fa-concierge-bell"></i>
        </div>
        <h3>Service Requests</h3>
        <p>Request housekeeping & services</p>
        <a href="{{ route('client.service-requests.create') }}" class="btn btn-outline">
            New Request
        </a>
    </div>

    <div class="action-card">
        <div class="action-icon">
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
