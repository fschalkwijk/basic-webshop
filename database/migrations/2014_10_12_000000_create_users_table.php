<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::transaction(function(){
            Schema::create('users', function (Blueprint $table) {
                $table->increments('id');
                $table->text('email')->unique();
                $table->text('password')->nullable();
                $table->text('name');
                $table->text('address');
                $table->text('city');
                $table->text('zipcode');

                $table->rememberToken();

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
            Schema::drop('users');
        });
    }
}
