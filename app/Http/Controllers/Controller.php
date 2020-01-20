<?php

namespace App\Http\Controllers;

use App\Action;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function makeAction($details)
    {
        $action = new Action();

        $action->character_id = $details['character'];
        $action->title = $details['title'];
        $action->type = $details['type'];
        $action->controller = $details['controller'];
        $action->target_id = $details['target'];

        $timeDisplay = $details['seconds'];
        $timeScale = "s";

        if ($timeDisplay > 60)
        {
            $timeDisplay = ($details['seconds'] / 60);
            $timeScale = "m";
        }

        if ($timeScale == "m" && $timeDisplay > 60)
        {
            $timeDisplay = ($details['seconds'] / 3600);
            $timeScale = "h";
        }

        if ($timeScale == "h" && $timeDisplay > 24) {
            $timeDisplay = ($details['seconds'] / 86400);
            $timeScale = "d";
        }

        $action->time = $timeDisplay . $timeScale;

        $theTime = Carbon::now();
        $theTime->addSeconds($details['seconds']);
        $action->finishes_at = $theTime;

        $action->save();

        return $action;
    }

    public function baseUpgradeCost($level)
    {
        $money['multiplier'] = config('formulas.bases_money_multiplier');
        $money['level_mod'] = config('formulas.bases_money_lvl_mod');
        $money['exp'] = config('formulas.bases_money_exponent');
        $money['add'] = config('formulas.bases_money_addition');

        $ore['multiplier'] = config('formulas.bases_ore_multiplier');
        $ore['level_mod'] = config('formulas.bases_ore_lvl_mod');
        $ore['exp'] = config('formulas.bases_ore_exponent');
        $ore['add'] = config('formulas.bases_ore_addition');

        $gas['multiplier'] = config('formulas.bases_gas_multiplier');
        $gas['level_mod'] = config('formulas.bases_gas_lvl_mod');
        $gas['exp'] = config('formulas.bases_gas_exponent');
        $gas['add'] = config('formulas.bases_gas_addition');

        $cost['money'] = floor( pow(($level + $money['level_mod']), $money['exp']) * $money['multiplier'] + $money['add'] );
        $cost['ore'] = floor( pow(($level + $ore['level_mod']), $ore['exp']) * $ore['multiplier'] + $ore['add'] );
        $cost['gas'] = floor( pow(($level + $gas['level_mod']), $gas['exp']) * $gas['multiplier'] + $gas['add'] );

        if (is_nan($cost['gas'])) { $cost['gas'] = 0; }

        return $cost;
    }

    public function facilityUpgradeCost($level)
    {
        $money['multiplier'] = config('formulas.facility_money_multiplier');
        $money['level_mod'] = config('formulas.facility_money_lvl_mod');
        $money['exp'] = config('formulas.facility_money_exponent');
        $money['add'] = config('formulas.facility_money_addition');

        $ore['multiplier'] = config('formulas.facility_ore_multiplier');
        $ore['level_mod'] = config('formulas.facility_ore_lvl_mod');
        $ore['exp'] = config('formulas.facility_ore_exponent');
        $ore['add'] = config('formulas.facility_ore_addition');

        $gas['multiplier'] = config('formulas.facility_gas_multiplier');
        $gas['level_mod'] = config('formulas.facility_gas_lvl_mod');
        $gas['exp'] = config('formulas.facility_gas_exponent');
        $gas['add'] = config('formulas.facility_gas_addition');

        $cost['money'] = floor( pow(($level + $money['level_mod']), $money['exp']) * $money['multiplier'] + $money['add'] );
        $cost['ore'] = floor( pow(($level + $ore['level_mod']), $ore['exp']) * $ore['multiplier'] + $ore['add'] );
        $cost['gas'] = floor( pow(($level + $gas['level_mod']), $gas['exp']) * $gas['multiplier'] + $gas['add'] );

        if (is_nan($cost['gas'])) { $cost['gas'] = 0; }
        return $cost;
    }
}
