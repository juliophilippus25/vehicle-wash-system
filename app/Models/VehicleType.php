<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VehicleType extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'price'];

    public function transactions()
    {
        return $this->hasMany(Transaction::class, 'vehicle_type_id');
    }
}
