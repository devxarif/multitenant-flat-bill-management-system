<?php
namespace App\Scopes;

use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class ScopesByOwner implements Scope
{
    public function apply(Builder $builder, Model $model)
    {
        $user = auth()->user();
        if ($user && $user->role === 'owner') {
            $builder->where($model->getTable() . '.owner_id', $user->id);
        }
    }
}
