<?php

return [
    // Format is (multiplier * (lvl + lvl_mod)^exponent) + addition
    'bases_money_multiplier' => 125,
    'bases_money_lvl_mod' => 0,
    'bases_money_exponent' => 1.2,
    'bases_money_addition' => 125,

    'bases_ore_lvl_mod' => -1,
    'bases_ore_exponent' => 2,
    'bases_ore_multiplier' => 50,
    'bases_ore_addition' => 0,

    'bases_gas_lvl_mod' => -2,
    'bases_gas_exponent' => 1.75,
    'bases_gas_multiplier' => 25,
    'bases_gas_addition' => 0,


    'facility_money_multiplier' => 60,
    'facility_money_lvl_mod' => 0,
    'facility_money_exponent' => 1.15,
    'facility_money_addition' => 60,

    'facility_ore_lvl_mod' => -1,
    'facility_ore_exponent' => 1.5,
    'facility_ore_multiplier' => 20,
    'facility_ore_addition' => 0,

    'facility_gas_lvl_mod' => -2,
    'facility_gas_exponent' => 1.25,
    'facility_gas_multiplier' => 15,
    'facility_gas_addition' => 0,

    // Mining per hour = multiplier * LVL + addition
    'mining_ore_multiplier' => env('MINING_ORE_MULTIPLIER', 125),
    'mining_ore_addition' => 25,

    'mining_gas_multiplier' => env('MINING_ORE_MULTIPLIER', 60),
    'mining_gas_addition' => 40,

    // Level ^ (exponent_storage + bonus) * base_storage
    'base_storage_ore' => 100,
    'exponent_storage_ore' => 2,
    
    'base_storage_gas' => 75,
    'exponent_storage_gas' => 2,

    'contract_base_expiration_days' => env('CONTRACT_EXPIRATION_DAYS', 1),
    'contract_increase_expiration_days' => env('CONTRACT_EXPIRATION_INCREASE', 2),
];