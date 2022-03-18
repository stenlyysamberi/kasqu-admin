<?php

use App\Water;
use Illuminate\Database\Seeder;

class WaterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            'tinggi_air' => "5.0",
            'keterangan' => "Status Waspada!"
        ];
       Water::create($data);
    }
}
