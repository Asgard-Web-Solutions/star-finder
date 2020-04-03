<?php

namespace App\Http\Controllers;
use Gate;
use Alert;
use App\PlanetType;
use Illuminate\Http\Request;

class planetTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        if (Gate::denies('manage-game-elements')) {
            Alert::toast('Permission Denied', 'warning');
            return redirect('/');
        }

        $planets = PlanetType::all();

        return view('acp/planet-type.index', [
            'planets' => $planets
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Gate::denies('manage-game-elements')) {
            Alert::toast('Permission Denied', 'warning');
            return redirect('/');
        }

        return view('acp.planet-type.new');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (Gate::denies('manage-game-elements')) {
            Alert::toast('Permission Denied', 'warning');
            return redirect('/');
        }

        $this->validate($request, [
            'type' => 'required|string|max:255',
            'diameter' => 'integer|max:300000',
            'planet_gas_multiplier' => 'max:100',
            'ore_type' => 'required|string|max:20',
            'planet_ore_multiplier' => 'max:100',
            'diameter_variance' => 'integer|max:100',
        ]);


        $planet = new planetType();

        $planet->type = $request->type;
        $planet->average_diameter = $request->diameter;
        $planet->gas_multiplier	 = $request->planet_gas_multiplier;
        $planet->ore_multiplier = $request->planet_ore_multiplier;
        $planet->diameter_varience = $request->diameter_variance;

        $planet->save();

        Alert::toast('New planet Type Added', 'success');

        return redirect()->route('all-planet-types');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (Gate::denies('manage-game-elements')) {
            Alert::toast('Permission Denied', 'warning');
            return redirect('/');
        }

        $planet = planetType::find($id);

        if (!$id) {
            Alert::toast('planet Not Found', 'error');
            return redirect()->route('all-planet-types');
        }
        return view('acp.planet-type.show', [
            'planet' => $planet,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response*/
    // */
    public function edit($id)
    {
        if (Gate::denies('manage-game-elements')) {
            Alert::toast('Permission Denied', 'warning');
            return redirect('/');
        }

        $planettype = planetType::find($id);

        if (!$planettype) {
            Alert::toast('planet Not Found', 'error');
            return redirect()->route('all-planet-types');
        }

        return view('planet-type.edit', [
            'planet' => $planettype,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (Gate::denies('manage-game-elements')) {
            Alert::toast('Permission Denied', 'warning');
        }            return redirect('/');

        $this->validate($request, [
            'type' => 'required|string|max:255',
            'diameter' => 'integer|max:300000',
            'planet_gas_multiplier' => 'decimal(5,3)',
            'planet_ore_multiplier' => 'decimal(5,3)',
            'diameter_variance' => 'integer|max:100',
        ]);

         $planet = planetType::find($id);

        if (!$planet) {
            Alert::toast('planet Not Found', 'warning');
            return redirect()->route('acp-planet-types');
        }

        $planet->type = $request->name;
        $planet->diameter = $request->diameter;
        $planet->color = $request->color;
        $planet->probability = $request->probability;
        $planet->save();

         Alert::toast('planet type Updated', 'success');

        return redirect()->route('all-planet-types');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
