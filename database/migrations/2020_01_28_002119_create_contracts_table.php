<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContractsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contracts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('base_id');
            $table->string('resource', 32);
            $table->string('action', 32);
            $table->tinyInteger('amount');
            $table->decimal('price', 8, 2);
            $table->smallInteger('frequency');
            $table->smallInteger('time');
            $table->string('status', 32);
            $table->dateTime('next_at');
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
        Schema::dropIfExists('contracts');
    }
}
