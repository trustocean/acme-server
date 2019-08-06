<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('email', 64)->nullable()->comment('Email');
            $table->string('kty', 8)->index()->comment('Key Type: RSA/ECSDA');
            $table->string('e', 16)->index()->comment('E');
            $table->text('n')->comment('N, 原则上要做唯一性判断');

            $table->timestamps();
        });

        Schema::table('orders', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->nullable()->index();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');

        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn('user_id');
        });
    }
}
