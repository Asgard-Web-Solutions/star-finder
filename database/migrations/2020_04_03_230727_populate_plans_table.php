<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class PopulatePlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('plans')->insert([
            ['name' => 'Gas Mine',          'learn_from' => 'default',    'level_required' => 0, 'type' => 'facility',    'description' => 'Allows the creation of Gas Mines'],
            ['name' => 'Ore Mine',          'learn_from' => 'default',    'level_required' => 0, 'type' => 'facility',    'description' => 'Allows the creation of Ore Mines'],
            ['name' => 'Factory',           'learn_from' => 'default',    'level_required' => 0, 'type' => 'facility',    'description' => 'Factories allow the creation of all kinds of items.'],
            ['name' => 'Starport',          'learn_from' => 'default',    'level_required' => 0, 'type' => 'facility',    'description' => 'Starports allow you to store your ships while on planet and lets you research new ship designs.'],

            ['name' => 'Admin Office',      'learn_from' => 'university', 'level_required' => 1, 'type' => 'facility',    'description' => 'Create and manage contracts to automatically sell your resources for Keplers.'],
            ['name' => 'Advanced Ore Mine', 'learn_from' => 'university', 'level_required' => 2, 'type' => 'facility',    'description' => 'Allows the creation of Advanced Ore Mines'],
            ['name' => 'Advanced Gas Mine', 'learn_from' => 'university', 'level_required' => 3, 'type' => 'facility',    'description' => 'Allows the creation of Advanced Gas Mines'],

            ['name' => 'Basic Shuttle',     'learn_from' => 'starport',   'level_required' => 1, 'type' => 'ship',        'description' => 'Basic shuttle that is a great place to start to travel to other planets in the solar system.'],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('plans')->where('name', '=', 'Gas Mine')->delete();
        DB::table('plans')->where('name', '=', 'Ore Mine')->delete();
        DB::table('plans')->where('name', '=', 'Factory')->delete();
        DB::table('plans')->where('name', '=', 'Starport')->delete();
        DB::table('plans')->where('name', '=', 'Admin Office')->delete();
        DB::table('plans')->where('name', '=', 'Advanced Ore Mine')->delete();
        DB::table('plans')->where('name', '=', 'Advanced Gas Mine')->delete();
        DB::table('plans')->where('name', '=', 'Basic Shuttle')->delete();
    }
}
