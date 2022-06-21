<?php
namespace App\Traits;

use App\Scopes\UserScope;

/**
 * Scope all queries with currently logged in user
 */

trait BelongsToUser
{
    protected static function boot()
    {
        parent::boot();
        
        static::addGlobalScope(new UserScope);
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
