<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('basket_id')->unsigned();

            $table->decimal('order_amount', 10, 4);
            $table->string('status', 30)->nullable();

            $table->string('name', 50)->nullable();
            $table->string('adress', 200)->nullable();
            $table->string('telephone', 20)->nullable();
            $table->string('phone', 20)->nullable();
            $table->string('bank', 20)->nullable();
            $table->integer('number_of_installments')->nullable();

            $table->timestamp('created_date')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_date')->default(DB::raw('CURRENT_TIMESTAMP on Update CURRENT_TIMESTAMP'));
            $table->softDeletes()->nullable();

            $table->foreign('basket_id')->references('id')->on('basket')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}