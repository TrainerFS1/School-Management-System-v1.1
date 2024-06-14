<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event; // Pastikan model Event sudah di-import

class EventController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'event_date' => 'required|date',
        ]);

        try {
            Event::create([
                'title' => $request->title,
                'event_date' => $request->event_date,
            ]);

            return response()->json(['message' => 'Event created successfully']);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to create event: ' . $e->getMessage()], 500);
        }
    }

    public function fetchEvents()
    {
        $events = Event::select('id', 'title', 'event_date as start')->get();

        return response()->json($events);
    }

    public function deleteAllEvents(Request $request)
    {
        try {
            Event::truncate(); // Menghapus semua record dari tabel events

            return response()->json(['message' => 'All events deleted successfully']);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to delete events: ' . $e->getMessage()], 500);
        }
    }
}
