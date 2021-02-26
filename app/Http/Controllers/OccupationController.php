<?php

namespace App\Http\Controllers;

use Acaronlex\LaravelCalendar\Calendar;
use App\Models\Occupation;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class OccupationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('occupations.index', [
            'occupations' => Auth::user()->occupations()->paginate(5),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $occupations = Occupation::where('date', '>=', Carbon::now())->where('user_id', '=', null)->get();

        $events = [];


        foreach ($occupations as $occupation) {
            if (Gate::check('create-occupation', $occupation->date)) {
                $backgroundcolor = '#34D399';
            } else {
                $backgroundcolor = '#F87171';
            }

             $events[] = \Calendar::event(
                 "{$occupation->location()->first()->streetname} {$occupation->location()->first()->streetnumber}, {$occupation->location()->first()->plz} {$occupation->location()->first()->city} - {$occupation->location()->first()->description}", //event title
                 true,
                 $occupation->date,
                 $occupation->date,
                 $occupation->id,
                 [
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
                     'initialView' => 'listWeek',
                     'noEventsContent' => 'Keine verfügbaren Standorte',
                     'headerToolbar' => [
                         'end' => 'prev,next'
                     ]
                 ]);
                 $calendar->setId('1');
                 $calendar->setCallbacks([
                     'eventClick' => "function(info){
                         window.location.href = ('/occupations/'+ info.event.id+ '/edit/');
                     }",
                 ]);

         return view('occupations.create', [
             'calendar' => $calendar,
         ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Occupation  $occupation
     * @return \Illuminate\Http\Response
     */
    public function edit(Occupation $occupation)
    {
        $location = $occupation->location()->first();
        return view('occupations.edit', [
            'occupation' => $occupation,
            'location' => $location,
            'user' => Auth::user(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Occupation  $occupation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Occupation $occupation)
    {
        if(Gate::check('create-occupation', $occupation->date)) {
            $occupation->update(['user_id' => Auth::user()->id]);
            return redirect(route('occupations.index'));
        } else {
            return redirect(route('occupations.edit', $occupation))
            ->withErrors('Sie haben diese Woche ihre Standplätze bereits ausgelastet.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Occupation  $occupation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Occupation $occupation)
    {
        if (Auth::user()->id == $occupation->user_id ) {
            $occupation->update(['user_id' => null]);
            return redirect(route('occupations.index'));
        }
        else {
            return redirect(route('occupations.edit', $occupation))
            ->withErrors('Sie sind nicht der Mieter dieses Standortes.');
        }
    }
}
