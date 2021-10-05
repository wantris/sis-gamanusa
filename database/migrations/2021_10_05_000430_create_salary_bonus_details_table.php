<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalaryBonusDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('salary_bonus_details', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('salary_bonus_id')->unsigned();
            $table->bigInteger('employee_id')->unsigned();
            $table->integer('precentage');
            $table->char('nominal_total', 50);
            $table->timestamps();

            $table->foreign('salary_bonus_id')->references('id')->on('salary_bonuses')->onDelete('cascade');
            $table->foreign('employee_id')->references('id')->on('employees')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('salary_bonus_details');
    }
}
