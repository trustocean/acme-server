<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrders extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('account_id')->index()->nullable();
            $table->unsignedBigInteger('ca_order_id')->index()->nullable();
            $table->text('identifiers')->comment('域名');
            $table->text('csr')->nullable()->comment('CSR');
            $table->text('add_ssl_order_response')->nullable()->default(null)->comment('TrustOcean 下单响应');
            $table->text('get_order_status_response')->nullable()->default(null)->comment('TrustOcean 状态查询');
            $table->text('re_try_dcv_email_or_dcv_cechk_response')->nullable()->default(null)->comment('TrustOcean 重新发送域名验证邮件或重新执行域名验证检查');
            $table->text('get_domain_validation_status_response')->nullable()->default(null)->comment('TrustOcean 域名验证状态');
            $table->text('get_ssl_details_response')->nullable()->default(null)->comment('TrustOcean 订单详情(包括证书获取)');
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
        Schema::dropIfExists('orders');
    }
}
