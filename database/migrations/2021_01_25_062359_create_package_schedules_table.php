<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePackageSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('package_schedules', function (Blueprint $table) {
            $table->id();
			$table->integer( 'package_id' );
			$table->integer( 'date' );
			$table->integer( 'sort' );
			$table->string( 'context', 100);
			$table->string( 'type', 20);
			$table->integer('tour_id')->nullable();
			$table->integer( 'city_id' );
			$table->integer( 'hotel_id' )->nullable();
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
        Schema::dropIfExists('package_schedules');
    }
}
