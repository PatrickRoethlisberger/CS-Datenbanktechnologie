<?php

namespace App\Http\Controllers;

use Acaronlex\LaravelCalendar\Calendar;
use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('locations.index', [
            'locations' => Auth::user()->locations()->paginate(5),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('locations.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'description' => 'nullable|string|max:512',
            'streetname' => 'required|string|max:255',
            'streetnumber' => 'required|string|max:8',
            'plz' => 'required|integer|digits:4',
            'city' => 'required|string|max:255',
        ]);

        Auth::user()->locations()->create([
            'description' => $request->description,
            'streetname' => $request->streetname,
            'streetnumber' => $request->streetnumber,
            'plz' => $request->plz,
            'city' => $request->city,
        ]);

        return redirect(route('locations.index'));

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function show(Location $location)
    {
       $occupations = $location->occupations()->get();

       $events = [];


       foreach ($occupations as $occupation) {
            if ($occupation->user_id) {
                $backgroundcolor = '#F87171';
            } elseif ($occupation->date <= now()) {
                $backgroundcolor = '#FEE2E2';
            } else {
                $backgroundcolor = '#34D399';
            }

            $events[] = \Calendar::event(
                '', //event title
                true, //full day event?
                $occupation->date, //start time (you can also use Carbon instead of DateTime)
                $occupation->date, //end time (you can also use Carbon instead of DateTime)
                0, //optionally, you can specify an event ID
                [
                    'display' => 'background',
                    'backgroundColor' => $backgroundcolor,
                ]
            );
       }


        $calendar = new Calendar();
                $calendar->addEvents($events)
                ->setOptions([
                    'locale' => 'de',
                    'firstDay' => 1,
                    'hiddenDays' => [0],
                    'displayEventTime' => false,
                    'selectable' => false,
                    'initialView' => 'dayGridMonth',
                    'headerToolbar' => [
                        'end' => 'prev,next'
                    ]
                ]);
                $calendar->setId('1');
                $calendar->setCallbacks([
                    'dateClick' => "function(info){
                        window.location.href = ('/locations/{$location->id}/occupations/' + info.dateStr);
                    }",
                ]);

        return view('locations.show', [
            'location' => $location,
            'occupations' => $occupations,
            'calendar' => $calendar,
        ]);
    }

}
