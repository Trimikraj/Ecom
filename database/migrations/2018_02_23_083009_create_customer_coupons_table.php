<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomerCouponsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_customer_coupons', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('coupon_id')->unsigned()->index();
            $table->foreign('coupon_id')
                  ->references('id')
                  ->on('tbl_coupons')
                  ->onDelete('cascade');
            $table->integer('customer_id')->unsigned()->index();
            $table->foreign('customer_id')
                  ->references('id')
                  ->on('tbl_customers');            
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable();
            $table->date('valid_until');
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
        Schema::dropIfExists('tbl_customer_coupons');
    }
}
