<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->char('position_cd', 10);
            $table->char('name', 200);
            $table->char('nik', 20);
            $table->char('email', 100);
            $table->enum('gender', ['Laki-laki', 'Perempuan', 'Lainnya']);
            $table->string('photo')->nullable();
            $table->timestamps();

            $table->foreign('position_cd')->references('position_cd')->on('positions')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employees');
    }
}
