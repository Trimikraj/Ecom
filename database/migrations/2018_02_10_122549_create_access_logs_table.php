<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccessLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_access_logs', function (Blueprint $table) {
            $table->increments('id');
            $table->ipAddress('ip_address');
            $table->timestamp('access_date')->useCurrent();
            $table->timestamp('updated_at')->nullable();
            $table->text('url');
            $table->string('method');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_access_logs');
    }
}
