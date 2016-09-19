<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommercePromocodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('commerce_promocodes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code');
            $table->string('type');
            $table->integer('amount');
            $table->timestamp('started_at')->nullable();
            $table->timestamp('expired_at')->nullable();
            $table->boolean('one_off')->default(false);
            $table->boolean('used')->default(false);
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
        Schema::drop('commerce_promocodes');
    }
}
