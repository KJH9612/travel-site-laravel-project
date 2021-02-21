<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAirlineReservationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('airline_reservations', function (Blueprint $table) {
            $table->id();
			$table->integer('consumers_id');
			$table->integer('schedules_id');
			$table->integer('adult');
			$table->integer('child');
			$table->integer('infant');
			$table->integer('total');
			$table->integer('baggage');
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
        Schema::dropIfExists('airline_reservations');
    }
}
