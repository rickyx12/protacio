<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EndingInventory extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('endingInventory',function(Blueprint $table){
            $table->string('inventoryLocation',50);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('endingInventory',function(Blueprint $table){
            $table->dropColumn('inventoryLocation');
        });
    }
}
