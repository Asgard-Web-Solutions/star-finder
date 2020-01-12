<?php

namespace App\Http\Controllers;

use Gate;
use Alert;
use App\Species;
use Illuminate\Http\Request;

class SpeciesController extends Controller
{
    public function index()
    {
        if (Gate::denies('manage-game-elements')) {
            Alert::toast('Permission Denied', 'warning');
            return redirect('/');
        }

        $species = Species::all();

        return view('acp.species.index', [
            'species' => $species,
        ]);
    }

    public function create()
    {
        if (Gate::denies('manage-game-elements')) {
            Alert::toast('Permission Denied', 'warning');
            return redirect('/');
        }

        return view('acp.species.new');
    }

    public function save(Request $request)
    {
        if (Gate::denies('manage-game-elements')) {
            Alert::toast('Permission Denied', 'warning');
            return redirect('/');
        }

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
        if (Gate::denies('manage-game-elements')) {
            Alert::toast('Permission Denied', 'warning');
            return redirect('/');
        }

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
        if (Gate::denies('manage-game-elements')) {
            Alert::toast('Permission Denied', 'warning');
            return redirect('/');
        }

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
        if (Gate::denies('manage-game-elements')) {
            Alert::toast('Permission Denied', 'warning');
            return redirect('/');
        }

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
