<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $user_id
 * @property string $name
 * @property int $experience
 * @property int $money
 * @property string $created_at
 * @property string $updated_at
 * @property User $user
 * @property CharacterHoldsItem[] $characterHoldsItems
 */
class Character extends Model
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
    protected $fillable = ['user_id', 'name', 'experience', 'money', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function characterHoldsItems()
    {
        return $this->hasMany('App\CharacterHoldsItem');
    }
}
