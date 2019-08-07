<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UsersCastsArrayPublicKey extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('kty');
            $table->dropColumn('e');
            $table->dropColumn('n');

            $table->text('public_key');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('public_key');

            $table->string('kty', 8)->index()->comment('Key Type: RSA/ECSDA');
            $table->string('e', 16)->index()->comment('E');
            $table->text('n')->comment('N, 原则上要做唯一性判断');
        });
    }
}
