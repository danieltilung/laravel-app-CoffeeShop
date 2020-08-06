<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenudetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menudetails', function (Blueprint $table) {
            $table->biginteger('Item_id')->unsigned();
            $table->foreign('Item_id')->references('Item_id')-> on('items');
            $table->biginteger('Menu_id')->unsigned();
            $table->foreign('Menu_id')->references('Menu_id')-> on('menus');
            $table->integer('Quantity_need');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('menudetails');
    }
}
