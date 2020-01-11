<?php

namespace App\Http\Controllers;

use Alert;
use App\User;
use App\Species;
use App\Character;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user_id = auth()->user()->id;
        $user = User::find($user_id);

        $character = $user->characters->first();

        return view('home', [
            'character' => $character,
        ]);
    }

    public function acp()
    {
        if (Gate::denies('view-acp')) {
            Alert::toast('Permission Denied', 'warning');
            return redirect('/');
        }

        return view('acp.index');
    }
}
