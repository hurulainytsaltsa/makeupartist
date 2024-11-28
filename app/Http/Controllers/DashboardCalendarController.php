<?php

namespace App\Http\Controllers;

use App\Models\Calendar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class DashboardCalendarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $calendars = Calendar::all();
        return view('admin.calendar.index', compact('calendars'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $calendars = Calendar::all();
        return view('admin.calendar.create_calendar', compact('calendars'));
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
    public function show(string $id)
    {
        $calendars = Calendar::all();
        return view('admin.calendar.show_all', compact('calendars'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $calendar = Calendar::findOrFail($id);
        return view('admin.calendar.edit_calendar', compact('calendar'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'start' => 'required|date_format:Y-m-d\TH:i',
            'color' => 'required|string|max:20',
        ]);

        try {
            $calendar = Calendar::findOrFail($id);

            $calendar->update($validatedData);

            session()->flash('success', 'Event berhasil diperbarui.');

            return redirect()->route('dashboard-calendar.index');
        } catch (\Exception $e) {

            Log::error('Error updating calendar: ' . $e->getMessage());

            return response()->json(['message' => 'Terjadi kesalahan saat memperbarui event.'], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $calendar = Calendar::findOrFail($id);
        $calendar->delete();
        return redirect('/dashboard-calendar')->with('pesan', 'Data sudah berhasil dihapus');
    }
}
