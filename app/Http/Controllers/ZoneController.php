<?php

namespace App\Http\Controllers;

use DB;
use Gate;
use Alert;
use App\PlanetType;
use App\StarType;
use App\Zone;
use Illuminate\Http\Request;

class ZoneController extends Controller
{
    public function add($id)
    {
        if (Gate::denies('manage-game-elements')) {
            Alert::toast('Permission Denied', 'warning');
            return redirect('/');
        }

        $starType = StarType::find($id);

        if (!$starType) {
            Alert::toast("Invalid Star Type", 'warning');
            return redirect()->route('acp');
        }

        return view('acp.zone.add', [
            'starType' => $starType,
        ]);
    }

    public function store(Request $request, $id)
    {
        if (Gate::denies('manage-game-elements')) {
            Alert::toast('Permission Denied', 'warning');
            return redirect('/');
        }

        $starType = StarType::find($id);

        if (!$starType) {
            Alert::toast("Invalid Star Type", 'warning');
            return redirect()->route('acp');
        }

        $this->validate($request, [
            'distance' => 'required|integer',
        ]);

        $zone = new Zone();

        $zone->distance = $request->distance;
        $zone->order = ($starType->zones->count() + 1);
        $zone->star_type_id = $starType->id;

        $zone->save();

        return redirect()->route('acp-star-type', $starType->id);
    }

    public function edit($id)
    {
        if (Gate::denies('manage-game-elements')) {
            Alert::toast('Permission Denied', 'warning');
            return redirect('/');
        }

        $zone = Zone::find($id);

        if (!$zone) {
            Alert::toast("Invalid Zone", 'warning');
            return redirect()->route('acp');
        }

        return view('acp.zone.edit', [
            'zone' => $zone,
        ]);
    }

    public function update(Request $request, $id)
    {
        if (Gate::denies('manage-game-elements')) {
            Alert::toast('Permission Denied', 'warning');
            return redirect('/');
        }

        $zone = Zone::find($id);

        if (!$zone) {
            Alert::toast("Invalid Zone", 'warning');
            return redirect()->route('acp');
        }

        $this->validate($request, [
            'distance' => 'required|integer',
        ]);

        $zone->distance = $request->distance;

        $zone->save();

        return redirect()->route('acp-star-type', $zone->star_type->id);
    }

    public function show($id)
    {
        if (Gate::denies('manage-game-elements')) {
            Alert::toast('Permission Denied', 'warning');
            return redirect('/');
        }

        $zone = Zone::find($id);

        if (!$zone) {
            Alert::toast("Invalid Zone", 'warning');
            return redirect()->route('acp');
        }

        $zone->probability = 0;
        foreach ($zone->planet_types as $planet) {
            $zone->probability = $zone->probability + $planet->pivot->probability;
        }

        return view('acp.zone.show', [
            'zone' => $zone,
        ]);
    }

    public function addPlanet($id)
    {
        if (Gate::denies('manage-game-elements')) {
            Alert::toast('Permission Denied', 'warning');
            return redirect('/');
        }

        $zone = Zone::find($id);

        if (!$zone) {
            Alert::toast("Invalid Zone", 'warning');
            return redirect()->route('acp');
        }

        $planets = PlanetType::all();

        return view('acp.zone.addplanet', [
            'zone' => $zone,
            'planets' => $planets,
        ]);
    }

    public function storePlanet(Request $request, $id)
    {
        if (Gate::denies('manage-game-elements')) {
            Alert::toast('Permission Denied', 'warning');
            return redirect('/');
        }

        $zone = Zone::find($id);

        if (!$zone) {
            Alert::toast("Invalid Zone", 'warning');
            return redirect()->route('acp');
        }

        $this->validate($request, [
            'planet' => 'required|integer',
            'probability' => 'required|integer',
        ]);

        $zone->planet_types()->attach($request->planet, ['probability' => $request->probability]);

        Alert::toast("Planet Type Added", 'success');

        return redirect()->route('zone-show', $zone->id);
    }

    public function deletePlanet($id, $planet_id)
    {
        if (Gate::denies('manage-game-elements')) {
            Alert::toast('Permission Denied', 'warning');
            return redirect('/');
        }

        DB::table('planet_type_zone')->where('zone_id', '=', $id)->where('planet_type_id', '=', $planet_id)->limit(1)->delete();

        Alert::toast('Planet Type Deleted From Zone', 'success');

        return redirect()->route('zone-show', $id);
    }
}
