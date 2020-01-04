<?php

namespace App\Http\Controllers;

use App\Species;
use Illuminate\Http\Request;

class SpeciesController extends Controller
{
    public function index()
    {
        $species = Species::all();

        return view('acp.species.index', [
            'species' => $species,
        ]);
    }

    public function create()
    {
        return view('acp.species.new');
    }

    public function save(Request $request)
    {
        $species = new Species();

        $species->name = $request->name;

        $species->save();

        return redirect()->route('acp');
    }
}
