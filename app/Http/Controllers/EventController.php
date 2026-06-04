<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    // ─── Public ──────────────────────────────────────────────────────────────

    public function index(Request $request)
    {
        $query = Event::published()->orderBy('start_date', 'asc');

        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        $tab       = $request->input('tab', 'calendar');
        $upcoming  = Event::published()->upcoming()->orderBy('start_date')->take(6)->get();
        $past      = Event::published()->where('start_date', '<', now())->orderBy('start_date', 'desc')->take(6)->get();
        $events    = $query->paginate(10)->withQueryString();

        return view('pages.events.index', compact('upcoming', 'past', 'events', 'tab'));
    }

    public function show(Event $event)
    {
        if (!$event->is_published) abort(404);
        $related = Event::published()
            ->where('id', '!=', $event->id)
            ->where('type', $event->type)
            ->orderBy('start_date', 'desc')
            ->take(3)
            ->get();
        return view('pages.events.show', compact('event', 'related'));
    }

    /**
     * JSON endpoint for FullCalendar.js
     */
    public function calendarData(Request $request)
    {
        $events = Event::published()
            ->when($request->filled('start'), fn($q) => $q->where('start_date', '>=', $request->start))
            ->when($request->filled('end'),   fn($q) => $q->where('start_date', '<=', $request->end))
            ->get()
            ->map(fn($e) => [
                'id'              => $e->id,
                'title'           => $e->title,
                'start'           => $e->start_date->toIso8601String(),
                'end'             => $e->end_date ? $e->end_date->toIso8601String() : null,
                'url'             => route('events.show', $e),
                'backgroundColor' => $e->type_calendar_color,
                'borderColor'     => $e->type_calendar_color,
                'extendedProps'   => [
                    'type'     => $e->type,
                    'location' => $e->location,
                ],
            ]);

        return response()->json($events);
    }

    // ─── Admin ────────────────────────────────────────────────────────────────

    public function adminIndex()
    {
        $events = Event::orderBy('start_date', 'desc')->paginate(15);
        $user   = auth()->user()->load('profile', 'role');
        return view('dashboard.events.index', compact('events', 'user'));
    }

    public function create()
    {
        $user = auth()->user()->load('profile', 'role');
        return view('dashboard.events.create', compact('user'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'            => 'required|string|max:200',
            'description'      => 'nullable|string',
            'location'         => 'nullable|string|max:200',
            'start_date'       => 'required|date',
            'end_date'         => 'nullable|date|after_or_equal:start_date',
            'type'             => 'required|in:rapat,seminar,pelatihan,webinar,musyawarah,lainnya',
            'registration_url' => 'nullable|url',
            'contact_person'   => 'nullable|string|max:200',
            'cover_image'      => 'nullable|image|max:5120',
            'is_published'     => 'nullable|boolean',
            'is_featured'      => 'nullable|boolean',
        ]);

        $coverPath = null;
        if ($request->hasFile('cover_image')) {
            $file      = $request->file('cover_image');
            $filename  = 'event_cover_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/events'), $filename);
            $coverPath = 'uploads/events/' . $filename;
        }

        Event::create([
            'title'            => $request->title,
            'description'      => $request->description,
            'location'         => $request->location,
            'start_date'       => $request->start_date,
            'end_date'         => $request->end_date,
            'type'             => $request->type,
            'registration_url' => $request->registration_url,
            'contact_person'   => $request->contact_person,
            'cover_image'      => $coverPath,
            'is_published'     => $request->boolean('is_published', true),
            'is_featured'      => $request->boolean('is_featured'),
        ]);

        return redirect()->route('dashboard.events')->with('success', 'Agenda/event berhasil ditambahkan!');
    }

    public function edit(Event $event)
    {
        $user = auth()->user()->load('profile', 'role');
        return view('dashboard.events.edit', compact('event', 'user'));
    }

    public function update(Request $request, Event $event)
    {
        $request->validate([
            'title'            => 'required|string|max:200',
            'description'      => 'nullable|string',
            'location'         => 'nullable|string|max:200',
            'start_date'       => 'required|date',
            'end_date'         => 'nullable|date|after_or_equal:start_date',
            'type'             => 'required|in:rapat,seminar,pelatihan,webinar,musyawarah,lainnya',
            'registration_url' => 'nullable|url',
            'contact_person'   => 'nullable|string|max:200',
            'cover_image'      => 'nullable|image|max:5120',
            'is_published'     => 'nullable|boolean',
            'is_featured'      => 'nullable|boolean',
        ]);

        $data = $request->only('title', 'description', 'location', 'start_date', 'end_date', 'type', 'registration_url', 'contact_person');
        $data['is_published'] = $request->boolean('is_published', true);
        $data['is_featured']  = $request->boolean('is_featured');

        if ($request->hasFile('cover_image')) {
            if ($event->cover_image && file_exists(public_path($event->cover_image))) {
                @unlink(public_path($event->cover_image));
            }
            $file = $request->file('cover_image');
            $fname = 'event_cover_' . $event->id . '_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/events'), $fname);
            $data['cover_image'] = 'uploads/events/' . $fname;
        }

        $event->update($data);

        return redirect()->route('dashboard.events')->with('success', 'Event berhasil diperbarui!');
    }

    public function destroy(Event $event)
    {
        if ($event->cover_image && file_exists(public_path($event->cover_image))) {
            @unlink(public_path($event->cover_image));
        }
        $event->delete();
        return back()->with('success', 'Event berhasil dihapus.');
    }
}
