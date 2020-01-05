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

        return redirect()->route('all-species');
    }

    public function show($id)
    {
        $species = Species::find($id);

        if (!$id) {
            return redirect()->route('all-species');
        }

        return view('acp.species.show', [
            'species' => $species,
        ]);
    }

    public function edit($id)
    {
        $species = Species::find($id);
        
        if (!$species) {
            return redirect()->route('all-species');
        }

        return view('acp.species.edit', [
            'species' => $species,
        ]);
    }

    public function update(Request $request, $id)
    {
        $species = Species::find($id);

        $species->name = $request->name;
        $species->save();

        return redirect()->route('all-species');
    }
}
