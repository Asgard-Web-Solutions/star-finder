<?php

namespace App\Http\Controllers;

use Auth;
use App\Base;
use App\Character;
use Illuminate\Http\Request;

class GameController extends Controller
{
    public function planet()
    {
        $user_id = Auth::id();

        $character = Character::where('user_id', '=', $user_id)->first();

        $planet = $character->planet;

        $bases = Base::where('character_id', '=', $character->id)
            ->where('planet_id', '=', $planet->id)->get();

        return view('game.planet', [
            'loadCharacter' => $character,
            'planet' => $planet,
            'bases' => $bases,
        ]);
    }
}
