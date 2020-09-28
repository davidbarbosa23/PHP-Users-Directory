<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Customers extends Model
{
    protected $table = 'customers';

    protected $fillable = [
        'job_title',
        'email',
        'first_name',
        'last_name',
        'document',
        'phone_number',
        'country',
        'state',
        'city',
        'birthday',
        'lang'
    ];

    public function search(string $query)
    {
        $query = '%' . $query . '%';
        return $this
            ->where('first_name', 'like', $query)
            ->orWhere('last_name', 'like', $query)
            ->orWhere('email', 'like', $query)
            ->get();
    }

    public function validateData(array $data, string $lang) 
    {
        $relation = [
            'job_title' => 'cargo',
            'email' => 'correo',
            'first_name' => 'primer_nombre',
            'last_name' => 'apellido',
            'document' => 'cedula',
            'phone_number' => 'telefono',
            'country' => 'pais',
            'state' => 'departamento',
            'city' => 'ciudad',
            'birthday' => 'fecha_nacimiento'
        ];

        foreach ($data as $key => $value) {
            foreach ($value as $index => $origin) {
                if ($index == 'birthday' || $index == 'fecha_nacimiento') {
                    $data[$key][$index] = date('Y-m-d', strtotime($data[$key][$index]));
                }

                if ($newKey = array_search($index, $relation)) {
                    $data[$key][$newKey] = $data[$key][$index];
                    unset($data[$key][$index]);
                }

                $data[$key]['lang'] = $lang;
            }
        }

        return $data;
    }
}
