<?php

namespace App\Http\Controllers;

use Auth;
use Alert;
use App\Base;
use App\Character;
use Illuminate\Http\Request;

class BaseController extends Controller
{
    public function create()
    {
        $user_id = Auth::id();
        $character = Character::where('user_id', '=', $user_id)->first();
        $bases = Base::where('character_id', '=', $character->id)
            ->where('planet_id', '=', $character->planet_id)->get();
        
        return view('game.base.new', [
            'loadCharacter' => $character,
            'bases' => $bases,
        ]);
    }

    public function store(Request $request)
    {
        $user_id = Auth::id();

        $character = Character::where('user_id', '=', $user_id)->first();

        $myBases = Base::where('character_id', '=', $character->id)
            ->where('planet_id', '=', $character->planet_id)->get();

        if ($myBases->count() >= config('game.max_bases_per_planet')) {
            Alert::error('Not Authorized', 'You are not authorized to build bases at this time.');
            return redirect()->route('visit-planet');
        }

        $this->validate($request, [
            'planet' => 'required|integer',
        ]);

        if ($request->planet != $character->planet_id) {
            Alert::error('System Error', 'There was an error constructing the base.');
            return redirect()->route('visit-planet');
        }

        if ($character->money < config('game.cost_new_base')) {
            Alert::warning('Not Enough ' . __('common.money'), 'You do not have the funds required to purchase this.');
            return redirect()->route('visit-planet');
        }

        $base = new Base();

        $base->character_id = $character->id;
        $base->planet_id = $character->planet_id;
        $base->level = 1;
        $base->bonus = 0;
        $base->status = "constructing";

        $base->save();

        $character->money = $character->money - config('game.cost_new_base');
        $character->save();

        Alert::success("Base Construction Started");
        return redirect()->route('visit-planet');
    }
}
