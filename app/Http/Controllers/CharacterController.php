<?php

namespace App\Http\Controllers;

use App\Character;
use Illuminate\Http\Request;

class CharacterController extends Controller
{
    public function create () {

        return view('character.new');
    }

    public function save (Request $request){
        $character = new Character();
    }

}
