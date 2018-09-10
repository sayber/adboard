<?php

namespace App\Model;

use App\User;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * Class UserInfo
 * @package App\Model
 */
class UserInfo extends Authenticatable
{
    protected $table = 'user_info';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'firstname', 'lastname', 'secondname', 'phone'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user()
    {
        return $this->hasOne(User::class);
    }

}
