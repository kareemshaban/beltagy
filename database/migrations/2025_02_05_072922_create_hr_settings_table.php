<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHrSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hr_settings', function (Blueprint $table) {
            $table->id();
            $table->decimal('allowLate')->default(0);
            $table->decimal('allowEarly')->default(0);
            $table->decimal('absentPenalty')->default(0);
            $table->decimal('user_ins')->default(0);
            $table->decimal('user_upd')->default(0);
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
        Schema::dropIfExists('hr_settings');
    }
}
