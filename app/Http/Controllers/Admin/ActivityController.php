<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Activity;

class ActivityController extends Controller
{
    public function index()
    {
        $activities = Activity::latest()->paginate(10);
        return view('admin.activities.index', compact('activities'));
    }

    public function create()
    {
        return view('admin.activities.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'caption' => 'required|string|max:500',
        ]);

        Activity::create([
            'user_id' => auth()->id(),
            'caption' => $request->caption,
        ]);

        return redirect()->route('admin.activities.index')->with('success', 'Activity posted to the feed!');
    }

    public function edit(Activity $activity)
    {
        return view('admin.activities.edit', compact('activity'));
    }

    public function update(Request $request, Activity $activity)
    {
        $request->validate([
            'caption' => 'required|string|max:500',
        ]);

        $activity->update([
            'caption' => $request->caption,
        ]);

        return redirect()->route('admin.activities.index')->with('success', 'Activity updated!');
    }

    public function destroy(Activity $activity)
    {
        $activity->delete();
        return redirect()->route('admin.activities.index')->with('success', 'Activity removed!');
    }
}
