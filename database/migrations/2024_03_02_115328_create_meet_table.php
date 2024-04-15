<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMeetTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meet', function (Blueprint $table) {
            $table->increments('id');
            $table->string('email')->nullable();
            $table->unsignedBigInteger('patient_id')->nullable();
            $table->longText('link')->nullable();
            $table->integer('status')->nullable();
            $table->dateTime('date_and_time')->nullable();
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
        Schema::dropIfExists('meet');
    }
}
