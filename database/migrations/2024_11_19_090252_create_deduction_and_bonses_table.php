<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeductionAndBonsesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deduction_and_bonses', function (Blueprint $table) {
            $table->id();
            $table -> integer('user_id');
            $table -> timestamp('date')  -> useCurrent();
            $table -> integer('type');
            $table -> decimal('hours');
            $table -> text('notes');
            $table -> integer('user_ins');
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
        Schema::dropIfExists('deduction_and_bonses');
    }
}
