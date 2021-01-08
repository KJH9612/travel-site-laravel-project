<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blogs', function (Blueprint $table) {
            $table->bigIncrements('id'); // $table->id(); 와 동일
            $table->integer('user_id');
            $table->string('title', 255);
            $table->string('content', 255);
            $table->string('image', 255)->nullable();
            $table->dateTime('regdateTime')->nullable();
            $table->dateTime('updateTime')->nullable();
            $table->dateTime('deleteTime')->nullable();
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
        Schema::dropIfExists('blogs');
    }
}
