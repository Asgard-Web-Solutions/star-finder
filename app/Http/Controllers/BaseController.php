<?php

namespace App\Http\Controllers;

use Auth;
use Gate;
use Alert;
use App\Base;
use App\Character;
use Illuminate\Http\Request;

class BaseController extends Controller
{
    public function index()
    {
        if (Gate::denies('manage-game-elements')) {
            Alert::toast('Permission Denied', 'warning');
            return redirect('/');
        }

        $bases = Base::all();

        return view('game.base.index', [
            'bases' => $bases,
        ]);
    }

    public function create()
    {
        $user_id = Auth::id();
        $character = Character::where('user_id', '=', $user_id)->first();
        $bases = Base::where('character_id', '=', $character->id)
            ->where('planet_id', '=', $character->planet_id)->get();

        $newCost = baseUpgradeCost(1);

        return view('game.base.new', [
            'loadCharacter' => $character,
            'bases' => $bases,
            'newCost' => $newCost,
        ]);
    }

    public function store(Request $request)
    {
        $user_id = Auth::id();

        $character = Character::where('user_id', '=', $user_id)->first();

        $myBases = Base::where('character_id', '=', $character->id)
            ->where('planet_id', '=', $character->planet_id)->get();

        if ($myBases->count() >= config('game.max_bases_per_planet')) {
            Alert::error('Not Authorized', 'You are not authorized to build bases at this time.');
            return redirect()->route('visit-planet');
        }

        $this->validate($request, [
            'planet' => 'required|integer',
        ]);

        if ($request->planet != $character->planet_id) {
            Alert::error('System Error', 'There was an error constructing the base.');
            return redirect()->route('visit-planet');
        }

        $baseCost = baseUpgradeCost(1);

        if ($character->money < $baseCost['money']) {
            Alert::warning('Not Enough ' . __('common.money'), 'You do not have the funds required to purchase this.');
            return redirect()->route('visit-planet');
        }

        $base = new Base();

        $base->character_id = $character->id;
        $base->planet_id = $character->planet_id;
        $base->level = 0;
        $base->bonus = 0;
        $base->status = "constructing";

        $base->save();

        $actionDetails = array(
            'character' => $character->id,
            'title' => "New Base - " . $character->planet->name,
            'type' => 'construction',
            'controller' => 'base',
            'target' => $base->id,
            'seconds' => config('game.time_new_base'),
        );

        $this->makeAction($actionDetails);

        $character->money = $character->money - $baseCost['money'];
        $character->save();

        Alert::success("Base Construction Started");
        return redirect()->route('visit-planet');
    }

    public function upgrade($id)
    {
        $base = Base::find($id);

        $user_id = Auth::id();
        $character = Character::where('user_id', '=', $user_id)->first();

        if ($character->id != $base->character_id) {
            Alert::toast('This is not your base', 'warning');
            return redirect()->route('visit-planet');
        }

        if ($base->level >= maxBaseLevel($base)) {
            Alert::toast('This planet cannot support larger bases.', 'warning');
            return redirect()->route('visit-planet');
        }

        $cost = baseUpgradeCost($base->level + 1);

        $bases = Base::where('planet_id', '=', $base->planet_id)->where('character_id', '=', $character->id)->get();
        $planetaryFunds['ore'] = 0;
        $planetaryFunds['gas'] = 0;

        foreach ($bases as $pbase) {
            $planetaryFunds['ore'] = $planetaryFunds['ore'] + $pbase->ore;
            $planetaryFunds['gas'] = $planetaryFunds['gas'] + $pbase->gas;
        }

        return view('game.base.upgrade', [
            'loadCharacter' => $character,
            'base' => $base,
            'cost' => $cost,
            'planetaryFunds' => $planetaryFunds,
        ]);
    }

    public function upgradeBase(Request $request, $id)
    {
        $user_id = Auth::id();
        $character = Character::where('user_id', '=', $user_id)->first();

        $base = Base::find($id);

        if ($character->id != $base->character_id) {
            Alert::toast('This is not your base', 'warning');
            return redirect()->route('visit-planet');
        }

        if ($base->level >= maxBaseLevel($base)) {
            Alert::toast('This planet cannot support larger bases.', 'warning');
            return redirect()->route('visit-planet');
        }

        $cost = baseUpgradeCost($base->level + 1);

        if ($character->money < $cost['money']) {
            Alert::warning('Not Enough ' . __('common.money'), 'You do not have the funds required to purchase this.');
            return redirect()->route('visit-planet');
        }

        $bases = Base::where('planet_id', '=', $base->planet_id)->where('character_id', '=', $character->id)->get();
        $planetaryFunds['ore'] = 0;
        $planetaryFunds['gas'] = 0;

        foreach ($bases as $pbase) {
            $planetaryFunds['ore'] = $planetaryFunds['ore'] + $pbase->ore;
            $planetaryFunds['gas'] = $planetaryFunds['gas'] + $pbase->gas;
        }

        if ($planetaryFunds['ore'] < $cost['ore']) {
            Alert::warning('Not Enough ' . __('common.ore'), 'You do not have the funds required to purchase this.');
            return redirect()->route('visit-planet');
        }

        if ($planetaryFunds['gas'] < $cost['gas']) {
            Alert::warning('Not Enough ' . __('common.gas'), 'You do not have the funds required to purchase this.');
            return redirect()->route('visit-planet');
        }

        $this->validate($request, [
            'confirm' => 'required',
        ]);

        //$base->level = $base->level + 1;
        $base->status = "upgrading";

        $base->save();

        $actionDetails = array(
            'character' => $character->id,
            'title' => "Upgrading Base - " . $character->planet->name,
            'type' => 'upgrade',
            'controller' => 'base',
            'target' => $base->id,
            'seconds' => (config('game.time_new_base') * ($base->level + 1)),
        );

        $this->makeAction($actionDetails);

        $character->money = $character->money - $cost['money'];
        $character->save();

        if ($base->ore > $cost['ore']) {
            $base->ore = $base->ore - $cost['ore'];
            $base->save();
        } else {
            $cost['ore'] = $cost['ore'] - $base->ore;
            $base->ore = 0;
            $base->save();

            foreach ($bases as $fundingBase) {
                if ($fundingBase->ore >= $cost['ore']) {
                    $fundingBase->ore = $fundingBase->ore - $cost['ore'];
                    $fundingBase->save();

                    $this->checkBaseMiningStatus($fundingBase);
                } else {
                    $cost['ore'] = $cost['ore'] - $fundingBase->ore;
                    $fundingBase->ore = 0;
                    $fundingBase->save();

                    $this->checkBaseMiningStatus($fundingBase);
                }
            }
        }

        if ($base->gas > $cost['gas']) {
            $base->gas = $base->gas - $cost['gas'];
            $base->save();

        } else {
            $cost['gas'] = $cost['gas'] - $base->gas;
            $base->gas = 0;
            $base->save();

            foreach ($bases as $fundingBase) {
                if ($fundingBase->gas >= $cost['gas']) {
                    $fundingBase->gas = $fundingBase->gas - $cost['gas'];
                    $fundingBase->save();

                    $this->checkBaseMiningStatus($fundingBase);
                } else {
                    $cost['gas'] = $cost['gas'] - $fundingBase->gas;
                    $fundingBase->gas = 0;
                    $fundingBase->save();

                    $this->checkBaseMiningStatus($fundingBase);
                }
            }
        }

        $this->checkBaseMiningStatus($base);

        Alert::success("Base Upgrade Started");
        return redirect()->route('visit-planet');
    }

    public function sell($id, $material)
    {
        $user_id = Auth::id();
        $character = Character::where('user_id', '=', $user_id)->first();

        $base = Base::find($id);

        if ($character->id != $base->character_id) {
            Alert::toast('This is not your base', 'warning');
            return redirect()->route('visit-planet');
        }

        if ($material != "ore" && $material != "gas") {
            Alert::toast('Invalid material', 'error');
            return redirect()->route('visit-planet');
        }

        $adminLevel = 0;
        foreach ($base->facilities as $facility) {
            if ($facility->facility_type->name == "Administration") {
                $adminLevel = $facility->level;
            }
        }

        $sell['Price'] = materialSellPrice($adminLevel, $material, 'direct');
        $sell['Material'] = $material;
        $sell['Amount'] = $base->$material;

        return view('game.base.sell', [
            'loadCharacter' => $character,
            'sell' => $sell,
            'base' => $base,
        ]);
    }

    public function sellConfirm(Request $request, $id, $material)
    {
        $user_id = Auth::id();
        $character = Character::where('user_id', '=', $user_id)->first();

        $base = Base::find($id);

        if ($character->id != $base->character_id) {
            Alert::toast('This is not your base', 'warning');
            return redirect()->route('visit-planet');
        }

        if ($material != "ore" && $material != "gas") {
            Alert::toast('Invalid material', 'error');
            return redirect()->route('visit-planet');
        }

        $this->validate($request, [
            'amount' => 'required|integer|max:' . $base->$material,
        ]);

        $adminLevel = 0;
        foreach ($base->facilities as $facility) {
            if ($facility->facility_type->name == "Administration") {
                $adminLevel = $facility->level;
            }
        }

        $sell['Price'] = materialSellPrice($adminLevel, $material, 'direct');

        $character->money = $character->money + floor($sell['Price'] * $request->amount);
        $base->$material = $base->$material - $request->amount;

        $character->save();
        $base->save();

        $this->checkBaseMiningStatus($base);

        Alert::success("Sold " . $request->amount . " " . __('common.' . $material) . " for " . __('common.money symbol') . (floor($sell['Price'] * $request->amount)));
        return redirect()->route('visit-planet');
    }
}
