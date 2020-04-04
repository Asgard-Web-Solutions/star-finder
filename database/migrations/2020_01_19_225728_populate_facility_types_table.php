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
            ['name' => 'Titanium Mine',     'required_level' => 1, 'type' => 'mine',    'material' => 'ore',           'required_plan' => 'Ore Mine'],
            ['name' => 'Gas Mine',          'required_level' => 2, 'type' => 'mine',    'material' => 'gas',           'required_plan' => 'Gas Mine'],
            ['name' => 'Administration',    'required_level' => 3, 'type' => 'admin',   'material' => 'contract',     'required_plan' => 'Admin Office'],
            ['name' => 'Star Port',         'required_level' => 3, 'type' => 'starport', 'material' => 'research',     'required_plan' => 'Starport'],
            ['name' => 'University',        'required_level' => 3, 'type' => 'admin',   'material' => 'research',     'required_plan' => 'University'],
            ['name' => 'Factory',           'required_level' => 4, 'type' => 'factory', 'material' => 'material',   'required_plan' => 'Factory'],
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
        DB::table('facility_types')->where('name', '=', 'Administration')->delete();
        DB::table('facility_types')->where('name', '=', 'Star Port')->delete();
        DB::table('facility_types')->where('name', '=', 'University')->delete();
        DB::table('facility_types')->where('name', '=', 'Factory')->delete();
    }
}
