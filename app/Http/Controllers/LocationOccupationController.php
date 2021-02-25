<?php

namespace App\Http\Controllers;

use App\Models\Location;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LocationOccupationController extends Controller
{

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Location $location, $date)
    {
        $match = $location->occupations()->where('date', $date)->first();
        return view('locations.occupations.create', [
            'location' => $location,
            'date' => $date,
            'match' => $match,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Location $location, $date)
    {
        if (Auth::user() == $location->provider()->first() ) {
            $match = $location->occupations()->where('date', $date)->first();
            if (empty($match)){
                $location->occupations()->create([
                    'date' => $date,
                ]);
                return redirect(route('locations.show', $location));
            } else {
                return redirect(route('locations.occupations.create', [$location, $date]))
                ->withErrors('Der Standort wurde an diesem Datum bereits zur Verfügung gestellt');
            }
        }
        else {
            return redirect(route('locations.occupations.create', [$location, $date]))
            ->withErrors('Sie sind nicht der Besitzer dieses Standortes.');
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Location $location, $date)
    {
        if (Auth::user() == $location->provider()->first() ) {
            $match = $location->occupations()->where('date', $date)->first();
            if (!empty($match)){
                if (! $match->user_id) {
                    $location->occupations()->where('date', $date)->delete();
                    return redirect(route('locations.show', $location));
                } else {
                    return redirect(route('locations.occupations.create', [$location, $date]))
                    ->withErrors('Der Standort wurde an diesem Datum bereits reserviert');
                }

            } else {
                return redirect(route('locations.occupations.create', [$location, $date]))
                ->withErrors('Der Standort wurde an diesem Datum noch nicht zur Verfügung gestellt');
            }
        }
        else {
            return redirect(route('locations.occupations.create', [$location, $date]))
            ->withErrors('Sie sind nicht der Besitzer dieses Standortes.');
        }
    }
}
