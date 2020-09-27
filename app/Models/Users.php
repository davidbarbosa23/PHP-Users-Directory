<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Users extends Model
{
    protected $fillable = [
        'name',
        'country_id',
        'email',
        'password'
    ];

    protected $hidden = [
        'password'
    ];

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
