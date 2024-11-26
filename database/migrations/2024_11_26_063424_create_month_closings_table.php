<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMonthClosingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('month_closings', function (Blueprint $table) {
            $table->id();
            $table -> timestamp('date') -> useCurrent();
            $table -> integer('user_id');
            $table -> decimal('attend_days_count');
            $table -> decimal('absence_days_count');
            $table -> decimal('deductions_days_count');
            $table -> decimal('bonse_days_count');
            $table -> decimal('deductions_amount');
            $table -> decimal('bonse_amount');
            $table -> decimal('advance_amount');
            $table -> decimal('net_salary');
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
        Schema::dropIfExists('month_closings');
    }
}
