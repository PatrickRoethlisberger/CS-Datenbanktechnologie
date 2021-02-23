<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PlanController extends Controller
{
    public function index()
    {
        return view('plans')->with([
            'initialPlans' => Plan::where([['isInitialPlan', true],['isTerminatingPlan', false]])->get(),
            'plans' => Plan::where([['isInitialPlan', false],['isTerminatingPlan', false]])->get(),
        ]);
    }
}
