<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLogTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
   public function up()
   {
       Schema::create('log', function (Blueprint $table) {
           $table->increments('ID');
           $table->integer('ID_User');
           $table->enum('action', ['INSERT', 'UPDATE', 'DELETE']);
           $table->integer('ID_Element');
           $table->ipAddress('IP_User');
           $table->string('Browser');
           $table->string('SO');
           $table->date('Action_Date');
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
       Schema::drop('log');
   }
}
