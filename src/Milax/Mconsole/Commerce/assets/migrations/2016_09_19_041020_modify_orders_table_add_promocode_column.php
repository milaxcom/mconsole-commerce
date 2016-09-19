<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyOrdersTableAddPromocodeColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('commerce_orders', function (Blueprint $table) {
            $table->json('promocode')->after('payment_method')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('commerce_orders', function (Blueprint $table) {
            $table->dropColumn('promocode');
        });
    }
}
