<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNewProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('new__products', function (Blueprint $table) {
            $table->id();            
            $table->string('product_code')->unique();
            $table->string('name');
            $table->string('category');
            $table->integer('stock');
            $table->string('unit_price');
            $table->string('sales_unit_price');
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
        Schema::dropIfExists('new__products');
    }
}
