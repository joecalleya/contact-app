<?php

namespace App\Models\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class SimpleSoftDeleteScope implements Scope
{
    /**
     * Apply the scope to a given Eloquent query builder.
     *  php artisan make:scope SimpleSoftDeleteScope
     *
     * we can use this to apply global things to models , here we are only looking for non deleted
     */
    public function apply(Builder $builder, Model $model): void
    {
        $builder->whereNull('deleted_at');
    }

    public function extend(Builder $builder)
    {
        $this->addWithTrashed($builder);
        $this->addOnlyTrashed($builder);
    }

    //this function allows us to apply this query with global scope
    public function addWithTrashed(Builder $builder): void
    {
        $builder->macro('withTrashed', function(Builder $builder){
            return $builder->withoutGlobalScope($this);
        });
    }

    //this function allows us to apply this query with global scope
    public function addOnlyTrashed(Builder $builder): void
    {
        $builder->macro('onlyTrashed', function(Builder $builder){
            return $builder->withoutGlobalScope($this)->whereNotNull('deleted_at');
        });
    }
}
