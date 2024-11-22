<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdvancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('advances', function (Blueprint $table) {
            $table->id();
            $table -> integer('user_id');
            $table -> integer('type');
            $table -> timestamp('date') -> useCurrent();
            $table -> decimal('amount');
            $table -> decimal('monthlyPayment');
            $table -> timestamp('startDate');
            $table -> integer('paymentsCount');
            $table -> integer('remainPaymentsCount');
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
        Schema::dropIfExists('advances');
    }
}
