<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class PopulatePlanetTypes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('planet_types')->insert([
            ['type' => 'Earth like',    'ore_multiplier' => "1.000",    'ore_type' => "basic",  'gas_multiplier' => '1.000',    'gas_type' => "basic",  'average_diameter' => "6000",   'diameter_varience' => '30'],
            ['type' => 'hemi earth',    'ore_multiplier' => "1.000",    'ore_type' => "basic",  'gas_multiplier' => '0.700',    'gas_type' => "basic",  'average_diameter' => "4000",   'diameter_varience' => '40'],
            ['type' => 'rocky planet',  'ore_multiplier' => "1.500",    'ore_type' => "basic",  'gas_multiplier' => '0.400',    'gas_type' => "basic",  'average_diameter' => "2000",   'diameter_varience' => '70'],
            ['type' => 'ice planet',    'ore_multiplier' => "0.800",    'ore_type' => "basic",  'gas_multiplier' => '0.300',    'gas_type' => "basic",  'average_diameter' => "1500",   'diameter_varience' => '30'],
            ['type' => 'astroid belts', 'ore_multiplier' => "1.300",    'ore_type' => "basic",  'gas_multiplier' => '0.400',    'gas_type' => "basic",  'average_diameter' => "450",    'diameter_varience' => '90'],
            ['type' => 'melting planet', 'ore_multiplier' => "0.800",   'ore_type' => "basic",  'gas_multiplier' => '0.200',    'gas_type' => "basic",  'average_diameter' => "2000",   'diameter_varience' => '70'],
            ['type' => 'thick atmishere', 'ore_multiplier' => "0.900",  'ore_type' => "basic",  'gas_multiplier' => '1.300',    'gas_type' => "basic",  'average_diameter' => "9000",   'diameter_varience' => '50'],
            ['type' => 'ice giant',     'ore_multiplier' => "0.500",    'ore_type' => "basic",  'gas_multiplier' => '1.150',    'gas_type' => "advanced", 'average_diameter' => "30000", 'diameter_varience' => '20'],
            ['type' => 'gas giant',     'ore_multiplier' => "0.300",    'ore_type' => "advanced", 'gas_multiplier' => '1.600',  'gas_type' => "basic",  'average_diameter' => "90000",  'diameter_varience' => '90'],
            ['type' => 'brown drawf',   'ore_multiplier' => "0.200",    'ore_type' => "advanced", 'gas_multiplier' => '2.000',  'gas_type' => "advanced", 'average_diameter' => "80000", 'diameter_varience' => '30'],
            ['type' => 'kiper belt',    'ore_multiplier' => "0.850",    'ore_type' => "basic",  'gas_multiplier' => '0.300',    'gas_type' => "basic",  'average_diameter' => "750",    'diameter_varience' => '90'],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
