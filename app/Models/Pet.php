<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pet extends Model
{
    use HasFactory;
    protected $fillable = ['cliente_id', 'nombre', 'tipo'];
    protected $table = 'mascotas';

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'cliente_id');
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }
}
