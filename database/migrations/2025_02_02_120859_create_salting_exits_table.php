<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSaltingExitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('salting_exits', function (Blueprint $table) {
            $table->id();
            $table -> string('code');
            $table -> integer('salting_enter_id');
            $table -> integer('item_id');
            $table -> integer('client_id');
            $table -> dateTime('date') -> useCurrent();
            $table -> decimal('duration');
            $table -> decimal('quantity');
            $table ->decimal('serviceTotal') ;
            $table ->decimal('paid') ;
            $table ->decimal('remain') ;
            $table ->integer('isPaid') ;
            $table ->text('notes') ;
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
        Schema::dropIfExists('salting_exits');
    }
}
