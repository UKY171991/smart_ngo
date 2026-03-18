<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Beneficiary;
use Illuminate\Http\Request;

class BeneficiaryController extends Controller
{
    public function index()
    {
        $beneficiaries = Beneficiary::latest()->paginate(10);
        return view('admin.beneficiaries.index', compact('beneficiaries'));
    }

    public function create()
    {
        return view('admin.beneficiaries.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
            'details' => 'nullable|string',
            'help_history' => 'nullable|string',
        ]);

        Beneficiary::create($validated);

        return redirect()->route('admin.beneficiaries.index')->with('success', 'Beneficiary added successfully.');
    }

    public function show(Beneficiary $beneficiary)
    {
        return view('admin.beneficiaries.show', compact('beneficiary'));
    }

    public function edit(Beneficiary $beneficiary)
    {
        return view('admin.beneficiaries.edit', compact('beneficiary'));
    }

    public function update(Request $request, Beneficiary $beneficiary)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
            'details' => 'nullable|string',
            'help_history' => 'nullable|string',
        ]);

        $beneficiary->update($validated);

        return redirect()->route('admin.beneficiaries.index')->with('success', 'Beneficiary updated successfully.');
    }

    public function destroy(Beneficiary $beneficiary)
    {
        $beneficiary->delete();
        return redirect()->route('admin.beneficiaries.index')->with('success', 'Beneficiary deleted successfully.');
    }
}
