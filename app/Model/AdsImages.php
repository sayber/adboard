<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * Class AdsImages
 * @package App\Model
 */
class AdsImages extends Model
{
    /** @var string  */
    protected $table = 'ads_images';

    /** @var array */
    protected $fillable = [
        'name',
        'type',
        'extension',
        'ads_id',
    ];
}
