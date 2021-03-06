<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::transaction(function(){
            Schema::create('orders', function (Blueprint $table) {
                $table->increments('id');
                $table->text('transaction_id')->nullable();
                $table->text('user_id')->unsigned()->nullable()->references('id')->on('users')->onDelete('RESTRICT');
                $table->text('email');
                $table->text('name');
                $table->text('address');
                $table->text('city');
                $table->text('zipcode');
                $table->timestamp('verified_at')->nullable();

                $table->timestamp('created_at')->default(DB::raw('NOW()'));
                $table->timestamp('updated_at')->default(DB::raw('NOW()'));
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
            Schema::drop('orders');
        });
    }
}
