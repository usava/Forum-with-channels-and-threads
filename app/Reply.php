<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;

/**
 * Class Reply
 * @package App
 */
class Reply extends Model
{

    use Favoritable;

    /**
     * @var array
     */
    protected $guarded = [];
    /**
     * @var int
     */

    protected $with = ['owner', 'favorites'];

    /**
     * @return BelongsTo
     */
    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}
