<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $guild_id
 * @property string $name
 * @property boolean $boss
 * @property boolean $level
 * @property string $dungeon_seed
 * @property string $created_at
 * @property string $updated_at
 * @property Guild $guild
 */
class Quest extends Model
{
    /**
     * The "type" of the auto-incrementing ID.
     * 
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['guild_id', 'name', 'boss', 'level', 'dungeon_seed', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function guild()
    {
        return $this->belongsTo('App\Guild');
    }
}
