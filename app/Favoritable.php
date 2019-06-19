<?php


namespace App;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait Favoritable
{

    /**
     * @return bool
     */
    public function isFavorited()
    {
        return !!$this->favorites->where('user_id', auth()->id())->count();
    }

    /**
     * @return mixed
     */
    public function getFavoritesCountAttribute()
    {
        return $this->favorites->count();
    }

    /**
     * @return MorphMany
     */
    public function favorites()
    {
        return $this->morphMany(Favorite::class, 'favorited');
    }

    /**
     * @return Model
     */
    public function favorite()
    {
        if (!$this->favorites()->where(['user_id' => auth()->id()])->exists()) {
            return $this->favorites()->create(['user_id' => auth()->id()]);
        }
    }
}
