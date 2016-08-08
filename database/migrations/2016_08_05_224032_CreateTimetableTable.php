<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTimetableTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
     public function up()
     {
         Schema::create('timetable', function (Blueprint $table) {
             $table->increments('ID');
             $table->integer('ID_User');
             $table->dateTime('Time_Input');
             $table->dateTime('Time_Output');
             $table->date('Reg_date');
             $table->enum('Type', ['Turno', 'Comida']);
             $table->timestamps();
             $table->softDeletes();
         });
     }

     /**
      * Reverse the migrations.
      *
      * @return void
      */
     public function down()
     {
         Schema::drop('timetable');
     }
}
