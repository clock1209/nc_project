<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWebSupportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('web_supports', function (Blueprint $table) {
            $table->increments('id');
            $table->date('date');
            $table->string('user');
            $table->string('client');
            $table->string('domain');
            $table->string('motive');
            $table->string('description');
            $table->string('status');
            $table->string('attentiontime');
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
        Schema::dropIfExists('web_supports');
    }
}
