<?php

namespace App\Http\Controllers;

use Alert;
use Gate;
use App\Character;
use App\Plan;
use App\Species;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CharacterController extends Controller
{
    public function index() {

        if (Gate::denies('manage-characters')) {
            Alert::toast('Permission Denied', 'warning');
            return redirect()->route('home');
        }

        $characters = Character::all();

        return view('character.index', [
            'characters' => $characters,
        ]);
    }

    public function show($id)
    {
        if (Gate::denies('manage-characters')) {
            Alert::toast('Permission Denied', 'warning');
            return redirect()->route('home');
        }
        $character = Character::find($id);

        if (!$character) {
            Alert::toast('character Not Found', 'error');
            return redirect()->route('all-characters');
        }

        return view('character.show', [
            'character' => $character,
        ]);
    }


    public function create() {

        $user_id = Auth::id();
        $character = Character::where("user_id", '=', $user_id)->get();

        if ($character->count()) {
            return redirect('/home');
        }

        $species = Species::all();

        return view('character.new', [
            'species' => $species,
        ]);
    }

    public function save(Request $request){

        $this->validate($request, [
            'name' => 'required|string|max:25',
            'species' => 'required|integer|exists:species,id',
        ]);

        $character = new Character();

        $character->name = $request->name;
        $character->user_id = Auth::id();
        $character->species_id = $request->species;
        $character->faction_id	= 0;
        $character->planet_id = 1; // Earth!
        $character->money = config('game.starting_money');

        $character->save();


        $plans = Plan::where('learn_from', '=', 'default')->get();

        foreach($plans as $plan) {
            $character->plans()->attach($plan->id);
        }

        return redirect()->route('home');
    }

}
