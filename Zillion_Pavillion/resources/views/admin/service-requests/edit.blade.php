@extends('admin.layout')

@section('page-title', 'Edit Service Request')

@section('content')
<div class="row">
    <div class="col-md-8 mx-auto">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Edit Service Request #{{ $serviceRequest->id }}</h5>
                <a href="{{ route('admin.service-requests.index') }}" class="btn btn-sm btn-outline-secondary">
                    <i class="bi bi-arrow-left"></i> Back to Requests
                </a>
            </div>
            <div class="card-body">
                <!-- Request Details (Read-only) -->
                <div class="mb-4 p-3 bg-light rounded">
                    <h6 class="mb-3">Request Information</h6>
                    <div class="row">
                        <div class="col-md-6 mb-2">
                            <strong>Client:</strong> {{ $serviceRequest->client->full_name }}
                        </div>
                        <div class="col-md-6 mb-2">
                            <strong>Service Type:</strong> {{ ucwords(str_replace('_', ' ', $serviceRequest->service_type)) }}
                        </div>
                        <div class="col-md-6 mb-2">
                            <strong>Room:</strong> {{ $serviceRequest->room_number ?? 'N/A' }}
                        </div>
                        <div class="col-md-6 mb-2">
                            <strong>Requested:</strong> {{ $serviceRequest->requested_at->format('M d, Y h:i A') }}
                        </div>
                        <div class="col-12 mt-2">
                            <strong>Description:</strong>
                            <p class="mb-0 mt-1">{{ $serviceRequest->description }}</p>
                        </div>
                    </div>
                </div>

                <form action="{{ route('admin.service-requests.update', $serviceRequest) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                        <select class="form-select @error('status') is-invalid @enderror" id="status" name="status" required>
                            <option value="pending" {{ $serviceRequest->status == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="in_progress" {{ $serviceRequest->status == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                            <option value="completed" {{ $serviceRequest->status == 'completed' ? 'selected' : '' }}>Completed</option>
                            <option value="cancelled" {{ $serviceRequest->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                        </select>
                        @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="priority" class="form-label">Priority <span class="text-danger">*</span></label>
                        <select class="form-select @error('priority') is-invalid @enderror" id="priority" name="priority" required>
                            <option value="low" {{ $serviceRequest->priority == 'low' ? 'selected' : '' }}>Low</option>
                            <option value="normal" {{ $serviceRequest->priority == 'normal' ? 'selected' : '' }}>Normal</option>
                            <option value="high" {{ $serviceRequest->priority == 'high' ? 'selected' : '' }}>High</option>
                            <option value="urgent" {{ $serviceRequest->priority == 'urgent' ? 'selected' : '' }}>Urgent</option>
                        </select>
                        @error('priority')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="assigned_to" class="form-label">Assign to Staff</label>
                        <select class="form-select @error('assigned_to') is-invalid @enderror" id="assigned_to" name="assigned_to">
                            <option value="">-- Unassigned --</option>
                            @foreach($staff as $member)
                                <option value="{{ $member->id }}" {{ $serviceRequest->assigned_to == $member->id ? 'selected' : '' }}>
                                    {{ $member->full_name }} ({{ $member->username }})
                                </option>
                            @endforeach
                        </select>
                        @error('assigned_to')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="staff_notes" class="form-label">Staff Notes</label>
                        <textarea class="form-control @error('staff_notes') is-invalid @enderror" 
                            id="staff_notes" name="staff_notes" rows="4" 
                            placeholder="Add internal notes about this request...">{{ $serviceRequest->staff_notes }}</textarea>
                        @error('staff_notes')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="text-muted">These notes are visible to staff only</small>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-save"></i> Update Request
                        </button>
                        <a href="{{ route('admin.service-requests.index') }}" class="btn btn-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
