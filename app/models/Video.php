<?php

/**
 * Class Video
 */
class Video extends Eloquent
{
    /**
     * @var array
     */
    protected $fillable = array('youtube_id', 'name', 'description', 'is_watched');

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function tags()
    {
        return $this->belongsToMany('Tag');
    }
}
