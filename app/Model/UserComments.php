<?php

namespace App\Model;

use App\User;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * Class UserComments
 * @package App\Model
 */
class UserComments extends Authenticatable
{
    protected $table = 'user_comments';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'comment', 'user_id', 'commented_id'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
