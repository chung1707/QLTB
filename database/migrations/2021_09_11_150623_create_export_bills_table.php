<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExportBillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exportbills', function (Blueprint $table) {
            $table->id();
            $table->string('transaction_id');
            $table->foreignId('area_id')->nullable()->constrained()->onDelete('cascade');
            $table->integer('room_id')->nullable();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->text('note')->nullable();
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
        Schema::dropIfExists('exportbills');
    }
}
