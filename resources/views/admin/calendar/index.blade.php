@extends('admin.layouts.main')
@section('title', 'Calendar')
@section('navCalendar', 'active')

@section('content')
{{-- <!DOCTYPE html>
<html lang="en">

<head> --}}
    {{-- <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kalender Booking</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.css" rel="stylesheet"> --}}

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f9f9f9;
            color: #333;
        }

        h2 {
            color: #de8d9b;
            margin-bottom: 30px;
            text-align: center;
        }

        #calendar {
            background-color: #fff;
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }

        .fc-button {
            background-color: pink !important;
            color: white !important;
            border: none !important;
            box-shadow: none !important;
        }

        .fc-button:hover {
            background-color: #e0879e !important;
        }

        .fc-button-active {
            background-color: #de8d9b !important;
            color: white !important;
        }

        .fc-daygrid-day-number,
        .fc-timegrid-axis-cushion,
        .fc-col-header-cell-cushion {
            color: pink !important;
        }
    </style>
{{-- </head>

<body> --}}
    <div class="container my-5">
        <h2>Kalender Booking</h2>

        <div class="row mb-3">
            <div class="col text-start">
                @if(Auth::check() && Auth::user()->isAdmin == 1)
                    <a href="/dashboard" class="btn btn-primary" style="background-color: pink; border-color: pink;">Back</a>
                @endif
            </div>

            <div class="col text-end">
                @if(Auth::check() && Auth::user()->isAdmin == 1)
                    <a href="/dashboard-calendar/create" class="btn btn-primary" style="background-color: pink; border-color: pink;">New Event</a>
                    <a href="/dashboard-calendar/6" class="btn btn-primary" style="background-color: pink; border-color: pink;">Daftar Event</a>
                @endif
            </div>
        </div>

        <div id="calendar"></div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const calendarEl = document.getElementById('calendar');

            const calendar = new FullCalendar.Calendar(calendarEl, {
                locale: 'id',
                initialView: 'dayGridMonth',
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                events: @json($calendars),
                selectable: true,
                editable: false,
                eventTimeFormat: {
                    hour: '2-digit',
                    minute: '2-digit',
                    meridiem: false // Nonaktifkan AM/PM
                },
                eventClick: function (info) {
                    alert(`Event: ${info.event.title}`);
                }
            });

            calendar.render();
        });
    </script>
{{-- </body>
</html> --}}
@endsection
