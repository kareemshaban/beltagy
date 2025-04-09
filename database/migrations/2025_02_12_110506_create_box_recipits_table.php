<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBoxRecipitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('box_recipits', function (Blueprint $table) {
            $table->id();
            $table -> timestamp('date') -> useCurrent();
            $table -> integer('payment_type');
            $table -> decimal('amount');
            $table -> text('notes');
            $table -> integer('user_ins') ;
            $table -> integer('user_upd') -> default(0) ;
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
        Schema::dropIfExists('box_recipits');
    }
}
