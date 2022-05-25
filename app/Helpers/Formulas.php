<?php

    function calculateMiningSpeed($facilityLevel, $facilityBonus, $material, $planetBonus)
    {
        return (config('formulas.mining_' . $material . '_multiplier') * ($facilityLevel + $facilityBonus)) + config('formulas.mining_' . $material . '_addition') * $planetBonus;
    }

    function calculateMaxStorage($baseLevel, $baseBonus, $material)
    {
        return ($baseLevel ** (config('formulas.exponent_storage_' . $material) + $baseBonus)) * config('formulas.base_storage_' . $material);
    }

    function facilityUpgradeCost($level)
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

    function baseUpgradeCost($level)
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

    function maxBaseLevel($base)
    {
        return floor($base->planet->size / 2000);
    }

    function materialSellPrice($administrationLevel, $material, $vendor)
    {
        $baseCost = config('game.' . $material . '_value_reduction');
        $sellCost = ((2 + $administrationLevel) ** (1 - $baseCost) - 1)/(1 - $baseCost);

        $reduction = 0;

        if ($material == "ore") {
            $reduction = $reduction + 1.3;
        }

        if ($material == "gas") {
            $reduction = $reduction + .4;
        }

        if ($vendor == "direct") {
            $reduction = $reduction + 1.5;
        }

        if ($vendor == "contract") {
            $reduction = $reduction + 0.1;
        }

        if ($reduction < 1) {
            $reduction = 1;
        }

        $sellCost = $sellCost / $reduction;

        $sellCost = round($sellCost, 1);

        return $sellCost;
    }

    /**
     * @return $seconds
     */
    function calculateContractTime()
    {
        // returns number of seconds
        //return (( 54/60 ) ** ($level - 1)) * 60 * 60;
        $time[1] = 60;
        $time[2] = 54;
        $time[3] = 48.6;
        $time[4] = 43.7;
        $time[5] = 39.4;
        $time[6] = 35.4;
        $time[7] = 31.9;
        $time[8] = 28.7;
        $time[9] = 25.8;
        $time[10] = 23.2;
        $time[11] = 20.9;
        $time[12] = 18.8;
        $time[13] = 16.9;
        $time[14] = 15.3;
        $time[15] = 13.7;
        $time[16] = 12.4;
        $time[17] = 11.1;
        $time[18] = 10;

        return $time;
    }

    /**
     * @return $percent
     */
    function calculateContractMaxSell()
    {
        //return 10 * (($level) ** 0.66);
        
        $percent[1] = 10;
        $percent[2] = 16;
        $percent[3] = 21;
        $percent[4] = 25;
        $percent[5] = 29;
        $percent[6] = 33;
        $percent[7] = 36;
        $percent[8] = 39;
        $percent[9] = 43;
        $percent[10] = 46;
        $percent[11] = 49;
        $percent[12] = 52;
        $percent[13] = 54;
        $percent[14] = 57;
        $percent[15] = 60;
        $percent[16] = 62;
        $percent[17] = 65;
        $percent[18] = 67;

        return $percent;
    }

    function calculateContractMaxDuration()
    {
        $currentDays = 0;

        for ($i = 0; $i <= 18; $i ++) {
            $currentDays = $currentDays + $i;
            $duration[$i] = $currentDays * 24;
        }

        return $duration;
    }
?>
