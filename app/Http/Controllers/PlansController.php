<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use Illuminate\Http\Request;

class PlansController extends Controller
{
    public function index()
    {
        return view('plans')->with([
            'initialPlans' => Plan::where([['isInitialPlan', true],['isTerminatingPlan', false]])->get(),
            'Plans' => Plan::where([['isInitialPlan', false],['isTerminatingPlan', false]])->get(),
        ]);
    }
}
