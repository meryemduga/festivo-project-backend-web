<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::with('tags')->latest()->get();
        return view('welcome', compact('events'));
    }

    public function create()
    {
        $tags = Tag::all();
        return view('events.create', compact('tags'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'tags' => 'nullable|array',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('events', 'public');
        }

        $event = Event::create($validated);

        if ($request->has('tags')) {
            $event->tags()->sync($request->tags);
        }

        return redirect()->route('events.index')->with('success', 'Event succesvol aangemaakt!');
    }

    public function show(Event $event)
    {
        $event->load(['tags', 'comments.user']);
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
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'tags' => 'nullable|array',
        ]);

        if ($request->hasFile('image')) {
            // Verwijder oude afbeelding indien aanwezig
            if ($event->image) {
                Storage::disk('public')->delete($event->image);
            }
            $validated['image'] = $request->file('image')->store('events', 'public');
        }

        $event->update($validated);

        // Sync tags (of koppel los als er geen zijn geselecteerd)
        $event->tags()->sync($request->input('tags', []));

        return redirect()->route('events.index')->with('success', 'Event succesvol bijgewerkt!');
    }

    public function destroy(Event $event)
    {
        if ($event->image) {
            Storage::disk('public')->delete($event->image);
        }

        $event->delete();

        return redirect()->route('events.index')->with('success', 'Event succesvol verwijderd!');
    }
}