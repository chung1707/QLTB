<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DeletedEquipmentSellCart extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deleted_equipment_sell_cart', function (Blueprint $table) {
            $table->id();
            $table->integer('deleted_equipment_id');
            $table->integer('sell_cart_id');
            $table->integer('quantity')->default(1);
            $table->double('newPrice')->nullable();
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
        Schema::dropIfExists('deleted_equipment_sell_cart');
    }
}
