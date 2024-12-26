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

    //  Menampilkan semua data kalender.

    // Menampilkan semua data kalender.
    public function index()
    {
        $calendars = Calendar::all();
        return view('layouts.calendar.index', compact('calendars'));
    }

    /**
     * Show the form for creating a new resource.
     */

    //  Menampilkan form untuk menambahkan data kalender baru.
    public function create()
    {
        $calendars = Calendar::all();
        return view('layouts.calendar.create_calendar', compact('calendars'));
    }

    /**
     * Store a newly created resource in storage.
     */

    //  Menyimpan data kalender baru ke dalam database.
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

    //  Menampilkan detail data kalender berdasarkan parameter.
    public function show(Calendar $calendar)
    {
        $calendars = Calendar::all();
        return view('layouts.calendar.show_all', compact('calendars'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {

    }


    public function destroy(string $id)
    {

    }

    public function getEvents()
    {

    }
    public function showAll()
    {

    }

}
