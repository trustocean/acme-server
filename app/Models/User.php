<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Interfaces\ModelInterface;

/**
 * App\Models\User
 *
 * @property int $id
 * @property string|null $email Email
 * @property array $public_key kty e n
 * @property string $fingerprint
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Order[] $orders
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereE($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereKty($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereN($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class User extends Model implements ModelInterface
{
    protected $fillable = [
        'email',
        'public_key',
        'fingerprint',
    ];

    protected $casts = [
        'public_key' => 'array',
        'fingerprint' => 'string',
        'email' => 'string',
    ];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
