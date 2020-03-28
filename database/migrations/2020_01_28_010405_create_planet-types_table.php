<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlanetTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('planet_types', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('type');
            $table->decimal('ore_multiplier', 5, 3);
            $table->string('ore_type', 20);
            $table->decimal('gas_multiplier' , 5, 3);
            $table->string('gas_type', 20);
            $table->mediumInteger('average_diameter');
            $table->decimal('diameter_varience', 6, 4 );
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('planet_types');
    }
}
