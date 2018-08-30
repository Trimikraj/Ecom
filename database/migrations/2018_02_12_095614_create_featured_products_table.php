<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFeaturedProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::defaultStringLength(191);
        Schema::dropIfExists('tbl_featured_products');
        Schema::create('tbl_featured_products', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('product_id')->unsigned()->index();
            $table->foreign('product_id')
                  ->references('id')
                  ->on('tbl_products')
                  ->onDelete('cascade');
            $table->timestamp('featured_date')->useCurrent();
            $table->integer('special_price');
            $table->date('start_date');
            $table->date('end_date');
            $table->boolean('status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_featured_products');
    }
}
