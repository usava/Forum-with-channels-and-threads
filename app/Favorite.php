<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

/**
 * Class Favorite
 * @package App
 */
class Favorite extends Model
{
    use RecordsActivity;
    /**
     * @var array
     */
    protected $guarded = [];
    /**
     * @var int
     */

    /**
     * @return MorphTo
     */
    public function favorited()
    {
        return $this->morphTo();

    }

}
