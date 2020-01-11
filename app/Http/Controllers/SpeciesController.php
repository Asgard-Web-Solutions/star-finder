<?php

namespace App\Http\Controllers;

use Alert;
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
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:5000',
        ]);
        
        $species = new Species();

        $species->name = $request->name;
        $species->description = $request->description;

        $species->save();

        Alert::toast('New Species Added', 'success');

        return redirect()->route('all-species');
    }

    public function show($id)
    {
        $species = Species::find($id);

        if (!$id) {
            Alert::toast('Species Not Found', 'error');
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
            Alert::toast('Species Not Found', 'error');
            return redirect()->route('all-species');
        }

        return view('acp.species.edit', [
            'species' => $species,
        ]);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:5000',
        ]);

        $species = Species::find($id);

        $species->name = $request->name;
        $species->description = $request->description;
        $species->save();

        Alert::toast('Species Updated', 'success');

        return redirect()->route('all-species');
    }
}
