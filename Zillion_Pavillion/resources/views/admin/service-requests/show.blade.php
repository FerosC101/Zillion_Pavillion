@extends('admin.layout')

@section('page-title', 'Service Request Details')

@section('content')
<div class="row">
    <div class="col-md-10 mx-auto">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Service Request #{{ $serviceRequest->id }}</h5>
                <div>
                    <a href="{{ route('admin.service-requests.edit', $serviceRequest) }}" class="btn btn-sm btn-primary me-2">
                        <i class="bi bi-pencil"></i> Edit
                    </a>
                    <a href="{{ route('admin.service-requests.index') }}" class="btn btn-sm btn-outline-secondary">
                        <i class="bi bi-arrow-left"></i> Back
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="row mb-4">
                    <div class="col-md-6">
                        <h6 class="text-muted mb-3">Request Information</h6>
                        <table class="table table-sm">
                            <tr>
                                <th width="40%">Service Type:</th>
                                <td>
                                    <i class="bi bi-{{ 
                                        $serviceRequest->service_type === 'housekeeping' ? 'house' :
                                        ($serviceRequest->service_type === 'room_service' ? 'bell' :
                                        ($serviceRequest->service_type === 'laundry' ? 'bag' :
                                        ($serviceRequest->service_type === 'maintenance' ? 'tools' :
                                        ($serviceRequest->service_type === 'delivery' ? 'box' : 'three-dots'))))
                                    }}"></i>
                                    {{ ucwords(str_replace('_', ' ', $serviceRequest->service_type)) }}
                                </td>
                            </tr>
                            <tr>
                                <th>Status:</th>
                                <td>
                                    @php
                                        $statusColors = [
                                            'pending' => 'warning',
                                            'in_progress' => 'info',
                                            'completed' => 'success',
                                            'cancelled' => 'danger'
                                        ];
                                    @endphp
                                    <span class="badge bg-{{ $statusColors[$serviceRequest->status] }}">
                                        {{ ucwords(str_replace('_', ' ', $serviceRequest->status)) }}
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <th>Priority:</th>
                                <td>
                                    @php
                                        $priorityColors = [
                                            'low' => 'secondary',
                                            'normal' => 'info',
                                            'high' => 'warning',
                                            'urgent' => 'danger'
                                        ];
                                    @endphp
                                    <span class="badge bg-{{ $priorityColors[$serviceRequest->priority] }}">
                                        {{ ucfirst($serviceRequest->priority) }}
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <th>Room Number:</th>
                                <td>{{ $serviceRequest->room_number ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th>Requested At:</th>
                                <td>{{ $serviceRequest->requested_at->format('M d, Y h:i A') }}</td>
                            </tr>
                            @if($serviceRequest->completed_at)
                            <tr>
                                <th>Completed At:</th>
                                <td>{{ $serviceRequest->completed_at->format('M d, Y h:i A') }}</td>
                            </tr>
                            @endif
                        </table>
                    </div>

                    <div class="col-md-6">
                        <h6 class="text-muted mb-3">Client & Assignment</h6>
                        <table class="table table-sm">
                            <tr>
                                <th width="40%">Client:</th>
                                <td>
                                    <a href="{{ route('admin.clients.show', $serviceRequest->client->id) }}">
                                        {{ $serviceRequest->client->full_name }}
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <th>Client Email:</th>
                                <td>{{ $serviceRequest->client->email }}</td>
                            </tr>
                            <tr>
                                <th>Client Phone:</th>
                                <td>{{ $serviceRequest->client->phone ?? 'N/A' }}</td>
                            </tr>
                            @if($serviceRequest->booking)
                            <tr>
                                <th>Related Booking:</th>
                                <td>
                                    <a href="{{ route('admin.bookings.show', $serviceRequest->booking->id) }}">
                                        Booking #{{ $serviceRequest->booking->id }}
                                    </a>
                                </td>
                            </tr>
                            @endif
                            <tr>
                                <th>Assigned Staff:</th>
                                <td>
                                    @if($serviceRequest->staff)
                                        <a href="{{ route('admin.staff.show', $serviceRequest->staff->id) }}">
                                            {{ $serviceRequest->staff->full_name }}
                                        </a>
                                    @else
                                        <span class="text-muted">Unassigned</span>
                                    @endif
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>

                <div class="mb-4">
                    <h6 class="text-muted mb-3">Description</h6>
                    <div class="p-3 bg-light rounded">
                        {{ $serviceRequest->description }}
                    </div>
                </div>

                @if($serviceRequest->staff_notes)
                <div class="mb-4">
                    <h6 class="text-muted mb-3">Staff Notes</h6>
                    <div class="p-3 bg-info bg-opacity-10 border border-info rounded">
                        {{ $serviceRequest->staff_notes }}
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
