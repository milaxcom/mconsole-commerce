<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyCommerceProductsRenameDecreasePriceColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('commerce_products', function (Blueprint $table) {
            $table->renameColumn('discrease_price', 'decrease_price');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('commerce_products', function (Blueprint $table) {
            $table->renameColumn('decrease_price', 'discrease_price');
        });
    }
}
