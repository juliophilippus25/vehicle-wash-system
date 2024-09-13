<?php

namespace App\Http\Controllers;

use App\Models\VehicleType;
use Illuminate\Http\Request;

class VehicleTypeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Fungsi ini untuk memanggil view index yang digunakan untuk menampilkan halaman utama vehicle types
    public function index () {
        // Membuat variabel $vTypes untuk menampilkan data dari tabel vehicle_types dengan method get() 
        $vTypes = VehicleType::get();

        // Kode program dibawah untuk memanggil view index yang dimana dalam folder vehicletypes terdapat file index
        // dan compact untuk mengembalikan data atau variabel yang dapat digunakan dalam view
        return view('vehicletypes.index', compact('vTypes'));
    }
}
