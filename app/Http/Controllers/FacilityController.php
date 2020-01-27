<?php

namespace App\Http\Controllers;

use Auth;
use Alert;
use App\Base;
use App\Facility;
use App\Character;
use App\FacilityType;
use Illuminate\Http\Request;

class FacilityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $base = Base::find($id);

        if (!$base) {
            Alert::toast('Base Not Found', 'error');
            return redirect()->route('visit-planet');
        }

        $user_id = Auth::id();
        $character = Character::where('user_id', '=', $user_id)->first();

        if ($character->id != $base->character_id) {
            Alert::toast('This is not your base', 'warning');
            return redirect()->route('visit-planet');
        }

        $facilities = FacilityType::where('required_level', '<=', $base->level)->get();
        foreach ($facilities as $facility) {
            $facility->cost = facilityUpgradeCost( $facility->required_level );
        }

        return view('game.facility.new', [
            'base' => $base,
            'loadCharacter' => $character,
            'facilities' => $facilities,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($id, $build)
    {
        $user_id = Auth::id();
        $base = Base::find($id);
        $character = Character::where('user_id', '=', $user_id)->first();

        // Make sure the character owns the base
        if ($character->id != $base->character_id) {
            Alert::toast('This is not your base', 'warning');
            return redirect()->route('visit-planet');
        }

        // Make sure the user is allowed to build another facility on this base
        if ($base->facilities->count() > $this->maxFacilities($base)) {
            Alert::toast('Cannot build another facility at this time', 'warning');
            return redirect()->route('visit-planet');
        }

        $facilityType = FacilityType::find($build);

        // Make sure the user can create this facility here
        if ($facilityType->required_level > $base->level) {
            Alert::toast('Your base cannot support this facility', 'warning');
            return redirect()->route('visit-planet');
        }

        $cost = facilityUpgradeCost( $facilityType->required_level );

        if ($character->money < $cost['money']) {
            Alert::warning('Not Enough ' . __('common.money'), 'You do not have the funds required to purchase this.');
            return redirect()->route('visit-planet');
        }

        if ($base->ore < $cost['ore']) {
            Alert::warning('Not Enough ' . __('common.ore'), 'You do not have the funds required to purchase this.');
            return redirect()->route('visit-planet');
        }

        if ($base->gas < $cost['gas']) {
            Alert::warning('Not Enough ' . __('common.gas'), 'You do not have the funds required to purchase this.');
            return redirect()->route('visit-planet');
        }

        $facility = new Facility();

        $facility->base_id = $base->id;
        $facility->facility_type_id = $facilityType->id;
        $facility->level = 0;
        $facility->bonus = 0;
        $facility->full = 1;
        $facility->status = 'constructing';

        $facility->save();

        $actionDetails = array(
            'character' => $character->id,
            'title' => "New Facility - " . $facilityType->name,
            'type' => 'construction',
            'controller' => 'facility',
            'target' => $facility->id,
            'seconds' => config('game.time_new_facility'),
        );

        $this->makeAction($actionDetails);

        $character->money = $character->money - $cost['money'];
        $character->save();

        $base->ore = $base->ore - $cost['ore'];
        $base->gas = $base->gas - $cost['gas'];
        $base->save();

        $this->checkBaseMiningStatus($base);

        Alert::success("Facility Construction Started");
        return redirect()->route('visit-planet');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $facility = Facility::find($id);

        if (!$facility) {
            Alert::toast('Facility Not Found', 'warning');
            return redirect()->route('visit-planet');
        }

        $user_id = Auth::id();
        $character = Character::where('user_id', '=', $user_id)->first();

        if ($facility->base->character->id != $character->id) {
            Alert::toast('This is not your base', 'warning');
            return redirect()->route('visit-planet');
        }

        $facility->miningSpeed = calculateMiningSpeed($facility->level, $facility->bonus, $facility->facility_type->material, 1);
        $facility->upgradeCost = facilityUpgradeCost($facility->level + $facility->facility_type->required_level);

        return view('game.facility.show', [
            'facility' => $facility,
            'loadCharacter' => $character,
        ]);
    }

    public function upgrade(Request $request, $id)
    {
        $facility = Facility::find($id);

        if (!$facility) {
            Alert::toast('Facility Not Found', 'warning');
            return redirect()->route('visit-planet');
        }

        $user_id = Auth::id();
        $character = Character::where('user_id', '=', $user_id)->first();

        if ($facility->base->character->id != $character->id) {
            Alert::toast('This is not your base', 'warning');
            return redirect()->route('visit-planet');
        }

        $cost = facilityUpgradeCost($facility->level + $facility->facility_type->required_level);

        if ($character->money < $cost['money']) {
            Alert::warning('Not Enough ' . __('common.money'), 'You do not have the funds required to purchase this.');
            return redirect()->route('visit-planet');
        }

        if ($facility->base->ore < $cost['ore']) {
            Alert::warning('Not Enough ' . __('common.ore'), 'You do not have the funds required to purchase this.');
            return redirect()->route('visit-planet');
        }

        if ($facility->base->gas < $cost['gas']) {
            Alert::warning('Not Enough ' . __('common.gas'), 'You do not have the funds required to purchase this.');
            return redirect()->route('visit-planet');
        }

        $facility->status = "upgrading";

        $character->money = $character->money - $cost['money'];
        $facility->base->ore = $facility->base->ore - $cost['ore'];
        $facility->base->gas = $facility->base->gas - $cost['gas'];

        $facility->save();
        $character->save();

        $this->checkBaseMiningStatus($facility->base);

        $actionDetails = array(
            'character' => $character->id,
            'title' => "Upgrading Facility - " . $facility->facility_type->name,
            'type' => 'upgrade',
            'controller' => 'facility',
            'target' => $facility->id,
            'seconds' => (config('game.time_new_facility') * $facility->level),
        );

        $this->makeAction($actionDetails);

        Alert::toast("Upgrade Started");
        return redirect()->route('visit-planet');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
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

    private function maxFacilities($base)
    {
        return $base->level;
    }
}
