<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table -> integer('client_id');
            $table -> dateTime('date') -> useCurrent();
            $table -> decimal('amount');
            $table -> text('notes');
            $table -> integer('type');
            $table -> integer('operation_id');
            $table -> integer('user_ins');
            $table -> integer('user_upd');
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
        Schema::dropIfExists('payments');
    }
}
