<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMealsExitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meals_exits', function (Blueprint $table) {
            $table->id();
            $table -> string('code');
            $table -> integer('meal_id');
            $table -> integer('item_id');
            $table -> dateTime('date') -> useCurrent();
            $table -> decimal('quantity');
            $table -> integer('client_id');
            $table -> decimal('outingTax');
            $table -> integer('duration');
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
        Schema::dropIfExists('meals_exits');
    }
}
