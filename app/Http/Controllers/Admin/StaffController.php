<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class StaffController extends Controller
{
    public function index()
    {
        $staff = User::whereIn('role', ['staff', 'admin', 'super_admin'])
            ->orderByRaw("FIELD(role, 'super_admin', 'admin', 'staff')")
            ->orderBy('name')
            ->get();

        return view('admin.staff.index', compact('staff'));
    }

    public function create()
    {
        return view('admin.staff.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'     => ['required', 'string', 'max:255'],
            'email'    => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'role'     => ['required', 'in:staff,admin'],
        ]);

        User::create([
            'name'              => $data['name'],
            'email'             => $data['email'],
            'password'          => Hash::make($data['password']),
            'role'              => $data['role'],
            'email_verified_at' => now(),
        ]);

        return redirect()->route('admin.staff.index')
            ->with('success', "Staff account for \"{$data['name']}\" created successfully.");
    }

    public function destroy(User $staff)
    {
        if ($staff->isSuperAdmin()) {
            return back()->with('error', 'The Super Admin account cannot be deleted.');
        }

        $name = $staff->name;
        $staff->delete();

        return redirect()->route('admin.staff.index')
            ->with('success', "Staff account \"{$name}\" removed.");
    }
}
