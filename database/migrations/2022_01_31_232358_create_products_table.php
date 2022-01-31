<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->tinyInteger('cat_id')->unsigned();
            $table->string('product_number');
            $table->string('category_name');
            $table->string('department_name');
            $table->string('manufacturer_name');
            $table->float('upc');
            $table->float('sku');
            $table->float('regular_price');
            $table->float('sale_price');
            $table->longText('description');

            $table->foreign('cat_id')
                ->references('id')
                ->on('categories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
