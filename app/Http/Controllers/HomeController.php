<?php

namespace App\Http\Controllers;

use App\Character;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user_id = Auth::id();
        $character = Character::where('user_id', '=', $user_id)->first();

        if (!$character) {
            return view('home', [
                'character' => "none",
            ]);
        }

        // get species name here

        return view('home', [
            'character' => $character,
        ]);
    }

    public function acp()
    {
        return view('acp.index');
    }
}
