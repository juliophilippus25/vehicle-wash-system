<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'phone'];

    // Digunakan untuk mendefinisikan relasi tabel
    // Cara baca kode program dibawah ini adalah satu Customer dapat memiliki banyak transaksi
    public function transactions()
    {
        return $this->hasMany(Transaction::class, 'customer_id');
    }
}
