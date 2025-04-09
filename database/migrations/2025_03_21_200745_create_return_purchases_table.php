<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReturnPurchasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('return_purchases', function (Blueprint $table) {
            $table->id();
            $table -> integer('purchaseBillId');
            $table -> string('billNumber');
            $table -> timestamp('date') -> useCurrent();
            $table -> integer('client_id');
            $table -> decimal('total');
            $table -> decimal('discount');
            $table -> decimal('net');
            $table -> decimal('paid');
            $table -> decimal('remain');
            $table -> integer('isPaid');
            $table -> text('notes') ;
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
        Schema::dropIfExists('return_purchases');
    }
}
