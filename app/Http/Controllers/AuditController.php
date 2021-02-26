<?php

namespace App\Http\Controllers;

use Acaronlex\LaravelCalendar\Calendar;
use App\Models\Audit;
use App\Models\Plan;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use phpDocumentor\Reflection\Types\Boolean;

class AuditController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $auditors = User::withCount('audited')->get()->where('audited_count', '>', 0);

        return view('audits.index', [
            'audits' => Audit::paginate(5),
            'auditors' => $auditors,
        ]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $events = [];

        $toAudit = collect();
        $orders = Plan::where('isInitialPlan', '=', true)->first()->orders()->where('from', '<=', now())->where('until', '>=', now())->get();
        foreach ($orders as $order) {
            $audits = $order->user()->first()->audits()->get();
            $audits->count() > 0
                ? ($audits->last()->date->diffInDays(Carbon::now()) > 12
                    ? $toAudit->push($order->user()->first())
                    : ''
                    )
                : $toAudit->push($order->user()->first());
        }

        foreach ($toAudit as $user) {
             $events[] = \Calendar::event(
                "{$user->name}",
                true,
                $user->nextOccupation()->date,
                $user->nextOccupation()->date,
                $user->id,
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
                     'noEventsContent' => 'Keine Audits durchführbar',
                     'headerToolbar' => [
                         'end' => 'prev,next'
                     ]
                 ]);
                 $calendar->setId('1');
                 $calendar->setCallbacks([
                     'eventClick' => "function(info){
                         window.location.href = ('/admin/audits/create/'+ info.event.id);
                     }",
                 ]);

         return view('audits.create', [
             'calendar' => $calendar,
         ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, User $user, bool $bool)
    {
        if($user->nextOccupation()->date == Carbon::today()) {
            $user->audits()->create([
                'date' => Carbon::today(),
                'auditor_user_id' => Auth::user()->id,
                'approved' => $bool,
            ]);
            if(! $bool) {
                $user->lastOrder()->update([
                    'until' => Carbon::today()
                ]);

                $user->orders()->create([
                    'plan_id' => 5,
                    'from' => Carbon::today(),
                    'until' => Carbon::today()->copy()->addMonths(3),
                ]);
            }
            return redirect(route('audits.create'));
        } else {
            return redirect(route('audits.edit', $user))
            ->withErrors('Es kann nur ein Audit an einem Tag durchgeführt werden, wo der Marktfaher einen Stand hat.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Audit  $audit
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('audits.show', [
            'audits' => $user->audited()->with('client')->paginate(5),
        ]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Audit  $audit
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $occupation = $user->nextOccupation();
        $location = $occupation->location()->first();

        return view('audits.edit', [
            'user' => $user,
            'occupation' => $occupation,
            'location' => $location,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Audit  $audit
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Audit $audit)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Audit  $audit
     * @return \Illuminate\Http\Response
     */
    public function destroy(Audit $audit)
    {
        //
    }
}
