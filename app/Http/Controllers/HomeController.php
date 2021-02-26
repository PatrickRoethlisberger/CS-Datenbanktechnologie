<?php

namespace App\Http\Controllers;

use App\Models\Occupation;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $occupations = Occupation::where('date', '=', Now())->where('user_id', '!=', null)->with('user')->with('location')->get();
        return(view('home', [
            'occupations' => $occupations,
        ]));
    }
}
