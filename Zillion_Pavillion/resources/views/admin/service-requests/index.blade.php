@extends('admin.layout')

@section('page-title', 'Service Requests Management')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Service Requests</h2>
</div>

<!-- Filters -->
<div class="card mb-3">
    <div class="card-body">
        <form action="{{ route('admin.service-requests.index') }}" method="GET" class="row g-3">
            <div class="col-md-3">
                <label class="form-label">Status</label>
                <select name="status" class="form-select" onchange="this.form.submit()">
                    <option value="">All Statuses</option>
                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="in_progress" {{ request('status') == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                    <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                    <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                </select>
            </div>
            <div class="col-md-3">
                <label class="form-label">Service Type</label>
                <select name="service_type" class="form-select" onchange="this.form.submit()">
                    <option value="">All Types</option>
                    <option value="housekeeping" {{ request('service_type') == 'housekeeping' ? 'selected' : '' }}>Housekeeping</option>
                    <option value="room_service" {{ request('service_type') == 'room_service' ? 'selected' : '' }}>Room Service</option>
                    <option value="laundry" {{ request('service_type') == 'laundry' ? 'selected' : '' }}>Laundry</option>
                    <option value="maintenance" {{ request('service_type') == 'maintenance' ? 'selected' : '' }}>Maintenance</option>
                    <option value="delivery" {{ request('service_type') == 'delivery' ? 'selected' : '' }}>Delivery</option>
                    <option value="other" {{ request('service_type') == 'other' ? 'selected' : '' }}>Other</option>
                </select>
            </div>
            <div class="col-md-3">
                <label class="form-label">Priority</label>
                <select name="priority" class="form-select" onchange="this.form.submit()">
                    <option value="">All Priorities</option>
                    <option value="low" {{ request('priority') == 'low' ? 'selected' : '' }}>Low</option>
                    <option value="normal" {{ request('priority') == 'normal' ? 'selected' : '' }}>Normal</option>
                    <option value="high" {{ request('priority') == 'high' ? 'selected' : '' }}>High</option>
                    <option value="urgent" {{ request('priority') == 'urgent' ? 'selected' : '' }}>Urgent</option>
                </select>
            </div>
            <div class="col-md-3 d-flex align-items-end">
                <a href="{{ route('admin.service-requests.index') }}" class="btn btn-secondary w-100">
                    <i class="bi bi-x-circle"></i> Clear Filters
                </a>
            </div>
        </form>
    </div>
</div>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Client</th>
                        <th>Service Type</th>
                        <th>Room</th>
                        <th>Priority</th>
                        <th>Status</th>
                        <th>Assigned To</th>
                        <th>Requested</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($requests as $request)
                        <tr>
                            <td><strong>#{{ $request->id }}</strong></td>
                            <td>{{ $request->client->full_name }}</td>
                            <td>
                                <i class="bi bi-{{ 
                                    $request->service_type === 'housekeeping' ? 'house' :
                                    ($request->service_type === 'room_service' ? 'bell' :
                                    ($request->service_type === 'laundry' ? 'bag' :
                                    ($request->service_type === 'maintenance' ? 'tools' :
                                    ($request->service_type === 'delivery' ? 'box' : 'three-dots'))))
                                }}"></i>
                                {{ ucwords(str_replace('_', ' ', $request->service_type)) }}
                            </td>
                            <td>{{ $request->room_number ?? 'N/A' }}</td>
                            <td>
                                @php
                                    $priorityColors = [
                                        'low' => 'secondary',
                                        'normal' => 'info',
                                        'high' => 'warning',
                                        'urgent' => 'danger'
                                    ];
                                @endphp
                                <span class="badge bg-{{ $priorityColors[$request->priority] }}">
                                    {{ ucfirst($request->priority) }}
                                </span>
                            </td>
                            <td>
                                @php
                                    $statusColors = [
                                        'pending' => 'warning',
                                        'in_progress' => 'info',
                                        'completed' => 'success',
                                        'cancelled' => 'danger'
                                    ];
                                @endphp
                                <span class="badge bg-{{ $statusColors[$request->status] }}">
                                    {{ ucwords(str_replace('_', ' ', $request->status)) }}
                                </span>
                            </td>
                            <td>{{ $request->staff?->full_name ?? 'Unassigned' }}</td>
                            <td>{{ $request->requested_at->format('M d, Y') }}</td>
                            <td>
                                <div class="btn-group btn-group-sm">
                                    <a href="{{ route('admin.service-requests.show', $request) }}" class="btn btn-outline-info" title="View">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.service-requests.edit', $request) }}" class="btn btn-outline-primary" title="Edit">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form action="{{ route('admin.service-requests.destroy', $request) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger" title="Delete" 
                                            onclick="return confirm('Are you sure?')">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="text-center py-4">
                                <i class="bi bi-bell" style="font-size: 3rem; opacity: 0.3;"></i>
                                <p class="mt-2">No service requests found</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-3">
            {{ $requests->links() }}
        </div>
    </div>
</div>
@endsection
