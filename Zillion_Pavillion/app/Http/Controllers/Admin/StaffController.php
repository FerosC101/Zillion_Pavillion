<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class StaffController extends Controller
{
    public function index()
    {
        $staff = Staff::orderBy('created_at', 'desc')->paginate(15);
        return view('admin.staff.index', compact('staff'));
    }

    public function create()
    {
        return view('admin.staff.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'username' => 'required|string|unique:staff,username',
            'email' => 'required|email|unique:staff,email',
            'password' => 'required|string|min:6',
            'full_name' => 'required|string',
            'phone' => 'nullable|string',
            'position' => 'nullable|string',
            'department' => 'nullable|string',
        ]);

        $validated['password'] = Hash::make($validated['password']);
        Staff::create($validated);

        return redirect()->route('admin.staff.index')->with('success', 'Staff member created successfully.');
    }

    public function edit(Staff $staff)
    {
        return view('admin.staff.edit', compact('staff'));
    }

    public function update(Request $request, Staff $staff)
    {
        $validated = $request->validate([
            'username' => 'required|string|unique:staff,username,' . $staff->id,
            'email' => 'required|email|unique:staff,email,' . $staff->id,
            'full_name' => 'required|string',
            'phone' => 'nullable|string',
            'position' => 'nullable|string',
            'department' => 'nullable|string',
            'is_active' => 'boolean',
        ]);

        if ($request->filled('password')) {
            $validated['password'] = Hash::make($request->password);
        }

        $staff->update($validated);

        return redirect()->route('admin.staff.index')->with('success', 'Staff member updated successfully.');
    }

    public function destroy(Staff $staff)
    {
        $staff->delete();
        return redirect()->route('admin.staff.index')->with('success', 'Staff member deleted successfully.');
    }

    public function show(Staff $staff)
    {
        return view('admin.staff.show', compact('staff'));
    }
}
