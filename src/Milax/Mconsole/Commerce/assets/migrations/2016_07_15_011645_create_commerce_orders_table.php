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
            $table->string('identifier');
            $table->string('status')->default('new');
            $table->string('slug')->nullable();
            $table->integer('user_id');
            $table->json('info');
            $table->json('cart');
            $table->json('delivery_type');
            $table->json('payment_method');
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

