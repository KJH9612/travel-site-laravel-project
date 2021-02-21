<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHreservationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hreservations', function (Blueprint $table) {
            $table->id();
			$table->date('check_in');
			$table->date('check_out');
			$table->tinyInteger('adult');
			$table->tinyInteger('child');
			$table->integer('price');
			$table->integer('hotel_id');
			$table->string('breakfast',10);
			$table->string('bedsize',10);
			$table->string('wifiegg',10);
			$table->integer('consumer_id');
            $table->integer('hroom_id');
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
        Schema::dropIfExists('hreservations');
    }
}
