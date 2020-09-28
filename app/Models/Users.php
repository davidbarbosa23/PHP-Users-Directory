<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Users extends Model
{
    protected $table = 'users';

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

    public function register(\Request $request)
    {
        $this->name = $request->get('name');
        $this->email = $request->get('email');
        $this->country_id = $request->get('country_id');
        $this->password = password_hash($request->get('password'), PASSWORD_BCRYPT);

        return $this->save();
    }

    public function search($data)
    {
        $data = '%' . $data . '%';
        return $this
            ->where('name', 'like', $data)
            ->orWhere('email', 'like', $data)
            ->get();
    }
}
