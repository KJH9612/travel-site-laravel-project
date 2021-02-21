<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConsumersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('consumers', function (Blueprint $table) {
            $table->id();
			$table->string('uid', 20);
			$table->string('pwd', 20);
			$table->string('name', 20);
			$table->date('birthday');
			$table->string('email', 40)->nullable();
			$table->string('tel', 20);
			$table->tinyinteger('gender');
			$table->string('pic', 30)->nullable();
			$table->tinyInteger('rank')->default(0);
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
        Schema::dropIfExists('consumers');
    }
}
