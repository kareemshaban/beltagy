<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttendsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attends', function (Blueprint $table) {
            $table->id();
            $table -> integer('user_id');
            $table -> timestamp('date') -> useCurrent();
            $table -> string('on_duty');
            $table -> string('off_duty');
            $table -> string('clock_in');
            $table -> string('clock_out');
            $table -> string('late');
            $table -> string('early');
            $table -> integer('absent');
            $table -> string('workTimeAdd');
            $table -> string('workTime');
            $table -> string('workTimeLate');
            $table -> string('penaltyLate');
            $table -> integer('user_ins') -> default(0);
            $table -> integer('user_upd') -> default(0);
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
        Schema::dropIfExists('attends');
    }
}
