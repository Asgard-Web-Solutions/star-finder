<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class PopulateStarTypes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('star_types')->insert([
            ['name' => 'Red Dwarf', 'diameter' => "13000", 'color' => 'red', 'probability' => "30"],
            ['name' => 'Orange Dwarf', 'diameter' => "45000", 'color' => 'Orange', 'probability' => "23"],
            ['name' => 'Yellow Dwarf', 'diameter' => "157000", 'color' => 'yellow', 'probability' => "17"],
            ['name' => 'Sun', 'diameter' => "864000", 'color' => 'white', 'probability' => "10"],
            ['name' => 'Blue Giant', 'diameter' => "3020000", 'color' => 'blue', 'probability' => "8"],
            ['name' => 'Orange Giant', 'diameter' => "25500000", 'color' => 'orange', 'probability' => "6"],
            ['name' => 'Red Giant', 'diameter' => "61500000", 'color' => 'red', 'probability' => "3"],
            ['name' => 'Red Supergiant', 'diameter' => "315000000", 'color' => 'red', 'probability' => "2"],
            ['name' => 'Neutron Star', 'diameter' => "10", 'color' => 'white', 'probability' => "1"],
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
