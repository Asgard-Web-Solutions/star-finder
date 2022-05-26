<?php

namespace App\Http\Controllers;

use Alert;
use Auth;
use App\Base;
use App\Facility;
use App\Character;
use App\Contract;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ContractController extends Controller
{
    public function create($id)
    {
        $facility = Facility::find($id);

        $user_id = Auth::id();
        $character = Character::where('user_id', '=', $user_id)->first();

        if (!$facility) {
            Alert::toast('Invalid Facility.', 'error');
            return redirect()->route('visit-planet');
        }

        if ($character->id != $facility->base->character_id) {
            Alert::toast('This is not your base', 'warning');
            return redirect()->route('visit-planet');
        }

        if ($facility->base->activeContracts->count() >= $facility->level) {
            Alert::toast('Contract Limit Reached', 'error');
            return redirect()->route('visit-planet');
        }

        $price['ore'] = materialSellPrice($facility->level, 'ore', 'contract');
        $price['gas'] = materialSellPrice($facility->level, 'gas', 'contract');
        $time = calculateContractTime();
        $percent = calculateContractMaxSell();
        $duration = calculateContractMaxDuration();

        return view('game.contract.new', [
            'loadCharacter' => $character,
            'facility' => $facility,
            'price' => $price,
            'time' => $time,
            'percent' => $percent,
            'duration' => $duration,
        ]);
    }

    public function reviewContract(Request $request, $id)
    {
        $facility = Facility::find($id);

        $user_id = Auth::id();
        $character = Character::where('user_id', '=', $user_id)->first();

        if (!$facility) {
            Alert::toast('Invalid Facility.', 'error');
            return redirect()->route('visit-planet');
        }

        if ($character->id != $facility->base->character_id) {
            Alert::toast('This is not your base', 'warning');
            return redirect()->route('visit-planet');
        }

        if ($facility->base->activeContracts->count() >= $facility->level) {
            Alert::toast('Contract Limit Reached', 'error');
            return redirect()->route('visit-planet');
        }

        if ($character->money < (($request->frequency + $request->amount + $request->duration) * config('game.contract_base_rate'))) {
            Alert::toast('Not Enough ' . __('common.money'), 'warning');
            return redirect()->route('visit-planet');
        }

        $price['ore'] = materialSellPrice($facility->level, 'ore', 'contract');
        $price['gas'] = materialSellPrice($facility->level, 'gas', 'contract');
        $time = calculateContractTime();
        $percent = calculateContractMaxSell();
        $duration = calculateContractMaxDuration();

        $this->validate($request, [
            'amount' => 'required|integer',
            'resource' => 'required|string',
            'frequency' => 'required|integer',
            'duration' => 'required|integer',
        ]);

        if ($request->resource != "ore" && $request->resource != "gas") {
            Alert::toast('Invalid material', 'error');
            return redirect()->route('visit-planet');
        }

        $production = 0;
        $base = $facility->base;

        foreach ($base->facilities as $fac)
        {
            if ($fac->facility_type->type == "mine" && $fac->facility_type->material == $request->resource)
            {
                $production = $production + calculateMiningSpeed($fac->level, $fac->bonus, $request->resource, 1);
            }
        }

        $storage = calculateMaxStorage($base->level, $base->bonus, $request->resource);

        return view('game.contract.new', [
            'loadCharacter' => $character,
            'facility' => $facility,
            'price' => $price,
            'time' => $time,
            'percent' => $percent,
            'contract' => $request,
            'production' => $production,
            'storage' => $storage,
            'duration' => $duration,
        ]);
    }

    public function createContract(Request $request, $id)
    {
        $facility = Facility::find($id);

        $user_id = Auth::id();
        $character = Character::where('user_id', '=', $user_id)->first();

        if (!$facility) {
            Alert::toast('Invalid Facility.', 'error');
            return redirect()->route('visit-planet');
        }

        if ($character->id != $facility->base->character_id) {
            Alert::toast('This is not your base', 'warning');
            return redirect()->route('visit-planet');
        }

        if ($facility->base->activeContracts->count() >= $facility->level) {
            Alert::toast('Contract Limit Reached', 'error');
            return redirect()->route('visit-planet');
        }

        $time = calculateContractTime();
        $percent = calculateContractMaxSell();
        $duration = calculateContractMaxDuration();

        $this->validate($request, [
            'amount' => 'required|integer',
            'resource' => 'required|string',
            'frequency' => 'required|integer',
            'duration' => 'required|integer',
        ]);

        if ($request->resource != "ore" && $request->resource != "gas") {
            Alert::toast('Invalid material', 'error');
            return redirect()->route('visit-planet');
        }

        $price = materialSellPrice($facility->level, $request->resource, 'contract');

        $now = new Carbon();
        $expires = new Carbon();
        $contract = new Contract();

        $contract->base_id = $facility->base_id;
        $contract->resource = $request->resource;
        $contract->action = "sell";
        $contract->amount = $percent[$request->amount];
        $contract->price = $price;
        $contract->frequency = floor($time[$request->frequency] * 60);
        $contract->time = 0;
        $contract->next_at = $now->addSeconds(floor($time[$request->frequency] * 60));
        $contract->expires_at = $expires->addHours($duration[$request->duration]);
        $contract->status = "active";
        $contract->save();

        $character->money = $character->money - (($request->frequency + $request->amount + $request->duration) * config('game.contract_base_rate'));
        $character->save();

        Alert::toast("Contract created!", 'success');
        // return redirect()->route('visit-planet');
        return redirect()->route('show-facility', $facility->id);
    }
}
