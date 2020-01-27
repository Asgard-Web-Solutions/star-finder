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
?>