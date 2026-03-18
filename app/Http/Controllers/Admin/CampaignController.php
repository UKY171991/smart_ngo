<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Campaign;
use Illuminate\Support\Str;

class CampaignController extends Controller
{
    public function index()
    {
        $campaigns = Campaign::latest()->paginate(10);
        return view('admin.campaigns.index', compact('campaigns'));
    }

    public function create()
    {
        return view('admin.campaigns.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'goal_amount' => 'required|numeric',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
        ]);

        Campaign::create([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'description' => $request->description,
            'goal_amount' => $request->goal_amount,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'is_active' => $request->has('is_active'),
        ]);

        return redirect()->route('admin.campaigns.index')->with('success', 'Campaign created successfully!');
    }

    public function edit(Campaign $campaign)
    {
        return view('admin.campaigns.edit', compact('campaign'));
    }

    public function update(Request $request, Campaign $campaign)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'goal_amount' => 'required|numeric',
        ]);

        $campaign->update([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'description' => $request->description,
            'goal_amount' => $request->goal_amount,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'is_active' => $request->has('is_active'),
        ]);

        return redirect()->route('admin.campaigns.index')->with('success', 'Campaign updated successfully!');
    }

    public function destroy(Campaign $campaign)
    {
        $campaign->delete();
        return redirect()->route('admin.campaigns.index')->with('success', 'Campaign deleted successfully!');
    }
}
