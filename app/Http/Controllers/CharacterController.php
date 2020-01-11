<?php

namespace App\Http\Controllers;

use App\Character;
use App\Species;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CharacterController extends Controller
{
    public function create () {

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

    public function save (Request $request){

        $this->validate($request, [
            'name' => 'required|string|max:25',
            'species' => 'required|integer|exists:species,id',
        ]);

        $character = new Character();

        $character->name = $request->name;
        $character->user_id = Auth::id();
        $character->species_id = $request->species;
        $character->faction_id	= 0;

        $character->save();

        return redirect()->route('home');
    }

}
