<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class PopulateFacilityTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('facility_types')->insert([
            ['name' => 'Titanium Mine', 'required_level' => 1, 'type' => 'mine'],
        ]);
        
        DB::table('facility_types')->insert([
            ['name' => 'Gas Mine', 'required_level' => 2, 'type' => 'mine'],
        ]);    

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('facility_types')->where('name', '=', 'Titanium Mine')->delete();
        DB::table('facility_types')->where('name', '=', 'Gas Mine')->delete();
    }
}
