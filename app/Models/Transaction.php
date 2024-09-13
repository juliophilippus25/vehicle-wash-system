<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $primaryKey = 'transaction_code';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'transaction_code',
        'vehicle_type_id',
        'customer_id',
        'price'
    ];

    // Digunakan untuk mendefinisikan relasi tabel
    // Cara baca kode program dibawah ini adalah satu transaksi dapat memiliki satu tipe kendaraan
    public function vehicle_type()
    {
        return $this->belongsTo(VehicleType::class, 'vehicle_type_id');
    }

    // Digunakan untuk mendefinisikan relasi tabel
    // Cara baca kode program dibawah ini adalah satu transaksi dapat memiliki satu customer
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }
}
