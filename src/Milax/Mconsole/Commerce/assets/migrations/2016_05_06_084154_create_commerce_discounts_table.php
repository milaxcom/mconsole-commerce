<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommerceDiscountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('commerce_discounts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('key')->nullable();
            $table->boolean('accumulative')->default(false);
            $table->string('name');
            $table->text('description')->nullable();
            $table->text('table');
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
        Schema::drop('commerce_discounts');
    }
}
