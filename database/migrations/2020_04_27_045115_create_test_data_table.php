<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTestDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('test_data', function (Blueprint $table) {
            $table->increments('id');
            $table->string('user_id');
            $table->string('pulse_rate');
            $table->string('heart_beat');
            $table->string('temperature');
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
        Schema::dropIfExists('test_data');
    }
}
