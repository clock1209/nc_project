<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->string('client');
            $table->string('user');
            $table->date('quote_date');
            $table->string('phone_number');
            $table->string('email');
            $table->string('address');
            $table->text('description');
            $table->float('budget');
            $table->float('retainer');
            $table->date('delivery_date');
            $table->string('priority')->default('Normal');
            $table->string('status')->default('En Progreso');
            $table->softDeletes();
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
        Schema::dropIfExists('orders');
    }
}
