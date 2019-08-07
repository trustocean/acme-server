<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Interfaces\ModelInterface;

/**
 * App\Models\Order
 *
 * @property int $id
 * @property int|null $ca_order_id
 * @property array $identifiers 域名  [ [ "type" => "dns", "value" => "www.zhihu.com" ],... ]
 * @property string $challenge_type
 * @property array|null $add_ssl_order_response TrustOcean 下单响应
 * @property array|null $get_order_status_response TrustOcean 状态查询
 * @property array|null $re_try_dcv_email_or_dcv_cechk_response TrustOcean 重新发送域名验证邮件或重新执行域名验证检查
 * @property array|null $get_domain_validation_status_response TrustOcean 域名验证状态
 * @property array|null $get_ssl_details_response TrustOcean 订单详情(包括证书获取)
 * @property string|null $csr CSR
 * @property int|null $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read mixed $fake_authorizations
 * @property-read mixed $authorizations
 * @property-read mixed $finalize
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereAccountId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereAddSslOrderResponse($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereGetDomainValidationStatusResponse($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereGetOrderStatusResponse($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereGetSslDetailsResponse($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereIdentifiers($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereReTryDcvEmailOrDcvCechkResponse($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereCaOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereChallengeType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereCsr($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereUserId($value)
 * @mixin \Eloquent
 */
class Order extends Model implements ModelInterface
{
    protected $fillable = [
        'identifiers',
        'add_ssl_order_response',
        'get_order_status_response',
        're_try_dcv_email_or_dcv_cechk_response',
        'get_domain_validation_status_response',
        'get_ssl_details_response',
        'csr',
        'ca_order_id',
        'challenge_type',
    ];

    protected $casts = [
        'identifiers' => 'array',
        'add_ssl_order_response' => 'array',
        'get_order_status_response' => 'array',
        're_try_dcv_email_or_dcv_cechk_response' => 'array',
        'get_domain_validation_status_response' => 'array',
        'get_ssl_details_response' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getAuthorizationsAttribute()
    {
        return collect($this->identifiers)->pluck('value')->map(function ($domain) {
            return route('acme.account.authz_detail', [$this->id, $domain]);
        });
    }

    public function getFinalizeAttribute()
    {
        return route('acme.account.authz_finalize', $this);
    }
}
