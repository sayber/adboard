<?php

namespace App\Model;

use App\User;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * Class UserRank
 * @package App\Model
 */
class UserRank extends Authenticatable
{
    protected $table = 'user_rank';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'amount', 'user_id', 'ranked_id'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user()
    {
        return $this->hasOne(User::class);
    }

}
