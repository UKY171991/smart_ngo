<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Designation;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class MemberController extends Controller
{
    public function index()
    {
        $members = User::where('role', 'member')->with('designation')->latest()->paginate(10);
        return view('admin.members.index', compact('members'));
    }

    public function create()
    {
        $designations = Designation::all();
        return view('admin.members.create', compact('designations'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'phone' => 'required|string|max:20',
            'designation_id' => 'required|exists:designations,id',
            'password' => 'required|min:8',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'designation_id' => $request->designation_id,
            'password' => Hash::make($request->password),
            'role' => 'member',
            'status' => 'active',
            'referral_code' => strtoupper(Str::random(8)),
        ]);

        return redirect()->route('admin.members.index')->with('success', 'New member added successfully!');
    }

    public function edit(User $member)
    {
        $designations = Designation::all();
        return view('admin.members.edit', compact('member', 'designations'));
    }

    public function update(Request $request, User $member)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,'.$member->id,
            'designation_id' => 'required|exists:designations,id',
        ]);

        $data = $request->only(['name', 'email', 'phone', 'designation_id', 'status']);
        
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $member->update($data);

        return redirect()->route('admin.members.index')->with('success', 'Member details updated!');
    }

    public function destroy(User $member)
    {
        $member->delete();
        return redirect()->route('admin.members.index')->with('success', 'Member removed from system.');
    }
}
