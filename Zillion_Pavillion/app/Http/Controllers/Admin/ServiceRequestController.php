<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ServiceRequest;
use App\Models\Staff;
use Illuminate\Http\Request;

class ServiceRequestController extends Controller
{
    public function index(Request $request)
    {
        $query = ServiceRequest::with(['client', 'booking', 'staff']);

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter by service type
        if ($request->filled('service_type')) {
            $query->where('service_type', $request->service_type);
        }

        // Filter by priority
        if ($request->filled('priority')) {
            $query->where('priority', $request->priority);
        }

        $requests = $query->orderBy('created_at', 'desc')->paginate(20);

        return view('admin.service-requests.index', compact('requests'));
    }

    public function show(ServiceRequest $serviceRequest)
    {
        $serviceRequest->load(['client', 'booking', 'staff']);
        return view('admin.service-requests.show', compact('serviceRequest'));
    }

    public function edit(ServiceRequest $serviceRequest)
    {
        $staff = Staff::where('is_active', true)->get();
        return view('admin.service-requests.edit', compact('serviceRequest', 'staff'));
    }

    public function update(Request $request, ServiceRequest $serviceRequest)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,in_progress,completed,cancelled',
            'assigned_to' => 'nullable|exists:staff,id',
            'staff_notes' => 'nullable|string',
            'priority' => 'required|in:low,normal,high,urgent',
        ]);

        if ($validated['status'] === 'completed' && !$serviceRequest->completed_at) {
            $validated['completed_at'] = now();
        }

        $serviceRequest->update($validated);

        return redirect()->route('admin.service-requests.index')
            ->with('success', 'Service request updated successfully!');
    }

    public function destroy(ServiceRequest $serviceRequest)
    {
        $serviceRequest->delete();

        return redirect()->route('admin.service-requests.index')
            ->with('success', 'Service request deleted successfully!');
    }
}
