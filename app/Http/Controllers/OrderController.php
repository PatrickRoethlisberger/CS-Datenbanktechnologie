<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use Carbon\Carbon;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Gate::allows('create-order')){
            return view('orders.index', [
                'orders' => Auth::user()->orders()->paginate(5),
            ]);
        } else {
            return redirect(route('plans.index'));
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Plan $plan)
    {
        $lastOrder = Auth::user()->lastOrder();

        if ($lastOrder) {
            if ($lastOrder->plan()->first()->isInitialPlan){
                if ($lastOrder->until <= Carbon::now()){
                    $fromDate = Carbon::now();
                } else {
                    $fromDate = null;
                }
            } else {
                $fromDate = $lastOrder->until;
            }
        } else {
            $fromDate = Carbon::now();
        }

        if (Gate::allows(['create-order']) && ! $plan->isTerminatingPlan && ($plan->isInitialPlan == Gate::allows(['create-trial-order']))){
            return view('orders.create', [
                'plan' => $plan,
                'fromDate' => $fromDate,
            ]);
        } else {
            return redirect(route('plans.index'));
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'plan_id' => ['required', 'integer']
        ]);

        $plan = Plan::where('id', '=', $request->only('plan_id'))->firstOrFail();

        $lastOrder = Auth::user()->lastOrder();

        if ($lastOrder) {
            if ($lastOrder->plan()->first()->isInitialPlan){
                if ($lastOrder->until <= Carbon::now()){
                    $fromDate = Carbon::now();
                } else {
                    return redirect(route('orders.create', $plan))
                    ->withErrors('Ein Fehler ist Aufgetreten.');
                }
            } else {
                $fromDate = $lastOrder->until;
            }
        } else {
            $fromDate = Carbon::now();
        }

        if ($plan && Gate::allows(['create-order']) && ! $plan->isTerminatingPlan && ($plan->isInitialPlan == Gate::allows(['create-trial-order']))){
            Auth::user()->orders()->create([
                'plan_id' => $plan->id,
                'from' => $fromDate,
                'until' => $fromDate->copy()->addMonths($plan->duration),
            ]);
            return redirect(route('orders.index'));
        } else {
            return redirect(route('orders.create', $plan))
            ->withErrors('Ein Fehler ist Aufgetreten.');
        }


    }
}
