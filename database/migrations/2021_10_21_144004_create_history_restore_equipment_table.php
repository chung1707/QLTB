<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistoryRestoreEquipmentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('history_restore_equipment', function (Blueprint $table) {
            $table->id();
            $table->foreignId('equipment_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->integer('room_id')->nullable();
            $table->foreignId('area_id')->nullable()->constrained()->onDelete('cascade');
            $table->integer('quantity')->default(1);
            $table->text('note')->nullable();
            $table->string('locate')->default('Kho thiết bị');
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
        Schema::dropIfExists('history_restore_equipment');
    }
}
