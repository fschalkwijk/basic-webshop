<?php

namespace App\Scopes;

use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

use Auth;

class OwnerScope implements Scope
{
    /**
     * Apply a where clause to all queries for this model which
     * restricts results to results that belong to the logged in user
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $builder
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @return void
     */
    public function apply(Builder $builder, Model $model)
    {
        return $builder->where('user_id', Auth::check() ? Auth::user()->id : null);
    }
}
