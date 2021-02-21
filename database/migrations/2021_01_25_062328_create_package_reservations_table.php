<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePackageReservationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('package_reservations', function (Blueprint $table) {
            $table->id();
			$table->integer( 'package_id' );
			$table->integer( 'consumer_id' );
			$table->integer( 'adult' );
			$table->integer( 'kid' );
			$table->integer( 'baby' );
			$table->integer( 'total' );
			$table->integer( 'service_total' );
			$table->integer( 'package_total' );
			$table->string( 'breakfast', 10);
			$table->string( 'bedsize', 10);
			$table->string( 'wifi', 10);
			$table->string( 'airplaneup', 10);
			$table->string( 'shuttle', 10);
            $table->boolean('review');
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
        Schema::dropIfExists('package_reservations');
    }
}
