<?php

namespace App\Http\Controllers;

use App\Models\Calendar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Log;

class CalendarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $calendars = Calendar::all();
        return view('layouts.calendar.index', compact('calendars'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $calendars = Calendar::all();
        return view('layouts.calendar.create_calendar', compact('calendars'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string',
            'start' => 'required|date',
            'color' => 'required|string',
        ]);

        Calendar::create([
            'title' => $validated['title'],
            'start' => $validated['start'],
            'color' => $validated['color']
        ]);

        session()->flash('success', 'Booking berhasil dibuat.');

        return redirect('/dashboard-calendar');
    }
    /**
     * Display the specified resource.
     */
    public function show(Calendar $calendar)
    {
        $calendars = Calendar::all(); // Ambil semua event kalender
        return view('layouts.calendar.show_all', compact('calendars'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // $calendar = Calendar::findOrFail($id);
        // return view('layouts.calendar.edit_calendar', compact('calendar'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // $validatedData = $request->validate([
        //     'title' => 'required|string|max:255',
        //     'start' => 'required|date_format:Y-m-d\TH:i',
        //     'color' => 'required|string|max:20',
        // ]);

        // try {
        //     $calendar = Calendar::findOrFail($id);

        //     $calendar->update($validatedData);

        //     session()->flash('success', 'Event berhasil diperbarui.');

        //     return redirect()->route('calendar.index');
        // } catch (\Exception $e) {
        //     Log::error('Error updating calendar: ' . $e->getMessage());

        //     return response()->json(['message' => 'Terjadi kesalahan saat memperbarui event.'], 500);
        // }
    }


    public function destroy(string $id)
    {
        // $calendar = Calendar::findOrFail($id);
        // $calendar->delete();
        // return redirect('/calendar')->with('pesan', 'Data sudah berhasil dihapus');
    }

    public function getEvents()
    {
        // $events = Calendar::all();
        // $formattedEvents = $events->map(function ($event) {
        //     return [
        //         'title' => $event->title,
        //         'start' => $event->start_time->toIso8601String(),
        //         'end' => $event->end_time ? $event->end_time->toIso8601String() : $event->start_time->addHour()->toIso8601String(),
        //         'color' => $event->status == 'Available' ? 'green' : 'red',
        //     ];
        // });

        // return response()->json($formattedEvents);
    }
    public function showAll()
    {
        // $calendars = Calendar::all();

        // return view('layouts.calendar.show_all', compact('calendars'));
    }

}
