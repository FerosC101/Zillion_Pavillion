@extends('client.layout')

@section('title', 'Service Requests')
@section('page-title', 'Service Requests')
@section('page-subtitle', 'Manage your housekeeping, room service, and other requests')

@push('styles')
<style>
    .request-card {
        background: #fff;
        border-radius: 12px;
        padding: 1.5rem;
        margin-bottom: 1rem;
        border-left: 4px solid #ddd;
        transition: all 0.3s;
    }

    .request-card.pending {
        border-left-color: #ffc107;
    }

    .request-card.in_progress {
        border-left-color: #17a2b8;
    }

    .request-card.completed {
        border-left-color: #28a745;
    }

    .request-card.cancelled {
        border-left-color: #dc3545;
    }

    .request-card:hover {
        box-shadow: 0 5px 20px rgba(0,0,0,0.1);
        transform: translateX(5px);
    }

    .request-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1rem;
    }

    .service-type-badge {
        display: inline-block;
        padding: 6px 14px;
        border-radius: 20px;
        font-size: 0.85rem;
        font-weight: 600;
        background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
        color: #fff;
    }

    .priority-badge {
        padding: 4px 10px;
        border-radius: 12px;
        font-size: 0.8rem;
        font-weight: 600;
    }

    .priority-low { background: #e3f2fd; color: #1976d2; }
    .priority-normal { background: #f1f8e9; color: #689f38; }
    .priority-high { background: #fff3e0; color: #f57c00; }
    .priority-urgent { background: #ffebee; color: #d32f2f; }

    .request-meta {
        display: flex;
        gap: 1.5rem;
        font-size: 0.9rem;
        color: #666;
        margin-bottom: 1rem;
    }

    .request-meta i {
        color: var(--primary-color);
        margin-right: 5px;
    }

    .empty-state {
        text-align: center;
        padding: 60px 20px;
        color: #7f8c8d;
    }

    .empty-state i {
        font-size: 4rem;
        margin-bottom: 20px;
        opacity: 0.3;
    }
</style>
@endpush

@section('content')
<div class="card">
    <div class="card-header">
        <span><i class="fas fa-concierge-bell"></i> All Service Requests</span>
        <a href="{{ route('client.service-requests.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> New Request
        </a>
    </div>

    @if($requests->count() > 0)
        @foreach($requests as $request)
            <div class="request-card {{ $request->status }}">
                <div class="request-header">
                    <div>
                        <span class="service-type-badge">
                            <i class="fas fa-{{ 
                                $request->service_type === 'housekeeping' ? 'broom' :
                                ($request->service_type === 'room_service' ? 'concierge-bell' :
                                ($request->service_type === 'laundry' ? 'tshirt' :
                                ($request->service_type === 'maintenance' ? 'tools' :
                                ($request->service_type === 'delivery' ? 'box' : 'concierge-bell'))))
                            }}"></i>
                            {{ ucwords(str_replace('_', ' ', $request->service_type)) }}
                        </span>
                        <span class="priority-badge priority-{{ $request->priority }}">
                            {{ ucfirst($request->priority) }}
                        </span>
                    </div>
                    <div>
                        <span class="badge-{{ $request->status }}" style="
                            padding: 6px 14px;
                            border-radius: 20px;
                            font-size: 0.85rem;
                            font-weight: 600;
                            @if($request->status === 'pending')
                                background: #fff3cd; color: #856404;
                            @elseif($request->status === 'in_progress')
                                background: #d1ecf1; color: #0c5460;
                            @elseif($request->status === 'completed')
                                background: #d4edda; color: #155724;
                            @else
                                background: #f8d7da; color: #721c24;
                            @endif
                        ">
                            {{ ucwords(str_replace('_', ' ', $request->status)) }}
                        </span>
                    </div>
                </div>

                <div class="request-meta">
                    <span><i class="fas fa-clock"></i> {{ $request->requested_at->diffForHumans() }}</span>
                    @if($request->room_number)
                        <span><i class="fas fa-door-open"></i> Room {{ $request->room_number }}</span>
                    @endif
                    @if($request->booking)
                        <span><i class="fas fa-calendar"></i> Booking #{{ $request->booking->id }}</span>
                    @endif
                    @if($request->staff)
                        <span><i class="fas fa-user-tie"></i> Assigned to {{ $request->staff->full_name }}</span>
                    @endif
                </div>

                <p style="color: #34495e; margin-bottom: 1rem;">{{ $request->description }}</p>

                <div style="display: flex; gap: 10px;">
                    <a href="{{ route('client.service-requests.show', $request->id) }}" class="btn btn-outline" style="font-size: 0.9rem;">
                        <i class="fas fa-eye"></i> View Details
                    </a>
                    @if($request->status === 'pending')
                        <form action="{{ route('client.service-requests.cancel', $request->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn" style="background: #dc3545; color: #fff; font-size: 0.9rem;" 
                                onclick="return confirm('Are you sure you want to cancel this request?')">
                                <i class="fas fa-times"></i> Cancel
                            </button>
                        </form>
                    @endif
                </div>
            </div>
        @endforeach

        <div style="margin-top: 2rem;">
            {{ $requests->links() }}
        </div>
    @else
        <div class="empty-state">
            <i class="fas fa-concierge-bell"></i>
            <h3>No service requests yet</h3>
            <p>Request housekeeping, room service, or other services</p>
            <a href="{{ route('client.service-requests.create') }}" class="btn btn-primary" style="margin-top: 20px;">
                <i class="fas fa-plus"></i> Create Your First Request
            </a>
        </div>
    @endif
</div>
@endsection
