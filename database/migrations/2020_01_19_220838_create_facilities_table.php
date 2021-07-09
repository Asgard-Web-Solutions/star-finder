<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFacilitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('facilities', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('base_id');
            $table->integer('facility_type_id');
            $table->integer('level')->default(1);
            $table->decimal('bonus', 8, 5);
            $table->string('status', 32);
            $table->dateTime('mined_at')->nullable();
            $table->boolean('full')->default(0);
            $table->bigInteger('researching')->nullable();
            $table->decimal('research_progress', 8,2)->nullable();
            $table->dateTime('researched_at')->nullable();
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
        Schema::dropIfExists('facilities');
    }
}
