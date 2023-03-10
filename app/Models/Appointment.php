<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;
    protected $fillable = ['inicio', 'fin', 'mascota_id'];
    protected $table = 'citas';

    public function pet()
    {
        return $this->belongsTo(Pet::class, 'mascota_id');
    }
}
