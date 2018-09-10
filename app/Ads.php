<?php

namespace App;

use App\Model\AdsImages;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Ads
 * @package App
 */
class Ads extends Model
{
    /** @var string */
    protected $table = 'ads';

    /** @var array */
    protected $fillable = [
        'title',
        'body',
        'user_id',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function users()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function image()
    {
        return $this->hasOne(AdsImages::class, 'ads_id', 'id');
    }


}
