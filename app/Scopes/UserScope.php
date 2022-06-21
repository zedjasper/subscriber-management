<?php
namespace App\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Auth;

/**
 * Scope queries with user_id
 */
class UserScope implements Scope
{
    public function apply(Builder $builder, Model $model)
    {
        $userId = 0;

        if (Auth::user()) {
            $userId = Auth::user()->id ? Auth::user()->id : -1;
        }

        if ($userId) {
            $builder->where('user_id', $userId);
        }
    }
}
