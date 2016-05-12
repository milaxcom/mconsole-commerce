<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommerceProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('commerce_products', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('product_id')->default(0)->nullable();
            $table->string('article')->nullable();
            $table->string('slug')->unique();
            $table->string('name');
            $table->text('description')->nullable();
            $table->json('tables')->nullable();
            $table->json('lists')->nullable();
            $table->integer('price')->nullable();
            $table->integer('discount_price')->nullable();
            $table->integer('increase_price')->nullable();
            $table->integer('decrease_price')->nullable();
            $table->integer('quantity')->default(0)->nullable();
            $table->boolean('in_stock')->default(true);
            $table->boolean('of_stock')->default(false);
            $table->boolean('on_request')->deafult(false);
            $table->boolean('enabled')->default(true);
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
        Schema::drop('commerce_products');
    }
}
