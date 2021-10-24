<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DeletedEquipmentSellBill extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deleted_equipment_sellbill', function (Blueprint $table) {
            $table->id();
            $table->integer('deleted_equipment_id');
            $table->integer('quantity');
            $table->double('price');
            $table->foreignId('sellbill_id')->constrained()->onDelete('cascade');
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
        Schema::dropIfExists('deleted_equipment_sellbill');
    }
}
