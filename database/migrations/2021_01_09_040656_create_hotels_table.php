<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHotelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hotels', function (Blueprint $table) {
            $table->id();
			$table->string('name',50);
            $table->integer('nation_id');
			$table->Integer('city_id');
			$table->string('gm_address',50);
			$table->string('address',50);
			$table->string('explain',512);
			$table->string('pic',50);
            $table->tinyInteger('star');
            $table->integer('geographic_id');
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
        Schema::dropIfExists('hotels');
    }
}
