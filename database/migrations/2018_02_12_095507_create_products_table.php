<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::defaultStringLength(191);
        Schema::dropIfExists('tbl_product_images');
        Schema::dropIfExists('tbl_products');
        Schema::create('tbl_products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->text('description');
            $table->string('image');
            $table->integer('quantity');
            $table->integer('price');
            $table->integer('category_id')->unsigned()->index();
            $table->foreign('category_id')
                  ->references('id')
                  ->on('tbl_categories')
                  ->onDelete('cascade');
            $table->integer('brand_id')->unsigned()->index();
            $table->foreign('brand_id')
                  ->references('id')
                  ->on('tbl_brands')
                  ->onDelete('cascade');
            $table->string('meta_description');
            $table->string('meta_keywords');
            $table->integer('display_order');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable();
            $table->boolean('status');
        });

        Schema::create('tbl_product_images',function(Blueprint $table){
            $table->increments('id');
            $table->string('image');
            $table->integer('product_id')->unsigned()->index();
            $table->foreign('product_id')
                  ->references('id')
                  ->on('tbl_products')
                  ->onDelete('cascade');
             $table->integer('display_order');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_products');
    }
}
