<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class PopulateSolarSystem extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('locations')->insert([
            ['x' => 0, 'y' => 0, 'system_id' => 1, 'discovered_by' => 0],
        ]);

        DB::table('systems')->insert([
            ['name' => 'Sol', 'location_id' => 1, 'star_type' => 1],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('locations')->where('x', '=', '0')->where('y', '=', '0')->delete();
        DB::table('systems')->where('name', '=', 'Sol')->delete();
    }
}
