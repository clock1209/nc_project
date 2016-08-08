<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
     public function up()
     {
         Schema::create('projects', function (Blueprint $table) {
             $table->increments('ID');
             $table->string('Name');
             $table->integer('ID_Client');
             $table->enum('Type', ['Interno', 'Externo']);
             $table->date('Date_Start');
             $table->date('Date_End');
             $table->string('Methodology');
             $table->integer('Status');
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
         Schema::drop('projects');
     }
}
