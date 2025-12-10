@extends('staff.layout')

@section('title', 'Service Request Details')
@section('page-title', 'Service Request #' . $serviceRequest->id)

@section('content')
<div class="row">
    <div class="col-lg-8">
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Service Request Details</h5>
                <span class="badge bg-{{ $serviceRequest->status === 'pending' ? 'secondary' : ($serviceRequest->status === 'in_progress' ? 'warning' : ($serviceRequest->status === 'completed' ? 'success' : 'danger')) }}">
                    {{ str_replace('_', ' ', ucfirst($serviceRequest->status)) }}
                </span>
            </div>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <strong>Request ID:</strong>
                        <p>#{{ $serviceRequest->id }}</p>
                    </div>
                    <div class="col-md-6">
                        <strong>Service Type:</strong>
                        <p>{{ $serviceRequest->service_type }}</p>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <strong>Priority:</strong>
                        <p>
                            <span class="badge bg-{{ $serviceRequest->priority === 'urgent' ? 'danger' : ($serviceRequest->priority === 'high' ? 'warning' : 'info') }}">
                                {{ ucfirst($serviceRequest->priority) }}
                            </span>
                        </p>
                    </div>
                    <div class="col-md-6">
                        <strong>Room Number:</strong>
                        <p>{{ $serviceRequest->room_number ?? 'N/A' }}</p>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-12">
                        <strong>Description:</strong>
                        <p>{{ $serviceRequest->description }}</p>
                    </div>
                </div>

                @if($serviceRequest->staff_notes)
                <div class="row mb-3">
                    <div class="col-md-12">
                        <strong>Staff Notes:</strong>
                        <p>{{ $serviceRequest->staff_notes }}</p>
                    </div>
                </div>
                @endif

                <div class="row mb-3">
                    <div class="col-md-6">
                        <strong>Requested At:</strong>
                        <p>{{ \Carbon\Carbon::parse($serviceRequest->requested_at)->format('M d, Y H:i') }}</p>
                    </div>
                    @if($serviceRequest->completed_at)
                    <div class="col-md-6">
                        <strong>Completed At:</strong>
                        <p>{{ \Carbon\Carbon::parse($serviceRequest->completed_at)->format('M d, Y H:i') }}</p>
                    </div>
                    @endif
                </div>

                @if($serviceRequest->booking)
                <div class="row mb-3">
                    <div class="col-md-12">
                        <strong>Related Booking:</strong>
                        <p><a href="{{ route('staff.bookings.show', $serviceRequest->booking->id) }}">#{{ $serviceRequest->booking->id }}</a></p>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="mb-0">Client Information</h5>
            </div>
            <div class="card-body">
                <p><strong>Name:</strong> {{ $serviceRequest->client->full_name ?? 'N/A' }}</p>
                <p><strong>Email:</strong> <a href="mailto:{{ $serviceRequest->client->email ?? '' }}">{{ $serviceRequest->client->email ?? 'N/A' }}</a></p>
                <p><strong>Phone:</strong> {{ $serviceRequest->client->phone ?? 'N/A' }}</p>
            </div>
        </div>

        @if($serviceRequest->staff)
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="mb-0">Assigned Staff</h5>
            </div>
            <div class="card-body">
                <p><strong>Name:</strong> {{ $serviceRequest->staff->full_name }}</p>
                <p><strong>Position:</strong> {{ $serviceRequest->staff->position ?? 'N/A' }}</p>
                <p><strong>Phone:</strong> {{ $serviceRequest->staff->phone ?? 'N/A' }}</p>
            </div>
        </div>
        @endif

        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Actions</h5>
            </div>
            <div class="card-body">
                <a href="{{ route('staff.service-requests.edit', $serviceRequest->id) }}" class="btn btn-primary w-100 mb-2">
                    <i class="bi bi-pencil"></i> Edit
                </a>
                <a href="{{ route('staff.service-requests.index') }}" class="btn btn-secondary w-100">
                    <i class="bi bi-arrow-left"></i> Back
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
