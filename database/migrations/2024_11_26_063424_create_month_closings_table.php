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
            $table -> decimal('requiredHours');
            $table -> decimal('requiredMinutes');
            $table -> decimal('actualHours');
            $table -> decimal('actualMinutes');
            $table -> decimal('lateHours');
            $table -> decimal('lateMinutes');
            $table -> decimal('additionalHours');
            $table -> decimal('additionalMinutes');
            $table -> decimal('rewardHours');
            $table -> decimal('rewardMinutes');
            $table -> decimal('deductionHours');
            $table -> decimal('deductionMinutes');
            $table -> decimal('rewardMoney');
            $table -> decimal('deductionMoney');
            $table -> decimal('advances');
            $table -> decimal('netHours');
            $table -> decimal('netMinutes');
            $table -> decimal('salary');
            $table -> decimal('netSalary');
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
