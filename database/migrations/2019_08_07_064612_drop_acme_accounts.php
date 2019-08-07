<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropAcmeAccounts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        require_once database_path('/migrations/2019_07_23_133139_create_acme_accounts.php');
        (new CreateAcmeAccounts)->down();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        require_once database_path('/migrations/2019_07_23_133139_create_acme_accounts.php');
        (new CreateAcmeAccounts)->up();
    }
}
