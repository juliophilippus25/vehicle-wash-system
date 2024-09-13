<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VehicleTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\VehicleType::insert([
            [
              'id'  			=> 1,
              'name'  			=> 'Motor dibawah 250cc',
              'price'		    => '15000',
              'created_at'      => \Carbon\Carbon::now(),
              'updated_at'      => \Carbon\Carbon::now()
            ], [
              'id'  			=> 2,
              'name'  			=> 'Motor diatas 250cc',
              'price'		    => '30000',
              'created_at'      => \Carbon\Carbon::now(),
              'updated_at'      => \Carbon\Carbon::now()
            ], [
               'id'  			=> 3,
               'name'  			=> 'Mobil pribadi',
               'price'		    => '70000',
               'created_at'     => \Carbon\Carbon::now(),
               'updated_at'     => \Carbon\Carbon::now()
            ], [
               'id'  			=> 4,
               'name'  		    => 'Minibus',
               'price'		    => '150000',
               'created_at'     => \Carbon\Carbon::now(),
               'updated_at'     => \Carbon\Carbon::now()
            ],
        ]);
    }
}
