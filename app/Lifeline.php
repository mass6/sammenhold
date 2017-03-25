<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Lifeline
 *
 * @package App
 */
class Lifeline extends Model
{
    /**
     * @var array
     */
    protected $guarded = [];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
