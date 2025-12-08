@extends('client.layout')

@section('title', 'Service Request Details')
@section('page-title', 'Service Request #' . $serviceRequest->id)
@section('page-subtitle', 'View your service request details')

@push('styles')
<style>
    .detail-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 1.5rem;
        margin-bottom: 2rem;
    }

    .detail-item {
        background: #f8f9fa;
        padding: 1.2rem;
        border-radius: 10px;
        border-left: 4px solid var(--primary-color);
    }

    .detail-label {
        font-size: 0.85rem;
        color: #7f8c8d;
        margin-bottom: 5px;
        font-weight: 600;
        text-transform: uppercase;
    }

    .detail-value {
        font-size: 1.1rem;
        color: var(--secondary-color);
        font-weight: 600;
    }

    .status-timeline {
        background: #fff;
        border-radius: 12px;
        padding: 2rem;
        margin-bottom: 2rem;
    }

    .timeline-item {
        display: flex;
        gap: 1.5rem;
        margin-bottom: 1.5rem;
        position: relative;
    }

    .timeline-item:not(:last-child)::before {
        content: '';
        position: absolute;
        left: 20px;
        top: 40px;
        height: calc(100% + 1.5rem);
        width: 2px;
        background: #e0e0e0;
    }

    .timeline-icon {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        z-index: 1;
    }

    .timeline-content {
        flex: 1;
    }

    .timeline-title {
        font-weight: 600;
        color: var(--secondary-color);
        margin-bottom: 5px;
    }

    .timeline-time {
        font-size: 0.9rem;
        color: #7f8c8d;
    }

    .description-box {
        background: #f8f9fa;
        border-radius: 12px;
        padding: 1.5rem;
        margin-bottom: 2rem;
    }

    .staff-notes-box {
        background: #e3f2fd;
        border-radius: 12px;
        padding: 1.5rem;
        margin-top: 1rem;
        border-left: 4px solid #2196f3;
    }
</style>
@endpush

@section('content')
<div class="card">
    <div class="card-header">
        <span><i class="fas fa-concierge-bell"></i> Request Details</span>
        <a href="{{ route('client.service-requests.index') }}" class="btn btn-outline">
            <i class="fas fa-arrow-left"></i> Back to Requests
        </a>
    </div>

    <div class="detail-grid">
        <div class="detail-item">
            <div class="detail-label">Service Type</div>
            <div class="detail-value">
                <i class="fas fa-{{ 
                    $serviceRequest->service_type === 'housekeeping' ? 'broom' :
                    ($serviceRequest->service_type === 'room_service' ? 'concierge-bell' :
                    ($serviceRequest->service_type === 'laundry' ? 'tshirt' :
                    ($serviceRequest->service_type === 'maintenance' ? 'tools' :
                    ($serviceRequest->service_type === 'delivery' ? 'box' : 'concierge-bell'))))
                }}"></i>
                {{ ucwords(str_replace('_', ' ', $serviceRequest->service_type)) }}
            </div>
        </div>

        <div class="detail-item">
            <div class="detail-label">Status</div>
            <div class="detail-value">
                <span class="badge-{{ $serviceRequest->status }}" style="
                    padding: 6px 14px;
                    border-radius: 20px;
                    font-size: 0.9rem;
                    font-weight: 600;
                    @if($serviceRequest->status === 'pending')
                        background: #fff3cd; color: #856404;
                    @elseif($serviceRequest->status === 'in_progress')
                        background: #d1ecf1; color: #0c5460;
                    @elseif($serviceRequest->status === 'completed')
                        background: #d4edda; color: #155724;
                    @else
                        background: #f8d7da; color: #721c24;
                    @endif
                ">
                    {{ ucwords(str_replace('_', ' ', $serviceRequest->status)) }}
                </span>
            </div>
        </div>

        <div class="detail-item">
            <div class="detail-label">Priority</div>
            <div class="detail-value" style="
                @if($serviceRequest->priority === 'urgent')
                    color: #d32f2f;
                @elseif($serviceRequest->priority === 'high')
                    color: #f57c00;
                @endif
            ">
                {{ ucfirst($serviceRequest->priority) }} Priority
            </div>
        </div>

        <div class="detail-item">
            <div class="detail-label">Requested At</div>
            <div class="detail-value">{{ $serviceRequest->requested_at->format('M d, Y h:i A') }}</div>
        </div>

        @if($serviceRequest->room_number)
            <div class="detail-item">
                <div class="detail-label">Room Number</div>
                <div class="detail-value">{{ $serviceRequest->room_number }}</div>
            </div>
        @endif

        @if($serviceRequest->booking)
            <div class="detail-item">
                <div class="detail-label">Related Booking</div>
                <div class="detail-value">
                    <a href="{{ route('client.booking.show', $serviceRequest->booking->id) }}" style="color: var(--primary-color);">
                        Booking #{{ $serviceRequest->booking->id }}
                    </a>
                </div>
            </div>
        @endif

        @if($serviceRequest->staff)
            <div class="detail-item">
                <div class="detail-label">Assigned Staff</div>
                <div class="detail-value">{{ $serviceRequest->staff->full_name }}</div>
            </div>
        @endif

        @if($serviceRequest->completed_at)
            <div class="detail-item">
                <div class="detail-label">Completed At</div>
                <div class="detail-value">{{ $serviceRequest->completed_at->format('M d, Y h:i A') }}</div>
            </div>
        @endif
    </div>

    <div class="description-box">
        <h3 style="margin-bottom: 1rem; color: var(--secondary-color);">
            <i class="fas fa-align-left"></i> Description
        </h3>
        <p style="color: #34495e; line-height: 1.6;">{{ $serviceRequest->description }}</p>
    </div>

    @if($serviceRequest->staff_notes)
        <div class="staff-notes-box">
            <h3 style="margin-bottom: 1rem; color: #1976d2;">
                <i class="fas fa-comment-dots"></i> Staff Notes
            </h3>
            <p style="color: #0d47a1; line-height: 1.6;">{{ $serviceRequest->staff_notes }}</p>
        </div>
    @endif

    @if($serviceRequest->status === 'pending')
        <div class="btn-group">
            <form action="{{ route('client.service-requests.cancel', $serviceRequest->id) }}" method="POST">
                @csrf
                @method('PATCH')
                <button type="submit" class="btn" style="background: #dc3545; color: #fff;" 
                    onclick="return confirm('Are you sure you want to cancel this request?')">
                    <i class="fas fa-times"></i> Cancel Request
                </button>
            </form>
        </div>
    @endif
</div>
@endsection
