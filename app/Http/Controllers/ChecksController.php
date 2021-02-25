<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CheckController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::whereNotNull('checks')->whereJsonContains('roles', 'verifing')->get();

        return view('checks.index')->with([
            'users' => $users,
        ]);
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
        ]);

        if(Auth::user()->checks == null) {
            $checks = new Collection([
                ['name' =>  '1/3 Vertrag', 'description' =>  'Wir senden Ihnen einen Vertrag zu, welchen Sie uns unterschrieben zurück senden.', 'approved' => false],
                ['name' =>  '2/3 Bonitätsprüfung', 'description' =>  'Wir prüfen Ihre Bonität.', 'approved' => false],
                ['name' =>  '3/3 Besuch', 'description' =>  'Ein Mitarbeiter kontaktiert Sie um einen Termin für einen persöhnlichen Besuch zu vereinbaren.', 'approved' => false],
            ]);

            if(Auth::user()->roles == null){
                $roles = new Collection(['verifing']);
            } else{
                $roles = Auth::user()->roles->push('verifing');
            }


            Auth::user()->update([
                'checks' => $checks,
                'roles' => $roles,
            ]);

        }
        return redirect(route('plans.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $checks = $user->checks->slice(1);

        if(! $checks->count()){
            $roles = $user->roles->filter(function ($value, $key) {
                return $value != 'verifing';
            })->push('verified');

            $user->update([
                'roles' => $roles,
            ]);
        }

        $user->update([
            'checks' => $checks,
        ]);

        return redirect(route('checks.index'));
    }

}
