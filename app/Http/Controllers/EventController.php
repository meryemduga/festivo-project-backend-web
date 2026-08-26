<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Tag;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::with('tags')->latest()->get();
        return view('events.index', compact('events'));
    }

    public function create()
    {
        $tags = Tag::all();
        return view('events.create', compact('tags'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'   => 'required|string|max:255',
            'content' => 'required|string',
            'image'   => 'nullable|string',
            'tags'    => 'nullable|array',
        ]);

        $event = Event::create($validated);

        if ($request->has('tags')) {
            $event->tags()->sync($request->tags);
        }

        return redirect()->route('events.index')->with('success', 'Event aangemaakt!');
    }

    public function show(Event $event)
    {
        $event->load('tags');
        return view('events.show', compact('event'));
    }

    public function edit(Event $event)
    {
        $tags = Tag::all();
        return view('events.edit', compact('event', 'tags'));
    }

    public function update(Request $request, Event $event)
    {
        $validated = $request->validate([
            'title'   => 'required|string|max:255',
            'content' => 'required|string',
            'image'   => 'nullable|string',
            'tags'    => 'nullable|array',
        ]);

        $event->update($validated);

        if ($request->has('tags')) {
            $event->tags()->sync($request->tags);
        } else {
            $event->tags()->detach();
        }

        return redirect()->route('events.index')->with('success', 'Event bijgewerkt!');
    }
}
