<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    protected $fillable = ['cedula', 'nombres', 'apellidos', 'celular', 'email'];
    protected $table = 'clientes';

    public function pets()
    {
        return $this->hasMany(Pet::class, 'cliente_id');
    }
}
