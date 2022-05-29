<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShipTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ship_types', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('name');
            $table->longText('description');
            $table->text('category');
            $table->integer('level');
            $table->integer('health');
            $table->integer('shields');
            $table->integer('armor');
            $table->integer('storage_capacity');
            $table->integer('fuel_capacity');
            $table->decimal('light_speed');
            $table->integer('weight');
            $table->integer('cost');
            $table->integer('material_ore_basic');
            $table->integer('material_ore_adv');
            $table->integer('material_gas_basic');
            $table->integer('material_gas_adv');
            $table->integer('structual_upgrades');
            $table->integer('computer_upgrades');
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
        Schema::dropIfExists('ship_types');
    }
}
