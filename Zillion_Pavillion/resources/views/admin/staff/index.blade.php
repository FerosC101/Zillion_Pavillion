@extends('admin.layout')

@section('title', 'Staff Management')
@section('page-title', 'Staff Management')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Staff Members</h2>
    <a href="{{ route('admin.staff.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> Add New Staff
    </a>
</div>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<div class="card">
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead class="table-light">
                <tr>
                    <th>ID</th>
                    <th>Full Name</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Position</th>
                    <th>Department</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($staff as $member)
                <tr>
                    <td>#{{ $member->id }}</td>
                    <td>
                        <strong>{{ $member->full_name }}</strong>
                    </td>
                    <td>{{ $member->username }}</td>
                    <td>{{ $member->email }}</td>
                    <td>{{ $member->position ?? 'N/A' }}</td>
                    <td>{{ $member->department ?? 'N/A' }}</td>
                    <td>
                        @if($member->is_active)
                            <span class="badge bg-success">Active</span>
                        @else
                            <span class="badge bg-secondary">Inactive</span>
                        @endif
                    </td>
                    <td>
                        <div class="btn-group btn-group-sm" role="group">
                            <a href="{{ route('admin.staff.show', $member) }}" class="btn btn-outline-primary" title="View">
                                <i class="bi bi-eye"></i>
                            </a>
                            <a href="{{ route('admin.staff.edit', $member) }}" class="btn btn-outline-secondary" title="Edit">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <form action="{{ route('admin.staff.destroy', $member) }}" method="POST" style="display: inline;" onsubmit="return confirm('Are you sure you want to delete this staff member?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger" title="Delete">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="text-center py-4">
                        <p class="text-muted">No staff members found.</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Pagination -->
<div class="mt-4">
    {{ $staff->links() }}
</div>
@endsection
