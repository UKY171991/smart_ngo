<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::latest('event_date')->paginate(10);
        return view('admin.events.index', compact('events'));
    }

    public function create()
    {
        return view('admin.events.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'event_date' => 'required|date',
            'location' => 'required|string|max:255',
            'fees' => 'nullable|numeric|min:0',
            'max_participants' => 'nullable|integer|min:1',
        ]);

        $data = $request->except('_token');
        $data['slug'] = Str::slug($request->title) . '-' . uniqid();
        
        Event::create($data);

        return redirect()->route('admin.events.index')->with('success', 'Event scheduled successfully!');
    }

    public function edit(Event $event)
    {
        return view('admin.events.edit', compact('event'));
    }

    public function update(Request $request, Event $event)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'event_date' => 'required|date',
            'location' => 'required|string|max:255',
            'fees' => 'nullable|numeric|min:0',
            'max_participants' => 'nullable|integer|min:1',
        ]);

        $data = $request->except('_token', '_method');
        $event->update($data);

        return redirect()->route('admin.events.index')->with('success', 'Event details updated!');
    }

    public function destroy(Event $event)
    {
        $event->delete();
        return redirect()->route('admin.events.index')->with('success', 'Event cancelled.');
    }
}
