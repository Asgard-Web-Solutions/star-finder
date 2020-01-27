<?php

return [
    'map_size' => 5,
    'starting_money' => 2000,
    'max_bases_per_planet' => 1,

    'cost_new_base' => 250,

    'time_new_base' => env('TIME_NEW_BASE', 300),
    'time_new_facility' => env('TIME_NEW_FACILITY', 300),

    'time_per_extraction' => '15m',
];