@extends('staff.layout')

@section('title', 'Edit Service Request')
@section('page-title', 'Edit Service Request #' . $serviceRequest->id)

@section('content')
<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Update Service Request</h5>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('staff.service-requests.update', $serviceRequest->id) }}">
                    @csrf
                    @method('PATCH')

                    <div class="mb-3">
                        <label for="service_type" class="form-label">Service Type</label>
                        <input type="text" name="service_type" id="service_type" class="form-control" 
                            value="{{ $serviceRequest->service_type }}" disabled>
                    </div>

                    <div class="mb-3">
                        <label for="room_number" class="form-label">Room Number</label>
                        <input type="text" name="room_number" id="room_number" class="form-control" 
                            value="{{ $serviceRequest->room_number }}" disabled>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea name="description" id="description" class="form-control" rows="3" disabled>{{ $serviceRequest->description }}</textarea>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="status" class="form-label">Status</label>
                                <select name="status" id="status" class="form-select @error('status') is-invalid @enderror">
                                    <option value="pending" {{ $serviceRequest->status === 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="in_progress" {{ $serviceRequest->status === 'in_progress' ? 'selected' : '' }}>In Progress</option>
                                    <option value="completed" {{ $serviceRequest->status === 'completed' ? 'selected' : '' }}>Completed</option>
                                    <option value="cancelled" {{ $serviceRequest->status === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                </select>
                                @error('status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="priority" class="form-label">Priority</label>
                                <select name="priority" id="priority" class="form-select @error('priority') is-invalid @enderror">
                                    <option value="low" {{ $serviceRequest->priority === 'low' ? 'selected' : '' }}>Low</option>
                                    <option value="medium" {{ $serviceRequest->priority === 'medium' ? 'selected' : '' }}>Medium</option>
                                    <option value="high" {{ $serviceRequest->priority === 'high' ? 'selected' : '' }}>High</option>
                                    <option value="urgent" {{ $serviceRequest->priority === 'urgent' ? 'selected' : '' }}>Urgent</option>
                                </select>
                                @error('priority')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="staff_notes" class="form-label">Staff Notes</label>
                        <textarea name="staff_notes" id="staff_notes" class="form-control @error('staff_notes') is-invalid @enderror" 
                            rows="4" placeholder="Add any notes about the service request...">{{ $serviceRequest->staff_notes }}</textarea>
                        @error('staff_notes')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-check"></i> Update
                        </button>
                        <a href="{{ route('staff.service-requests.show', $serviceRequest->id) }}" class="btn btn-secondary">
                            <i class="bi bi-x"></i> Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Request Information</h5>
            </div>
            <div class="card-body">
                <p><strong>Request ID:</strong> #{{ $serviceRequest->id }}</p>
                <p><strong>Client:</strong> {{ $serviceRequest->client->full_name ?? 'N/A' }}</p>
                <p><strong>Current Status:</strong> {{ str_replace('_', ' ', ucfirst($serviceRequest->status)) }}</p>
                <p><strong>Current Priority:</strong> {{ ucfirst($serviceRequest->priority) }}</p>
                <p><strong>Requested At:</strong> {{ \Carbon\Carbon::parse($serviceRequest->requested_at)->format('M d, Y H:i') }}</p>
                @if($serviceRequest->completed_at)
                <p><strong>Completed At:</strong> {{ \Carbon\Carbon::parse($serviceRequest->completed_at)->format('M d, Y H:i') }}</p>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
