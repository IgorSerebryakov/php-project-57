<?php

namespace App\Traits;

use App\Http\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;


trait HasFilter
{
    public function scopeFilter(Builder $builder, Filter $filter): Builder
    {
        return $filter->apply($builder);
    }
}
