<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUndeliveredsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('undelivereds', function (Blueprint $table) {
            $table->id();
            $table->integer('qnty');
            $table->integer('undelivered_qnty')->default(0);
            $table->integer('prod_disc')->nullable();
            $table->unsignedBigInteger('product_id');
            $table->string('unit_price');
            $table->string('production_price');
            $table->unsignedBigInteger('req_id');
            $table->integer('del_qnt')->default(0);
            $table->boolean('is_approved')->default(0);
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('req_id')->references('id')->on('sell_requests')->onDelete('cascade');
            $table->integer('deleted')->default(0);
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
        Schema::dropIfExists('undelivereds');
    }
}
