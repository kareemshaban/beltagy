<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMealsEntersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meals_enters', function (Blueprint $table) {
            $table->id();
            $table -> string('code');
            $table -> integer('item_id');
            $table ->decimal('enteringTax') ;
            $table -> dateTime('date') -> useCurrent();
            $table -> decimal('quantity');
            $table ->decimal('outingQuantity') ;
            $table ->text('notes') ;
            $table -> integer('client_id');
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
        Schema::dropIfExists('meals_enters');
    }
}
