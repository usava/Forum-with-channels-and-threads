<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Thread
 * @package App
 */
class Thread extends Model
{
    /**
     * @var array
     */
    protected $guarded = [];

    /**
     * @return string
     */
    public function path()
    {
        return '/threads/' . $this->id;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function replies()
    {
        return $this->hasMany(Reply::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * @param $reply
     * @return $this
     */
    public function addReply($reply)
    {
        $this->replies()->create($reply);
        return $this;
    }
}
