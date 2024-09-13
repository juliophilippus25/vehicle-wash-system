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

    public function index () {
        $vTypes = VehicleType::get();
        return view('vehicletypes.index', compact('vTypes'));
    }
}
