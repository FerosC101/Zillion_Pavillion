@extends('admin.layout')

@section('title', 'Staff Details')
@section('page-title', 'Staff Member Details')

@section('content')
<div class="row">
    <div class="col-md-8 mx-auto">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">
                    <i class="bi bi-person-circle"></i> {{ $staff->full_name }}
                </h5>
            </div>
            <div class="card-body">
                <div class="row mb-4">
                    <div class="col-md-6">
                        <h6 class="text-muted">Full Name</h6>
                        <p class="lead">{{ $staff->full_name }}</p>
                    </div>
                    <div class="col-md-6">
                        <h6 class="text-muted">Username</h6>
                        <p class="lead">{{ $staff->username }}</p>
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-md-6">
                        <h6 class="text-muted">Email</h6>
                        <p><a href="mailto:{{ $staff->email }}">{{ $staff->email }}</a></p>
                    </div>
                    <div class="col-md-6">
                        <h6 class="text-muted">Phone</h6>
                        <p>{{ $staff->phone ?? 'Not provided' }}</p>
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-md-6">
                        <h6 class="text-muted">Position</h6>
                        <p>{{ $staff->position ?? 'Not assigned' }}</p>
                    </div>
                    <div class="col-md-6">
                        <h6 class="text-muted">Department</h6>
                        <p>{{ $staff->department ?? 'Not assigned' }}</p>
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-md-6">
                        <h6 class="text-muted">Status</h6>
                        <p>
                            @if($staff->is_active)
                                <span class="badge bg-success">Active</span>
                            @else
                                <span class="badge bg-secondary">Inactive</span>
                            @endif
                        </p>
                    </div>
                    <div class="col-md-6">
                        <h6 class="text-muted">Account Created</h6>
                        <p>{{ $staff->created_at->format('M d, Y H:i A') }}</p>
                    </div>
                </div>

                <hr>

                <h6 class="text-muted mb-3">Last Updated</h6>
                <p class="text-muted">{{ $staff->updated_at->format('M d, Y H:i A') }}</p>

                <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
                    <a href="{{ route('admin.staff.index') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left"></i> Back to List
                    </a>
                    <a href="{{ route('admin.staff.edit', $staff) }}" class="btn btn-warning">
                        <i class="bi bi-pencil"></i> Edit
                    </a>
                    <form action="{{ route('admin.staff.destroy', $staff) }}" method="POST" style="display: inline;" onsubmit="return confirm('Are you sure you want to delete this staff member? This action cannot be undone.');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">
                            <i class="bi bi-trash"></i> Delete
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
