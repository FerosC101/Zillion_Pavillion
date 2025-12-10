@extends('staff.layout')

@section('title', 'Service Requests')
@section('page-title', 'All Service Requests')

@section('content')
<div class="mb-3">
    <a href="{{ route('staff.service-requests.index') }}" class="btn btn-primary">Refresh List</a>
</div>

<div class="table-responsive">
    <table class="table table-hover">
        <thead>
            <tr>
                <th>ID</th>
                <th>Client</th>
                <th>Service Type</th>
                <th>Priority</th>
                <th>Status</th>
                <th>Requested At</th>
                <th>Assigned To</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($service_requests as $request)
            <tr>
                <td>#{{ $request->id }}</td>
                <td>{{ $request->client->full_name ?? 'N/A' }}</td>
                <td>{{ $request->service_type }}</td>
                <td>
                    <span class="badge bg-{{ $request->priority === 'urgent' ? 'danger' : ($request->priority === 'high' ? 'warning' : 'info') }}">
                        {{ ucfirst($request->priority) }}
                    </span>
                </td>
                <td>
                    <span class="badge bg-{{ $request->status === 'pending' ? 'secondary' : ($request->status === 'in_progress' ? 'warning' : ($request->status === 'completed' ? 'success' : 'danger')) }}">
                        {{ str_replace('_', ' ', ucfirst($request->status)) }}
                    </span>
                </td>
                <td>{{ \Carbon\Carbon::parse($request->requested_at)->format('M d, Y H:i') }}</td>
                <td>{{ $request->staff?->full_name ?? 'Unassigned' }}</td>
                <td>
                    <a href="{{ route('staff.service-requests.show', $request->id) }}" class="btn btn-sm btn-info">
                        <i class="bi bi-eye"></i>
                    </a>
                    <a href="{{ route('staff.service-requests.edit', $request->id) }}" class="btn btn-sm btn-warning">
                        <i class="bi bi-pencil"></i>
                    </a>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="8" class="text-center">No service requests found</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-3">
    {{ $service_requests->links() }}
</div>
@endsection
