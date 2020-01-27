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

        $planet->ore = 0;
        $planet->gas = 0;

        foreach($bases as $base) {
            $planet->ore = $planet->ore + $base->ore;
            $planet->gas = $planet->gas + $base->gas;

            $base->max_level = maxBaseLevel($base);
        }

        return view('game.planet', [
            'loadCharacter' => $character,
            'planet' => $planet,
            'bases' => $bases,
        ]);
    }
}
