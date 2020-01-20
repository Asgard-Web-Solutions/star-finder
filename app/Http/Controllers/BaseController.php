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
        
        $newCost = $this->baseUpgradeCost(1);

        return view('game.base.new', [
            'loadCharacter' => $character,
            'bases' => $bases,
            'newCost' => $newCost,
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

        $baseCost = $this->baseUpgradeCost(1);

        if ($character->money < $baseCost['money']) {
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

        $actionDetails = array(
            'character' => $character->id,
            'title' => "New Base - " . $character->planet->name,
            'type' => 'construction',
            'controller' => 'base',
            'target' => $base->id,
            'seconds' => config('game.time_new_base'),
        );

        $this->makeAction($actionDetails);

        $character->money = $character->money - $baseCost['money'];
        $character->save();

        Alert::success("Base Construction Started");
        return redirect()->route('visit-planet');
    }
}
