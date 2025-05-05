<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWeightStatmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('weight_statments', function (Blueprint $table) {
            $table->id();
            $table -> integer('meal_id');
            $table -> integer('client_id');
            $table -> decimal('total_quantity');
            $table -> timestamp('date');
            $table -> decimal('weight');
            $table -> decimal('burlap_weight');
            $table -> decimal('net_weight');
            $table -> decimal('quantity');
            $table -> decimal('price');
            $table -> decimal('total');
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
        Schema::dropIfExists('weight_statments');
    }
}
