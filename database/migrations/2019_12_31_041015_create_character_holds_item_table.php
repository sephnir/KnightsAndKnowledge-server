<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCharacterHoldsItemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('character_holds_item', function (Blueprint $table) {
            $table->unsignedBigInteger('character_id');
            $table->unsignedBigInteger('item_id');
            $table->foreign('character_id')->references('id')->on('characters');
            $table->foreign('item_id')->references('id')->on('items');
            $table->integer('quantity');
            $table->index(['character_id', 'item_id']);
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
        Schema::dropIfExists('character_holds_item');
    }
}
