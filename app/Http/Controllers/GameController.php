<?php

namespace App\Http\Controllers;

use Auth;
use App\Base;
use App\Character;
use App\Contract;
use App\Facility;
use Illuminate\Http\Request;

class GameController extends Controller
{
    public function planet()
    {
        $user_id = Auth::id();

        $character = Character::where('user_id', '=', $user_id)->first();

        $planet = $character->planet;

        $bases = Base::where('character_id', '=', $character->id)
            ->where('planet_id', '=', $planet->id)
            ->orderBy('level')->get();

        $planet->ore = 0;
        $planet->gas = 0;

        foreach($bases as $base) {
            $planet->ore = $planet->ore + $base->ore;
            $planet->gas = $planet->gas + $base->gas;

            $base->max_level = maxBaseLevel($base);

            $base->maxStorage = array(
                'ore' =>calculateMaxStorage($base->level, $base->bonus, 'ore'),
                'gas' =>calculateMaxStorage($base->level, $base->bonus, 'gas')
            );

            $admin = Facility::where('base_id', '=', $base->id)->where('facility_type_id', '=', 3)->first();

            $base->hasAdmin = ($admin->count()) ? $admin : 0;
        }

        return view('game.planet', [
            'loadCharacter' => $character,
            'planet' => $planet,
            'bases' => $bases,
        ]);
    }
}
