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
            ['name' => 'Admin', 'color_class' => "red-700", 'name' => 'Admin', 'color_class' => "red-700"],
            ['name' => 'Moderator', 'color_class' => 'green-700', 'name' => 'Admin', 'color_class' => "red-700"],
            ['name' => 'Game Master', 'color_class' => 'blue-700', 'name' => 'Admin', 'color_class' => "red-700"],
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
