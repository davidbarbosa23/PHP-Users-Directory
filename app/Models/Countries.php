<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Countries extends Model
{
    public $timestamps = false;

    protected $table = 'countries';

    protected static function boot()
    {
        parent::boot();

        // Set Global Scope
        static::addGlobalScope(
            'active',
            function (Builder $builder) {
                $builder->whereActive(1);
            }
        );
    }
}
