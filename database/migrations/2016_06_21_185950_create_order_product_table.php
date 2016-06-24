<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::transaction(function(){
            Schema::create('order_product', function (Blueprint $table) {
                $table->integer('order_id')->unsigned()->references('id')->on('orders')->onDelete('CASCADE');
                $table->integer('product_id')->unsigned()->references('id')->on('products')->onDelete('RESTRICT');
                $table->integer('amount');
                $table->decimal('price_each', 7, 2);
                $table->decimal('vat_percentage', 3, 2);

                $table->timestamp('created_at')->default(DB::raw('NOW()'));
                $table->timestamp('updated_at')->default(DB::raw('NOW()'));

                $table->primary(['order_id', 'product_id']);
            });
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::transaction(function(){
            Schema::drop('order_product');
        });
    }
}
