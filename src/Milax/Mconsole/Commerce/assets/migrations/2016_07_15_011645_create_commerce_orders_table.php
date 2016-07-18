<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommerceOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('commerce_orders', function (Blueprint $table) {
            $table->increments('id');
            $table->string('number');
            $table->integer('user_id');
            $table->integer('delivery_type_id');
            $table->json('info');
            $table->json('cart');
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
        Schema::drop('commerce_orders');
    }
}

