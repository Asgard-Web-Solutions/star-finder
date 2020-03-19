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
            ['type' => 'Red drawf', 'diameter' => "13000", 'color' => 'red', 'probability' => "30"],
            ['type' => 'Orange drawf', 'diameter' => "45000", 'color' => 'Orange', 'probability' => "23"],
            ['type' => 'Yellow drawf', 'diameter' => "157000", 'color' => 'yellow', 'probability' => "17"],
            ['type' => 'Sun', 'diameter' => "864000", 'color' => 'white', 'probability' => "10"],
            ['type' => 'Blue Giant', 'diameter' => "3020000", 'color' => 'blue', 'probability' => "8"],
            ['type' => 'Orange Giant', 'diameter' => "25500000", 'color' => 'orange', 'probability' => "6"],
            ['type' => 'Red Giant', 'diameter' => "61500000", 'color' => 'red', 'probability' => "3"],
            ['type' => 'Red Supergiant', 'diameter' => "315000000", 'color' => 'red', 'probability' => "2"],
            ['type' => 'Neutron Star', 'diameter' => "10", 'color' => 'white', 'probability' => "1"],
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
