<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReturnPurchaseDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('return_purchase_details', function (Blueprint $table) {
            $table->id();
            $table -> integer('return_purchase_id');
            $table -> timestamp('date') -> useCurrent();
            $table -> integer('item_id');
            $table -> decimal('quantity');
            $table -> decimal('weight');
            $table -> decimal('price');
            $table -> decimal('total');
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
        Schema::dropIfExists('return_purchase_details');
    }
}
