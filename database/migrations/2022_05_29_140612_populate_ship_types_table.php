<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class PopulateShipTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('ship_types')->insert([
            ['name' => 'Basic Shuttle Craft', 'category' => 'personal', 'level' => '1', 'health' => '100', 'shields' => '50', 'armor' => '50', 'storage_capacity' => '75', 'fuel_capacity' => '150', 'light_speed' => '0.1', 'weight' => '50', 'cost' => '5000', 'material_ore_basic' => '1750', 'material_ore_adv' => '0', 'material_gas_basic' => '750', 'material_gas_adv' => '0', 'structual_upgrades' => '0', 'computer_upgrades' => '1',  'description' => "Small personal craft for moving around a solar system."],
            ['name' => 'Basic Cargo Hauler', 'category' => 'cargo', 'level' => '1', 'health' => '75', 'shields' => '50', 'armor' => '50', 'storage_capacity' => '400', 'fuel_capacity' => '250', 'light_speed' => '0.05', 'weight' => '500', 'cost' => '7500', 'material_ore_basic' => '2250', 'material_ore_adv' => '0', 'material_gas_basic' => '1200', 'material_gas_adv' => '0', 'structual_upgrades' => '1', 'computer_upgrades' => '0',  'description' => "Small cargo hauler for carrying goods to another planet. Great for jump starting a new base."],
            ['name' => 'Basic Exploration Craft', 'category' => 'exploration', 'level' => '1', 'health' => '125', 'shields' => '100', 'armor' => '50', 'storage_capacity' => '35', 'fuel_capacity' => '450', 'light_speed' => '0.25', 'weight' => '40', 'cost' => '10000', 'material_ore_basic' => '1250', 'material_ore_adv' => '0', 'material_gas_basic' => '1600', 'material_gas_adv' => '0', 'structual_upgrades' => '1', 'computer_upgrades' => '1',  'description' => "Small exploration craft great for getting to the outter reaches of a solar system."],
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
