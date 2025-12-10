<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\ServiceRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ServiceRequestController extends Controller
{
    public function index()
    {
        $service_requests = ServiceRequest::with('client', 'booking')
            ->orderBy('requested_at', 'desc')
            ->paginate(15);

        return view('staff.service-requests.index', compact('service_requests'));
    }

    public function show(ServiceRequest $serviceRequest)
    {
        $serviceRequest->load('client', 'booking', 'staff');
        return view('staff.service-requests.show', compact('serviceRequest'));
    }

    public function edit(ServiceRequest $serviceRequest)
    {
        $staff = Auth::guard('staff')->user();
        $serviceRequest->load('client', 'booking');
        return view('staff.service-requests.edit', compact('serviceRequest', 'staff'));
    }

    public function update(Request $request, ServiceRequest $serviceRequest)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,in_progress,completed,cancelled',
            'priority' => 'required|in:low,medium,high,urgent',
            'staff_notes' => 'nullable|string|max:1000',
        ]);

        if ($request->filled('status') && $request->input('status') === 'completed') {
            $validated['completed_at'] = now();
        }

        $serviceRequest->update($validated);

        return redirect()->route('staff.service-requests.show', $serviceRequest)
            ->with('success', 'Service request updated successfully.');
    }

    public function assign(Request $request, ServiceRequest $serviceRequest)
    {
        $validated = $request->validate([
            'assigned_to' => 'nullable|exists:staff,id',
        ]);

        $serviceRequest->update($validated);

        return redirect()->back()->with('success', 'Service request assigned successfully.');
    }
}
