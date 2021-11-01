<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->char('nis', 20)->nullable();
            $table->bigInteger('user_id')->unsigned()->nullable();
            $table->char('fullname', 100);
            $table->enum('gender', ['Laki-laki', 'Perempuan']);
            $table->char('place_of_birth', 100);
            $table->date('date_of_birth');
            $table->text('address');
            $table->char('phone', 20);
            $table->char('email', 100);
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('students');
    }
}
