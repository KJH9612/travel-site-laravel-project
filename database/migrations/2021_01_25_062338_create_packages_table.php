<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('packages', function (Blueprint $table) {
            $table->id();
			$table->string( 'name',50);
			$table->string( 'pic',255);
			$table->integer( 'nation_id' );
			$table->integer( 'adult_price' );
			$table->integer( 'kid_price' );
			$table->integer( 'baby_price' );
			$table->string( 'explain',512);
			$table->date( 'departure_date' );
			$table->date( 'arrival_date' );
			$table->integer( 'departure_schedule_id' );
			$table->integer( 'arrival_schedule_id' );
            $table->tinyInteger('star');
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
        Schema::dropIfExists('packages');
    }
}
